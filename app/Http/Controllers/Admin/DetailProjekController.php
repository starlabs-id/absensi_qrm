<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\AbsenLembur;
use App\Models\Chat;
use App\Models\ChatDetail;
use App\Models\DetailProjek;
use App\Models\FotoKerusakan;
use App\Models\JenisKerusakan;
use App\Models\ListPekerjaan;
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
        $level = ModelHasRoles::select('model_has_roles.*', 'roles.name')
                        ->leftjoin('users', 'users.id', '=', 'model_has_roles.model_id')
                        ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                        ->where('model_has_roles.model_id', Auth::user()->id)
                        ->first();
        
        if($level['name'] == 'APP' || $level['name'] == 'AP1')
        {
            toastr()->error('Anda dilarang masuk ke area ini.', 'Oopss...');
            return redirect()->to('/');
        }

        $detailprojeks = DetailProjek::select('detail_projeks.*', 'projeks.id as pid', 'projeks.tanggal')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'detail_projeks.projek_id')
                                    ->orderBy('detail_projeks.id', 'DESC')
                                    ->get();

        return view('admin.detailprojek.index', compact('detailprojeks', 'level'));
    }

    public function show($id)
    {
        $detailprojeks = DetailProjek::select('detail_projeks.*', 'projeks.nama_projek')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'detail_projeks.projek_id')
                                    ->where('detail_projeks.id', '=', $id)
                                    ->first();

        return view('admin.detailprojek.show', compact('detailprojeks'));
    }

    public function kerusakan($id)
    {
        $detailprojeks = DetailProjek::select('detail_projeks.*', 'projeks.uraian_pekerjaan')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'detail_projeks.projek_id')
                                    ->where('detail_projeks.id', '=', $id)
                                    ->first();

        $jenis_kerusakan = JenisKerusakan::select('jenis_kerusakans.*', 'detail_projeks.id as pid', 'list_pekerjaans.nama_pekerjaan')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'jenis_kerusakans.id_projeks')
                                    ->leftjoin('detail_projeks', 'detail_projeks.id', '=', 'jenis_kerusakans.id_detail_projeks')
                                    ->leftjoin('list_pekerjaans', 'list_pekerjaans.id', '=', 'jenis_kerusakans.nama_kerusakan')
                                    ->orderBy('detail_projeks.id', 'DESC')
                                    ->where('jenis_kerusakans.id_detail_projeks', '=', $id)
                                    ->get();

        $foto_kerusakan = FotoKerusakan::select('foto_kerusakans.*', 'detail_projeks.id as pid')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'foto_kerusakans.id_projek')
                                    ->leftjoin('detail_projeks', 'detail_projeks.id', '=', 'foto_kerusakans.id_detail_projek')
                                    ->orderBy('detail_projeks.id', 'DESC')
                                    ->where('foto_kerusakans.id_detail_projek', '=', $id)
                                    ->get();

        return view('admin.detailprojek.kerusakan', compact('detailprojeks', 'jenis_kerusakan', 'foto_kerusakan'));
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
            'nama_pekerjaan'  => 'required',
            'status'  => 'required',
            'lokasi'  => 'required',
            'shift'  => 'required',
            'jam'  => 'required',
            'foto_1'  => 'required',
        ]); 

        $data= new DetailProjek();

        if($request->hasFile('foto_1')) {
            Storage::disk('local')->delete('public/projekdetail/'.$data->foto_1);

            $file       =   $request->file('foto_1');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $data->foto_1 = $fileName;
        }

        if($request->hasFile('foto_2')) {
            Storage::disk('local')->delete('public/projekdetail/'.$data->foto_2);

            $file       =   $request->file('foto_2');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/projekdetail/'. $fileName);
            Image::make($file)->save($location);
            $data->foto_2 = $fileName;
        }
        $data->projek_id   		= $request->projek_id;
        $data->nama_pekerjaan   		= $request->nama_pekerjaan;
        $data->status   		= $request->status;
        $data->lokasi   		= $request->lokasi;
        $data->shift   		= $request->shift;
        $data->jam   		= $request->jam;
        $data->edit_by   		= Auth::user()->id;

        $data->save();
    
        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('projekdetail.index');
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
            'nama_pekerjaan'  => 'required',
            'status'  => 'required',
            'lokasi'  => 'required',
            'shift'  => 'required',
        ]); 

        $detailprojeks = DetailProjek::findOrFail($request->id);

        $detailprojeks->nama_pekerjaan   		= $request->nama_pekerjaan;
        $detailprojeks->status        = $request->status;
        $detailprojeks->keterangan        = $request->keterangan;
        $detailprojeks->lokasi        = $request->lokasi;
        $detailprojeks->shift        = $request->shift;

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

        $detailprojeks->save();
    
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
    
    public function delete($id)
    {
        $detail = DetailProjek::find($id);

            $query1 = DB::table('foto_kerusakans')->where('id_detail_projek', '=', $detail->id)->delete();
            $query2 = DB::table('jenis_kerusakans')->where('id_detail_projeks', '=', $detail->id)->delete();

        $detail->delete();

        toastr()->success('Data berhasil dihapus!');
        return redirect()->route('projekdetail.index');
    }



    // KERUSAKAN
    public function kerusakan_create($id)
    {
        $projeks = Projek::get();
        $list_pekerjaan = ListPekerjaan::get();
        $detailprojeks = DetailProjek::where('id', '=', $id)->first();

        return view('admin.detailprojek.kerusakan_create', compact('projeks', 'list_pekerjaan', 'detailprojeks'));
    }

    public function kerusakan_add(Request $request)
    {
        $this->validate($request, [
            'id_detail_projeks' => 'required',
            'nama_kerusakan'  => 'required',
            'satuan'  => 'required',
            'volume'  => 'required',
        ]);

        $list = ListPekerjaan::where('id', '=', $request->nama_kerusakan)->first();
        $total_harga = $list->harga * $request->volume;
        $id_projeks = DetailProjek::where('id', '=', $request->id_detail_projeks)->first();

        $data= new JenisKerusakan();

        if($request->hasFile('foto')) {
            Storage::disk('local')->delete('public/foto_kerusakan/'.$data->foto);

            $file       =   $request->file('foto');
            $fileName   =   $file->hashName();
            $location   =   public_path('storage/foto_kerusakan/'. $fileName);
            Image::make($file)->save($location);
            $data->foto = $fileName;
        }

        $data->id_detail_projeks   		= $request->id_detail_projeks;
        $data->id_projeks   		= $id_projeks->projek_id;
        $data->nama_kerusakan   		= $request->nama_kerusakan;
        $data->harga   		= $list->harga;
        $data->satuan   		= $request->satuan;
        $data->total_harga   		= $total_harga;
        $data->volume   		= $request->volume;
        $data->edit_by   		= Auth::user()->id;

        $data->save();



        // $data = new FotoKerusakan();

        // if($request->hasFile('foto')) {
        //     Storage::disk('local')->delete('public/foto_kerusakan/'.$data->foto);

        //     $file       =   $request->file('foto');
        //     $fileName   =   $file->hashName();
        //     $location   =   public_path('storage/foto_kerusakan/'. $fileName);
        //     Image::make($file)->save($location);
        //     $data->foto = $fileName;
        // }

        // $data->id_detail_projek   		= $request->id_detail_projeks;
        // $data->id_projek   		= $id_projeks->projek_id;
        // $data->edit_by   		= Auth::user()->id;

        // $data->save();
    
        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('projekdetail.index');
    }
    
    public function kerusakan_delete($id)
    {
        $jenis = JenisKerusakan::find($id);
            // $query = DB::table('foto_kerusakans')->where('id_detail_projek', '=', $jenis->id_detail_projeks)->delete();
        $jenis->delete();

        toastr()->success('Data berhasil dihapus!');
        return redirect()->route('projekdetail.index');
    }
}
