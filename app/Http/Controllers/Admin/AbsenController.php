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
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class AbsenController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:projek-list', ['only' => ['projek']]);
        $this->middleware('permission:projek-add', ['only' => ['projek_add']]);
        $this->middleware('permission:projek-update', ['only' => ['projek_update']]);
        $this->middleware('permission:projek-destroy', ['only' => ['projek_destroy']]);

        $this->middleware('permission:validasi-update', ['only' => ['validasi']]);
    }

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

        return view('admin.absen.detail', compact('absens', 'absen', 'tukangs'));
    }

    public function create($tukang_id)
    {
        $tukangs = Tukang::where('id', '=', $tukang_id)->first();

        return view('admin.absen.create', compact('tukangs'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'lokasi_datang' => 'required',
            'ttd'  => 'required',
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
            //upload foto
            $foto = $request->file('foto');
            $foto->storeAs('public/absen', $foto->hashName());
            $foto = $foto->hashName();

            // $ttd = $request->file('ttd');
            // $ttd->storeAs('public/ttd', $ttd->hashName());
            // $ttd = $ttd->hashName();
            
            $folderPath = public_path('ttd/');
            // dd($folderPath);
            
            $image_parts = explode(";base64,", $request->ttd);
                
            $image_type_aux = explode("image/", $image_parts[0]);
            
            $image_type = $image_type_aux[1];
            
            $image_base64 = base64_decode($image_parts[1]);

            $filename = uniqid() . '.'.$image_type;
            
            $file = $folderPath . $filename;
        
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
            return redirect()->route('absen.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
        }
        else{
            toastr()->error('Anda sudah absen hari ini!');
            return redirect()->route('absen.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
        }      
    }
    
    public function update(Request $request)
    {
        $absen = Absen::findOrFail($request->id);
        $absen->update([
            'jam_pulang'   => $request->jam_pulang,
            'tanggal_pulang'   => $request->tanggal_pulang,
            'hari_pulang'   => $request->hari_pulang,
            'bulan_pulang'   => $request->bulan_pulang,
            'tahun_pulang'   => $request->tahun_pulang,
            'edit_by'   => Auth::user()->id,
        ]);
 
        toastr()->success('Data berhasil disimpan!');
        // return redirect()->route('absen.show', [$request->tukang_id]);
        return redirect()->route('absen.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
    }
    
    public function validasi(Request $request)
    {
        $absen = Absen::findOrFail($request->id);

        $data = Storage::disk('local')->delete('public/absen/'.$absen->foto);
        $image_path = "ttd/". $absen->ttd;
        File::delete($image_path);
        
        $absen->update([
            // 'validasi'   => $request->validasi,
            'jam_validasi'   => date('d-m-Y h:i:s'),
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'foto' => "",
            'ttd' => "",
            'validasi_by'   => $request->validasi_by,
        ]);
 
        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('absen.detail', ['id'=>$request->tukang_id,'user_id'=>$request->user_id]);
    }
    
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = Absen::find($request->id);
                $image = Storage::disk('local')->delete('public/absen/'.$data->foto);
                $image_path = "ttd/". $data->ttd;
                File::delete($image_path);

            $data->delete();

            return response()->json($data);
        }
    }
}
