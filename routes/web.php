<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\kriteriaController;
use App\Http\Controllers\NilaiKriteriaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\NilaiAlterController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/auth/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/pages/tentang', function () {
    return view('pages.tentang');
})->name('pages.tentang');
Route::get('/pages/panduan', function () {
    return view('pages.panduan');
})->name('pages.panduan');
Route::get('/rekomendasi', [RekomendasiController::class, 'index']);
Route::post('/rekomendasi/store', [RekomendasiController::class, 'store'])->name('rekomendasi.store');
Route::get('/rekomendasi/hasil', [RekomendasiController::class, 'showHasil'])->name('rekomendasi.hasil');


Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::controller(ProdukController::class)->group(function () {
    Route::get('/produk', 'index');
    Route::get('/produk/create', 'create');
    Route::post('/produk/store', 'store');
    Route::get('/produk/edit/{id}', 'edit');
    Route::post('/produk/update/{id}', 'update');
    Route::delete('/produk/delete/{id}', 'destroy');
    Route::post('/produk/update-stok', 'updateStok');
});

Route::controller(AlternatifController::class)->group(function () {
    Route::get('/alternatif', 'index');
    Route::get('/alternatif/create', 'create');
    Route::post('/alternatif/store', 'store');
    Route::get('/alternatif/edit/{id}', 'edit');
    Route::post('/alternatif/update/{id}', 'update');
    Route::delete('/alternatif/delete/{id}', 'destroy');
});
Route::controller(NilaiAlterController::class)->group(function () {
    Route::get('/nilaialternatif', 'index');
    Route::get('/nilaialternatif/create', 'create');
    Route::post('/nilaialternatif/store', 'store');
    Route::get('/nilaialternatif/edit/{id}', 'edit');
    Route::post('/nilaialternatif/update/{id}', 'update');
    Route::delete('/nilaialternatif/delete/{id}', 'destroy');
    Route::get('/nilaialternatif/get-nilai-kriteria/{id}', 'getNilaiKriteria');
});
Route::controller(KriteriaController::class)->group(function () {
    Route::get('/kriteria', 'index');
    Route::get('/kriteria/create', 'create');
    Route::post('/kriteria/store', 'store');
    Route::get('/kriteria/edit/{id}', 'edit');
    Route::post('/kriteria/update/{id}', 'update');
    Route::delete('/kriteria/delete/{id}', 'destroy');
});
Route::controller(NilaiKriteriaController::class)->group(function () {
    Route::get('/nilaikriteria', 'index');
    Route::get('/nilaikriteria/create', 'create');
    Route::post('/nilaikriteria/store', 'store');
    Route::get('/nilaikriteria/edit/{id}', 'edit');
    Route::post('/nilaikriteria/update/{id}', 'update');
    Route::delete('/nilaikriteria/delete/{id}', 'destroy');
});
Route::controller(PerhitunganController::class)->group(function () {
    Route::get('/perhitungan',  'index');
    Route::post('/perhitungan/store',  'store');
    Route::get('/perhitungan/hasil', 'showHasil');
});

Route::post('/save-result', [HasilController::class, 'saveResult'])->name('save.result');
Route::controller(LaporanController::class)->group(function () {
    Route::get('/laporan', 'index')->name('laporan.index');
    Route::post('/laporan/store', 'store')->name('laporan.index.store');
    Route::delete('/laporan/delete/{id}', 'destroy')->name('laporan.delete');
});


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/data', [UserController::class, 'data'])->name('user.data');
Route::resource('users', UserController::class)->except(['index']);
Route::delete('/users/delete/{id}', [UserController::class, 'destroy']);
Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');


Route::controller(SettingController::class)->group(function () {
    Route::get('/setting', 'index')->name('setting');
    Route::get('/setting/frist', 'show')->name('setting.show');
    Route::post('/setting', 'update')->name('setting.update');
});

