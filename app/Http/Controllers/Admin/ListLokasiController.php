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
use App\Models\ListLokasi;
use App\Models\RolePermission;
use App\Models\Roles;
use App\Models\Tukang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class ListLokasiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:list-lokasi-list', ['only' => ['list_lokasi']]);
        $this->middleware('permission:list-lokasi-add', ['only' => ['list_lokasi_add']]);
        $this->middleware('permission:list-lokasi-update', ['only' => ['list_lokasi_update']]);
        $this->middleware('permission:list-lokasi-destroy', ['only' => ['list_lokasi_destroy']]);
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

        $listlokasi = ListLokasi::get();

        return view('admin.listlokasi.index', compact('listlokasi', 'level'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'nama_lokasi'  => 'required',
        ]); 
        $listlokasi = ListLokasi::create([
            'nama_lokasi' => $request->nama_lokasi,
            'edit_by' => Auth::user()->id,
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'nama_lokasi' => 'required'
        ]); 

        $listlokasi = ListLokasi::findOrFail($request->id);
        $listlokasi->update([
            'nama_lokasi' => $request->nama_lokasi,
            'edit_by' => Auth::user()->id,
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){
            $data = ListLokasi::find($request->id)->delete();

            return response()->json($data);
        }
    }
}
