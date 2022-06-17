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
use App\Models\ListPekerjaan;
use App\Models\RolePermission;
use App\Models\Roles;
use App\Models\Tukang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class ListPekerjaanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:listpekerjaan-list', ['only' => ['listpekerjaan']]);
        $this->middleware('permission:listpekerjaan-add', ['only' => ['listpekerjaan_add']]);
        $this->middleware('permission:listpekerjaan-update', ['only' => ['listpekerjaan_update']]);
        $this->middleware('permission:listpekerjaan-destroy', ['only' => ['listpekerjaan_destroy']]);
    }

    public function index()
    {
        $level = ModelHasRoles::select('model_has_roles.*', 'roles.name')
                        ->leftjoin('users', 'users.id', '=', 'model_has_roles.model_id')
                        ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                        ->where('model_has_roles.model_id', Auth::user()->id)
                        ->first();
        
        // if($level['name'] == 'Karyawan')
        // {
        //     toastr()->error('Anda dilarang masuk ke area ini.', 'Oopss...');
        //     return redirect()->to('/');
        // }

        $listpekerjaan = ListPekerjaan::orderBy('id', 'DESC')->get();

        return view('admin.listpekerjaan.index', compact('listpekerjaan', 'level'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'nama_pekerjaan'  => 'required',
            'harga'  => 'required',
        ]); 
        $shift = ListPekerjaan::create([
            'nama_pekerjaan'   => $request->nama_pekerjaan,
            'harga'   => $request->harga,
            'edit_by'   => Auth::user()->id,
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'nama_pekerjaan'  => 'required',
            'harga'  => 'required',
        ]); 

        $shift = ListPekerjaan::findOrFail($request->id);
        $shift->update([
            'nama_pekerjaan'   => $request->nama_pekerjaan,
            'harga'   => $request->harga,
            'edit_by'   => Auth::user()->id,
        ]);
        
        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }
    
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = ListPekerjaan::find($request->id)->delete();

            return response()->json($data);
        }
    }
}
