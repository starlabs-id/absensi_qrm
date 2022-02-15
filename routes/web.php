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

        Route::resource('/projek', ProjekController::class, ['as' => 'admin']);
        Route::get('projek_detail', [ProjekController::class, 'show'])->name('projek.detail');

        Route::resource('/detailprojek', DetailProjekController::class, ['as' => 'admin']);
        Route::get('projek_edit', [ProjekController::class, 'edit'])->name('projek.edit');

        Route::resource('/absen', AbsenController::class, ['as' => 'admin']);

        Route::resource('/absenlembur', AbsenLemburController::class, ['as' => 'admin']);

        Route::resource('/shift', ShiftController::class, ['as' => 'admin']);
        Route::get('shift_edit', [ShiftController::class, 'edit'])->name('shift.edit');

        Route::resource('/tukang', TukangController::class, ['as' => 'admin']);
        Route::get('tukang_edit', [TukangController::class, 'edit'])->name('tukang.edit');

        Route::resource('/chat', ChatController::class, ['as' => 'admin']);
        Route::get('chat_edit', [ChatController::class, 'edit'])->name('chat.edit');

    });
});