<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKerusakan;
use App\Models\Projek;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class DashboardController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $total_karyawan = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                                ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                                ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                                ->where('roles.name', '=', "Karyawan")
                                ->count();

        $total_app = Projek::where('approval_app', '=', "Belum")->count();
        $total_ap1 = Projek::where('approval_ap1', '=', "Belum")->count();

        return view('admin.index', compact('total_karyawan', 'total_app', 'total_ap1'));
    }

    public function pdf_so($id)
    {
        $jenis_kerusakan = JenisKerusakan::select('jenis_kerusakans.*', 'detail_projeks.id as pid', 'list_pekerjaans.nama_pekerjaan')
                                            ->leftjoin('projeks', 'projeks.id', '=', 'jenis_kerusakans.id_projeks')
                                            ->leftjoin('detail_projeks', 'detail_projeks.id', '=', 'jenis_kerusakans.id_detail_projeks')
                                            ->leftjoin('list_pekerjaans', 'list_pekerjaans.id', '=', 'jenis_kerusakans.nama_kerusakan')
                                            ->orderBy('detail_projeks.id', 'DESC')
                                            ->where('jenis_kerusakans.id_projeks', '=', $id)
                                            ->get();

        $total_harga = JenisKerusakan::select('total_harga')
                        ->where('id_projeks', '=', $id)
                        ->sum('total_harga');

        $approval = Projek::select('projeks.*', 'A.name as approval_pm_id', 'B.name as approval_app_id', 'C.name as approval_ap1_id')
                            ->leftjoin('users AS A', 'A.id', '=', 'projeks.approval_pm_id')
                            ->leftjoin('users AS B', 'B.id', '=', 'projeks.approval_app_id')
                            ->leftjoin('users AS C', 'C.id', '=', 'projeks.approval_ap1_id')
                            // ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                            // ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                            ->where('projeks.id', '=', $id)
                            ->first();

        // $pdf = PDF::loadview('admin.projek.pdfso', compact('jenis_kerusakan', 'total_harga', 'approval'))->setPaper('a4', 'portrait');
        // return $pdf->stream('so'.date('YmdHis').'.pdf');
        
        return view('admin.projek.pdfso', compact('jenis_kerusakan', 'total_harga', 'approval'));
    }
}