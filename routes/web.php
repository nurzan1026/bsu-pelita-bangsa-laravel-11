<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaurUlangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengelolaanController;
use App\Http\Controllers\PenarikanPoinController;
use App\Http\Controllers\PenarikanSaldoController;

// !  ========== Halaman utama Landing page==============
Route::get('/', function () {
    return view('pelita-bangsa');
});

// ! ============  Halaman bsu ======================
Route::get('/unit/dashboard', [DashboardController::class, 'index'])->name('unit.dashboard');
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

//  ! ==================== Halaman nasabah  ===========================
Route::prefix('nasabah')->name('nasabah.')->group(function () {
    Route::view('dashboard', 'nasabah-page.dashboard.dashboard')->name('dashboard');

    // Penarikan Poin
    Route::get('riwayat-penarikan-poin', [PenarikanPoinController::class, 'index'])->name('riwayat-penarikan-poin');
    Route::post('penarikan-poin', [PenarikanPoinController::class, 'store'])->name('penarikan-poin.store');
    
    // Penarikan Saldo
    Route::post('penarikan-saldo', [PenarikanSaldoController::class, 'store'])->name('penarikan-saldo.store');
    Route::get('riwayat-penarikan-saldo', [PenarikanSaldoController::class, 'index'])->name('riwayat-penarikan-saldo');
    
    // Profile
    Route::view('profile', 'nasabah-page.profile.profile')->name('profile');
    
    // Riwayat Penarikan Poin
    Route::view('riwayat-penarikan-poin', 'nasabah-page.riwayat-penarikan-poin.riwayat-penarikan-poin')->name('riwayat-penarikan-poin');
    
    // Riwayat Penarikan Saldo
    Route::view('riwayat-penarikan-saldo', 'nasabah-page.riwayat-penarikan-saldo.riwayat-penarikan-saldo')->name('riwayat-penarikan-saldo');
    
    // Riwayat Setoran Sampah
    Route::view('riwayat-setoran-sampah', 'nasabah-page.riwayat-setoran-sampah.riwayat-setoran-sampah')->name('riwayat-setoran-sampah');
});
