<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Penjualan;
use App\Models\DataSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPenjualanExport;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::with('detailPenjualans.sampah');

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_jual', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_jual', $request->bulan);
        }

        $penjualans = $query->get();
        $sampahs = DataSampah::all();
        $years = Penjualan::selectRaw('distinct YEAR(tanggal_jual) as year')->pluck('year');
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        return view('bank_sampah_unit.laporan.laporanPenjualan', compact('penjualans', 'sampahs', 'years', 'months'));
    }

    public function store(Request $request)
    {
        Log::info('Masuk ke store method');
        Log::info('Data permintaan: ', $request->all());

        try {
            Log::info('Mulai validasi');
            $validatedData = $request->validate([
                'tanggal_jual' => 'required|date',
                'pembeli' => 'required|string',
                'jenis_sampah.*' => 'required|exists:data_sampahs,id',
                'berat.*' => 'required|numeric|min:0.01',
                'harga_per_kg.*' => 'nullable|numeric|min:0',
                'vendor_name' => 'nullable|string|required_if:pembeli,Vendor',
            ]);
            Log::info('Data tervalidasi: ', $validatedData);

            $pembeli = $request->pembeli;
            if ($pembeli === 'Vendor') {
                $pembeli = $request->vendor_name;
            }

            $penjualan = Penjualan::create([
                'tanggal_jual' => $request->tanggal_jual,
                'pembeli' => $pembeli,
                'total_harga' => 0,
            ]);

            $totalHarga = 0;
            foreach ($request->jenis_sampah as $index => $sampahId) {
                $berat = $request->berat[$index];

                if ($request->pembeli === 'Vendor') {
                    $hargaPerKg = $request->harga_per_kg[$index];
                } else {
                    $sampah = DataSampah::where('id', $sampahId)->first();
                    $hargaPerKg = $sampah->wastePrices->first()->price ?? 0;
                }

                $harga = $berat * $hargaPerKg;

                $penjualan->detailPenjualans()->create([
                    'waste_id' => $sampahId,
                    'berat' => $berat,
                    'harga_per_kg' => $hargaPerKg,
                ]);

                $totalHarga += $harga;
            }

            $penjualan->update(['total_harga' => $totalHarga]);

            return redirect()->route('penjualan.laporan')->with('success', 'Penjualan berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan: ', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function penjualanExportPDF(Request $request)
    {
        $query = Penjualan::with('detailPenjualans.sampah');

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_jual', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_jual', $request->bulan);
        }

        $penjualans = $query->get();
        $html = view('bank_sampah_unit.laporan.pdf.pdfPenjualan', compact('penjualans'))->render();

        $mpdf = new Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('penjualan_sampah.pdf', 'I');
    }

    public function penjualanExportExcel(Request $request)
    {
        $query = Penjualan::with('detailPenjualans.sampah');

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_jual', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_jual', $request->bulan);
        }

        $penjualans = $query->get();

        return Excel::download(new LaporanPenjualanExport($penjualans), 'penjualan_sampah.xlsx');
    }
}
