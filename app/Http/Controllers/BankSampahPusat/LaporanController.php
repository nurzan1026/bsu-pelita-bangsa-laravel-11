<?php
namespace App\Http\Controllers\BankSampahPusat;

use App\Exports\LaporanPengangkutanExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('tahun', Carbon::now()->year);
        $selectedMonth = $request->input('bulan', null);
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $permintaan = DB::table('permintaan_pengangkutan')
            ->where('status', 'Selesai')
            ->whereYear('created_at', $year)
            ->when($selectedMonth, function ($query) use ($selectedMonth) {
                return $query->whereMonth('created_at', $selectedMonth);
            })
            ->select('id', 'created_at', 'sampah')
            ->get();

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

        return view('bank_sampah_pusat.laporan', compact('monthlyData', 'kategoriSampahList', 'months', 'year', 'selectedMonth'));
    }

    public function exportExcel(Request $request)
    {
        $year = $request->input('tahun', Carbon::now()->year);
        $selectedMonth = $request->input('bulan', null);

        return Excel::download(new LaporanPengangkutanExport($year, $selectedMonth), 'laporan_pengangkutan.xlsx');
    }
}
