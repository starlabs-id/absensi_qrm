<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\AbsenLembur;
use App\Models\ChatDetail;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelHasRoles;
use App\Models\Permission;
use App\Models\Chat;
use App\Models\Projek;
use App\Models\RolePermission;
use App\Models\Roles;
use App\Models\Tukang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class ChatController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $chats = Chat::select('chats.id', 'A.name as superadmin', 'B.name as direktur_utama', 'C.name as owner', 'D.name as direktur_teknik', 'E.name as admin_teknik', 'F.name as pm', 'G.name as marketing', 'H.name as gm', 'I.name as co_gm', 'J.name as supervisor', 'projeks.nama_projek')
                            ->leftjoin('projeks', 'projeks.id', '=', 'chats.projek_id')
                            ->leftjoin('users AS A', 'A.id', '=', 'chats.superadmin')
                            ->leftjoin('users AS B', 'B.id', '=', 'chats.direktur_utama')
                            ->leftjoin('users AS C', 'C.id', '=', 'chats.owner')
                            ->leftjoin('users AS D', 'D.id', '=', 'chats.direktur_teknik')
                            ->leftjoin('users AS E', 'E.id', '=', 'chats.admin_teknik')
                            ->leftjoin('users AS F', 'F.id', '=', 'chats.pm')
                            ->leftjoin('users AS G', 'G.id', '=', 'chats.marketing')
                            ->leftjoin('users AS H', 'H.id', '=', 'chats.gm')
                            ->leftjoin('users AS I', 'I.id', '=', 'chats.co_gm')
                            ->leftjoin('users AS J', 'J.id', '=', 'chats.supervisor')
                            ->orderBy('chats.id', 'desc')
                            ->get();

        $projeks = Projek::get();
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

        $superadmin = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Superadmin")
                    ->get();

        $direktur_utama = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Direktur Utama")
                    ->get();

        $direktur_teknik = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Direktur Teknik")
                    ->get();

        $admin_teknik = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Admin Teknik")
                    ->get();

        $gm = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "GM")
                    ->get();

        $co_gm = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Co GM")
                    ->get();

        return view('admin.chat.index', compact('chats', 'projeks', 'marketing', 'pm', 'supervisor', 'owner', 'superadmin', 'direktur_utama', 'direktur_teknik', 'admin_teknik', 'gm', 'co_gm'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'projek_id'  => 'required',
            'direktur_utama'  => 'required',
            'superadmin'  => 'required',
            'owner'  => 'required',
            'admin_teknik'  => 'required',
            'pm'  => 'required',
        ]); 
        $chat = Chat::create([
            'projek_id'   => $request->projek_id,
            'direktur_utama'   => $request->direktur_utama,
            'superadmin'   => $request->superadmin,
            'owner'   => $request->owner,
            'direktur_teknik'   => $request->direktur_teknik,
            'admin_teknik'   => $request->admin_teknik,
            'pm'   => $request->pm,
            'marketing'   => $request->marketing,
            'gm'   => $request->gm,
            'co_gm'   => $request->co_gm,
            'supervisor'   => $request->supervisor,
            'edit_by'   => Auth::user()->id,
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }
    
    public function update(Request $request, Chat $chat)
    {
        $this->validate($request, [
            'projek_id'  => 'required',
            'direktur_utama'  => 'required',
            'superadmin'  => 'required',
            'owner'  => 'required',
            'admin_teknik'  => 'required',
            'pm'  => 'required',
        ]); 

        $chat = Chat::findOrFail($chat->id);
        $chat->update([
            'projek_id'   => $request->projek_id,
            'direktur_utama'   => $request->direktur_utama,
            'superadmin'   => $request->superadmin,
            'owner'   => $request->owner,
            'direktur_teknik'   => $request->direktur_teknik,
            'admin_teknik'   => $request->admin_teknik,
            'pm'   => $request->pm,
            'marketing'   => $request->marketing,
            'gm'   => $request->gm,
            'co_gm'   => $request->co_gm,
            'supervisor'   => $request->supervisor,
            'edit_by'   => Auth::user()->id,
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }

    
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = Chat::find($request->id)->delete();

            return response()->json($data);
        }
    }

    public function show(Request $request)
    {
        return view('admin.chat.detail');
    }

    public function store_chat_detail(Request $request)
    {
        $this->validate($request, [
            'komentar'  => 'required',
        ]); 
        $chatdetail = ChatDetail::create([
            'komentar'   => $request->komentar,
            'chat_id'   => $request->chat_id,
            'pengirim'   => $request->user_id,
        ]);
 
        if($chatdetail){
             //redirect dengan pesan sukses
             return redirect()->route('admin.chat.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.chat.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }
}
