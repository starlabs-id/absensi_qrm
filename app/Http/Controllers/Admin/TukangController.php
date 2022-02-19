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
use App\Models\Projek;
use App\Models\Tukang;
use App\Models\RolePermission;
use App\Models\Roles;
use App\Models\User;
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
        $tukangs = Tukang::select('tukangs.*', 'projeks.nama_projek', 'users.name')
                            ->leftjoin('projeks', 'projeks.id', '=', 'tukangs.projek_id')
                            ->leftjoin('users', 'users.id', '=', 'tukangs.user_id')
                            ->orderBy('tukangs.id', 'desc')
                            ->get();

        $karyawan = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Karyawan")
                    ->get();

        $projeks = Projek::get();

        return view('admin.tukang.index', compact('tukangs', 'karyawan', 'projeks'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'projek_id'  => 'required',
            'tukang_id'  => 'required',
            'biaya_harian'  => 'required',
            'biaya_lembur'  => 'required',
        ]);

        $projek = $request->projek_id;
        $ada = Tukang::select('user_id')
                    ->where('projek_id', '=', $projek)
                    ->get();

        if(count($ada) == 0)
        {
            $tukang = Tukang::create([
                'projek_id'   => $request->projek_id,
                'user_id'   => $request->tukang_id,
                'biaya_harian'   => $request->biaya_harian,
                'biaya_lembur'   => $request->biaya_lembur,
                'edit_by'   => Auth::user()->id,
            ]);

            toastr()->success('Data berhasil disimpan!');
            return redirect()->back();
        }

        toastr()->error('Karyawan sudah ada!');
        return redirect()->back();
    }

    
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = Tukang::find($request->id)->delete();

            return response()->json($data);
        }
    }
}
