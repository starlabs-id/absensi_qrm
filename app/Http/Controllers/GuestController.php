<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatDetail;
use App\Models\DetailProjek;
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
    }

    public function index()
    {
        $projeks = Projek::where('owner', '=', Auth::user()->id)
                        ->get();

        return view('guest.projek.index', compact('projeks'));
    }

    public function show($id)
    {
        $projeks = Projek::select('projeks.*', 'users.name')
                        ->leftjoin('users', 'users.id', '=', 'projeks.marketing')
                        ->where('projeks.id', '=', $id)
                        ->first();
        
        $tukangs = Tukang::select('tukangs.*', 'projeks.nama_projek', 'users.name', 'shifts.nama_shift')
                            ->leftjoin('projeks', 'projeks.id', '=', 'tukangs.projek_id')
                            ->leftjoin('users', 'users.id', '=', 'tukangs.user_id')
                            ->leftjoin('shifts', 'shifts.id', '=', 'tukangs.shift_id')
                            ->orderBy('tukangs.id', 'desc')
                            ->where('projeks.id', '=', $id)
                            ->get();

        $chatdetails = ChatDetail::select('chat_details.*', 'users.name', 'users.foto')
                            ->leftjoin('chats', 'chats.slug', '=', 'chat_details.chat_id')
                            ->leftjoin('users', 'users.id', '=', 'chat_details.pengirim')
                            ->leftjoin('projeks', 'projeks.id', '=', 'chats.projek_id')
                            ->where('chats.projek_id', '=', $id)
                            ->get();
        
        $detailprojeks = DetailProjek::select('detail_projeks.id', 'detail_projeks.uraian_pekerjaan', 'detail_projeks.volume_kontrak', 'detail_projeks.harga_satuan', 'projeks.id as pid', 'projeks.nama_projek')
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
        $detailprojeks = DetailProjek::select('detail_projeks.*', 'projeks.nama_projek')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'detail_projeks.projek_id')
                                    ->where('detail_projeks.id', '=', $id)
                                    ->first();

        return view('guest.projek.detail_show', compact('detailprojeks'));
    }
}
