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
use Intervention\Image\Facades\Image;

class DetailProjekController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:projekdetail-list', ['only' => ['projekdetail']]);
        $this->middleware('permission:projekdetail-add', ['only' => ['projekdetail_add']]);
        $this->middleware('permission:projekdetail-update', ['only' => ['projekdetail_update']]);
        $this->middleware('permission:projekdetail-destroy', ['only' => ['projekdetail_destroy']]);
    }

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
        $detailprojeks = DetailProjek::select('detail_projeks.*', 'projeks.nama_projek')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'detail_projeks.projek_id')
                                    ->where('detail_projeks.id', '=', $id)
                                    ->first();

        return view('admin.detailprojek.show', compact('detailprojeks'));
    }

    public function create()
    {
        $projeks = Projek::get();

        return view('admin.detailprojek.create', compact('projeks'));
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
        
        if($request->hasFile('foto_1') != '') {
            
            if($request->file('foto_1') != '')
            {
                $foto_1 = $request->file('foto_1');
                $foto_1->storeAs('public/projekdetail', $foto_1->hashName());
                $foto_1 = $foto_1->hashName();
            }
            else{
                $foto_1 = null;
            }
            
            if($request->file('foto_2') != '')
            {
                $foto_2 = $request->file('foto_2');
                $foto_2->storeAs('public/projekdetail', $foto_2->hashName());
                $foto_2 = $foto_2->hashName();
            }
            else{
                $foto_2 = null;
            }
            
            if($request->file('foto_3') != '')
            {
                $foto_3 = $request->file('foto_3');
                $foto_3->storeAs('public/projekdetail', $foto_3->hashName());
                $foto_3 = $foto_3->hashName();
            }
            else{
                $foto_3 = null;
            }
            
            if($request->file('foto_4') != '')
            {
                $foto_4 = $request->file('foto_4');
                $foto_4->storeAs('public/projekdetail', $foto_4->hashName());
                $foto_4 = $foto_4->hashName();
            }
            else{
                $foto_4 = null;
            }
            
            if($request->file('foto_5') != '')
            {
                $foto_5 = $request->file('foto_5');
                $foto_5->storeAs('public/projekdetail', $foto_5->hashName());
                $foto_5 = $foto_5->hashName();
            }
            else{
                $foto_5 = null;
            }
            
            if($request->file('foto_6') != '')
            {
                $foto_6 = $request->file('foto_6');
                $foto_6->storeAs('public/projekdetail', $foto_6->hashName());
                $foto_6 = $foto_6->hashName();
            }
            else{
                $foto_6 = null;
            }
            
            if($request->file('foto_7') != '')
            {
                $foto_7 = $request->file('foto_7');
                $foto_7->storeAs('public/projekdetail', $foto_7->hashName());
                $foto_7 = $foto_7->hashName();
            }
            else{
                $foto_7 = null;
            }
            
            if($request->file('foto_8') != '')
            {
                $foto_8 = $request->file('foto_8');
                $foto_8->storeAs('public/projekdetail', $foto_8->hashName());
                $foto_8 = $foto_8->hashName();
            }
            else{
                $foto_8 = null;
            }
            
            if($request->file('foto_9') != '')
            {
                $foto_9 = $request->file('foto_9');
                $foto_9->storeAs('public/projekdetail', $foto_9->hashName());
                $foto_9 = $foto_9->hashName();
            }
            else{
                $foto_9 = null;
            }
            
            if($request->file('foto_10') != '')
            {
                $foto_10 = $request->file('foto_10');
                $foto_10->storeAs('public/projekdetail', $foto_10->hashName());
                $foto_10 = $foto_10->hashName();
            }
            else{
                $foto_10 = null;
            }
            
            $detailprojeks = DetailProjek::create([
                'projek_id'   => $request->projek_id,
                'uraian_pekerjaan'   => $request->uraian_pekerjaan,
                'volume_kontrak'   => $request->volume_kontrak,
                'harga_satuan'   => $request->harga_satuan,
                'volume_pekerjaan_hari_ini'   => $request->volume_pekerjaan_hari_ini,
                'volume_dikerjakan'   => $request->volume_dikerjakan,
                'prestasi_keuangan_hari_ini'   => $request->prestasi_keuangan_hari_ini,
                'prestasi_fisik_hari_ini'   => $request->prestasi_fisik_hari_ini,
                'tanggal'   => $request->tanggal,
                'foto_1'   => $foto_1,
                'foto_2'   => $foto_2,
                'foto_3'   => $foto_3,
                'foto_4'   => $foto_4,
                'foto_5'   => $foto_5,
                'foto_6'   => $foto_6,
                'foto_7'   => $foto_7,
                'foto_8'   => $foto_8,
                'foto_9'   => $foto_9,
                'foto_10'   => $foto_10,
                'keterangan'   => $request->keterangan,
                'edit_by'   => Auth::user()->id,
            ]);

            $projeks = Projek::findOrFail($request->projek_id);
    
            $total_volume_pekerjaan_sebelumnya = $projeks->total_volume_pekerjaan_sebelumnya + $detailprojeks->volume_pekerjaan_hari_ini;
            $total_prestasi_keuangan = $projeks->total_prestasi_keuangan + $detailprojeks->prestasi_keuangan_hari_ini;
            $total_prestasi_fisik = $projeks->total_prestasi_fisik + $detailprojeks->prestasi_fisik_hari_ini;
    
            $projeks->update([
                'total_volume_pekerjaan_sebelumnya'   => $total_volume_pekerjaan_sebelumnya,
                'total_volume_pekerjaan_hari_ini'   => $detailprojeks->volume_pekerjaan_hari_ini,
                'total_prestasi_keuangan'   => $total_prestasi_keuangan,
                'total_prestasi_fisik'   => $total_prestasi_fisik,
            ]);
     
            toastr()->success('Data berhasil disimpan!');
            return redirect()->route('projekdetail.index');
        }
        else{
            $detailprojeks = DetailProjek::create([
                'projek_id'   => $request->projek_id,
                'uraian_pekerjaan'   => $request->uraian_pekerjaan,
                'volume_kontrak'   => $request->volume_kontrak,
                'harga_satuan'   => $request->harga_satuan,
                'volume_pekerjaan_hari_ini'   => $request->volume_pekerjaan_hari_ini,
                'volume_dikerjakan'   => $request->volume_dikerjakan,
                'prestasi_keuangan_hari_ini'   => $request->prestasi_keuangan_hari_ini,
                'prestasi_fisik_hari_ini'   => $request->prestasi_fisik_hari_ini,
                'tanggal'   => $request->tanggal,
                'keterangan'   => $request->keterangan,
                'edit_by'   => Auth::user()->id,
            ]);

            $projeks = Projek::findOrFail($request->projek_id);
    
            $total_volume_pekerjaan_sebelumnya = $projeks->total_volume_pekerjaan_sebelumnya + $detailprojeks->volume_pekerjaan_hari_ini;
            $total_prestasi_keuangan = $projeks->total_prestasi_keuangan + $detailprojeks->prestasi_keuangan_hari_ini;
            $total_prestasi_fisik = $projeks->total_prestasi_fisik + $detailprojeks->prestasi_fisik_hari_ini;
    
            $projeks->update([
                'total_volume_pekerjaan_sebelumnya'   => $total_volume_pekerjaan_sebelumnya,
                'total_volume_pekerjaan_hari_ini'   => $detailprojeks->volume_pekerjaan_hari_ini,
                'total_prestasi_keuangan'   => $total_prestasi_keuangan,
                'total_prestasi_fisik'   => $total_prestasi_fisik,
            ]);
     
            toastr()->success('Data berhasil disimpan!');
            return redirect()->route('projekdetail.index');
        }
    }

    public function edit($id)
    {
        $detailprojeks = DetailProjek::where('id', '=', $id)->first();
        $projeks = Projek::get();

        return view('admin.detailprojek.edit', compact('detailprojeks', 'projeks'));
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

        // $detailprojeks = DetailProjek::findOrFail($request->id);
        // Storage::disk('local')->delete('public/projekdetail/'.$detailprojeks->foto_1);

        // $foto_1 = $request->file('foto_1');
        // $foto_1->storeAs('public/projekdetail', $foto_1->hashName());
        // $foto_1 = $foto_1->hashName();
        $detailprojeks = DetailProjek::findOrFail($request->id);

        $detailprojeks->projek_id   		= $request->projek_id;
        $detailprojeks->uraian_pekerjaan        = $request->uraian_pekerjaan;
        $detailprojeks->volume_kontrak        = $request->volume_kontrak;
        $detailprojeks->harga_satuan        = $request->harga_satuan;
        $detailprojeks->volume_pekerjaan_hari_ini        = $request->volume_pekerjaan_hari_ini;
        $detailprojeks->volume_dikerjakan       = $request->volume_dikerjakan;
        $detailprojeks->prestasi_keuangan_hari_ini            = $request->prestasi_keuangan_hari_ini;
        $detailprojeks->prestasi_fisik_hari_ini           = $request->prestasi_fisik_hari_ini;
        $detailprojeks->tanggal       = $request->tanggal;

        if($request->hasFile('foto_1')) {
            Storage::disk('local')->delete('public/projekdetail/'.$detailprojeks->foto_1);

            $file       =   $request->file('foto_1');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $detailprojeks->foto_1 = $fileName;
        }

        if($request->hasFile('foto_2')) {
            Storage::disk('local')->delete('public/projekdetail/'.$detailprojeks->foto_2);

            $file       =   $request->file('foto_2');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $detailprojeks->foto_2 = $fileName;
        }

        if($request->hasFile('foto_3')) {
            Storage::disk('local')->delete('public/projekdetail/'.$detailprojeks->foto_3);

            $file       =   $request->file('foto_3');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $detailprojeks->foto_3 = $fileName;
        }

        if($request->hasFile('foto_4')) {
            Storage::disk('local')->delete('public/projekdetail/'.$detailprojeks->foto_4);

            $file       =   $request->file('foto_4');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $detailprojeks->foto_4 = $fileName;
        }

        if($request->hasFile('foto_5')) {
            Storage::disk('local')->delete('public/projekdetail/'.$detailprojeks->foto_5);

            $file       =   $request->file('foto_5');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $detailprojeks->foto_5 = $fileName;
        }

        if($request->hasFile('foto_6')) {
            Storage::disk('local')->delete('public/projekdetail/'.$detailprojeks->foto_6);

            $file       =   $request->file('foto_6');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $detailprojeks->foto_6 = $fileName;
        }

        if($request->hasFile('foto_7')) {
            Storage::disk('local')->delete('public/projekdetail/'.$detailprojeks->foto_7);

            $file       =   $request->file('foto_7');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $detailprojeks->foto_7 = $fileName;
        }

        if($request->hasFile('foto_8')) {
            Storage::disk('local')->delete('public/projekdetail/'.$detailprojeks->foto_8);

            $file       =   $request->file('foto_8');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $detailprojeks->foto_8 = $fileName;
        }

        if($request->hasFile('foto_9')) {
            Storage::disk('local')->delete('public/projekdetail/'.$detailprojeks->foto_9);

            $file       =   $request->file('foto_9');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $detailprojeks->foto_9 = $fileName;
        }

        if($request->hasFile('foto_10')) {
            Storage::disk('local')->delete('public/projekdetail/'.$detailprojeks->foto_10);

            $file       =   $request->file('foto_10');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $detailprojeks->foto_10 = $fileName;
        }

        $detailprojeks->save();

        

        $projeks = Projek::findOrFail($request->projek_id);

        $total_volume_pekerjaan_sebelumnya = $projeks->total_volume_pekerjaan_sebelumnya + $detailprojeks->volume_pekerjaan_hari_ini;
        $total_prestasi_keuangan = $projeks->total_prestasi_keuangan + $detailprojeks->prestasi_keuangan_hari_ini;
        $total_prestasi_fisik = $projeks->total_prestasi_fisik + $detailprojeks->prestasi_fisik_hari_ini;

        $projeks->update([
            'total_volume_pekerjaan_sebelumnya'   => $total_volume_pekerjaan_sebelumnya,
            'total_volume_pekerjaan_hari_ini'   => $detailprojeks->volume_pekerjaan_hari_ini,
            'total_prestasi_keuangan'   => $total_prestasi_keuangan,
            'total_prestasi_fisik'   => $total_prestasi_fisik,
        ]);
    
        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('projekdetail.index');
        
    }
    
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = DetailProjek::find($request->id)->delete();

            return response()->json($data);
        }
    }
}
