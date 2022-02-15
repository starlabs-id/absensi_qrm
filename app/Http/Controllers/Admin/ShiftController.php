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
use App\Models\Shift;
use App\Models\RolePermission;
use App\Models\Roles;
use App\Models\Tukang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class ShiftController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $shifts = Shift::latest()->when(request()->q, function($shifts) {
            $shifts = $shifts->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.shift.index', compact('shifts'));
    }

    public function create()
    {
        return view('admin.shift.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_shift'  => 'required',
            'jam_masuk'  => 'required',
            'jam_pulang'  => 'required',
        ]); 
        $shift = Shift::create([
            'nama_shift'   => $request->nama_shift,
            'jam_masuk'   => $request->jam_masuk,
            'jam_pulang'   => $request->jam_pulang,
            'edit_by'   => Auth::user()->id,
        ]);
 
        if($shift){
             //redirect dengan pesan sukses
             return redirect()->route('admin.shift.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.shift.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    public function edit(Shift $shift)
    {
        return view('admin.shift.edit', compact('shift'));
    }

    
    public function update(Request $request, Shift $shift)
    {
        $this->validate($request, [
            'nama_shift'  => 'required',
            'jam_masuk'  => 'required',
            'jam_pulang'  => 'required',
        ]); 

        $shift = Shift::findOrFail($shift->id);
        $shift->update([
            'nama_shift'   => $request->nama_shift,
            'jam_masuk'   => $request->jam_masuk,
            'jam_pulang'   => $request->jam_pulang,
            'edit_by'   => Auth::user()->id,
        ]);

        if($shift){
            //redirect dengan pesan sukses
            return redirect()->route('admin.shift.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.shift.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    
    public function destroy($id)
    {
        $shift = Shift::findOrFail($id);
        $shift->delete();

        if($shift){
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
