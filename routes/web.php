<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenarikanPoinController;
use App\Http\Controllers\PenarikanSaldoController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LogoutLandingController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\NasabahAkunController;

// Rute untuk registrasi dan login nasabah
Route::get('/nasabah/register', [NasabahAkunController::class, 'showRegisterForm'])->name('nasabah.register');
Route::post('/nasabah/register', [NasabahAkunController::class, 'register']);

Route::get('/nasabah/login', [NasabahAkunController::class, 'showLoginForm'])->name('nasabah.login');
Route::post('/nasabah/login', [NasabahAkunController::class, 'login']);

// Rute untuk reset password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware('auth:nasabah')->group(function () {
    Route::get('/nasabah/dashboard', function () {
        return view('nasabah-page.dashboard.dashboard');
    })->name('nasabah.dashboard');

    Route::post('/nasabah/logout', [NasabahAkunController::class, 'logout'])->name('nasabah.logout');
});


// Rute halaman utama
Route::get('/', function () {
    return view('pelita-bangsa');
});

// Rute untuk Nasabah
Route::prefix('nasabah')->name('nasabah.')->group(function () {
    // Dashboard
    Route::view('dashboard', 'nasabah-page.dashboard.dashboard')->name('dashboard');
    
    // Penarikan Poin
    Route::view('penarikan-poin', 'nasabah-page.penarikan-poin.penarikan-poin')->name('penarikan-poin');
    Route::post('penarikan-poin', [PenarikanPoinController::class, 'store'])->name('penarikan-poin.store');
    Route::get('riwayat-penarikan-poin', [PenarikanPoinController::class, 'index'])->name('riwayat-penarikan-poin');
    
    // Penarikan Saldo
    Route::view('penarikan-saldo', 'nasabah-page.penarikan-saldo.penarikan-saldo')->name('penarikan-saldo');
    Route::post('penarikan-saldo', [PenarikanSaldoController::class, 'store'])->name('penarikan-saldo.store');
    Route::get('riwayat-penarikan-saldo', [PenarikanSaldoController::class, 'index'])->name('riwayat-penarikan-saldo');
    
    // Profile
    Route::view('profile', 'nasabah-page.profile.profile')->name('profile');
    
    // Riwayat Setoran Sampah
    Route::view('riwayat-setoran-sampah', 'nasabah-page.riwayat-setoran-sampah.riwayat-setoran-sampah')->name('riwayat-setoran-sampah');

});


// Rute logout ke halaman landing page pelita bangsa
Route::post('logout', function () {
    Auth::logout();
    return redirect()->route('pelita-bangsa');
})->name('logout');
Route::get('/', [LogoutLandingController::class, 'index'])->name('pelita-bangsa');

