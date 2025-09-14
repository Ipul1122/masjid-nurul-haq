<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dkm\DkmAuthController;

Route::prefix('dkm')->name('dkm.')->group(function () {
    // login
    Route::get('/login', [DkmAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [DkmAuthController::class, 'login'])->name('login.submit');

    // butuh login
    Route::middleware('auth.dkm')->group(function () {
        Route::get('/dashboard', [DkmAuthController::class, 'dashboard'])->name('dashboard');
       Route::post('logout', [DkmAuthController::class, 'logout'])->name('logout');

    });
});

Route::get('/', function () {
    return view('welcome');
});
