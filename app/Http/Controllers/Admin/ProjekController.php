<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelHasRoles;
use App\Models\Permission;
use App\Models\Projek;
use App\Models\RolePermission;
use App\Models\Roles;
use Spatie\Permission\Models\Role;

class ProjekController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $projeks = Projek::latest()->when(request()->q, function($projeks) {
            $projeks = $projeks->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.projek.index', compact('projeks'));
    }

    public function create()
    {
        return view('admin.projek.create');
    }
}
