<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatDetail;
use App\Models\DetailProjek;
use App\Models\FotoKerusakan;
use App\Models\JenisKerusakan;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelHasRoles;
use App\Models\Permission;
use App\Models\Projek;
use App\Models\RolePermission;
use App\Models\Roles;
use App\Models\Tukang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class GuestController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:guest-proyek-list', ['only' => ['guest-proyek-list']]);
        $this->middleware('permission:approval-pm', ['only' => ['approval-pm']]);
        $this->middleware('permission:approval-app', ['only' => ['approval-app']]);
        $this->middleware('permission:approval-ap1', ['only' => ['approval-ap1']]);
    }

    public function index()
    {
        // $projeks = Projek::where('owner', '=', Auth::user()->id)
        //                 ->get();

        $projeks = Projek::select('projeks.*', 'A.name as approval_pm_id', 'B.name as approval_app_id', 'C.name as approval_ap1_id')
                            ->leftjoin('users AS A', 'A.id', '=', 'projeks.approval_pm_id')
                            ->leftjoin('users AS B', 'B.id', '=', 'projeks.approval_app_id')
                            ->leftjoin('users AS C', 'C.id', '=', 'projeks.approval_ap1_id')
                            ->where([
                                ['projeks.tanggal', '!=', date('Y-m-d')],
                                ['projeks.status_pekerjaan', '!=', 'Reject']
                            ])
                            ->get();

        return view('guest.projek.index', compact('projeks'));
    }

    public function show($id)
    {
        $projeks = Projek::where('projeks.id', '=', $id)->first();
                            
        $tukangs = User::select('tukangs.projek_id', 'users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                        ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                        ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                        ->leftjoin('tukangs', 'tukangs.user_id', '=', 'users.id')
                        ->leftjoin('projeks', 'projeks.id', '=', 'tukangs.projek_id')
                        ->where('roles.name', '=', "Karyawan")
                        ->get();

        $chatdetails = ChatDetail::select('chat_details.*', 'users.name', 'users.foto')
                            ->leftjoin('chats', 'chats.slug', '=', 'chat_details.chat_id')
                            ->leftjoin('users', 'users.id', '=', 'chat_details.pengirim')
                            ->leftjoin('projeks', 'projeks.id', '=', 'chats.projek_id')
                            ->where('chats.projek_id', '=', $id)
                            ->get();
        
        $detailprojeks = DetailProjek::select('detail_projeks.*', 'projeks.id as pid', 'projeks.uraian_pekerjaan', 'projeks.tanggal')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'detail_projeks.projek_id')
                                    ->orderBy('detail_projeks.id', 'DESC')
                                    ->where('projek_id', $id)
                                    ->get();

        $chats = Chat::where('projek_id', '=', $id)->first();

        return view('guest.projek.show', compact('projeks', 'tukangs', 'chatdetails', 'chats', 'detailprojeks'));
    }

    public function chat_detail_add(Request $request)
    {
        $this->validate($request, [
            'komentar'  => 'required',
        ]); 
        $chatdetail = ChatDetail::create([
            'komentar'   => $request->komentar,
            'chat_id'   => $request->chat_id,
            'pengirim'   => $request->user_id,
        ]);

        toastr()->success('Chat berhasil terkirim!');
        // return redirect()->route('projek.show', [$request->projek_id, '#chat']);
        return redirect()->route('proyek.show', [$request->projek_id])->withFragment('chat');
    }

    public function detail_show($id)
    {
        $detailprojeks = DetailProjek::select('detail_projeks.*', 'projeks.uraian_pekerjaan')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'detail_projeks.projek_id')
                                    ->where('detail_projeks.id', '=', $id)
                                    ->first();

        $jenis_kerusakan = JenisKerusakan::select('jenis_kerusakans.*', 'detail_projeks.id as pid', 'list_pekerjaans.nama_pekerjaan')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'jenis_kerusakans.id_projeks')
                                    ->leftjoin('detail_projeks', 'detail_projeks.id', '=', 'jenis_kerusakans.id_detail_projeks')
                                    ->leftjoin('list_pekerjaans', 'list_pekerjaans.id', '=', 'jenis_kerusakans.nama_kerusakan')
                                    ->orderBy('detail_projeks.id', 'DESC')
                                    ->where('jenis_kerusakans.id_detail_projeks', '=', $id)
                                    ->get();

        $foto_kerusakan = FotoKerusakan::select('foto_kerusakans.*', 'detail_projeks.id as pid')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'foto_kerusakans.id_projek')
                                    ->leftjoin('detail_projeks', 'detail_projeks.id', '=', 'foto_kerusakans.id_detail_projek')
                                    ->orderBy('detail_projeks.id', 'DESC')
                                    ->where('foto_kerusakans.id_detail_projek', '=', $id)
                                    ->get();

        return view('guest.projek.detail_show', compact('detailprojeks', 'jenis_kerusakan', 'foto_kerusakan'));
    }

    public function approval_app(Request $request)
    {
        $projek = Projek::findOrFail($request->id);
        $projek->update([
            'tanggal_approval_app'   => date('Y-m-d H:i:s'),
            'approval_app'   => $request->approval_app,
            'komen_app'   => $request->komen_app,
            'approval_app_id' => Auth::user()->id
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('proyek.index');
    }

    public function approval_ap1(Request $request)
    {
        $projek = Projek::findOrFail($request->id);
        $projek->update([
            'tanggal_approval_ap1'   => date('Y-m-d H:i:s'),
            'approval_ap1'   => $request->approval_ap1,
            'komen_ap1'   => $request->komen_ap1,
            'status_pekerjaan'   => $request->approval_ap1,
            'approval_ap1_id' => Auth::user()->id
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('proyek.index');
    }
}
