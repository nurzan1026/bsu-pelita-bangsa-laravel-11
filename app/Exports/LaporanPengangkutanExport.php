<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanPengangkutanExport implements FromView, WithEvents
{
    use Exportable;

    protected $year;
    protected $month;

    public function __construct($year, $month = null)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function view(): View
    {
        $year = $this->year;
        $selectedMonth = $this->month;

        $permintaan = DB::table('permintaan_pengangkutan')
            ->where('status', 'Selesai')
            ->whereYear('created_at', $year)
            ->when($selectedMonth, function($query) use ($selectedMonth) {
                return $query->whereMonth('created_at', $selectedMonth);
            })
            ->select('id', 'created_at', 'sampah')
            ->get();

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $monthlyData = [];
        $kategoriSampahList = [];

        foreach ($permintaan as $item) {
            $sampahData = json_decode($item->sampah, true);
            $month = Carbon::parse($item->created_at)->month;

            foreach ($sampahData as $sampah) {
                $kategori = $sampah['kategori_sampah'];

                if (!in_array($kategori, $kategoriSampahList)) {
                    $kategoriSampahList[] = $kategori;
                }

                if (!isset($monthlyData[$month])) {
                    $monthlyData[$month] = [];
                }

                if (!isset($monthlyData[$month][$kategori])) {
                    $monthlyData[$month][$kategori] = [
                        'total_berat' => 0,
                        'total_harga' => 0
                    ];
                }

                $monthlyData[$month][$kategori]['total_berat'] += $sampah['berat'];
                $monthlyData[$month][$kategori]['total_harga'] += $sampah['harga'] * $sampah['berat'];
            }
        }

        return view('bank_sampah_pusat.laporan_excel', compact('monthlyData', 'kategoriSampahList', 'months', 'year'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $sheet->getDelegate()->mergeCells('A1:Z1');
                $sheet->getDelegate()->setCellValue('A1', 'Laporan Pengangkutan Sampah Tahun ' . $this->year);
                $sheet->getDelegate()->getStyle('A1')->getFont()->setSize(16);
                $sheet->getDelegate()->getStyle('A1')->getFont()->setBold(true);
                $sheet->getDelegate()->getStyle('A1')->getAlignment()->setHorizontal('center');

                $cellRange = 'A3:Z3'; // All headers
                $sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);

                // Set auto width for columns
                foreach(range('A','Z') as $columnID) {
                    $sheet->getDelegate()->getColumnDimension($columnID)->setAutoSize(true);
                }

                // Styling the table
                $sheet->getDelegate()->getStyle('A3:Z100')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Set background color for headers
                $sheet->getDelegate()->getStyle('A3:Z4')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFFF00'],
                    ],
                ]);
            },
        ];
    }
}
