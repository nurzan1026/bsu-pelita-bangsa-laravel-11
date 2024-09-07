<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Setoran;
use App\Models\DaurUlang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPengelolaanExport;

class PengelolaanController extends Controller
{
    public function laporanPengelolaan(Request $request)
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $rekapPengelolaan = array_fill_keys($months, [
            'sampah_masuk' => 0,
            'sampah_terangkut' => 0,
            'sampah_daur_ulang' => 0,
        ]);

        $tahun = $request->get('tahun');

        $setorans = Setoran::with('detailSetoran.sampah.harga')
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tanggal_setor', $tahun);
            })
            ->get();

        $penjualans = Penjualan::with('detailPenjualans.sampah')
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tanggal_jual', $tahun);
            })
            ->get();

        $daurUlangs = DaurUlang::with('detailDaurUlangs.sampah')
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tanggal_daur_ulang', $tahun);
            })
            ->get();

        foreach ($setorans as $setoran) {
            $month = Carbon::parse($setoran->tanggal_setor)->format('F');
            $totalBeratMasuk = $setoran->detailSetoran->sum('berat');
            $rekapPengelolaan[$month]['sampah_masuk'] += $totalBeratMasuk;
        }

        foreach ($penjualans as $penjualan) {
            $month = Carbon::parse($penjualan->tanggal_jual)->format('F');
            $totalBeratTerangkut = $penjualan->detailPenjualans->sum('berat');
            $rekapPengelolaan[$month]['sampah_terangkut'] += $totalBeratTerangkut;
        }

        foreach ($daurUlangs as $daurUlang) {
            $month = Carbon::parse($daurUlang->tanggal_daur_ulang)->format('F');
            $totalBeratDaurUlang = $daurUlang->detailDaurUlangs->sum('berat');
            $rekapPengelolaan[$month]['sampah_daur_ulang'] += $totalBeratDaurUlang;
        }

        $years = Setoran::selectRaw('distinct YEAR(tanggal_setor) as year')->union(Penjualan::selectRaw('YEAR(tanggal_jual) as year'))->union(DaurUlang::selectRaw('YEAR(tanggal_daur_ulang) as year'))->orderBy('year', 'desc')->pluck('year');

        return view('bank_sampah_unit.laporan.laporanPengelolaan', compact('rekapPengelolaan', 'years'));
    }

    public function pengelolaanExportPDF(Request $request)
    {
        $tahun = $request->get('tahun');
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $rekapPengelolaan = array_fill_keys($months, [
            'sampah_masuk' => 0,
            'sampah_terangkut' => 0,
            'sampah_daur_ulang' => 0,
        ]);

        $setorans = Setoran::with('detailSetoran.sampah.harga')
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tanggal_setor', $tahun);
            })
            ->get();

        $penjualans = Penjualan::with('detailPenjualans.sampah')
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tanggal_jual', $tahun);
            })
            ->get();

        $daurUlangs = DaurUlang::with('detailDaurUlangs.sampah')
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tanggal_daur_ulang', $tahun);
            })
            ->get();

        foreach ($setorans as $setoran) {
            $month = Carbon::parse($setoran->tanggal_setor)->format('F');
            $totalBeratMasuk = $setoran->detailSetoran->sum('berat');
            $rekapPengelolaan[$month]['sampah_masuk'] += $totalBeratMasuk;
        }

        foreach ($penjualans as $penjualan) {
            $month = Carbon::parse($penjualan->tanggal_jual)->format('F');
            $totalBeratTerangkut = $penjualan->detailPenjualans->sum('berat');
            $rekapPengelolaan[$month]['sampah_terangkut'] += $totalBeratTerangkut;
        }

        foreach ($daurUlangs as $daurUlang) {
            $month = Carbon::parse($daurUlang->tanggal_daur_ulang)->format('F');
            $totalBeratDaurUlang = $daurUlang->detailDaurUlangs->sum('berat');
            $rekapPengelolaan[$month]['sampah_daur_ulang'] += $totalBeratDaurUlang;
        }

        $html = view('bank_sampah_unit.laporan.pdf.pdfPengelolaan', compact('rekapPengelolaan'))->render();

        $mpdf = new Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('laporan_pengelolaan_sampah.pdf', 'I');
    }

    public function pengelolaanExportExcel(Request $request)
    {
        $tahun = $request->get('tahun');
        return Excel::download(new LaporanPengelolaanExport($tahun), 'laporan_pengelolaan_sampah.xlsx');
    }
}
