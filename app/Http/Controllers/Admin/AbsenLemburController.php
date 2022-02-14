<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelHasRoles;
use App\Models\Permission;
use App\Models\AbsenLembur;
use App\Models\RolePermission;
use App\Models\Roles;
use App\Models\Tukang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AbsenLemburController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $absenlembur = AbsenLembur::latest()->when(request()->q, function($absenlembur) {
            $absenlembur = $absenlembur->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.absenlembur.index', compact('absenlembur'));
    }

    public function create()
    {
        return view('admin.absenlembur.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ttd'  => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'foto'  => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ]); 

        //upload foto
        $foto = $request->file('foto');
        $foto->storeAs('public/absenlembur', $foto->hashName());

        $ttd = $request->file('ttd');
        $ttd->storeAs('public/ttdlembur', $ttd->hashName());

        $absenlembur = AbsenLembur::create([
            'lokasi_datang'   => $request->lokasi_datang,
            'jam_datang'   => date('H:i:s'),
            'tanggal_datang'   => date('d-m-Y'),
            'hari_datang'   => $request->hari_datang,
            'bulan_datang'   => $request->bulan_datang,
            'tahun_datang'   => date('Y'),
            'user_id'   => $request->user_id,
            'projek_id'   => $request->projek_id,
            'tukang_id'   => $request->tukang_id,
            'edit_by'   => Auth::user()->id,
        ]);
 
        if($absenlembur){
             //redirect dengan pesan sukses
             return redirect()->route('karyawan.absenlembur.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('karyawan.absenlembur.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    public function edit(AbsenLembur $absenlembur)
    {
        return view('karyawan.absenlembur.edit', compact('absenlembur'));
    }
    
    public function update(Request $request, AbsenLembur $absenlembur)
    {
        $absenlembur = AbsenLembur::findOrFail($absenlembur->id);
        $absenlembur->update([
            'lokasi_pulang'   => $request->lokasi_pulang,
            'jam_pulang'   => date('H:i:s'),
            'tanggal_pulang'   => date('d-m-Y'),
            'hari_pulang'   => $request->hari_pulang,
            'bulan_pulang'   => $request->bulan_pulang,
            'tahun_pulang'   => date('Y'),
            'edit_by'   => Auth::user()->id,
        ]);

        $waktu_datang = $absenlembur->jam_datang;
        $waktu_pulang = $absenlembur->jam_pulang;

        $selisih = $waktu_pulang - $waktu_datang;
        $total_lembur = $selisih * 250;

        $absenlembur->update([
            'total_biaya_lembur'   => $total_lembur,
        ]);

        if($absenlembur){
            //redirect dengan pesan sukses
            return redirect()->route('karyawan.absenlembur.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('karyawan.absenlembur.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
    
    public function validasi(Request $request, AbsenLembur $absenlembur)
    {
        $absenlembur = AbsenLembur::findOrFail($absenlembur->id);
        $absenlembur->update([
            'validasi'   => $request->validasi,
            'jam_validasi'   => date('d-m-Y h:i:s'),
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'validasi_by'   => $request->validasi_by,
        ]);

        $absenlembur = Storage::disk('local')->delete('public/absenlembur/'.$absenlembur->foto);

        $ttdlembur = AbsenLembur::findOrFail($request->id);
        $ttdlembur = Storage::disk('local')->delete('public/ttdlembur/'.$ttdlembur->ttd);

        if($absenlembur){
            //redirect dengan pesan sukses
            return redirect()->route('karyawan.absenlembur.validasi')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('karyawan.absenlembur.validasi')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    
    public function destroy($id)
    {
        $absenlembur = AbsenLembur::findOrFail($id);
        $absenlembur->delete();

        if($absenlembur){
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
