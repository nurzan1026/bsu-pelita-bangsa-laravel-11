<?php

namespace App\Exports;

use App\Models\DaurUlang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanDaurUlangExport implements FromView, WithStyles, ShouldAutoSize
{
    public function view(): View
    {
        $daurUlangs = DaurUlang::with('detailDaurUlangs.sampah')->get();
        return view('laporan.excel.excelDaurUlang', compact('daurUlangs'));
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount =
            DaurUlang::with('detailDaurUlangs')
                ->get()
                ->sum(function ($daurUlang) {
                    return $daurUlang->detailDaurUlangs->count();
                }) + 3;

        // Set alignment for the entire table
        $sheet
            ->getStyle('A1:D' . $rowCount)
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet
            ->getStyle('A1:D' . $rowCount)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // Merge cells for the title
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(14);
        $sheet
            ->getStyle('A1')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set bold font for headers and center alignment
        $sheet->getStyle('A2:D2')->getFont()->setBold(true);
        $sheet
            ->getStyle('A2:D2')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(15);

        return [
            2 => ['font' => ['bold' => true]],
        ];
    }
}
