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
use App\Models\User;
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
        $absens = Tukang::select('tukangs.id', 'projeks.nama_projek')
                        ->leftjoin('projeks', 'projeks.id', '=', 'tukangs.projek_id')
                        ->orderBy('projeks.id', 'DESC')
                        ->get();

        return view('admin.absen.index', compact('absens'));
    }

    public function show($id)
    {
        $absens = Tukang::select('tukangs.id', 'tukangs.user_id', 'users.name')
                        ->leftjoin('projeks', 'projeks.id', '=', 'tukangs.projek_id')
                        ->leftjoin('users', 'users.id', '=', 'tukangs.user_id')
                        ->orderBy('projeks.id', 'DESC')
                        ->where('tukangs.id', '=', $id)
                        ->get();

        $tukangs = Tukang::select('tukangs.id', 'tukangs.user_id')
                        ->where('tukangs.id', '=', $id)
                        ->first();

        return view('admin.absen.show', compact('absens', 'tukangs'));
    }

    public function detail(Request $request)
    {
        $absens = Absen::select('absens.*', 'users.name')
                        ->leftjoin('projeks', 'projeks.id', '=', 'absens.projek_id')
                        ->leftjoin('users', 'users.id', '=', 'absens.user_id')
                        ->orderBy('projeks.id', 'DESC')
                        ->where('absens.user_id', '=', $request->user_id)
                        ->get();

        $tukangs = Tukang::where('tukangs.id', '=', $request->id)->first();
        
        $absen = User::where('id', '=', $request->user_id)->first();

        return view('admin.absen.detail', compact('absens', 'absen', 'tukangs'));
    }

    public function create(Request $request)
    {
        $tukangs = Tukang::where('id', '=', $request->tukang_id)->first();

        return view('admin.absen.create', compact('tukangs'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'lokasi_datang' => 'required',
            'ttd'  => 'required',
            'foto'  => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ]); 

        //upload foto
        $foto = $request->file('foto');
        $foto->storeAs('public/absen', $foto->hashName());
        $foto = $foto->hashName();

        // $ttd = $request->file('ttd');
        // $ttd->storeAs('public/ttd', $ttd->hashName());
        // $ttd = $ttd->hashName();
        
        $folderPath = public_path('storage/ttd/');
        
        $image_parts = explode(";base64,", $request->ttd);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $filename = uniqid() . '.'.$image_type;
        $file = $folderPath . uniqid() . '.'.$image_type;
        file_put_contents($file, $image_base64);
        // dd($file, $image_base64, $image_type, $image_type_aux, $image_parts, $folderPath);

        $absen = Absen::create([
            'lokasi_datang'   => $request->lokasi_datang,
            'jam_datang'   => $request->jam_datang,
            'tanggal_datang'   => $request->tanggal_datang,
            'hari_datang'   => $request->hari_datang,
            'bulan_datang'   => $request->bulan_datang,
            'tahun_datang'   => $request->tahun_datang,
            'foto'   => $foto,
            'ttd'   => $filename,
            'user_id'   => $request->user_id,
            'projek_id'   => $request->projek_id,
            'tukang_id'   => $request->tukang_id,
            'edit_by'   => Auth::user()->id,
        ]);
 
       
        toastr()->success('Data berhasil disimpan!');
        // return redirect()->route('absen.show', [$request->tukang_id]);
        return redirect()->route('absen.index');
    }

    public function edit()
    {
        return view('admin.absen.edit');
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'lokasi_pulang' => 'required',
        ]); 

        $absen = Absen::findOrFail($request->id);
        $absen->update([
            'lokasi_pulang'   => $request->lokasi_pulang,
            'jam_pulang'   => $request->jam_pulang,
            'tanggal_pulang'   => $request->tanggal_pulang,
            'hari_pulang'   => $request->hari_pulang,
            'bulan_pulang'   => $request->bulan_pulang,
            'tahun_pulang'   => $request->tahun_pulang,
            'edit_by'   => Auth::user()->id,
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }
    
    public function validasi(Request $request)
    {
        $absen = Absen::findOrFail($request->id);
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


        toastr()->success('Data berhasil disimpan!');
        return redirect()->back();
    }
    
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = Absen::find($request->id)->delete();

            return response()->json($data);
        }
    }
}
