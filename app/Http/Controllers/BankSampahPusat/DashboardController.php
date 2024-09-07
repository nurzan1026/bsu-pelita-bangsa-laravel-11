<?php

namespace App\Http\Controllers\BankSampahPusat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $year = Carbon::now()->year;

        // Ambil data permintaan pengangkutan
        $permintaan = DB::table('permintaan_pengangkutan')
            ->where('status', 'Selesai')
            ->whereYear('created_at', $year)
            ->select('id', 'created_at', 'sampah')
            ->get();

        $monthlyData = [];
        $kategoriSampahList = [];
        $totalBerat = 0;

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
                    $monthlyData[$month][$kategori] = 0;
                }

                $monthlyData[$month][$kategori] += $sampah['berat'];
                $totalBerat += $sampah['berat'];
            }
        }

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // Ambil data akun bank sampah unit
        $units = DB::table('bank_sampah_unit_accounts')->get();

        return view('bank_sampah_pusat.dashboard', compact('monthlyData', 'kategoriSampahList', 'months', 'year', 'totalBerat', 'units'));
    }
}
