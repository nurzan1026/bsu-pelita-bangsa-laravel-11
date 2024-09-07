<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Nasabah;
use App\Models\Setoran;
use App\Models\DaurUlang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('bank_sampah_unit')->user();

        $totalHargaPenjualan = Penjualan::get()->sum(function ($penjualan) {
            return floatval($penjualan->total_harga);
        });

        $totalBeratSetoran = Setoran::with('detailSetoran')
            ->get()
            ->sum(function ($setoran) {
                return $setoran->detailSetoran->sum('berat');
            });

        $totalBeratDaurUlang = DaurUlang::with('detailDaurUlangs')
            ->get()
            ->sum(function ($daurUlang) {
                return optional($daurUlang->detailDaurUlangs)->sum('berat');
            });

        $nasabahTerbaru = Nasabah::with(['setoran.detailSetoran'])
            ->get()
            ->sortByDesc(function ($nasabah) {
                return $nasabah->setoran->sum(function ($setoran) {
                    return $setoran->detailSetoran->sum('berat');
                });
            })
            ->take(5)
            ->map(function ($nasabah) {
                $nasabah->total_berat = $nasabah->setoran->sum(function ($setoran) {
                    return $setoran->detailSetoran->sum('berat');
                });
                return $nasabah;
            });

        $penjualanBulanan = Penjualan::selectRaw('YEAR(tanggal_jual) as tahun, MONTH(tanggal_jual) as bulan, SUM(CAST(total_harga AS DECIMAL(10, 2))) as total')->groupBy('tahun', 'bulan')->orderBy('tahun', 'asc')->orderBy('bulan', 'asc')->get();

        $setoranBulanan = Setoran::selectRaw('YEAR(tanggal_setor) as tahun, MONTH(tanggal_setor) as bulan, SUM(detail_setorans.berat) as total')->join('detail_setorans', 'setorans.id', '=', 'detail_setorans.setoran_id')->groupBy('tahun', 'bulan')->orderBy('tahun', 'asc')->orderBy('bulan', 'asc')->get();

        return view('bank_sampah_unit.dashboard', compact('totalHargaPenjualan', 'totalBeratSetoran', 'totalBeratDaurUlang', 'penjualanBulanan', 'nasabahTerbaru', 'setoranBulanan', 'user'));
    }
}
