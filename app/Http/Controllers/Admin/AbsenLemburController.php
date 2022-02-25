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

class AbsenLemburController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:absenlembur-list', ['only' => ['absenlembur']]);
        $this->middleware('permission:absenlembur-add', ['only' => ['absenlembur_add']]);
        $this->middleware('permission:absenlembur-update', ['only' => ['absenlembur_update']]);
        $this->middleware('permission:absenlembur-destroy', ['only' => ['absenlembur_destroy']]);

        $this->middleware('permission:validasi-update', ['only' => ['validasi-update']]);
    }
    
    public function index()
    {
        $level = ModelHasRoles::select('model_has_roles.*', 'roles.name')
                        ->leftjoin('users', 'users.id', '=', 'model_has_roles.model_id')
                        ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                        ->where('model_has_roles.model_id', Auth::user()->id)
                        ->first();
        
        if($level['name'] == 'Karyawan' || $level['name'] == 'Owner')
        {
            toastr()->error('Anda dilarang masuk ke area ini.', 'Oopss...');
            return redirect()->to('/');
        }

        $absenlemburs = Tukang::select('tukangs.id', 'projeks.nama_projek')
                        ->leftjoin('projeks', 'projeks.id', '=', 'tukangs.projek_id')
                        ->orderBy('projeks.id', 'DESC')
                        ->get();

        return view('admin.absenlembur.index', compact('absenlemburs', 'level'));
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

        return view('admin.absenlembur.show', compact('absens', 'tukangs'));
    }

    public function detail($id, $user_id)
    {
        $absens = AbsenLembur::select('absen_lemburs.*', 'users.name')
                        ->leftjoin('projeks', 'projeks.id', '=', 'absen_lemburs.projek_id')
                        ->leftjoin('users', 'users.id', '=', 'absen_lemburs.user_id')
                        ->orderBy('projeks.id', 'DESC')
                        ->where('absen_lemburs.user_id', '=', $user_id)
                        ->get();

        $tukangs = Tukang::where('tukangs.id', '=', $id)->first();
        
        $absen = User::where('id', '=', $user_id)->first();

        return view('admin.absenlembur.detail', compact('absens', 'absen', 'tukangs'));
    }

    public function create($tukang_id)
    {
        $tukangs = Tukang::where('id', '=', $tukang_id)->first();

        return view('admin.absenlembur.create', compact('tukangs'));
    }

    public function add(Request $request)
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
            return redirect()->route('absenlembur.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
        }
        else{
            toastr()->error('Anda sudah absen hari ini!');
            return redirect()->route('absenlembur.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
        }       
    }
    
    public function update(Request $request)
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
        return redirect()->route('absenlembur.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
    }
    
    public function validasi(Request $request)
    {
        $absen = AbsenLembur::findOrFail($request->id);

        // $data = Storage::disk('local')->delete('public/absenlembur/'.$absen->foto);
        // $image_path = "ttd_lembur/". $absen->ttd;
        // File::delete($image_path);
                
        $waktu_datang = strtotime($absen->jam_datang);
        $waktu_pulang = strtotime($absen->jam_pulang);

        $diff = $waktu_pulang - $waktu_datang;
        $jam    = floor($diff / (60 * 60));
        $menit    = $jam * 60;
        $total_lembur = $menit * 250;
        
        $absen->update([
            // 'validasi'   => $request->validasi,
            'jam_validasi'   => date('d-m-Y h:i:s'),
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'foto' => "",
            'ttd' => "",
            'total_biaya_lembur'   => $total_lembur,
            'validasi_by'   => $request->validasi_by,
        ]);
 
        toastr()->success('Data berhasil disimpan!');
        // return redirect()->route('absenlembur.show', [$request->tukang_id]);
        return redirect()->route('absenlembur.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
    }
    
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = AbsenLembur::find($request->id);
                $image = Storage::disk('local')->delete('public/absenlembur/'.$data->foto);
                $image_path = "ttd_lembur/". $data->ttd;
                File::delete($image_path);

            $data->delete();

            return response()->json($data);
        }
    }
}
