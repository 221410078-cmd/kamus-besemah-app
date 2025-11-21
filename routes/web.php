<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KamusController;
use App\Http\Controllers\KataController;
use App\Http\Controllers\KalimatController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\ManajemenEditController;

// route belum login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'index'])->name('login');

// route sudah login role admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // halaman admin
    Route::get('kelola-user', [UserController::class, 'index'])->name('kelola-user');
    Route::get('kelola-kamus', [KamusController::class, 'index'])->name('kelola-kamus');
    Route::get('entry-kata', [KataController::class, 'index'])->name('entry-kata');
    Route::get('entry-kalimat',[KalimatController::class, 'index'])->name('entry-kalimat');
    Route::get('admin-validasi', [ValidasiController::class, 'index'] )->name('admin-validasi');

    // function kelola user (CRUD)
    Route::post('kelola-user', [UserController::class, 'tambahUser'])->name('kelola-user.tambah');
    Route::put('kelola-user/update/{user}', [UserController::class, 'updateUser'])->name('kelola-user.update');
    Route::delete('kelola-user/hapus/{user}', [UserController::class, 'hapusUser'])->name('kelola-user.hapus');
});

// route sudah login role validator
Route::middleware(['auth', 'role:validator'])->prefix('validator')->group(function () {
    Route::get('input-kata', [KataController::class, 'index'])->name('input-kata');
    Route::get('input-kalimat', [KalimatController::class, 'index'])->name('input-kata');
    Route::get('validasi-kata', [ValidasiController::class, 'index'])->name('validasi-kata');
    Route::get('validasi-kalimat', [ValidasiController::class, 'indexKalimat'])->name('validasi-kalimat');
    Route::get('validator-draf', [KamusController::class, 'index'])->name('validator-draf');
});


Route::middleware(['auth', 'role:kontributor'])->prefix('kontributor')->group(function () {
    Route::get('entry-kata', [KataController::class, 'index'])->name('entry-kata');
    Route::get('entry-kalimat', [KalimatController::class, 'index'])->name('input-kata');
    Route::get('manajemen-edit', [ManajemenEditController::class, 'index'])->name('manajemen-edit');
    Route::get('status', [KamusController::class, 'index'])->name('status');
});


Route::middleware(['auth', 'role:admin,validator,kontributor'])->group(function () {
    Route::prefix('{role}')->group(function () {
         // function kelola kata dan kalimat (CRUD)
        Route::post('entry-kata/tambah', [KataController::class, 'tambahKata'])->name('kata.tambah');
        Route::post('entry-kalimat/tambah', [KalimatController::class, 'tambahKalimat'])->name('kalimat.tambah');
        Route::put('validasi/kata', [ValidasiController::class, 'updateKata'])->name('validasi.updateKata');
        Route::put('validasi/kalimat', [ValidasiController::class, 'updateKalimat'])->name('validasi.updateKalimat');
        Route::delete('validasi/kata', [ValidasiController::class, 'deleteKata'])->name('validasi.kata.delete');
        Route::delete('validasi/kalimat', [ValidasiController::class, 'deleteKalimat'])->name('validasi.kalimat.delete');
        Route::put('validasi/update-status', [ValidasiController::class, 'updateStatus'])->name('validasi.updateStatus');
    });
});


// function untuk authentication
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


