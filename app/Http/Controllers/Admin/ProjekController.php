<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\AbsenLembur;
use App\Models\Chat;
use App\Models\ChatDetail;
use App\Models\DetailProjek;
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

class ProjekController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:projek-list', ['only' => ['projek']]);
        $this->middleware('permission:projek-add', ['only' => ['projek_add']]);
        $this->middleware('permission:projek-update', ['only' => ['projek_update']]);
        $this->middleware('permission:projek-destroy', ['only' => ['projek_destroy']]);

        $this->middleware('permission:approval-pm', ['only' => ['approval_pm']]);
        $this->middleware('permission:approval-app', ['only' => ['approval_app']]);
        $this->middleware('permission:approval-ap1', ['only' => ['approval_ap1']]);
    }

    public function index()
    {
        $level = ModelHasRoles::select('model_has_roles.*', 'roles.name')
                        ->leftjoin('users', 'users.id', '=', 'model_has_roles.model_id')
                        ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                        ->where('model_has_roles.model_id', Auth::user()->id)
                        ->first();
        
        if($level['name'] == 'APP' || $level['name'] == 'AP1')
        {
            toastr()->error('Anda dilarang masuk ke area ini.', 'Oopss...');
            return redirect()->to('/');
        }

        // $projeks = Projek::latest()->when(request()->q, function($projeks) {
        //     $projeks = $projeks->where('nama_pekerjaan', 'like', '%'. request()->q . '%');
        // })->paginate(10);

        $projeks = Projek::select('projeks.*', 'A.name as approval_pm_id', 'B.name as approval_app_id', 'C.name as approval_ap1_id')
                            ->leftjoin('users AS A', 'A.id', '=', 'projeks.approval_pm_id')
                            ->leftjoin('users AS B', 'B.id', '=', 'projeks.approval_app_id')
                            ->leftjoin('users AS C', 'C.id', '=', 'projeks.approval_ap1_id')
                            ->get();

        return view('admin.projek.index', compact('projeks', 'level'));
    }

    public function show($id)
    {
        $projeks = Projek::select('projeks.*')
                        // ->leftjoin('users', 'users.id', '=', 'projeks.marketing')
                        ->where('id', '=', $id)
                        ->first();
        
        // $tukangs = Tukang::select('tukangs.*', 'projeks.nama_projek', 'users.name', 'shifts.nama_shift')
        //                     ->leftjoin('projeks', 'projeks.id', '=', 'tukangs.projek_id')
        //                     ->leftjoin('users', 'users.id', '=', 'tukangs.user_id')
        //                     ->leftjoin('shifts', 'shifts.id', '=', 'tukangs.shift_id')
        //                     ->orderBy('tukangs.id', 'desc')
        //                     ->where('projeks.id', '=', $id)
        //                     ->get();
                            
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
        
        $detailprojeks = DetailProjek::select('detail_projeks.*', 'projeks.id as pid', 'projeks.tanggal')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'detail_projeks.projek_id')
                                    ->orderBy('detail_projeks.id', 'DESC')
                                    ->where('projek_id', $id)
                                    ->get();
                                    

        $jenis_kerusakan = JenisKerusakan::select('jenis_kerusakans.*', 'detail_projeks.id as pid', 'list_pekerjaans.nama_pekerjaan')
                                            ->leftjoin('projeks', 'projeks.id', '=', 'jenis_kerusakans.id_projeks')
                                            ->leftjoin('detail_projeks', 'detail_projeks.id', '=', 'jenis_kerusakans.id_detail_projeks')
                                            ->leftjoin('list_pekerjaans', 'list_pekerjaans.id', '=', 'jenis_kerusakans.nama_kerusakan')
                                            ->orderBy('detail_projeks.id', 'DESC')
                                            ->where('jenis_kerusakans.id_projeks', '=', $id)
                                            ->get();

        $chats = Chat::where('projek_id', '=', $id)->first();

        return view('admin.projek.show', compact('tukangs', 'chatdetails', 'chats', 'detailprojeks', 'jenis_kerusakan', 'projeks'));
    }

    public function create()
    {
        $marketing = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Marketing")
                    ->get();

        $pm = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "PM")
                    ->get();

        $supervisor = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Supervisor")
                    ->get();

        $owner = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Owner")
                    ->get();

        return view('admin.projek.create', compact('marketing', 'pm', 'supervisor', 'owner'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'tanggal'  => 'required',
            'uraian_pekerjaan'  => 'required',
        ]); 
        $projek = Projek::create([
            'tanggal'   => $request->tanggal,
            'uraian_pekerjaan'   => $request->uraian_pekerjaan,
            'status_pekerjaan'   => "belum",
            'approval_pm'   => "Belum",
            'approval_app'   => "Belum",
            'approval_ap1'   => "Belum",
            'edit_by'   => Auth::user()->id,
        ]);

        toastr()->success('Data berhasil disimpan!');
        // return redirect()->route('projek.index', [ $request->idjadwal, '#team']);
        return redirect()->route('projek.index');
    }

    public function edit($id)
    {
        $projek = Projek::where('id', '=', $id)->first();

        // $marketing = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
        //             ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        //             ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        //             ->where('roles.name', '=', "Marketing")
        //             ->get();

        // $pm = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
        //             ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        //             ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        //             ->where('roles.name', '=', "PM")
        //             ->get();

        // $supervisor = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
        //             ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        //             ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        //             ->where('roles.name', '=', "Supervisor")
        //             ->get();

        // $owner = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
        //             ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        //             ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        //             ->where('roles.name', '=', "Owner")
        //             ->get();

        return view('admin.projek.edit', compact('projek'));
    }

    
    public function update(Request $request)
    {
        $this->validate($request, [
            'tanggal'  => 'required',
            'uraian_pekerjaan'  => 'required',
        ]); 

        $projek = Projek::findOrFail($request->id);
        $projek->update([
            'tanggal'   => $request->tanggal,
            'uraian_pekerjaan'   => $request->uraian_pekerjaan,
            'edit_by'   => Auth::user()->id,
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('projek.index');
    }

    
    public function delete($id)
    {
        $projek = Projek::find($id);
            
            // $chat = DB::table('chat')->where('projek_id', '=', $projek->id)->delete();
            $chat = Chat::where('projek_id', '=', $projek->id)->first();
            if($chat != null) {
                $chat_detail = ChatDetail::where('chat_id', '=', $chat->slug)->first();
                if($chat_detail != null) {
                    $chat_detail->delete();
                }
                $chat->delete();
            }
            $jenis_kerusakan = DB::table('jenis_kerusakans')->where('id_projeks', '=', $projek->id)->delete();
            $detail_projek = DB::table('detail_projeks')->where('projek_id', '=', $projek->id)->delete();

        $projek->delete();

        toastr()->success('Data berhasil dihapus!');
        return redirect()->route('projek.index');
    }
    
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $projek = Projek::find($request->id);

                $chat = Chat::findOrFail('projek_id', '=', $projek->id);

                    $chat_detail = ChatDetail::findOrFail('chat_id', '=', $chat->id);
                    $chat_detail->delete();

                $chat->delete();

                $tukang = Tukang::findOrFail('projek_id', '=', $projek->id);
                $tukang->delete();

                $absen = Absen::findOrFail('projek_id', '=', $projek->id);
                $absen->delete();

                $absen_lembur = AbsenLembur::findOrFail('projek_id', '=', $projek->id);
                $absen_lembur->delete();

                $detail_projek = DetailProjek::findOrFail('projek_id', '=', $projek->id);
                $detail_projek->delete();

            $projek->delete();

            toastr()->success('Data berhasil dihapus!');
            return response()->json($projek);
        }
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
        return redirect()->route('projek.show', [$request->projek_id])->withFragment('chat');
    }

    public function approval_pm(Request $request)
    {
        $projek = Projek::findOrFail($request->id);
        $projek->update([
            'tanggal_approval_pm'   => date('Y-m-d H:i:s'),
            'approval_pm'   => "Diterima",
            'approval_pm_id' => Auth::user()->id
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('projek.index');
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
        return redirect()->route('projek.index');
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
        return redirect()->route('projek.index');
    }
}
