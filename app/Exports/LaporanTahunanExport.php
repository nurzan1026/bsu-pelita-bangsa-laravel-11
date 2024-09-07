<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanTahunanExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $rekapBulanan;
    protected $types;

    public function __construct($rekapBulanan, $types)
    {
        $this->rekapBulanan = $rekapBulanan;
        $this->types = $types;
    }

    public function view(): View
    {
        return view('bank_sampah_unit.laporan.excel.excelTahunan', [
            'rekapBulanan' => $this->rekapBulanan,
            'types' => $this->types,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = count($this->rekapBulanan) + 4;
        $highestColumn = 'O';

        $sheet->mergeCells('A1:O1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getAlignment()->setVertical('center');

        $sheet->getStyle('A2:O2')->getFont()->setBold(true);
        $sheet->getStyle('A3:O3')->getFont()->setBold(true);
        $sheet->getStyle('A2:O3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2:O3')->getAlignment()->setVertical('center');

        $sheet
            ->getStyle('A4:A' . $highestRow)
            ->getAlignment()
            ->setHorizontal('center');
        $sheet
            ->getStyle('A4:A' . $highestRow)
            ->getAlignment()
            ->setVertical('center');

        $sheet
            ->getStyle("B4:O$highestRow")
            ->getAlignment()
            ->setHorizontal('left');

        return [];
    }
}
