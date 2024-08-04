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
    public function laporanPengelolaan()
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $rekapPengelolaan = [];
        foreach ($months as $month) {
            $rekapPengelolaan[$month]['sampah_masuk'] = '-';
            $rekapPengelolaan[$month]['sampah_terangkut'] = '-';
            $rekapPengelolaan[$month]['sampah_daur_ulang'] = '-';
        }

        $setorans = Setoran::with('detailSetoran.sampah.harga')->get();
        $penjualans = Penjualan::all();
        $daurUlangs = DaurUlang::with('detailDaurUlangs.sampah')->get();

        foreach ($setorans as $setoran) {
            $month = Carbon::parse($setoran->tanggal_setor)->format('F');
            $totalBeratMasuk = $setoran->detailSetoran->sum('berat');

            if ($rekapPengelolaan[$month]['sampah_masuk'] === '-') {
                $rekapPengelolaan[$month]['sampah_masuk'] = 0;
            }
            $rekapPengelolaan[$month]['sampah_masuk'] += $totalBeratMasuk;
        }

        foreach ($penjualans as $penjualan) {
            $month = Carbon::parse($penjualan->tanggal_jual)->format('F');
            $totalBeratTerangkut = $penjualan->detailPenjualans->sum('berat');

            if ($rekapPengelolaan[$month]['sampah_terangkut'] === '-') {
                $rekapPengelolaan[$month]['sampah_terangkut'] = 0;
            }
            $rekapPengelolaan[$month]['sampah_terangkut'] += $totalBeratTerangkut;
        }

        foreach ($daurUlangs as $daurUlang) {
            $month = Carbon::parse($daurUlang->tanggal_daur_ulang)->format('F');
            $totalBeratDaurUlang = $daurUlang->detailDaurUlangs->sum('berat');

            if ($rekapPengelolaan[$month]['sampah_daur_ulang'] === '-') {
                $rekapPengelolaan[$month]['sampah_daur_ulang'] = 0;
            }
            $rekapPengelolaan[$month]['sampah_daur_ulang'] += $totalBeratDaurUlang;
        }

        return view('bank_sampah_unit.laporan.laporanPengelolaan', compact('rekapPengelolaan'));
    }

    public function pengelolaanExportPDF()
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $rekapPengelolaan = [];
        foreach ($months as $month) {
            $rekapPengelolaan[$month]['sampah_masuk'] = '-';
            $rekapPengelolaan[$month]['sampah_terangkut'] = '-';
            $rekapPengelolaan[$month]['sampah_daur_ulang'] = '-';
        }

        $setorans = Setoran::with('detailSetoran.sampah.harga')->get();
        $penjualans = Penjualan::all();
        $daurUlangs = DaurUlang::with('detailDaurUlangs.sampah')->get();

        foreach ($setorans as $setoran) {
            $month = Carbon::parse($setoran->tanggal_setor)->format('F');
            $totalBeratMasuk = $setoran->detailSetoran->sum('berat');

            if ($rekapPengelolaan[$month]['sampah_masuk'] === '-') {
                $rekapPengelolaan[$month]['sampah_masuk'] = 0;
            }
            $rekapPengelolaan[$month]['sampah_masuk'] += $totalBeratMasuk;
        }

        foreach ($penjualans as $penjualan) {
            $month = Carbon::parse($penjualan->tanggal_jual)->format('F');
            $totalBeratTerangkut = $penjualan->detailPenjualans->sum('berat');

            if ($rekapPengelolaan[$month]['sampah_terangkut'] === '-') {
                $rekapPengelolaan[$month]['sampah_terangkut'] = 0;
            }
            $rekapPengelolaan[$month]['sampah_terangkut'] += $totalBeratTerangkut;
        }

        foreach ($daurUlangs as $daurUlang) {
            $month = Carbon::parse($daurUlang->tanggal_daur_ulang)->format('F');
            $totalBeratDaurUlang = $daurUlang->detailDaurUlangs->sum('berat');

            if ($rekapPengelolaan[$month]['sampah_daur_ulang'] === '-') {
                $rekapPengelolaan[$month]['sampah_daur_ulang'] = 0;
            }
            $rekapPengelolaan[$month]['sampah_daur_ulang'] += $totalBeratDaurUlang;
        }

        $html = view('bank_sampah_unit.laporan.pdf.pdfPengelolaan', compact('rekapPengelolaan'))->render();

        $mpdf = new Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('laporan_pengelolaan_sampah.pdf', 'I');
    }

    public function pengelolaanExportExcel()
    {
        return Excel::download(new LaporanPengelolaanExport(), 'laporan_pengelolaan_sampah.xlsx');
    }
}
