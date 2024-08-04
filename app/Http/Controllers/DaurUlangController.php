<?php

namespace App\Http\Controllers;

use App\Models\DaurUlang;
use App\Models\DataSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanDaurUlangExport;

class DaurUlangController extends Controller
{
    public function index()
    {
        $daurUlangs = DaurUlang::with('detailDaurUlangs.sampah')->get();
        $sampahs = DataSampah::all();
        return view('bank_sampah_unit.laporan.laporanDaurUlang', compact('daurUlangs', 'sampahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_daur_ulang' => 'required|date',
            'jenis_sampah' => 'required|array',
            'jenis_sampah.*' => 'exists:data_sampahs,id',
            'berat' => 'required|array',
            'berat.*' => 'numeric|min:0',
        ]);

        Log::info('Data permintaan: ', $request->all());

        DB::beginTransaction();

        try {
            $daurUlang = DaurUlang::create([
                'tanggal_daur_ulang' => $request->tanggal_daur_ulang,
            ]);

            foreach ($request->jenis_sampah as $index => $jenisSampah) {
                $daurUlang->detailDaurUlangs()->create([
                    'sampah_id' => $jenisSampah,
                    'berat' => $request->berat[$index],
                ]);
            }

            DB::commit();

            return redirect()->route('daur_ulang.index')->with('success', 'Daur ulang berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Terjadi kesalahan: ', ['error' => $e->getMessage()]);

            return redirect()->route('daur_ulang.index')->with('error', 'Terjadi kesalahan saat menambahkan daur ulang.');
        }
    }

    public function exportPdf()
    {
        $daurUlangs = DaurUlang::with('detailDaurUlangs.sampah')->get();
        $html = view('laporan.pdf.pdfDaurUlang', compact('daurUlangs'))->render();

        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('laporan_daur_ulang.pdf', 'I');
    }

    public function exportExcel()
    {
        $daurUlans = DaurUlang::with('detailDaurUlangs.sampah')->get();
        return Excel::download(new LaporanDaurUlangExport(), 'laporan_daur_ulang.xlsx');
    }
}
