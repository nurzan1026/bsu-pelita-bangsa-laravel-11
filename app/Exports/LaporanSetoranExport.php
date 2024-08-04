<?php

namespace App\Exports;

use App\Models\Setoran;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanSetoranExport implements FromView, ShouldAutoSize, WithStyles
{
    public function view(): \Illuminate\Contracts\View\View
    {
        $setorans = Setoran::with('nasabah', 'detailSetoran.sampah.harga')->get();

        return view('laporan.excel.excelSetoran', [
            'setorans' => $setorans,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount =
            Setoran::with('detailSetoran')
                ->get()
                ->sum(function ($setoran) {
                    return $setoran->detailSetoran->count();
                }) + 3;

        $sheet
            ->getStyle('A1:I' . $rowCount)
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet
            ->getStyle('A1:I' . $rowCount)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(14);
        $sheet
            ->getStyle('A1')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A3:I2')->getFont()->setBold(true);

        return [
            3 => ['font' => ['bold' => true]],
        ];
    }
}
