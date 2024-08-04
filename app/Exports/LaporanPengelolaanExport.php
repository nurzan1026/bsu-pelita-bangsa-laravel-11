<?php

namespace App\Exports;

use App\Models\Setoran;
use App\Models\Penjualan;
use App\Models\DaurUlang;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanPengelolaanExport implements FromView, WithStyles
{
    public function view(): View
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

        return view('laporan.excel.excelPengelolaan', compact('rekapPengelolaan'));
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:D1');

        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(30);

        $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2:D2')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A2:D2')->getFont()->setBold(true);

        $sheet->getStyle('A3:A1000')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B3:B1000')->getAlignment()->setHorizontal('left');
        $sheet->getStyle('C3:C1000')->getAlignment()->setHorizontal('left');
        $sheet->getStyle('D3:D1000')->getAlignment()->setHorizontal('left');
        $sheet->getStyle('A1:D1000')->getAlignment()->setVertical('center');
    }
}
