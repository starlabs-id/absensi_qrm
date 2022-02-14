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
use App\Models\RolePermission;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class ChatDetailController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $chatdetail = ChatDetail::latest()->when(request()->q, function($chatdetail) {
            $chatdetail = $chatdetail->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.chatdetail.index', compact('chatdetail'));
    }

    public function create()
    {
        return view('admin.chatdetail.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'komentar'  => 'required',
        ]); 
        $chatdetail = ChatDetail::create([
            'komentar'   => $request->komentar,
            'chat_id'   => $request->chat_id,
            'pengirim'   => Auth::user()->id,
        ]);
 
        if($chatdetail){
             //redirect dengan pesan sukses
             return redirect()->route('admin.chatdetail.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.chatdetail.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    public function edit(ChatDetail $chatdetail)
    {
        return view('admin.chatdetail.edit', compact('chatdetail'));
    }

    
    public function update(Request $request, ChatDetail $chatdetail)
    {
        $this->validate($request, [
            'komentar'  => 'required',
        ]); 

        $chatdetail = ChatDetail::findOrFail($chatdetail->id);
        $chatdetail->update([
            'komentar'   => $request->komentar,
            'chat_id'   => $request->chat_id,
            'pengirim'   => Auth::user()->id,
        ]);

        if($chatdetail){
            //redirect dengan pesan sukses
            return redirect()->route('admin.chatdetail.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.chatdetail.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    
    public function destroy($id)
    {
        $chatdetail = ChatDetail::findOrFail($id);
        $chatdetail->delete();

        if($chatdetail){
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
