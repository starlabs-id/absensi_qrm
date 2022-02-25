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
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:shift-list', ['only' => ['shift']]);
        $this->middleware('permission:shift-add', ['only' => ['shift_add']]);
        $this->middleware('permission:shift-update', ['only' => ['shift_update']]);
        $this->middleware('permission:shift-destroy', ['only' => ['shift_destroy']]);
    }

    public function index()
    {
        $level = ModelHasRoles::select('model_has_roles.*', 'roles.name')
                        ->leftjoin('users', 'users.id', '=', 'model_has_roles.model_id')
                        ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                        ->where('model_has_roles.model_id', Auth::user()->id)
                        ->first();
        
        if($level['name'] == 'Karyawan' || $level['name'] == 'Owner')
        {
            toastr()->error('Anda dilarang masuk ke area ini.', 'Oopss...');
            return redirect()->to('/');
        }

        $shifts = Shift::get();

        return view('admin.shift.index', compact('shifts', 'level'));
    }

    public function add(Request $request)
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

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'nama_shift'  => 'required',
            'jam_masuk'  => 'required',
            'jam_pulang'  => 'required',
        ]); 

        $shift = Shift::findOrFail($request->id);
        $shift->update([
            'nama_shift'   => $request->nama_shift,
            'jam_masuk'   => $request->jam_masuk,
            'jam_pulang'   => $request->jam_pulang,
            'edit_by'   => Auth::user()->id,
        ]);
        
        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }
    
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = Shift::find($request->id)->delete();

            return response()->json($data);
        }
    }
}
