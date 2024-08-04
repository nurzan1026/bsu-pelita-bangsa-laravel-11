<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Nasabah;
use App\Models\Setoran;
use App\Models\DaurUlang;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalHargaPenjualan = Penjualan::sum('total_harga');

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

        $nasabahTerbaru = Nasabah::latest()->take(5)->get();

        $penjualanBulanan = Penjualan::selectRaw("strftime('%Y', tanggal_jual) as tahun, strftime('%m', tanggal_jual) as bulan, SUM(total_harga) as total")->groupBy('tahun', 'bulan')->orderBy('tahun', 'asc')->orderBy('bulan', 'asc')->get();

        $setoranBulanan = Setoran::selectRaw("strftime('%Y', tanggal_setor) as tahun, strftime('%m', tanggal_setor) as bulan, SUM(detail_setorans.berat) as total")->join('detail_setorans', 'setorans.id', '=', 'detail_setorans.setoran_id')->groupBy('tahun', 'bulan')->orderBy('tahun', 'asc')->orderBy('bulan', 'asc')->get();

        return view('bank_sampah_unit.dashboard', compact('totalHargaPenjualan', 'totalBeratSetoran', 'totalBeratDaurUlang', 'penjualanBulanan', 'nasabahTerbaru', 'setoranBulanan'));
    }
}
