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
        $detailprojeks = DetailProjek::latest()->when(request()->q, function($detailprojeks) {
            $detailprojeks = $detailprojeks->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.detailprojek.index', compact('detailprojeks'));
    }

    public function show(Request $request)
    {
        return view('admin.detailprojek.show');
    }

    public function create()
    {
        return view('admin.detailprojek.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_proyek'  => 'required',
            'kode_proyek'  => 'required',
            'area_proyek'  => 'required',
            'nomor_kontrak'  => 'required',
            'tanggal_kontrak'  => 'required',
            'judul_kontrak'  => 'required',
            'nilai_kontrak'  => 'required',
            'durasi_kontrak'  => 'required',
            'lokasi'  => 'required',
            'pemberi_kontrak'  => 'required',
            'pm'  => 'required',
            'marketing'  => 'required',
            'supervisor'  => 'required',
            'rencana_kerja'  => 'required',
            'owner'  => 'required',
            'tanggal_mulai'  => 'required',
            'total_volume_pekerjaan_sebelumnya'  => 'required',
        ]); 
        $detailprojeks = Projek::create([
            'nama_proyek'   => $request->nama_proyek,
            'kode_proyek'   => $request->kode_proyek,
            'area_proyek'   => $request->area_proyek,
            'nomor_kontrak'   => $request->nomor_kontrak,
            'tanggal_kontrak'   => $request->tanggal_kontrak,
            'judul_kontrak'   => $request->judul_kontrak,
            'nilai_kontrak'   => $request->nilai_kontrak,
            'durasi_kontrak'   => $request->durasi_kontrak,
            'lokasi'   => $request->lokasi,
            'pemberi_kontrak'   => $request->pemberi_kontrak,
            'pm'   => $request->pm,
            'marketing'   => $request->marketing,
            'supervisor'   => $request->supervisor,
            'rencana_kerja'   => $request->rencana_kerja,
            'owner'   => $request->owner,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'total_volume_pekerjaan_sebelumnya'   => $request->total_volume_pekerjaan_sebelumnya,
            'total_volume_kontrak'   => $request->total_volume_kontrak,
            'total_harga_satuan'   => "0",
            'total_volume_pekerjaan_hari_ini'   => "0",
            'total_prestasi_keuangan'   => "0",
            'total_prestasi_fisik'   => "0",
            'status'   => "process",
            'edit_by'   => Auth::user()->id,
        ]);
 
        if($detailprojeks){
             //redirect dengan pesan sukses
             return redirect()->route('admin.detailprojek.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.detailprojek.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    public function edit(DetailProjek $detailprojeks)
    {
        $detailprojeks = DetailProjek::get();
        return view('admin.projek.edit', compact('detailprojeks'));
    }

    
    public function update(Request $request, DetailProjek $detailprojeks)
    {
        $this->validate($request, [
            'nama_proyek'  => 'required',
            'kode_proyek'  => 'required',
            'area_proyek'  => 'required',
            'nomor_kontrak'  => 'required',
            'tanggal_kontrak'  => 'required',
            'judul_kontrak'  => 'required',
            'nilai_kontrak'  => 'required',
            'durasi_kontrak'  => 'required',
            'lokasi'  => 'required',
            'pemberi_kontrak'  => 'required',
            'pm'  => 'required',
            'marketing'  => 'required',
            'supervisor'  => 'required',
            'rencana_kerja'  => 'required',
            'owner'  => 'required',
            'tanggal_mulai'  => 'required',
            'total_volume_pekerjaan_sebelumnya'  => 'required',
            'total_volume_kontrak'  => 'required',
            'total_harga_satuan'  => 'required',
        ]); 

        $detailprojeks = DetailProjek::findOrFail($detailprojeks->id);
        $detailprojeks->update([
            'nama_proyek'   => $request->nama_proyek,
            'kode_proyek'   => $request->kode_proyek,
            'area_proyek'   => $request->area_proyek,
            'nomor_kontrak'   => $request->nomor_kontrak,
            'tanggal_kontrak'   => $request->tanggal_kontrak,
            'judul_kontrak'   => $request->judul_kontrak,
            'nilai_kontrak'   => $request->nilai_kontrak,
            'durasi_kontrak'   => $request->durasi_kontrak,
            'lokasi'   => $request->lokasi,
            'pemberi_kontrak'   => $request->pemberi_kontrak,
            'pm'   => $request->pm,
            'marketing'   => $request->marketing,
            'supervisor'   => $request->supervisor,
            'rencana_kerja'   => $request->rencana_kerja,
            'owner'   => $request->owner,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'total_volume_pekerjaan_sebelumnya'   => $request->total_volume_pekerjaan_sebelumnya,
            'total_volume_kontrak'   => $request->total_volume_kontrak,
            'total_harga_satuan'   => $request->total_harga_satuan,
            'status'   => $request->status,
            'edit_by'   => Auth::user()->id,
        ]);

        if($detailprojeks){
            //redirect dengan pesan sukses
            return redirect()->route('admin.detailprojek.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.detailprojek.index')->with(['error' => 'Data Gagal Diupdate!']);
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
