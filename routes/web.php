<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dkm\DkmAuthController;
use App\Http\Controllers\Dkm\ManagePenggunaController;
use App\Http\Controllers\Dkm\VerifyPinController;
use App\Http\Controllers\Dkm\ManajemenKontenController\KegiatanMasjidController;
use App\Http\Controllers\Dkm\ArtikelController;
use App\Http\Controllers\Dkm\KategoriController;
use App\Http\Controllers\Dkm\KategoriKegiatanMasjidController;
use App\Http\Controllers\Dkm\KategoriArtikelController;
use App\Http\Controllers\Dkm\JadwalImamController;
use App\Http\Controllers\Dkm\PemasukkanController;
use App\Http\Controllers\Dkm\KategoriPemasukkanController;
use App\Http\Controllers\Dkm\PengeluaranController;
use App\Http\Controllers\Dkm\KategoriPengeluaranController;
use App\Http\Controllers\Dkm\ManajemenKeuanganController;
use App\Http\Controllers\Dkm\GaleriController;


Route::get('/', function () {
    return view('welcome');
});

// ====================
// 📌 DKM Routes
// ====================
Route::prefix('dkm')->name('dkm.')->group(function () {
    
    // 🔐 Auth
    Route::get('/login', [DkmAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [DkmAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [DkmAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth.dkm')->group(function () {
        Route::get('/dashboard', [DkmAuthController::class, 'dashboard'])->name('dashboard');

        // ====================
        // 📌 Manajemen Konten
        // ====================
        Route::prefix('manajemenKonten')->name('manajemenKonten.')->group(function () {
            // Kegiatan Masjid
            Route::delete('kegiatanMasjid/delete-multiple', [KegiatanMasjidController::class, 'destroyMultiple'])->name('kegiatanMasjid.destroyMultiple');
            Route::resource('kegiatanMasjid', KegiatanMasjidController::class);
            // Artikel Masjid
            Route::resource('artikel', ArtikelController::class);
            // Jadwal Imam
            Route::resource('jadwalImam', JadwalImamController::class);
        });

        // ====================
        // 📌 ManajemeKeuangan
        // ====================
        Route::prefix('manajemenKeuangan')->name('manajemenKeuangan.')->group(function () {
            // Manajemen Keuangan
            Route::get('/', [ManajemenKeuanganController::class, 'index'])->name('index');
            // Hapus multiple pemasukkan
            Route::delete('/pemasukkan/bulk-delete', [PemasukkanController::class, 'bulkDelete'])->name('pemasukkan.bulkDelete');
            // Hapus multiple pengeluaran
            Route::delete('/pengeluaran/bulk-delete', [PengeluaranController::class, 'bulkDelete'])->name('pengeluaran.bulkDelete');
            // Pemasukkan
            Route::resource('pemasukkan', PemasukkanController::class);
            // Pengeluaran
            Route::resource('pengeluaran', PengeluaranController::class);
        });

        // ====================
        // 📌 ManajemeKeuangan
        // ====================
        Route::prefix('manajemenFasilitas')->name('manajemenFasilitas.')->group(function () {
            // Galeri
            Route::resource('galeri', GaleriController::class);
        });

        // ====================
        // 📌 Kategori
        // ====================
        Route::prefix('kategori')->name('kategori.')->group(function () {
            Route::get('/', [KategoriController::class, 'index'])->name('index'); 
            Route::resource('kegiatanMasjid', KategoriKegiatanMasjidController::class);
            Route::resource('artikel', KategoriArtikelController::class);
            Route::resource('pemasukkan', KategoriPemasukkanController::class);
            Route::resource('pengeluaran', KategoriPengeluaranController::class);
        });

        // ====================
        // 🔐 Verifikasi PIN
        // ====================
        Route::get('/verify-pin', [VerifyPinController::class, 'showVerifyForm'])->name('verifyPinForm');
        Route::post('/verify-pin', [VerifyPinController::class, 'verify'])->name('verifyPin');

        // ====================
        // 👥 Manajemen Pengguna (butuh PIN)
        // ====================
        Route::middleware('auth.dkm.pin')->group(function () {
            Route::resource('managePengguna', ManagePenggunaController::class);
        });
    });
});
