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
use App\Models\RolePermission;
use App\Models\Roles;
use App\Models\Tukang;
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
        $chat = Chat::latest()->when(request()->q, function($chat) {
            $chat = $chat->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.chat.index', compact('chat'));
    }

    public function create()
    {
        return view('admin.chat.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'projek_id'  => 'required',
            'direktur_utama'  => 'required',
            'superadmin'  => 'required',
            'owner'  => 'required',
            'direktur_teknik'  => 'required',
            'admin_teknik'  => 'required',
            'pm'  => 'required',
            'marketing'  => 'required',
            'gm'  => 'required',
            'co_gm'  => 'required',
            'supervisor'  => 'required',
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
 
        if($chat){
             //redirect dengan pesan sukses
             return redirect()->route('admin.chat.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.chat.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    public function edit(Chat $chat)
    {
        return view('admin.chat.edit', compact('chat'));
    }

    
    public function update(Request $request, Chat $chat)
    {
        $this->validate($request, [
            'projek_id'  => 'required',
            'direktur_utama'  => 'required',
            'superadmin'  => 'required',
            'owner'  => 'required',
            'direktur_teknik'  => 'required',
            'admin_teknik'  => 'required',
            'pm'  => 'required',
            'marketing'  => 'required',
            'gm'  => 'required',
            'co_gm'  => 'required',
            'supervisor'  => 'required',
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

        if($chat){
            //redirect dengan pesan sukses
            return redirect()->route('admin.chat.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.chat.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    
    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->delete();

        if($chat){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
