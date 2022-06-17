<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
use Intervention\Image\Image;
use Intervention\Image\Exception\NotReadableException;
use File;

class UsersController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:role-list', ['only' => ['role']]);
        $this->middleware('permission:role-add', ['only' => ['role_add']]);
        $this->middleware('permission:role-update', ['only' => ['role_update']]);
        $this->middleware('permission:role-destroy', ['only' => ['role_destroy']]);

        $this->middleware('permission:permission-list', ['only' => ['permission']]);
        $this->middleware('permission:permission-add', ['only' => ['permission_add']]);
        $this->middleware('permission:permission-update', ['only' => ['permission_update']]);
        $this->middleware('permission:permission-destroy', ['only' => ['permission_destroy']]);

        $this->middleware('permission:user-list', ['only' => ['user']]);
        $this->middleware('permission:user-add', ['only' => ['user_add']]);
        $this->middleware('permission:user-update', ['only' => ['user_update']]);
        $this->middleware('permission:user-destroy', ['only' => ['user_destroy']]);
    }

    public function index(Request $request)
    {
        $level = ModelHasRoles::select('model_has_roles.*', 'roles.name')
                        ->leftjoin('users', 'users.id', '=', 'model_has_roles.model_id')
                        ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                        ->where('model_has_roles.model_id', Auth::user()->id)
                        ->first();
        
        if($level['name'] == 'Karyawan' || $level['name'] == 'APP' || $level['name'] == 'AP1')
        {
            toastr()->error('Anda dilarang masuk ke area ini.', 'Oopss...');
            return redirect()->to('/');
        }

        $users = User::select('users.id', 'users.email', 'users.no_telp_hp', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->orderBy('users.id', 'DESC')
                    // ->where('roles.name', '=', '')
                    // ->whereOr('roles.name', '=', '')
                    ->get();
        $role = Role::pluck('name','name')->all();
        $roles = Roles::leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'roles.id')
                        ->get();

        return view('admin.users.index', compact('users', 'role', 'roles', 'level'));
    }

    public function user_add(Request $request)
    {
        $rules = array(
            'name' => 'required|max:50',
            'email' => 'required',
            'no_telp_hp' => 'required|unique:users,no_telp_hp|numeric',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            // return response()->json(['errors' => $error->errors()->all()]);
            toastr()->error('Data sudah ada atau input lagi!');
            return redirect()->back();
        }

        $data                   = new User;
        $data->name             = $request->name;
        $data->no_telp_hp       = $request->no_telp_hp;
        $data->email            = $request->email;
        $data->password         = bcrypt(($request->password));
        $data->save();

        $data->assignRole($request->input('roles'));

        // return response()->json(['success' => 'Data berhasil disimpan!']);
        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }

    public function user_edit($id)
    {
        if(request()->ajax())
        {
            $data = User::select('users.id', 'users.email', 'users.no_telp_hp', 'users.name as namea', 'roles.id as ris', 'roles.name')
                        ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                        ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                        ->where('users.id', '=', $id)
                        ->first();
            return response()->json(['data' => $data]);
        }
    }

    public function user_update(Request $request)
    {
        $rules = array(
            'name' => 'required|max:50',
            'email' => 'unique:users,email',
            'no_telp_hp' => 'max:20|unique:users,no_telp_hp',
            'roles' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data                   = User::find($request->id);
        $data->name             = $request->name;

        if($request->input('password')) {
            $data->password = bcrypt(($request->password));
        }

        if($request->input('no_telp_hp')) {
            $data->no_telp_hp = $request->no_telp_hp;
        }

        if($request->input('email')) {
            $data->email = $request->email;
        }

        $data->save();
        
        DB::table('model_has_roles')->where('model_id', $request->hidden_id)->delete();
        $data->assignRole($request->input('roles'));
        

        // return response()->json(['success' => 'Data berhasil disimpan!']);
        

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }

    public function user_destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = User::find($request->id)->delete();

            toastr()->success('Data berhasil dihapus!');
            return response()->json($data);
        }
    }


    // PERMISSION
    public function permission(Request $request)
    {
        $permission = Permission::get();

        return view('admin.users.permission', compact('permission'));
    }

    public function permission_add(Request $request)
    {
        request()->validate([
            'name' => 'required|max:70',
        ],
        [
            'name.required' => 'Nama harus dilengkapi!',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter!',
        ]);

        $data                   = new Permission;
        $data->name             = $request->name;
        $data->guard_name       = 'web';
        $data->save();

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }

    public function permission_update(Request $request)
    {
        request()->validate([
            'name' => 'required|max:70|unique:permissions,name',
        ],
        [
            'name.required' => 'Nama harus dilengkapi!',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter!',
            'name.unique' => 'Nama sudah ada!'
        ]);

        $data                   = Permission::find($request->id);
        $data->name             = $request->name;
        $data->save();

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }

    public function permission_destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::find($request->id)->delete();

            toastr()->success('Data berhasil dihapus!');
            return response()->json($data);
        }
    }


    // ROLE
    public function role(Request $request)
    {
        $datarole = Role::get();
        $permission = Permission::get();

        return view('admin.users.role', compact('datarole', 'permission'));
    }

    public function role_add(Request $request)
    {
        request()->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ],
        [
            'name.required' => 'Nama harus dilengkapi!',
            'name.unique' => 'Nama sudah ada!',

            'permission.required' => 'Roles harus dilengkapi!',
        ]);

        $data = Role::create(['name' => $request->input('name')]);
        $data->syncPermissions($request->input('permission'));

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }

    public function role_edit($id)
    {
        $permission = Permission::get();
        $roles = RolePermission::where('role_id', $id)
                                ->pluck('permission_id', 'permission_id')
                                ->all();
        $role = Roles::where('id', $id)->first();

        return view('admin.users.role_edit', compact('role', 'roles', 'permission'));
    }

    public function role_update(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'permission' => 'required',
        ],
        [
            'name.required' => 'Nama harus dilengkapi!',
            'permission.required' => 'Roles harus dilengkapi!',
        ]);

        $data = Role::find($request->input('id'));
        $data->name = $request->input('name');
        $data->save();

        $data->syncPermissions($request->input('permission'));

        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('role.index');
    }

    public function role_destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::find($request->id)->delete();

            return response()->json($data);
        }
    }


    // PROFILE
    public function profil()
    {
        $user = User::where('id', Auth::user()->id)->first();

        return view('admin.users.profil', compact('user'));
    }

    public function profil_update(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'name' => 'required|max:50',
            'no_telp_hp' => 'max:20|unique:users,no_telp_hp',
            'password' => 'same:confirm-password',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ],
        [
            'name.required' => 'Nama harus dilengkapi!',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter!',

            'no_telp_hp.unique' => 'No. Telpon sudah ada!',
            'no_telp_hp.max' => 'No. Telpon tidak boleh lebih dari :max karakter!',

            'foto.required' => 'Foto harus dilengkapi!',
            'foto.max' => 'Foto tidak boleh lebih dari :max mb!',
            'foto.mimes' => 'Foto harus jpg, png, atau jpeg!',

            'password.same' => 'Password Konfirmasi tidak sesuai!',
        ]);

        $data                   = User::find(Auth::user()->id);
        $data->name             = $request->name;

        if($request->input('password')) {
            $data->password = bcrypt(($request->password));
        }

        if($request->input('no_telp_hp')) {
            $data->no_telp_hp = $request->no_telp_hp;
        }

        if ($request->hasFile('foto')) {
            
            Storage::disk('local')->delete('public/user/'.$data->foto);

            //upload image baru
            $image = $request->file('foto');
            $image->storeAs('public/user', $image->hashName());

            $data->foto = $image->hashName();

            // $file       =   $request->file('foto');
            // $fileName   =   time().'_'.$request->name.'.'.$file->getClientOriginalExtension();
            // $location   =   public_path('storage/user/'. $fileName);
            // Image::make($file)->save($location);
            // $data->foto = $fileName;
        }
        

        $data->save();

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }
}
