<?php

use App\Http\Controllers\Admin\AbsenController;
use App\Http\Controllers\Admin\AbsenLemburController;
use App\Http\Controllers\Admin\ChatController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailProjekController;
use App\Http\Controllers\Admin\ProjekController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\TukangController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('admin.index');
})->name('home')->middleware('auth');

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

        Route::get('projekdetail', [DetailProjekController::class, 'index'])->name('projekdetail.index');
        Route::get('projekdetail_show/{id}', [DetailProjekController::class, 'show'])->name('projekdetail.show');
        Route::get('projekdetail_create', [DetailProjekController::class, 'create'])->name('projekdetail.create');
        Route::post('projekdetail_add', [DetailProjekController::class, 'add'])->name('projekdetail.add');
        Route::get('projekdetail_edit/{id}', [DetailProjekController::class, 'edit'])->name('projekdetail.edit');
        Route::post('projekdetail_update', [DetailProjekController::class, 'update'])->name('projekdetail.update');
        Route::get('projekdetail_destroy', [DetailProjekController::class, 'destroy'])->name('projekdetail.destroy');

        Route::get('shift', [ShiftController::class, 'index'])->name('shift.index');
        Route::post('shift_add', [ShiftController::class, 'add'])->name('shift.add');
        Route::post('shift_update', [ShiftController::class, 'update'])->name('shift.update');
        Route::get('shift_destroy', [ShiftController::class, 'destroy'])->name('shift.destroy');
        
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
        
        Route::resource('/absen', AbsenController::class, ['as' => 'admin']);

        Route::resource('/absenlembur', AbsenLemburController::class, ['as' => 'admin']);

    });
});