<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KategoriController;
use App\Models\Gudang;
use Illuminate\Support\Facades\DB;
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

Route::get('/', [GudangController::class, 'index'])->name('gudang.home');
Route::get('/detail/{id}', [GudangController::class, 'detail'])->name('gudang.detail');
// Route::get('/detail', [PeminjamanController::class, 'display'])->name('gudang.tampil');
Route::get('/rekomendasi', [GudangController::class, 'rekomendasi'])->name('gudang.rekomendasi');
Route::get('/list_gudang', [GudangController::class, 'listGudang'])->name('gudang.list');
Route::get('/list_gudang/{gudang}', [GudangController::class, 'listGudangSearch'])->name('gudang.listSearch');

// Login
Route::get('/login', [UserController::class, 'index'])->name('user.login');
Route::get('/admin/login', [UserController::class, 'login_admin'])->name('admin.login');
Route::post('/login', [UserController::class, 'login'])->name('user.proseslogin');
// Register
Route::get('/daftar', [UserController::class, 'daftar'])->name('user.daftar');
Route::post('/daftar', [UserController::class, 'store'])->name('user.prosesdaftar');
Route::post('/register', [UserController::class, 'registerAccount'])->name('user.register');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

// Peminjaman
Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('gudang.transaksi');

// Dashboard
Route::redirect('/dashboard', '/dashboard/history')->name('dashboard.index')->middleware('auth');

Route::prefix('dashboard')->group(function () {
    // Gudang
    Route::get('/gudang', [DashboardController::class, 'gudang'])->name('dashboard.gudang')->middleware('auth');
    Route::get('/gudang/add', [GudangController::class, 'create'])->name('dashboard.gudang_add')->middleware('auth');
    Route::post('/gudang/add', [GudangController::class, 'store'])->name('dashboard.gudang_post')->middleware('auth');
    Route::get('/gudang/update/{id}', [GudangController::class, 'edit'])->name('dashboard.gudang_update')->middleware('auth');
    Route::put('/gudang/update/{id}', [GudangController::class, 'update'])->name('dashboard.gudang_put')->middleware('auth');
    Route::delete('/gudang/delete/{id}', [GudangController::class, 'destroy'])->name('dashboard.gudang_delete')->middleware('auth');

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'kategori'])->name('dashboard.kategori')->middleware('auth');
    Route::get('/kategori/add', [KategoriController::class, 'create'])->name('dashboard.kategori_add')->middleware('auth');
    Route::post('/kategori/add', [KategoriController::class, 'store'])->name('dashboard.kategori_post')->middleware('auth');
    Route::get('/kategori/update/{id}', [KategoriController::class, 'edit'])->name('dashboard.kategori_update')->middleware('auth');
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('dashboard.kategori_put')->middleware('auth');
    Route::delete('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('dashboard.kategori_delete')->middleware('auth');

    Route::get('/admin', [UserController::class, 'index'])->name('dashboard.admin')->middleware('auth');
    Route::get('/admin/list_pelanggan', [UserController::class, 'listPelanggan'])->name('dashboard.pelanggan')->middleware('auth');
    Route::get('/admin/add', [UserController::class, 'create'])->name('dashboard.admin_add')->middleware('auth');
    Route::post('/admin/add', [UserController::class, 'store'])->name('dashboard.admin_post')->middleware('auth');
    Route::get('/admin/update/{id}', [UserController::class, 'edit'])->name('dashboard.admin_update')->middleware('auth');
    Route::put('/admin/update/{id}', [UserController::class, 'update'])->name('dashboard.admin_put')->middleware('auth');
    Route::delete('/admin/delete/{id}', [UserController::class, 'destroy'])->name('dashboard.admin_delete')->middleware('auth');
    // Route::get('/list_pelanggan/edit/{id}', [UserController::class, 'editPelanggan'])->name('pelanggan.update');
    // Route::put('/list_pelanggan/edit/{id}', [UserController::class, 'updatePelanggan'])->name('pelanggan.put');

    Route::get('/transaksi', [PeminjamanController::class, 'index'])->name('dashboard.transaksi')->middleware('auth');
    Route::put('/admin/transaksi/pengembalian', [PengembalianController::class, 'pengembalian'])->name('dashboard.pengembalian')->middleware('auth');
    // Route::delete('/admin/transaksi/delete/{id}', [PeminjamanController::class, 'destroy'])->name('dashboard.transaksi_delete')->middleware('auth');


    Route::get('/history', [PeminjamanController::class, 'history'])->name('dashboard.history')->middleware('auth');

    Route::get('/user', [UserController::class, 'dashboard_user'])->name('dashboard.user')->middleware('auth');
    Route::get('/user/add', [UserController::class, 'create'])->name('dashboard.user_add')->middleware('auth');
    Route::post('/user/add', [UserController::class, 'store'])->name('dashboard.user_post')->middleware('auth');
    Route::get('/user/update/{id}', [UserController::class, 'edit'])->name('dashboard.user_update')->middleware('auth');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('dashboard.user_put')->middleware('auth');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('dashboard.user_delete')->middleware('auth');
});
