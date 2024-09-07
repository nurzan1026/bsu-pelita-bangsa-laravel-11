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

        return view('bank_sampah_unit.laporan.excel.excelPenjualan', [
            'penjualans' => $penjualans,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:G1'); 
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $headerStyleArray = [
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFDDDDDD'],
            ],
        ];

        $sheet->getStyle('A2:G2')->applyFromArray($headerStyleArray);

        $dataStyleArray = [
            'alignment' => [
                'vertical' => 'center',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle("A3:G$highestRow")->applyFromArray($dataStyleArray);

        $sheet->getStyle('A:G')->getAlignment()->setHorizontal('center');

        return [];
    }
}
