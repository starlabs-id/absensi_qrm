<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\AbsenLembur;
use App\Models\Chat;
use App\Models\ChatDetail;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelHasRoles;
use App\Models\Permission;
use App\Models\Tukang;
use App\Models\RolePermission;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class TukangController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $tukang = Tukang::latest()->when(request()->q, function($tukang) {
            $tukang = $tukang->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.tukang.index', compact('tukang'));
    }

    public function create()
    {
        return view('admin.tukang.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'projek_id'  => 'required',
            'tukang_id'  => 'required',
            'biaya_harian'  => 'required',
            'biaya_lembur'  => 'required',
        ]); 
        $tukang = Tukang::create([
            'projek_id'   => $request->projek_id,
            'user_id'   => $request->tukang_id,
            'biaya_harian'   => $request->biaya_harian,
            'biaya_lembur'   => $request->biaya_lembur,
            'edit_by'   => Auth::user()->id,
        ]);
 
        if($tukang){
             //redirect dengan pesan sukses
             return redirect()->route('admin.tukang.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.tukang.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    public function edit(Tukang $tukang)
    {
        return view('admin.tukang.edit', compact('tukang'));
    }

    
    public function update(Request $request, Tukang $tukang)
    {
        $this->validate($request, [
            'projek_id'  => 'required',
            'tukang_id'  => 'required',
            'biaya_harian'  => 'required',
            'biaya_lembur'  => 'required',
        ]); 

        $tukang = Tukang::findOrFail($tukang->id);
        $tukang->update([
            'projek_id'   => $request->projek_id,
            'user_id'   => $request->tukang_id,
            'biaya_harian'   => $request->biaya_harian,
            'biaya_lembur'   => $request->biaya_lembur,
            'edit_by'   => Auth::user()->id,
        ]);

        if($tukang){
            //redirect dengan pesan sukses
            return redirect()->route('admin.tukang.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.tukang.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    
    public function destroy($id)
    {
        $tukang = Tukang::findOrFail($id);
        $tukang->delete();

        if($tukang){
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
