<?php

use App\Http\Controllers\Admin\AbsenController;
use App\Http\Controllers\Admin\AbsenLemburController;
use App\Http\Controllers\Admin\ChatController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailProjekController;
use App\Http\Controllers\Admin\ProjekController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\ListPekerjaanController;
use App\Http\Controllers\Admin\TukangController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\GuestController;
use App\Models\ListLokasi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.index');
// })->name('home')->middleware('auth');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('pdf_so/{id}', [DashboardController::class, 'pdf_so'])->name('pdf.so');

Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function() {
        
        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');
        
        Route::get('users', [UsersController::class, 'index'])->name('users.index');
        Route::post('user_add', [UsersController::class, 'user_add'])->name('user.add');
        Route::get('user_edit/{id}', [UsersController::class, 'user_edit'])->name('user.edit');
        Route::post('user_update', [UsersController::class, 'user_update'])->name('user.update');
        Route::get('user_destroy', [UsersController::class, 'user_destroy'])->name('user.destroy');
        Route::post('user_import', [UsersController::class, 'user_import'])->name('user_import');
        Route::get('user_export', [UsersController::class, 'user_export'])->name('user_export');
        Route::get('role_export', [UsersController::class, 'role_export'])->name('role_export');
        Route::post('role_import', [UsersController::class, 'role_import'])->name('role_import');

        Route::get('profil', [UsersController::class, 'profil'])->name('profil');
        Route::post('profil_update', [UsersController::class, 'profil_update'])->name('profil.update');

        Route::get('role', [UsersController::class, 'role'])->name('role.index');
        Route::post('role_add', [UsersController::class, 'role_add'])->name('role.add');
        Route::get('role_edit/{id}', [UsersController::class, 'role_edit'])->name('role.edit');
        Route::post('role_update', [UsersController::class, 'role_update'])->name('role.update');
        Route::get('role_destroy', [UsersController::class, 'role_destroy'])->name('role.destroy');

        Route::get('permission', [UsersController::class, 'permission'])->name('permission.index');
        Route::post('permission_add', [UsersController::class, 'permission_add'])->name('permission.add');
        Route::post('permission_update', [UsersController::class, 'permission_update'])->name('permission.update');
        Route::get('permission_destroy', [UsersController::class, 'permission_destroy'])->name('permission.destroy');

        Route::get('projek', [ProjekController::class, 'index'])->name('projek.index');
        Route::get('projek_show/{id}', [ProjekController::class, 'show'])->name('projek.show');
        Route::get('projek_create', [ProjekController::class, 'create'])->name('projek.create');
        Route::post('projek_add', [ProjekController::class, 'add'])->name('projek.add');
        Route::get('projek_edit/{id}', [ProjekController::class, 'edit'])->name('projek.edit');
        Route::post('projek_update', [ProjekController::class, 'update'])->name('projek.update');
        Route::get('projek_destroy', [ProjekController::class, 'destroy'])->name('projek.destroy');
        Route::post('projek_chat_detail_add', [ProjekController::class, 'chat_detail_add'])->name('projek_chat.add');
        Route::get('projek_delete/{id}', [ProjekController::class, 'delete'])->name('projek.delete');
        Route::get('projek_approval_pm/{id}', [ProjekController::class, 'approval_pm'])->name('projek.approval_pm');
        Route::post('projek_approval_app', [ProjekController::class, 'approval_app'])->name('projek.approval_app');
        Route::post('projek_approval_ap1', [ProjekController::class, 'approval_ap1'])->name('projek.approval_ap1');

        Route::get('projekdetail', [DetailProjekController::class, 'index'])->name('projekdetail.index');
        Route::get('projekdetail_show/{id}', [DetailProjekController::class, 'show'])->name('projekdetail.show');
        Route::get('projekdetail_create', [DetailProjekController::class, 'create'])->name('projekdetail.create');
        Route::post('projekdetail_add', [DetailProjekController::class, 'add'])->name('projekdetail.add');
        Route::get('projekdetail_edit/{id}', [DetailProjekController::class, 'edit'])->name('projekdetail.edit');
        Route::post('projekdetail_update', [DetailProjekController::class, 'update'])->name('projekdetail.update');
        Route::get('projekdetail_destroy', [DetailProjekController::class, 'destroy'])->name('projekdetail.destroy');
        Route::get('projekdetail_delete/{id}', [DetailProjekController::class, 'delete'])->name('projekdetail.delete');
        
        Route::get('projekdetail_kerusakan/{id}', [DetailProjekController::class, 'kerusakan'])->name('projekdetail.kerusakan');
        Route::get('projekdetailkerusakan_create/{id}', [DetailProjekController::class, 'kerusakan_create'])->name('projekdetail.kerusakancreate');
        Route::post('projekdetailkerusakan_add', [DetailProjekController::class, 'kerusakan_add'])->name('projekdetail.kerusakanadd');
        Route::get('projekdetailkerusakan_delete/{id}', [DetailProjekController::class, 'kerusakan_delete'])->name('projekdetail.kerusakandelete');

        Route::get('shift', [ShiftController::class, 'index'])->name('shift.index');
        Route::post('shift_add', [ShiftController::class, 'add'])->name('shift.add');
        Route::post('shift_update', [ShiftController::class, 'update'])->name('shift.update');
        Route::get('shift_destroy', [ShiftController::class, 'destroy'])->name('shift.destroy');

        Route::get('listlokasi', [ListLokasi::class, 'index'])->name('listlokasi.index');
        Route::post('listlokasi_add', [ListLokasi::class, 'add'])->name('listlokasi_add');
        Route::post('listlokasi_update', [ListLokasi::class, 'update'])->name('listlokasi_update');
        Route::get('listlokasi_destroy', [ListLokasi::class, 'destroy'])->name('listlokasi_destroy');

        Route::get('list_pekerjaan', [ListPekerjaanController::class, 'index'])->name('list_pekerjaan.index');
        Route::post('list_pekerjaan_add', [ListPekerjaanController::class, 'add'])->name('list_pekerjaan.add');
        Route::post('list_pekerjaan_update', [ListPekerjaanController::class, 'update'])->name('list_pekerjaan.update');
        Route::get('list_pekerjaan_destroy', [ListPekerjaanController::class, 'destroy'])->name('list_pekerjaan.destroy');
        
        Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
        Route::get('chat_show/{slug}', [ChatController::class, 'show'])->name('chat.show');
        Route::post('chat_add', [ChatController::class, 'add'])->name('chat.add');
        Route::get('chat_edit/{id}', [ChatController::class, 'edit'])->name('chat.edit');
        Route::post('chat_update', [ChatController::class, 'update'])->name('chat.update');
        Route::get('chat_destroy', [ChatController::class, 'destroy'])->name('chat.destroy');
        Route::post('chat_detail_add', [ChatController::class, 'chat_detail_add'])->name('chat_detail.add');
        
        Route::get('tukang', [TukangController::class, 'index'])->name('tukang.index');
        Route::post('tukang_add', [TukangController::class, 'add'])->name('tukang.add');
        Route::get('tukang_destroy', [TukangController::class, 'destroy'])->name('tukang.destroy');

        Route::get('absen', [AbsenController::class, 'index'])->name('absen.index');
        Route::get('absen_show/{id}', [AbsenController::class, 'show'])->name('absen.show');
        Route::get('absen_detail/{id}/{user_id}', [AbsenController::class, 'detail'])->name('absen.detail');
        Route::get('absen_create/{id}', [AbsenController::class, 'create'])->name('absen.create');
        Route::post('absen_add', [AbsenController::class, 'add'])->name('absen.add');
        Route::post('absen_update', [AbsenController::class, 'update'])->name('absen.update');
        Route::post('absen_validasi', [AbsenController::class, 'validasi'])->name('absen.validasi');
        Route::get('absen_destroy', [AbsenController::class, 'destroy'])->name('absen.destroy');

        Route::get('absenlembur', [AbsenLemburController::class, 'index'])->name('absenlembur.index');
        Route::get('absenlembur_show/{id}', [AbsenLemburController::class, 'show'])->name('absenlembur.show');
        Route::get('absenlembur_detail/{id}/{user_id}', [AbsenLemburController::class, 'detail'])->name('absenlembur.detail');
        Route::get('absenlembur_create/{id}', [AbsenLemburController::class, 'create'])->name('absenlembur.create');
        Route::post('absenlembur_add', [AbsenLemburController::class, 'add'])->name('absenlembur.add');
        Route::post('absenlembur_update', [AbsenLemburController::class, 'update'])->name('absenlembur.update');
        Route::post('absenlembur_validasi', [AbsenLemburController::class, 'validasi'])->name('absenlembur.validasi');
        Route::get('absenlembur_destroy', [AbsenLemburController::class, 'destroy'])->name('absenlembur.destroy');
    });
});

Route::prefix('guest')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function() {

        Route::get('proyek', [GuestController::class, 'index'])->name('proyek.index');
        Route::get('proyek_show/{id}', [GuestController::class, 'show'])->name('proyek.show');
        Route::post('proyek_chat_detail_add', [GuestController::class, 'chat_detail_add'])->name('proyek_chat.add');

        Route::get('proyekdetail_show/{id}', [GuestController::class, 'detail_show'])->name('proyekdetail.show');

        Route::post('proyek_approval_app', [GuestController::class, 'approval_app'])->name('proyek.approval_app');
        Route::post('proyek_approval_ap1', [GuestController::class, 'approval_ap1'])->name('proyek.approval_ap1');
    });
});

Route::prefix('karyawan')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function() {

        Route::get('absensi', [KaryawanController::class, 'index'])->name('absensi.index');
        Route::get('absensi_detail/{id}/{user_id}', [KaryawanController::class, 'detail'])->name('absensi.detail');
        Route::get('absensi_create', [KaryawanController::class, 'create'])->name('absensi.create');
        Route::post('absensi_add', [KaryawanController::class, 'add'])->name('absensi.add');
        Route::post('absensi_update', [KaryawanController::class, 'update'])->name('absensi.update');

        Route::get('absensilembur', [KaryawanController::class, 'absensilembur_index'])->name('absensilembur.index');
        Route::get('absensilembur_detail/{id}/{user_id}', [KaryawanController::class, 'absensilembur_detail'])->name('absensilembur.detail');
        Route::get('absensilembur_create/{id}', [KaryawanController::class, 'absensilembur_create'])->name('absensilembur.create');
        Route::post('absensilembur_add', [KaryawanController::class, 'absensilembur_add'])->name('absensilembur.add');
        Route::post('absensilembur_update', [KaryawanController::class, 'absensilembur_update'])->name('absensilembur.update');
    });
});