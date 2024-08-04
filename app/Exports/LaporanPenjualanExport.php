<?php

namespace App\Exports;

use App\Models\Penjualan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanPenjualanExport implements FromView, WithStyles, ShouldAutoSize
{
    public function view(): View
    {
        $penjualans = Penjualan::with('detailPenjualans.sampah')->get();

        return view('laporan.excel.excelPenjualan', [
            'penjualans' => $penjualans,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $titleStyleArray = [
            'font' => ['bold' => true, 'size' => 20],
            'alignment' => ['horizontal' => 'center'],
        ];

        $headerStyleArray = [
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => 'center'],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFA0A0A0'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1:F1')->applyFromArray($titleStyleArray);

        $sheet->getStyle('A2:F2')->applyFromArray($headerStyleArray);

        $sheet->getStyle('A3:F1000')->getAlignment()->setVertical('center');

        return [
            ];
    }
}
