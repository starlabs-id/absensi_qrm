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
use App\Models\User;
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
            $projeks = $projeks->where('nama_projek', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.projek.index', compact('projeks'));
    }

    public function show($id)
    {
        $projeks = Projek::where('id', '=', $id)->first();
        
        $tukangs = Tukang::select('tukangs.*', 'projeks.nama_projek', 'users.name')
                            ->leftjoin('projeks', 'projeks.id', '=', 'tukangs.projek_id')
                            ->leftjoin('users', 'users.id', '=', 'tukangs.user_id')
                            ->orderBy('tukangs.id', 'desc')
                            ->where('projeks.id', '=', $id)
                            ->get();

        $chatdetails = ChatDetail::select('chat_details.*', 'users.name', 'users.foto')
                            ->leftjoin('chats', 'chats.slug', '=', 'chat_details.chat_id')
                            ->leftjoin('users', 'users.id', '=', 'chat_details.pengirim')
                            ->leftjoin('projeks', 'projeks.id', '=', 'chats.projek_id')
                            ->where('chats.projek_id', '=', $id)
                            ->get();
        
        $detailprojeks = DetailProjek::select('detail_projeks.id', 'detail_projeks.uraian_pekerjaan', 'detail_projeks.volume_kontrak', 'detail_projeks.harga_satuan', 'projeks.id as pid', 'projeks.nama_projek')
                                    ->leftjoin('projeks', 'projeks.id', '=', 'detail_projeks.projek_id')
                                    ->orderBy('detail_projeks.id', 'DESC')
                                    ->get();

        $chats = Chat::where('projek_id', '=', $id)->first();

        return view('admin.projek.show', compact('projeks', 'tukangs', 'chatdetails', 'chats', 'detailprojeks'));
    }

    public function create()
    {
        $marketing = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Marketing")
                    ->get();

        $pm = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "PM")
                    ->get();

        $supervisor = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Supervisor")
                    ->get();

        $owner = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Owner")
                    ->get();

        return view('admin.projek.create', compact('marketing', 'pm', 'supervisor', 'owner'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'nama_projek'  => 'required',
            'kode_projek'  => 'required',
            'area_projek'  => 'required',
            'nomor_kontrak'  => 'required',
            'tanggal_kontrak'  => 'required',
            'judul_kontrak'  => 'required',
            'nilai_kontrak'  => 'required',
            'durasi_kontrak'  => 'required',
            'lokasi'  => 'required',
            'pemberi_kerja'  => 'required',
            'pm'  => 'required',
            'marketing'  => 'required',
            'supervisor'  => 'required',
            'rencana_kerja'  => 'required',
            'owner'  => 'required',
            'tanggal_mulai'  => 'required',
            'total_pekerja'  => 'required',
        ]); 
        $projek = Projek::create([
            'nama_projek'   => $request->nama_projek,
            'kode_projek'   => $request->kode_projek,
            'area_projek'   => $request->area_projek,
            'nomor_kontrak'   => $request->nomor_kontrak,
            'tanggal_kontrak'   => $request->tanggal_kontrak,
            'judul_kontrak'   => $request->judul_kontrak,
            'nilai_kontrak'   => $request->nilai_kontrak,
            'durasi_kontrak'   => $request->durasi_kontrak,
            'lokasi'   => $request->lokasi,
            'pemberi_kerja'   => $request->pemberi_kerja,
            'pm'   => $request->pm,
            'marketing'   => $request->marketing,
            'supervisor'   => $request->supervisor,
            'rencana_kerja'   => $request->rencana_kerja,
            'owner'   => $request->owner,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'total_volume_kontrak'   => $request->total_volume_kontrak,
            'total_harga_satuan'   => $request->total_harga_satuan,
            'total_volume_pekerjaan_hari_ini'   => $request->total_volume_pekerjaan_hari_ini,
            'status'   => "process",
            'total_pekerja'   => $request->total_pekerja,
            'edit_by'   => Auth::user()->id,
        ]);

        toastr()->success('Data berhasil disimpan!');
        // return redirect()->route('projek.index', [ $request->idjadwal, '#team']);
        return redirect()->route('projek.index');
    }

    public function edit($id)
    {
        $projek = Projek::where('id', '=', $id)->first();

        $marketing = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Marketing")
                    ->get();

        $pm = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "PM")
                    ->get();

        $supervisor = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Supervisor")
                    ->get();

        $owner = User::select('users.id', 'users.name as namea', 'roles.id as ris', 'roles.name')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->where('roles.name', '=', "Owner")
                    ->get();

        return view('admin.projek.edit', compact('projek', 'marketing', 'pm', 'supervisor', 'owner'));
    }

    
    public function update(Request $request)
    {
        $this->validate($request, [
            'nama_projek'  => 'required',
            'kode_projek'  => 'required',
            'area_projek'  => 'required',
            'nomor_kontrak'  => 'required',
            'tanggal_kontrak'  => 'required',
            'judul_kontrak'  => 'required',
            'nilai_kontrak'  => 'required',
            'durasi_kontrak'  => 'required',
            'lokasi'  => 'required',
            'pemberi_kerja'  => 'required',
            'pm'  => 'required',
            'marketing'  => 'required',
            'supervisor'  => 'required',
            'rencana_kerja'  => 'required',
            'owner'  => 'required',
            'tanggal_mulai'  => 'required',
            'total_volume_kontrak'  => 'required',
            'total_harga_satuan'  => 'required',
            'total_pekerja'  => 'required',
        ]); 

        $projek = Projek::findOrFail($request->id);
        $projek->update([
            'nama_projek'   => $request->nama_projek,
            'kode_projek'   => $request->kode_projek,
            'area_projek'   => $request->area_projek,
            'nomor_kontrak'   => $request->nomor_kontrak,
            'tanggal_kontrak'   => $request->tanggal_kontrak,
            'judul_kontrak'   => $request->judul_kontrak,
            'nilai_kontrak'   => $request->nilai_kontrak,
            'durasi_kontrak'   => $request->durasi_kontrak,
            'lokasi'   => $request->lokasi,
            'pemberi_kerja'   => $request->pemberi_kerja,
            'pm'   => $request->pm,
            'marketing'   => $request->marketing,
            'supervisor'   => $request->supervisor,
            'rencana_kerja'   => $request->rencana_kerja,
            'owner'   => $request->owner,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'total_volume_kontrak'   => $request->total_volume_kontrak,
            'total_harga_satuan'   => $request->total_harga_satuan,
            'total_pekerja'   => $request->total_pekerja,
            'edit_by'   => Auth::user()->id,
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('projek.index');
    }

    
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $projek = Projek::find($request->id);

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

            toastr()->success('Data berhasil dihapus!');
            return response()->json($projek);
        }
    }

    public function chat_detail_add(Request $request)
    {
        $this->validate($request, [
            'komentar'  => 'required',
        ]); 
        $chatdetail = ChatDetail::create([
            'komentar'   => $request->komentar,
            'chat_id'   => $request->chat_id,
            'pengirim'   => $request->user_id,
        ]);

        toastr()->success('Chat berhasil terkirim!');
        // return redirect()->route('projek.show', [$request->projek_id, '#chat']);
        return redirect()->route('projek.show', [$request->projek_id])->withFragment('chat');
    }
}
