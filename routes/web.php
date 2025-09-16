<?php


// DKM Routes
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dkm\DkmAuthController;
use App\Http\Controllers\Dkm\ManagePenggunaController;
use App\Http\Controllers\Dkm\VerifyPinController;
use App\Http\Controllers\Dkm\ManajemenKontenController\KegiatanMasjidController;

Route::prefix('dkm')->name('dkm.')->group(function () {
    // Auth
    Route::get('/login', [DkmAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [DkmAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [DkmAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth.dkm')->group(function () {
        Route::get('/dashboard', [DkmAuthController::class, 'dashboard'])->name('dashboard');

        // 📌 Manajemen Konten
         Route::prefix('manajemenKonten')->name('manajemenKonten.')->group(function () {
            Route::delete('kegiatanMasjid/delete-multiple', [KegiatanMasjidController::class, 'destroyMultiple'])->name('kegiatanMasjid.destroyMultiple');
            Route::resource('kegiatanMasjid', KegiatanMasjidController::class);
        });

        // 📌 Kategori
        Route::resource('kategori', \App\Http\Controllers\Dkm\KategoriController::class);

        // 🔐 Verifikasi PIN
        Route::get('/verify-pin', [VerifyPinController::class, 'showVerifyForm'])->name('verifyPinForm');
        Route::post('/verify-pin', [VerifyPinController::class, 'verify'])->name('verifyPin');

        // 🔐 ManagePengguna
        Route::middleware('auth.dkm.pin')->group(function () {
            Route::resource('managePengguna', ManagePenggunaController::class);
        });
    });
});



Route::get('/', function () {
    return view('welcome');
});
