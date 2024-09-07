<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\PenarikanController;
use App\Http\Controllers\NasabahAkunController;
use App\Http\Controllers\LogoutLandingController;
use App\Http\Controllers\RiwayatSetoranController;
use App\Http\Controllers\DashboardNasabahController;
use App\Http\Controllers\PenarikanApprovalController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaurUlangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PengelolaanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermintaanPengangkutanController;
use App\Http\Controllers\Auth\BankSampahUnitAuthController;
use App\Http\Controllers\BankSampahPusat\DashboardController as PusatDashboardController;
use App\Http\Controllers\BankSampahPusat\DaftarPermintaanPengangkutanController as PusatDaftarPermintaanPengangkutanController;
use App\Http\Controllers\BankSampahPusat\PusatJadwalPengangkutanController;
use App\Http\Controllers\BankSampahPusat\LaporanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DataSampahController;
use App\Http\Controllers\Admin\HargaSampahController as AdminHargaSampahController;
use App\Http\Controllers\Admin\AkunController as AdminAkunController;
use App\Http\Controllers\Admin\BankSampahUnitAccountController;
use App\Http\Controllers\JadwalPengangkutanController;
use App\Http\Controllers\BankSampahPusat\Auth\PusatLoginController;
use App\Http\Controllers\BankSampahPusat\Auth\RegisterController;
use App\Http\Controllers\BankSampahPusat\Auth\PusatForgotPasswordController;
use App\Http\Controllers\BankSampahPusat\Auth\PusatResetPasswordController;

// Rute untuk halaman utama
Route::get('/pusat/landing', function () {
    return view('landing');
})->name('landing');

// Rute logout ke halaman landing page pelita bangsa
Route::post('logout', function () {
    Auth::logout();
    return redirect()->route('pelita-bangsa');
})->name('logout');
Route::get('/', [LogoutLandingController::class, 'index'])->name('pelita-bangsa');

Route::get('unit/login', [LoginController::class, 'showLoginForm'])->name('unit.login');
Route::post('unit/login', [LoginController::class, 'login'])->name('unit.login');
Route::get('/unit/register', [BankSampahUnitAuthController::class, 'showRegistrationForm'])->name('unit.register');
Route::post('/unit/register', [BankSampahUnitAuthController::class, 'register'])->name('unit.register.submit');
Route::get('/unit/login', [BankSampahUnitAuthController::class, 'showLoginForm'])->name('unit.login');
Route::post('/unit/login', [BankSampahUnitAuthController::class, 'login'])->name('unit.login.submit');
Route::post('/unit/logout', [BankSampahUnitAuthController::class, 'logout'])->name('unit.logout');
Route::get('password/reset', [BankSampahUnitAuthController::class, 'showLinkRequestForm'])->name('unit.passwords.request');
Route::post('password/email', [BankSampahUnitAuthController::class, 'sendResetLinkEmail'])->name('unit.passwords.email');
Route::get('password/reset/{token}', [BankSampahUnitAuthController::class, 'showResetForm'])->name('unit.passwords.reset');
Route::post('password/reset', [BankSampahUnitAuthController::class, 'reset'])->name('unit.password.update');

// Route untuk login, register, dan perubahan password
Route::get('/nasabah/register', [NasabahAkunController::class, 'showRegisterForm'])->name('nasabah.register');
Route::post('/nasabah/register', [NasabahAkunController::class, 'register']);
Route::get('/nasabah/login', [NasabahAkunController::class, 'showLoginForm'])->name('nasabah.login');
Route::post('/nasabah/login', [NasabahAkunController::class, 'login']);
// Rute untuk reset password
Route::get('/password/change', [NasabahAkunController::class, 'showChangeForm'])->name('password.change.form');
Route::post('/password/change', [NasabahAkunController::class, 'change'])->name('password.change');

Route::middleware('auth:nasabah')->group(function () {
    Route::get('/profile/change-password', [NasabahAkunController::class, 'showChangeForm'])->name('nasabah.change-password.form');
    Route::post('/profile/change-password', [NasabahAkunController::class, 'change'])->name('nasabah.change-password');
    // Dashboard
    Route::get('/nasabah/dashboard', [DashboardNasabahController::class, 'index'])->name('nasabah.dashboard');
    // Penarikan Poin
    Route::get('/nasabah/penarikan-poin', [PenarikanController::class, 'createPoin'])->name('nasabah.penarikan-poin.create');
    Route::post('/nasabah/penarikan-poin', [PenarikanController::class, 'storePoin'])->name('nasabah.penarikan-poin.store');
    // Penarikan Saldo
    Route::get('/nasabah/penarikan-saldo', [PenarikanController::class, 'createSaldo'])->name('nasabah.penarikan-saldo.create');
    Route::post('/nasabah/penarikan-saldo', [PenarikanController::class, 'storeSaldo'])->name('nasabah.penarikan-saldo.store');
    // Riwayat Penarikan
    Route::get('/nasabah/riwayat-penarikan', [PenarikanController::class, 'riwayatPenarikan'])->name('nasabah.riwayat-penarikan');
    // Profile
    Route::view('/nasabah/profile', 'nasabah-page.profile.profile')->name('nasabah.profile');
    // Riwayat Setoran Sampah
    Route::get('/nasabah/riwayat-setoran-sampah', [RiwayatSetoranController::class, 'index'])->name('nasabah.riwayat-setoran-sampah');
});

Route::prefix('pusat')
    ->namespace('BankSampahPusat\Auth')
    ->group(function () {
        // login
        Route::get('/pusat/login', [PusatLoginController::class, 'showLoginForm'])->name('pusat.login');
        Route::post('/pusat/login', [PusatLoginController::class, 'login'])->name('pusat.login.submit');

        // register
        Route::get('/pusat/register', [RegisterController::class, 'showRegistrationForm'])->name('pusat.register');
        Route::post('/pusat/register', [RegisterController::class, 'register'])->name('register.submit');

        // reset password
        Route::get('/pusat/password/reset', [PusatForgotPasswordController::class, 'showLinkRequestForm'])->name('pusat.password.request');
        Route::post('/pusat/password/email', [PusatForgotPasswordController::class, 'sendResetLinkEmail'])->name('pusat.password.email');
        Route::get('/pusat/password/reset/{token}', [PusatForgotPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/pusat/password/reset', [PusatResetPasswordController::class, 'reset'])->name('pusat.password.update');
    });

Route::group(['middleware' => 'auth:bank_sampah_unit'], function () {
    Route::get('/unit/dashboard', [DashboardController::class, 'index'])->name('unit.dashboard');
    Route::get('unit/permintaan_pengangkutan', [PermintaanPengangkutanController::class, 'create'])->name('permintaan.pengangkutan.create');
    Route::post('unit/permintaan_pengangkutan', [PermintaanPengangkutanController::class, 'store'])->name('permintaan.pengangkutan.store');
    Route::get('unit/permintaan_pengangkutan/riwayat', [PermintaanPengangkutanController::class, 'riwayat'])->name('permintaan.pengangkutan.riwayat');
    Route::get('unit/permintaan_pengangkutan/{id}/edit', [PermintaanPengangkutanController::class, 'edit'])->name('permintaan.pengangkutan.edit');
    Route::put('unit/permintaan_pengangkutan/{id}', [PermintaanPengangkutanController::class, 'update'])->name('permintaan.pengangkutan.update');
    Route::delete('unit/permintaan_pengangkutan/{id}', [PermintaanPengangkutanController::class, 'destroy'])->name('permintaan.pengangkutan.destroy');
    Route::get('/unit/jadwal_pengangkutan', [JadwalPengangkutanController::class, 'index'])->name('unit.jadwal_pengangkutan');
    Route::get('/unit/permintaan_pengangkutan/selesai', [PermintaanPengangkutanController::class, 'permintaanSelesai'])->name('permintaan.pengangkutan.selesai');
    Route::get('/setoran', [SetoranController::class, 'index'])->name('setoran.index');
    Route::post('/setoran', [SetoranController::class, 'store'])->name('setoran.store');
    Route::get('/nasabah/search', [NasabahController::class, 'search'])->name('nasabah.search');
    Route::get('/setoran/export-pdf', [SetoranController::class, 'setoranExportPDF'])->name('setoran.setoranExportPDF');
    Route::get('/rekap-tahunan/export-pdf', [SetoranController::class, 'rekapTahunanExportPDF'])->name('rekap.export.pdf');
    Route::get('/laporan/penjualan/export-pdf', [PenjualanController::class, 'penjualanExportPDF'])->name('penjualan.exportPdf');
    Route::get('/laporan/daur-ulang/export-pdf', [DaurUlangController::class, 'exportPdf'])->name('daur_ulang.exportPdf');
    Route::get('/laporan/pengelolaan/export-pdf', [PengelolaanController::class, 'pengelolaanExportPDF'])->name('pengelolaan.export.pdf');
    Route::get('/laporan/setoran/excel', [SetoranController::class, 'setoranExportExcel'])->name('setoran.exportExcel');
    Route::get('/laporan/tahunan/export-excel', [SetoranController::class, 'rekapTahunanExportExcel'])->name('rekap.export.excel');
    Route::get('/laporan/penjualan/export-excel', [PenjualanController::class, 'penjualanExportExcel'])->name('penjualan.exportExcel');
    Route::get('/laporan/daur-ulang/export-excel', [DaurUlangController::class, 'exportExcel'])->name('daur_ulang.exportExcel');
    Route::get('/laporan/pengelolaan/export-excel', [PengelolaanController::class, 'pengelolaanExportExcel'])->name('pengelolaan.export.excel');
    Route::resource('setoran', SetoranController::class)->except(['create', 'edit', 'show']);
    Route::get('/setoran/{id}/detail', [SetoranController::class, 'show'])->name('setoran.show');
    Route::get('/setoran/{id}/edit', [SetoranController::class, 'edit'])->name('setoran.edit');
    Route::put('/setoran/{id}', [SetoranController::class, 'update'])->name('setoran.update');
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('nasabah.index');
    Route::post('/nasabah', [NasabahController::class, 'store'])->name('nasabah.store');
    Route::delete('/nasabah/{id}', [NasabahController::class, 'destroy'])->name('nasabah.destroy');
    Route::put('/nasabah/{id}', [NasabahController::class, 'update'])->name('nasabah.update');
    Route::get('/nasabah/{id}', [NasabahController::class, 'show'])->name('nasabah.show');
    Route::get('/kategori', [SampahController::class, 'indexKategori'])->name('sampah.kategori');
    Route::get('/setoran/search', [SetoranController::class, 'search'])->name('setoran.search');
    Route::get('/laporan/setoran', [SetoranController::class, 'rekapSetoran'])->name('setoran.rekapSetoran');
    Route::get('/laporan/tahunan', [SetoranController::class, 'rekapTahunan'])->name('setoran.rekapTahunan');
    Route::get('/laporan/penjualan', [PenjualanController::class, 'index'])->name('penjualan.laporan');
    Route::post('/penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('/laporan/pengelolaan', [PengelolaanController::class, 'laporanPengelolaan'])->name('laporan.pengelolaan');
    Route::get('/laporan/daur-ulang', [DaurUlangController::class, 'index'])->name('daur_ulang.index');
    Route::post('/daur-ulang/store', [DaurUlangController::class, 'store'])->name('daur_ulang.store');
    Route::get('/unit/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/unit/persetujuan-penarikan', [PenarikanApprovalController::class, 'index'])->name('unit.persetujuan-penarikan.index');
    Route::patch('/unit/penarikan-poin/{id}/approve', [PenarikanApprovalController::class, 'approvePoin'])->name('unit.penarikan-approval.poin.approve');
    Route::patch('/unit/penarikan-poin/{id}/reject', [PenarikanApprovalController::class, 'rejectPoin'])->name('unit.penarikan-approval.poin.reject');
    Route::patch('/unit/penarikan-saldo/{id}/approve', [PenarikanApprovalController::class, 'approveSaldo'])->name('unit.penarikan-approval.saldo.approve');
    Route::patch('/unit/penarikan-saldo/{id}/reject', [PenarikanApprovalController::class, 'rejectSaldo'])->name('unit.penarikan-approval.saldo.reject');
});

Route::prefix('pusat')
    ->namespace('BankSampahPusat\Auth')
    ->group(function () {
        // login
        Route::get('/pusat/login', [PusatLoginController::class, 'showLoginForm'])->name('pusat.login');
        Route::post('/pusat/login', [PusatLoginController::class, 'login'])->name('pusat.login.submit');

        // register
        Route::get('/pusat/register', [RegisterController::class, 'showRegistrationForm'])->name('pusat.register');
        Route::post('/pusat/register', [RegisterController::class, 'register'])->name('register.submit');

        // reset password
        Route::get('/pusat/password/reset', [PusatForgotPasswordController::class, 'showLinkRequestForm'])->name('pusat.password.request');
        Route::post('/pusat/password/email', [PusatForgotPasswordController::class, 'sendResetLinkEmail'])->name('pusat.password.email');
        Route::get('/pusat/password/reset/{token}', [PusatForgotPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/pusat/password/reset', [PusatResetPasswordController::class, 'reset'])->name('pusat.password.update');
    });

// Route dengan middleware 'auth'
Route::middleware(['auth:bank_sampah_pusat'])
    ->prefix('pusat')
    ->namespace('BankSampahPusat\Auth')
    ->group(function () {
        // logout
        Route::post('/pusat/logout', [PusatLoginController::class, 'logout'])->name('pusat.logout');
        Route::get('/pusat/dashboard', [PusatDashboardController::class, 'index'])->name('pusat.dashboard');
        Route::get('/permintaan_pengangkutan', [PusatDaftarPermintaanPengangkutanController::class, 'index'])->name('pusat.permintaan_pengangkutan');
        Route::post('/permintaan_pengangkutan/{id}/konfirmasi', [PusatDaftarPermintaanPengangkutanController::class, 'konfirmasi'])->name('pusat.konfirmasi_pengangkutan');
        Route::post('/permintaan_pengangkutan/{id}/atur_jadwal', [PusatDaftarPermintaanPengangkutanController::class, 'aturJadwal'])->name('pusat.jadwalkan_pengangkutan');
        Route::post('/permintaan_pengangkutan/{id}/menuju_tempat', [PusatDaftarPermintaanPengangkutanController::class, 'menujuTempat'])->name('pusat.menuju_tempat');
        Route::post('/permintaan_pengangkutan/{id}/selesai', [PusatDaftarPermintaanPengangkutanController::class, 'selesaiPengangkutan'])->name('pusat.selesai_pengangkutan');
        Route::get('/permintaan_pengangkutan/{id}/edit', [PusatDaftarPermintaanPengangkutanController::class, 'edit'])->name('pusat.permintaan_pengangkutan.edit');
        Route::put('/permintaan_pengangkutan/{id}', [PusatDaftarPermintaanPengangkutanController::class, 'update'])->name('pusat.permintaan_pengangkutan.update');
        Route::get('/jadwal_pengangkutan', [PusatJadwalPengangkutanController::class, 'index'])->name('pusat.jadwal_pengangkutan');
        Route::get('/riwayat_pengambilan/{id}/cetak', [PusatDaftarPermintaanPengangkutanController::class, 'cetakPdf'])->name('bank_sampah_pusat.cetak_pdf');
        Route::get('/riwayat_pengambilan', [PusatDaftarPermintaanPengangkutanController::class, 'riwayatPengangkutan'])->name('pusat.riwayat_pengambilan');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('pusat.laporan');
        Route::get('/pusat/laporan/excel', [LaporanController::class, 'exportExcel'])->name('pusat.laporan.excel');
    });

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/data_sampah', [DataSampahController::class, 'index'])->name('admin.data_sampah');
    Route::get('/data_sampah/create', [DataSampahController::class, 'create'])->name('admin.data_sampah.create');
    Route::post('/data_sampah', [DataSampahController::class, 'store'])->name('admin.data_sampah.store');
    Route::get('/data_sampah/{id}/edit', [DataSampahController::class, 'edit'])->name('admin.data_sampah.edit');
    Route::put('/data_sampah/{id}', [DataSampahController::class, 'update'])->name('admin.data_sampah.update');
    Route::delete('/data_sampah/{id}', [DataSampahController::class, 'destroy'])->name('admin.data_sampah.destroy');

    Route::get('/daftar_harga_sampah_pusat', [AdminHargaSampahController::class, 'index'])->name('admin.daftar_harga_sampah_pusat');
    Route::post('/daftar_harga_sampah_pusat', [AdminHargaSampahController::class, 'store'])->name('admin.daftar_harga_sampah_pusat.store');
    Route::get('/daftar_harga_sampah_pusat/create', [AdminHargaSampahController::class, 'create'])->name('admin.daftar_harga_sampah_pusat.create');
    Route::get('/daftar_harga_sampah_pusat/{id}/edit', [AdminHargaSampahController::class, 'edit'])->name('admin.daftar_harga_sampah_pusat.edit');
    Route::put('/daftar_harga_sampah_pusat/{id}', [AdminHargaSampahController::class, 'update'])->name('admin.daftar_harga_sampah_pusat.update');
    Route::delete('/daftar_harga_sampah_pusat/{id}', [AdminHargaSampahController::class, 'destroy'])->name('admin.daftar_harga_sampah_pusat.destroy');

    Route::get('daftar_harga_sampah_unit', [App\Http\Controllers\Admin\BankSampahUnitController::class, 'index'])->name('admin.daftar_harga_sampah_unit');
    Route::post('daftar_harga_sampah_unit', [App\Http\Controllers\Admin\BankSampahUnitController::class, 'store'])->name('admin.daftar_harga_sampah_unit.store');
    Route::put('daftar_harga_sampah_unit/{id}', [App\Http\Controllers\Admin\BankSampahUnitController::class, 'update'])->name('admin.daftar_harga_sampah_unit.update');
    Route::delete('daftar_harga_sampah_unit/{id}', [App\Http\Controllers\Admin\BankSampahUnitController::class, 'destroy'])->name('admin.daftar_harga_sampah_unit.destroy');

    Route::get('/daftar_akun/bank_sampah_unit', [BankSampahUnitAccountController::class, 'index'])->name('admin.daftar_akun.bank_sampah_unit');
    Route::get('/daftar_akun/nasabah', [AdminAkunController::class, 'nasabah'])->name('admin.daftar_akun.nasabah');
});