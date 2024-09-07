<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\DaurUlang;
use App\Models\DataSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanDaurUlangExport;

class DaurUlangController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');

        $daurUlangs = DaurUlang::with('detailDaurUlangs.sampah')
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tanggal_daur_ulang', $tahun);
            })
            ->when($bulan, function ($query) use ($bulan) {
                return $query->whereMonth('tanggal_daur_ulang', $bulan);
            })
            ->get();

        $sampahs = DataSampah::all();
        $years = DaurUlang::selectRaw('distinct YEAR(tanggal_daur_ulang) as year')->pluck('year');
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

        return view('bank_sampah_unit.laporan.laporanDaurUlang', compact('daurUlangs', 'sampahs', 'years', 'months'));
    }

    public function store(Request $request)
    {
        Log::info('Data permintaan: ', $request->all());

        $request->validate([
            'tanggal_daur_ulang' => 'required|date',
            'jenis_sampah' => 'required|array',
            'jenis_sampah.*' => 'exists:data_sampahs,id',
            'berat' => 'required|array',
            'berat.*' => 'numeric|min:0',
        ]);

        Log::info('Validasi berhasil');

        DB::beginTransaction();

        try {
            $daurUlang = DaurUlang::create([
                'tanggal_daur_ulang' => $request->tanggal_daur_ulang,
            ]);

            Log::info('Daur Ulang berhasil disimpan', ['daur_ulang_id' => $daurUlang->id]);

            foreach ($request->jenis_sampah as $index => $jenisSampah) {
                $detailDaurUlang = $daurUlang->detailDaurUlangs()->create([
                    'waste_id' => $jenisSampah,
                    'berat' => $request->berat[$index],
                ]);
                Log::info('Detail Daur Ulang berhasil disimpan', ['detail_daur_ulang_id' => $detailDaurUlang->id]);
            }

            DB::commit();
            return redirect()->route('daur_ulang.index')->with('success', 'Daur ulang berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Terjadi kesalahan saat menyimpan daur ulang', ['error' => $e->getMessage()]);
            return redirect()->route('daur_ulang.index')->with('error', 'Terjadi kesalahan saat menambahkan daur ulang.');
        }
    }

    public function exportPdf(Request $request)
    {
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');

        $daurUlangs = DaurUlang::with('detailDaurUlangs.sampah')
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tanggal_daur_ulang', $tahun);
            })
            ->when($bulan, function ($query) use ($bulan) {
                return $query->whereMonth('tanggal_daur_ulang', $bulan);
            })
            ->get();

        $html = view('laporan.pdf.pdfDaurUlang', compact('daurUlangs'))->render();

        $mpdf = new Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('laporan_daur_ulang.pdf', 'I');
    }

    public function exportExcel(Request $request)
    {
        $tahun = $request->get('tahun');
        $bulan = $request->get('bulan');
        return Excel::download(new LaporanDaurUlangExport($tahun, $bulan), 'laporan_daur_ulang.xlsx');
    }
}
