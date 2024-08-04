<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DataSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPenjualanExport;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('detailPenjualans.sampah')->get();
        Log::info('Penjualans Data: ', $penjualans->toArray());
        $sampahs = DataSampah::all();

        return view('bank_sampah_unit.laporan.laporanPenjualan', compact('penjualans', 'sampahs'));
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
                'jenis_sampah.*' => 'required|exists:data_sampahs,sampah_id',
                'berat.*' => 'required|numeric|min:0.01',
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
                $sampah = DataSampah::where('sampah_id', $sampahId)->first();
                $hargaPerKg = $sampah->wastePrices->first()->harga ?? 0;
                $harga = $berat * $hargaPerKg;

                $penjualan->detailPenjualans()->create([
                    'sampah_id' => $sampahId,
                    'berat' => $berat,
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

    public function penjualanExportPDF()
    {
        $penjualans = Penjualan::with('detailPenjualans.sampah')->get();
        $html = view('bank_sampah_unit.laporan.pdf.pdfPenjualan', compact('penjualans'))->render();

        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('penjualan_sampah.pdf', 'I');
    }

    public function penjualanExportExcel()
    {
        return Excel::download(new LaporanPenjualanExport(), 'penjualan_sampah.xlsx');
    }
}
