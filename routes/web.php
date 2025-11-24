<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rute untuk halaman awal
Route::get('/', [AuthController::class, 'showLoginRegister'])->name('loginRegister');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('login.handle');

// Grup rute untuk proses registrasi
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/email', [AuthController::class, 'showEmailRegister'])->name('email');
    Route::post('/email', [AuthController::class, 'handleEmailRegister'])->name('email.handle');
    Route::get('/profile', [AuthController::class, 'showProfileRegister'])->name('profile');
    Route::post('/profile', [AuthController::class, 'handleProfileRegister'])->name('profile.handle');
});

// Rute untuk AJAX
Route::post('/ajax/check-email', [AuthController::class, 'checkEmail'])->name('ajax.checkEmail');

// Rute ini tidak lagi perlu dibungkus middleware
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
// Method logout diubah dari POST ke GET agar lebih mudah dipanggil dari tombol
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');