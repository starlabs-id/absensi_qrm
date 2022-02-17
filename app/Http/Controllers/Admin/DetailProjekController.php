<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\AbsenLembur;
use App\Models\Chat;
use App\Models\ChatDetail;
use App\Models\DetailProjek;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelHasRoles;
use App\Models\Permission;
use App\Models\Projek;
use App\Models\RolePermission;
use App\Models\Roles;
use App\Models\Tukang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class DetailProjekController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $detailprojeks = DetailProjek::select('detail_projeks.id', 'detail_projeks.uraian_pekerjaan', 'detail_projeks.volume_kontrak', 'detail_projeks.harga_satuan', 'projeks.id as pid', 'projeks.nama_projek')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'detail_projeks.projek_id')
                                    ->orderBy('detail_projeks.id', 'DESC')
                                    ->get();

        return view('admin.detailprojek.index', compact('detailprojeks'));
    }

    public function show($id)
    {
        $detailprojeks = DetailProjek::where('id', '=', $id)->first();

        return view('admin.detailprojek.show', compact('detailprojeks'));
    }

    public function create()
    {
        $projek = Projek::get();

        return view('admin.detailprojek.create', compact('projek'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'projek_id' => 'required',
            'uraian_pekerjaan'  => 'required',
            'volume_kontrak'  => 'required',
            'harga_satuan'  => 'required',
            'volume_pekerjaan_hari_ini'  => 'required',
            'volume_dikerjakan'  => 'required',
            'prestasi_keuangan_hari_ini'  => 'required',
            'prestasi_fisik_hari_ini'  => 'required',
            'tanggal'  => 'required',
        ]); 
        $detailprojeks = Projek::create([
            'projek_id'   => $request->projek_id,
            'uraian_pekerjaan'   => $request->uraian_pekerjaan,
            'volume_kontrak'   => $request->volume_kontrak,
            'harga_satuan'   => $request->harga_satuan,
            'volume_pekerjaan_hari_ini'   => $request->volume_pekerjaan_hari_ini,
            'volume_dikerjakan'   => $request->volume_dikerjakan,
            'prestasi_keuangan_hari_ini'   => $request->prestasi_keuangan_hari_ini,
            'prestasi_fisik_hari_ini'   => $request->prestasi_fisik_hari_ini,
            'tanggal'   => $request->tanggal,
            'foto_1'   => $request->foto_1,
            'foto_2'   => $request->foto_2,
            'foto_3'   => $request->foto_3,
            'foto_4'   => $request->foto_4,
            'foto_5'   => $request->foto_5,
            'foto_6'   => $request->foto_6,
            'foto_7'   => $request->foto_7,
            'foto_8'   => $request->foto_8,
            'foto_9'   => $request->foto_9,
            'foto_10'   => $request->foto_10,
            'keterangan'   => $request->keterangan,
            'edit_by'   => Auth::user()->id,
        ]);

        $projeks = Projek::findOrFail($request->projek_id);

        $total_volume_pekerjaan_sebelumnya = $projeks->total_volume_pekerjaan_sebelumnya + $detailprojeks->volume_pekerjaan_hari_ini;
        $total_volume_pekerjaan_hari_ini = $projeks->total_volume_pekerjaan_hari_ini + $detailprojeks->volume_pekerjaan_hari_ini;
        $total_prestasi_keuangan = $projeks->total_prestasi_keuangan + $detailprojeks->prestasi_keuangan_hari_ini;
        $total_prestasi_fisik = $projeks->total_prestasi_fisik + $detailprojeks->prestasi_fisik_hari_ini;

        $projeks->update([
            'total_volume_pekerjaan_sebelumnya'   => $total_volume_pekerjaan_sebelumnya,
            'total_volume_pekerjaan_hari_ini'   => $total_volume_pekerjaan_hari_ini,
            'total_prestasi_keuangan'   => $total_prestasi_keuangan,
            'total_prestasi_fisik'   => $total_prestasi_fisik,
        ]);
 
        if($detailprojeks){
             //redirect dengan pesan sukses
             return redirect()->route('detailprojek.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('detailprojek.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    public function edit($id)
    {
        $detailprojeks = DetailProjek::where('id', '=', $id)->get();
        return view('admin.projek.edit', compact('detailprojeks'));
    }

    
    public function update(Request $request)
    {
        $this->validate($request, [
            'projek_id' => 'required',
            'uraian_pekerjaan'  => 'required',
            'volume_kontrak'  => 'required',
            'harga_satuan'  => 'required',
            'volume_pekerjaan_hari_ini'  => 'required',
            'volume_dikerjakan'  => 'required',
            'prestasi_keuangan_hari_ini'  => 'required',
            'prestasi_fisik_hari_ini'  => 'required',
            'tanggal'  => 'required',
        ]); 

        $detailprojeks = DetailProjek::findOrFail($request->id);
        $detailprojeks->update([
            'projek_id'   => $request->projek_id,
            'uraian_pekerjaan'   => $request->uraian_pekerjaan,
            'volume_kontrak'   => $request->volume_kontrak,
            'harga_satuan'   => $request->harga_satuan,
            'volume_pekerjaan_hari_ini'   => $request->volume_pekerjaan_hari_ini,
            'volume_dikerjakan'   => $request->volume_dikerjakan,
            'prestasi_keuangan_hari_ini'   => $request->prestasi_keuangan_hari_ini,
            'prestasi_fisik_hari_ini'   => $request->prestasi_fisik_hari_ini,
            'tanggal'   => $request->tanggal,
            'foto_1'   => $request->foto_1,
            'foto_2'   => $request->foto_2,
            'foto_3'   => $request->foto_3,
            'foto_4'   => $request->foto_4,
            'foto_5'   => $request->foto_5,
            'foto_6'   => $request->foto_6,
            'foto_7'   => $request->foto_7,
            'foto_8'   => $request->foto_8,
            'foto_9'   => $request->foto_9,
            'foto_10'   => $request->foto_10,
            'keterangan'   => $request->keterangan,
            'edit_by'   => Auth::user()->id,
        ]);

        if($detailprojeks){
            //redirect dengan pesan sukses
            return redirect()->route('detailprojek.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('detailprojek.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    
    public function destroy($id)
    {
        $detailprojeks = DetailProjek::findOrFail($id);
        $detailprojeks->delete();

        if($detailprojeks){
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
