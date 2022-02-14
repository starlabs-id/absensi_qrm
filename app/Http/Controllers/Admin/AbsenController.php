<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelHasRoles;
use App\Models\Permission;
use App\Models\Absen;
use App\Models\RolePermission;
use App\Models\Roles;
use App\Models\Tukang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AbsenController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $absens = Absen::latest()->when(request()->q, function($absens) {
            $absens = $absens->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.absen.index', compact('absens'));
    }

    public function create()
    {
        return view('admin.absen.create');
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
        $foto->storeAs('public/absen', $foto->hashName());

        $ttd = $request->file('ttd');
        $ttd->storeAs('public/ttd', $ttd->hashName());

        $absen = Absen::create([
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
 
        if($absen){
             //redirect dengan pesan sukses
             return redirect()->route('karyawan.absen.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('karyawan.absen.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    public function edit(Absen $absen)
    {
        return view('karyawan.absen.edit', compact('absen'));
    }
    
    public function update(Request $request, Absen $absen)
    {
        $this->validate($request, [
            'lokasi_pulang' => 'required',
        ]); 

        $absen = Absen::findOrFail($absen->id);
        $absen->update([
            'lokasi_pulang'   => $request->lokasi_pulang,
            'jam_pulang'   => $request->jam_pulang,
            'tanggal_pulang'   => $request->tanggal_pulang,
            'hari_pulang'   => $request->hari_pulang,
            'bulan_pulang'   => $request->bulan_pulang,
            'tahun_pulang'   => $request->tahun_pulang,
            'edit_by'   => Auth::user()->id,
        ]);

        if($absen){
            //redirect dengan pesan sukses
            return redirect()->route('karyawan.absen.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('karyawan.absen.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
    
    public function validasi(Request $request, Absen $absen)
    {
        $absen = Absen::findOrFail($absen->id);
        $absen->update([
            // 'validasi'   => $request->validasi,
            'jam_validasi'   => date('d-m-Y h:i:s'),
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'validasi_by'   => $request->validasi_by,
        ]);

        $absen = Storage::disk('local')->delete('public/absen/'.$absen->foto);

        $ttd = Absen::findOrFail($request->id);
        $ttd = Storage::disk('local')->delete('public/ttd/'.$ttd->ttd);

        if($absen){
            //redirect dengan pesan sukses
            return redirect()->route('karyawan.absen.validasi')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('karyawan.absen.validasi')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    
    public function destroy($id)
    {
        $absen = Absen::findOrFail($id);
        $absen->delete();

        if($absen){
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
