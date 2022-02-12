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
        $projek = Projek::create([
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
 
        if($projek){
             //redirect dengan pesan sukses
             return redirect()->route('admin.projek.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.projek.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    public function edit(Projek $projek)
    {
        return view('admin.projek.edit', compact('projek'));
    }

    
    public function update(Request $request, Projek $projek)
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

        $projek = Projek::findOrFail($projek->id);
        $projek->update([
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

        if($projek){
            //redirect dengan pesan sukses
            return redirect()->route('admin.projek.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.projek.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    
    public function destroy($id)
    {
        $projek = Projek::findOrFail($id);

            $chat = Chat::where('projek_id', '=', $projek->id);

                $chat_detail = ChatDetail::where('chat_id', '=', $chat->id);
                $chat_detail->delete();

            $chat->delete();

            $tukang = Tukang::where('projek_id', '=', $projek->id);
            $tukang->delete();

            $absen = Absen::where('projek_id', '=', $projek->id);
            $absen->delete();

            $absen_lembur = AbsenLembur::where('projek_id', '=', $projek->id);
            $absen_lembur->delete();

            $detail_projek = DetailProjek::where('projek_id', '=', $projek->id);
            $detail_projek->delete();

        $projek->delete();

        if($projek){
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
