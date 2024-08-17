<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenarikanPoinController;
use App\Http\Controllers\PenarikanSaldoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LogoutLandingController;
use App\Http\Controllers\Auth\NasabahAkunController;
use App\Http\Controllers\TabunganSampahController;


// Route untuk login, register, dan perubahan password
Route::get('/nasabah/register', [NasabahAkunController::class, 'showRegisterForm'])->name('nasabah.register');
Route::post('/nasabah/register', [NasabahAkunController::class, 'register']);

Route::get('/nasabah/login', [NasabahAkunController::class, 'showLoginForm'])->name('nasabah.login');
Route::post('/nasabah/login', [NasabahAkunController::class, 'login']);

// Rute untuk reset password
Route::get('/password/change', [NasabahAkunController::class, 'showChangeForm'])->name('password.change.form');
Route::post('/password/change', [NasabahAkunController::class, 'change'])->name('password.change');

Route::middleware('auth:nasabah')->group(function () {
    Route::get('/nasabah/dashboard', function () {
        return view('nasabah.dashboard');
    })->name('nasabah.dashboard');
});

// Rute halaman utama
Route::get('/nasabah', function () {
    return view('nasabah-page.pelita-bangsa');
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

    //  tabungan sampah 
    // Route::view('sampah-masuk', 'nasabah-page.tabungan-sampah.sampah-masuk')->name('sampah-masuk');
    // route::view('sampah-keluar', 'nasabah-page.tabungan-sampah.sampah-keluar')->name('sampah-keluar');
    
//    Route::get('/nasabah/sampah-masuk', [TabunganSampahController::class, 'riwayatMasuk'])->name('nasabah.sampah-masuk');
//    Route::get('/nasabah/sampah-keluar', [TabunganSampahController::class, 'riwayatKeluar'])->name('nasabah.sampah-keluar');
});

// Rute logout ke halaman landing page pelita bangsa
Route::post('logout', function () {
    Auth::logout();
    return redirect()->route('pelita-bangsa');
})->name('logout');
Route::get('/', [LogoutLandingController::class, 'index'])->name('pelita-bangsa');

