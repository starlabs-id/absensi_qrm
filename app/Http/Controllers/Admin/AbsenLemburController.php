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
        $absenlemburs = AbsenLembur::latest()->when(request()->q, function($absenlemburs) {
            $absenlemburs = $absenlemburs->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.absenlembur.index', compact('absenlemburs'));
    }

    public function create()
    {
        return view('admin.absenlembur.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'lokasi_datang' => 'required',
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
            'jam_datang'   => $request->jam_datang,
            'tanggal_datang'   => $request->tanggal_datang,
            'hari_datang'   => $request->hari_datang,
            'bulan_datang'   => $request->bulan_datang,
            'tahun_datang'   => $request->tahun_datang,
            'user_id'   => Auth::user()->id,
            'projek_id'   => $request->projek_id,
            'tukang_id'   => $request->tukang_id,
            'edit_by'   => Auth::user()->id,
        ]);
 
        if($absenlembur){
             //redirect dengan pesan sukses
             return redirect()->route('admin.absenlembur.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.absenlembur.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    public function edit(AbsenLembur $absenlembur)
    {
        return view('admin.absenlembur.edit', compact('absenlembur'));
    }
    
    public function update(Request $request, AbsenLembur $absenlembur)
    {
        $this->validate($request, [
            'lokasi_pulang' => 'required',
        ]); 

        $absenlembur = AbsenLembur::findOrFail($absenlembur->id);
        $absenlembur->update([
            'lokasi_pulang'   => $request->lokasi_pulang,
            'jam_pulang'   => $request->jam_pulang,
            'tanggal_pulang'   => $request->tanggal_pulang,
            'hari_pulang'   => $request->hari_pulang,
            'bulan_pulang'   => $request->bulan_pulang,
            'tahun_pulang'   => $request->tahun_pulang,
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
            return redirect()->route('admin.absenlembur.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.absenlembur.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
    
    public function validasi(Request $request, AbsenLembur $absenlembur)
    {
        $absenlembur = AbsenLembur::findOrFail($absenlembur->id);
        $absenlembur->update([
            // 'validasi'   => $request->validasi,
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
            return redirect()->route('admin.absenlembur.validasi')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.absenlembur.validasi')->with(['error' => 'Data Gagal Diupdate!']);
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
