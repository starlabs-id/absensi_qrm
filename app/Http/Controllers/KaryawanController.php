<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelHasRoles;
use App\Models\Permission;
use App\Models\Absen;
use App\Models\AbsenLembur;
use App\Models\RolePermission;
use App\Models\Roles;
use App\Models\Tukang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class KaryawanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:karyawan-absen-list', ['only' => ['karyawan_absen_list']]);
        $this->middleware('permission:karyawan-absen-add', ['only' => ['karyawan_absen_add']]);
        $this->middleware('permission:karyawan-absen-update', ['only' => ['karyawan_absen_update']]);

        $this->middleware('permission:karyawan-absenlembur-list', ['only' => ['karyawan_absenlembur_list']]);
        $this->middleware('permission:karyawan-absenlembur-add', ['only' => ['karyawan_absenlembur_add']]);
        $this->middleware('permission:karyawan-absenlembur-update', ['only' => ['karyawan_absenlembur_update']]);
    }

    public function index()
    {
        $absens = Absen::select('absens.*', 'users.name')
                        ->leftjoin('projeks', 'projeks.id', '=', 'absens.projek_id')
                        ->leftjoin('users', 'users.id', '=', 'absens.user_id')
                        ->orderBy('projeks.id', 'DESC')
                        ->where('absens.user_id', '=', Auth::user()->id)
                        ->get();
        
        $absen = User::where('id', '=', Auth::user()->id)->first();

        // $tukangs = Tukang::select('tukangs.*', 'shifts.nama_shift', 'shifts.jam_masuk', 'shifts.jam_pulang')
        //                 ->where('tukangs.id', '=', $id)
        //                 ->leftjoin('shifts', 'shifts.id', '=', 'tukangs.shift_id')
        //                 ->first();

        return view('karyawan.absen.detail', compact('absens', 'absen'));
    }

    public function detail($id, $user_id)
    {
        $absens = Absen::select('absens.*', 'users.name')
                        ->leftjoin('projeks', 'projeks.id', '=', 'absens.projek_id')
                        ->leftjoin('users', 'users.id', '=', 'absens.user_id')
                        ->orderBy('projeks.id', 'DESC')
                        ->where('absens.user_id', '=', $user_id)
                        ->get();

        $tukangs = Tukang::select('tukangs.*', 'shifts.nama_shift', 'shifts.jam_masuk', 'shifts.jam_pulang')
                        ->where('tukangs.id', '=', $id)
                        ->leftjoin('shifts', 'shifts.id', '=', 'tukangs.shift_id')
                        ->first();
        
        $absen = User::where('id', '=', $user_id)->first();

        return view('karyawan.absen.detail', compact('absens', 'absen', 'tukangs'));
    }

    public function create()
    {
        // $tukangs = Tukang::where('id', '=', $tukang_id)->first();

        return view('karyawan.absen.create');
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            // 'lokasi_datang' => 'required',
            // 'ttd'  => 'required',
            'foto'  => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ]);

        $projek = $request->projek_id;
        $ada = Absen::select('user_id')
                    ->where([
                        ['projek_id', '=', $projek],
                        ['tanggal_datang', '=', date('d-m-Y')],
                    ])
                    ->get(); 

        if(count($ada) == 0)
        {
            $data= new Absen();

            if($request->hasFile('foto')) {
                Storage::disk('local')->delete('public/absen/'.$data->foto);

                $file       =   $request->file('foto');
                $fileName   =   $file->hashName();
                $location   =   public_path('storage/absen/'. $fileName);
                Image::make($file)->save($location);
                $data->foto = $fileName;
            }

            // $data->projek_id   		= $request->projek_id;
            $data->latitude_datang   		= $request->latitude_datang;
            $data->longitude_datang   		= $request->longitude_datang;
            $data->lokasi_datang   		= $request->latitude_datang. ',' .$request->longitude_datang;
            $data->jam_datang   		= $request->jam_datang;
            $data->tanggal_datang   		= $request->tanggal_datang;
            $data->hari_datang   		= $request->hari_datang;
            $data->bulan_datang   		= $request->bulan_datang;
            $data->tahun_datang   		= $request->tahun_datang;
            $data->user_id   		= Auth::user()->id;
            $data->edit_by   		= Auth::user()->id;

            $data->save();
    
        
            toastr()->success('Data berhasil disimpan!');
            return redirect()->route('absensi.index');
            // return redirect()->route('absensi.show', [$request->tukang_id]);
            // return redirect()->route('absensi.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
        }
        else{
            toastr()->error('Anda sudah absen hari ini!');
            return redirect()->route('absensi.index');
            // return redirect()->route('absensi.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
        }      
    }
    
    public function update(Request $request)
    {
        $absen = Absen::findOrFail($request->id);
        $absen->update([
            'latitude_pulang'   => $request->latitude_pulang,
            'longitude_pulang'   => $request->longitude_pulang,
            'lokasi_pulang'   => $request->latitude_pulang. ',' .$request->longitude_pulang,
            'jam_pulang'   => $request->jam_pulang,
            'tanggal_pulang'   => $request->tanggal_pulang,
            'hari_pulang'   => $request->hari_pulang,
            'bulan_pulang'   => $request->bulan_pulang,
            'tahun_pulang'   => $request->tahun_pulang,
            'edit_by'   => Auth::user()->id,
        ]);
 
        toastr()->success('Data berhasil disimpan!');
        // return redirect()->route('absensi.show', [$request->tukang_id]);
        // return redirect()->route('absensi.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
        return redirect()->route('absensi.index');
    }

    // LEMBUR
    
    public function absensilembur_index()
    {
        $absenlemburs = Tukang::select('tukangs.*', 'projeks.uraian_pekerjaan')
                        ->leftjoin('projeks', 'projeks.id', '=', 'tukangs.projek_id')
                        ->orderBy('projeks.id', 'DESC')
                        ->where('tukangs.user_id', Auth::user()->id)
                        ->get();

        return view('karyawan.absenlembur.index', compact('absenlemburs'));
    }

    public function absensilembur_detail($id, $user_id)
    {
        $absens = AbsenLembur::select('absen_lemburs.*', 'users.name')
                        ->leftjoin('projeks', 'projeks.id', '=', 'absen_lemburs.projek_id')
                        ->leftjoin('users', 'users.id', '=', 'absen_lemburs.user_id')
                        ->orderBy('projeks.id', 'DESC')
                        ->where('absen_lemburs.user_id', '=', $user_id)
                        ->get();

        $tukangs = Tukang::where('tukangs.id', '=', $id)->first();
        
        $absen = User::where('id', '=', $user_id)->first();

        return view('karyawan.absenlembur.detail', compact('absens', 'absen', 'tukangs'));
    }

    public function absensilembur_create($tukang_id)
    {
        $tukangs = Tukang::where('id', '=', $tukang_id)->first();

        return view('karyawan.absenlembur.create', compact('tukangs'));
    }

    public function absensilembur_add(Request $request)
    {
        $this->validate($request, [
            'ttd'  => 'required',
            'foto'  => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ]);

        $projek = $request->projek_id;
        $ada = AbsenLembur::select('user_id')
                    ->where([
                        ['projek_id', '=', $projek],
                        ['tanggal_datang', '=', date('d-m-Y')],
                    ])
                    ->get(); 

        if(count($ada) == 0)
        {
            //upload foto
            $foto = $request->file('foto');
            $foto->storeAs('public/absenlembur', $foto->hashName());
            $foto = $foto->hashName();

            // $ttd = $request->file('ttd');
            // $ttd->storeAs('public/ttd', $ttd->hashName());
            // $ttd = $ttd->hashName();
            
            $folderPath = public_path('ttd_lembur/');
            // dd($folderPath);
            
            $image_parts = explode(";base64,", $request->ttd);
                
            $image_type_aux = explode("image/", $image_parts[0]);
            
            $image_type = $image_type_aux[1];
            
            $image_base64 = base64_decode($image_parts[1]);

            $filename = uniqid() . '.'.$image_type;
            
            $file = $folderPath . $filename;
        
            file_put_contents($file, $image_base64);
            // dd($file, $image_base64, $image_type, $image_type_aux, $image_parts, $folderPath);

            $absen = AbsenLembur::create([
                'latitude_datang'   => $request->latitude_datang,
                'longitude_datang'   => $request->longitude_datang,
                'lokasi_datang'   => $request->latitude_datang. ',' .$request->longitude_datang,
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
            // return redirect()->route('absenlembur.show', [$request->tukang_id]);
            return redirect()->route('absensilembur.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
        }
        else{
            toastr()->error('Anda sudah absen hari ini!');
            return redirect()->route('absensilembur.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
        }       
    }
    
    public function absensilembur_update(Request $request)
    {
        $absen = AbsenLembur::findOrFail($request->id);

        $absen->update([
            'latitude_pulang'   => $request->latitude_pulang,
            'longitude_pulang'   => $request->longitude_pulang,
            'lokasi_pulang'   => $request->latitude_pulang. ',' .$request->longitude_pulang,
            'jam_pulang'   => $request->jam_pulang,
            'tanggal_pulang'   => $request->tanggal_pulang,
            'hari_pulang'   => $request->hari_pulang,
            'bulan_pulang'   => $request->bulan_pulang,
            'tahun_pulang'   => $request->tahun_pulang,
            'edit_by'   => Auth::user()->id,
        ]);
 
        toastr()->success('Data berhasil disimpan!');
        // return redirect()->route('absenlembur.show', [$request->tukang_id]);
        return redirect()->route('absensilembur.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
    }
}
