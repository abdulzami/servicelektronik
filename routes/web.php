<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KebutuhanpengerjaanController;
use App\Http\Controllers\PengambilanBarangController;
use App\Http\Controllers\PendapatanController;
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

Route::get('/', [AuthController::class, 'index'])->name('login');

Route::post('/proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::get('/m-konsumen', [KonsumenController::class, 'index'])->name('m-konsumen');
        Route::get('/m-konsumen/create', [KonsumenController::class, 'create'])->name('m-konsumen.create');
        Route::post('/m-konsumen/store', [KonsumenController::class, 'store'])->name('m-konsumen.store');
        Route::get('/m-konsumen/{id}/edit', [KonsumenController::class, 'edit'])->name('m-konsumen.edit');
        Route::put('/m-konsumen/{id}/update', [KonsumenController::class, 'update'])->name('m-konsumen.update');
        Route::delete('/m-konsumen/{id}/delete', [KonsumenController::class, 'destroy'])->name('m-konsumen.delete');
        Route::put('/m-konsumen/{id}/reset_password', [KonsumenController::class, 'reset_password'])->name('m-konsumen.reset_password');

        Route::get('/m-barang', [BarangController::class, 'index'])->name('m-barang');
        Route::get('/m-barang/create', [BarangController::class, 'create'])->name('m-barang.create');
        Route::post('/m-barang/store', [BarangController::class, 'store'])->name('m-barang.store');
        Route::get('/m-barang/{id}/edit', [BarangController::class, 'edit'])->name('m-barang.edit');
        Route::put('/m-barang/{id}/update', [BarangController::class, 'update'])->name('m-barang.update');
        Route::delete('/m-barang/{id}/delete', [BarangController::class, 'destroy'])->name('m-barang.delete');

        Route::get('/m-kebutuhanpengerjaan/{id}', [KebutuhanPengerjaanController::class, 'index'])->name('m-kebutuhanpengerjaan');
        Route::get('/m-kebutuhanpengerjaan/{id}/create', [KebutuhanPengerjaanController::class, 'create'])->name('m-kebutuhanpengerjaan.create');
        Route::post('/m-kebutuhanpengerjaan/{id}/store', [KebutuhanPengerjaanController::class, 'store'])->name('m-kebutuhanpengerjaan.store');
        Route::get('/m-kebutuhanpengerjaan/{id}/edit/{id_barang}', [KebutuhanPengerjaanController::class, 'edit'])->name('m-kebutuhanpengerjaan.edit');
        Route::put('/m-kebutuhanpengerjaan/{id}/update', [KebutuhanPengerjaanController::class, 'update'])->name('m-kebutuhanpengerjaan.update');
        Route::delete('/m-kebutuhanpengerjaan/{id}/delete', [KebutuhanPengerjaanController::class, 'destroy'])->name('m-kebutuhanpengerjaan.delete');

        Route::get('/m-pengambilanbarang', [PengambilanBarangController::class, 'index'])->name('m-pengambilanbarang');
        Route::get('/m-pengambilanbarang/{id}/create', [PengambilanBarangController::class, 'create'])->name('m-pengambilanbarang.create');
        Route::post('/m-pengambilanbarang/{id}/store', [PengambilanBarangController::class, 'store'])->name('m-pengambilanbarang.store');
        Route::get('/m-pengambilanbarang/{id}/edit', [PengambilanBarangController::class, 'edit'])->name('m-pengambilanbarang.edit');
        Route::put('/m-pengambilanbarang/{id}/update', [PengambilanBarangController::class, 'update'])->name('m-pengambilanbarang.update');
        Route::delete('/m-pengambilanbarang/{id}/delete', [PengambilanBarangController::class, 'destroy'])->name('m-pengambilanbarang.delete');
        Route::get('/m-pengambilanbarang/{id}/cetaknota', [PengambilanBarangController::class, 'cetaknota'])->name('m-pengambilanbarang.cetaknota');
    });

    Route::group(['middleware' => ['cek_login:konsumen']], function () {
        Route::get('/barang', [BarangController::class, 'barang_konsumen'])->name('barang');
        Route::get('/profil', [KonsumenController::class, 'profil'])->name('profil');
        Route::put('/profil/{id}/ubahidentitas', [KonsumenController::class, 'ubah_identitas'])->name('ubahidentitas');
        Route::put('/profil/{id}/ubahpassword', [KonsumenController::class, 'ubah_password'])->name('ubahpassword');
        Route::get('/barang/{id}/cetaknota', [PengambilanBarangController::class, 'cetaknota2'])->name('barang.cetaknota');
    });
});