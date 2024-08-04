<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\DataSampah;
use App\Models\Nasabah;
use App\Models\Setoran;
use Illuminate\Http\Request;
use App\Models\DetailSetoran;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanSetoranExport;
use App\Exports\LaporanTahunanExport;

class SetoranController extends Controller
{
    public function index()
    {
        // Mengambil semua data setoran beserta detail setoran dan nasabah
        $setoran = Setoran::with('nasabah', 'detailSetoran.sampah')->paginate(10);
        $sampah = DataSampah::all();
        return view('bank_sampah_unit.setoran.index', compact('setoran', 'sampah'));
    }

    public function rekapSetoran()
    {
        // Mengambil data setoran dengan relasi untuk rekap
        $paginatedSetoran = Setoran::with(['nasabah', 'detailSetoran.sampah.harga'])->paginate(10);

        return view('bank_sampah_unit.laporan.laporanSetoran', compact('paginatedSetoran'));
    }

    public function search(Request $request)
    {
        // Pencarian data setoran berdasarkan nama nasabah
        $query = $request->get('query');
        $setoran = Setoran::with('nasabah', 'detailSetoran.sampah')
            ->whereHas('nasabah', function ($q) use ($query) {
                $q->where('nama', 'like', "%$query%");
            })
            ->get();

        return response()->json($setoran);
    }

    public function store(Request $request)
    {
        Log::info('Request Data:', $request->all());

        $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'tanggal_setor' => 'required|date',
            'detail_setoran' => 'required|array',
            'detail_setoran.*.sampah_id' => 'required|exists:data_sampahs,sampah_id',
            'detail_setoran.*.berat' => 'required|numeric|min:0.01',
        ]);

        Log::info('Validation passed');

        $nasabah = Nasabah::find($request->nasabah_id);

        $setoran = new Setoran();
        $setoran->nasabah_id = $nasabah->id;
        $setoran->tanggal_setor = $request->tanggal_setor;
        $setoran->save();

        Log::info('Setoran created', ['setoran_id' => $setoran->id]);

        foreach ($request->detail_setoran as $detail) {
            Log::info('Processing detail setoran', $detail);

            $detailSetoran = new DetailSetoran();
            $detailSetoran->setoran_id = $setoran->id;
            $detailSetoran->sampah_id = $detail['sampah_id'];
            $detailSetoran->berat = $detail['berat'];
            $detailSetoran->poin = $this->hitungPoin($detail['berat'], $detail['sampah_id']);
            $detailSetoran->save();
        }

        return redirect()->route('setoran.index')->with('success', 'Setoran berhasil ditambahkan');
    }

    public function destroy($id)
    {
        // Menghapus record setoran
        try {
            $setoran = Setoran::findOrFail($id);
            $setoran->delete();
            return response()->json(['success' => 'Setoran deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        // Menampilkan detail setoran
        try {
            $setoran = Setoran::with('nasabah', 'detailSetoran.sampah')->findOrFail($id);
            Log::info('Detail Setoran:', ['setoran' => $setoran]);
            return response()->json($setoran);
        } catch (\Exception $e) {
            Log::error('Error fetching setoran detail: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching data'], 500);
        }
    }

    public function edit($id)
    {
        // Menampilkan form edit setoran
        $setoran = Setoran::with('nasabah', 'detailSetoran.sampah')->findOrFail($id);
        $sampah = DataSampah::all();
        return response()->json(['setoran' => $setoran, 'sampah' => $sampah]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diperbarui
        $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'tanggal_setor' => 'required|date',
            'detail_setoran' => 'required|array',
            'detail_setoran.*.sampah_id' => 'required|exists:data_sampahs,sampah_id',
            'detail_setoran.*.berat' => 'required|numeric|min:0.01',
        ]);

        // Memperbarui record setoran
        $setoran = Setoran::findOrFail($id);
        $setoran->nasabah_id = $request->nasabah_id;
        $setoran->tanggal_setor = $request->tanggal_setor;
        $setoran->save();

        // Menghapus detail setoran lama dan menambahkan yang baru
        DetailSetoran::where('setoran_id', $id)->delete();

        foreach ($request->detail_setoran as $detail) {
            $detailSetoran = new DetailSetoran();
            $detailSetoran->setoran_id = $setoran->id;
            $detailSetoran->sampah_id = $detail['sampah_id'];
            $detailSetoran->berat = $detail['berat'];
            $detailSetoran->poin = $this->hitungPoin($detail['berat'], $detail['sampah_id']);
            $detailSetoran->save();
        }

        return redirect()->route('setoran.index')->with('success', 'Data setoran berhasil diperbarui');
    }

    private function hitungPoin($berat, $sampahId)
    {
        // Menghitung poin berdasarkan berat dan jenis sampah
        $sampah = DataSampah::where('sampah_id', $sampahId)->first();

        if ($sampah) {
            return $berat * $sampah->poin;
        }

        return 0;
    }

    public function setoranExportPDF()
    {
        // Mengekspor data setoran ke PDF
        $setoran = Setoran::with('nasabah', 'detailSetoran.sampah.harga')->get();

        $totalBerat = $setoran->sum(function ($item) {
            return $item->detailSetoran->sum('berat');
        });

        $totalHarga = $setoran->sum(function ($item) {
            return $item->detailSetoran->sum(function ($detail) {
                return $detail->sampah->harga->harga * $detail->berat;
            });
        });

        $html = view('bank_sampah_unit.laporan.pdf.pdfSetoran', compact('setoran', 'totalBerat', 'totalHarga'))->render();

        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('setoran_sampah_nasabah.pdf', 'I');
    }

    public function setoranExportExcel()
    {
        // Mengekspor data setoran ke file Excel
        return Excel::download(new LaporanSetoranExport(), 'laporan_setoran.xlsx');
    }

    public function rekapTahunan()
    {
        // Rekap tahunan setoran
        $rekapBulanan = $this->getRekapBulanan();
        $types = DataSampah::distinct()->pluck('kategori')->toArray();

        return view('bank_sampah_unit.laporan.laporanTahunan', compact('rekapBulanan', 'types'));
    }

    public function rekapTahunanExportPDF()
    {
        // Mengekspor rekap tahunan setoran ke PDF
        $rekapBulanan = $this->getRekapBulanan();
        $types = DataSampah::distinct()->pluck('kategori')->toArray();

        $html = view('bank_sampah_unit.laporan.pdf.pdfTahunan', compact('rekapBulanan', 'types'))->render();

        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('rekap_setoran_tahunan.pdf', 'I');
    }

    public function rekapTahunanExportExcel()
    {
        // Mengekspor rekap tahunan setoran ke file Excel
        $rekapBulanan = $this->getRekapBulanan();
        $types = DataSampah::distinct()->pluck('kategori')->toArray();

        return Excel::download(new LaporanTahunanExport($rekapBulanan, $types), 'rekap_tahunan.xlsx');
    }

    private function getRekapBulanan()
    {
        // Menghitung rekap bulanan setoran
        $rekapBulanan = [];
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $types = DataSampah::distinct()->pluck('kategori')->toArray();

        foreach ($months as $month) {
            foreach ($types as $type) {
                $rekapBulanan[$month][strtolower($type) . '_kg'] = '-';
                $rekapBulanan[$month][strtolower($type) . '_rp'] = '-';
            }
            $rekapBulanan[$month]['total_kg'] = '-';
            $rekapBulanan[$month]['total_rp'] = '-';
        }

        $setorans = Setoran::with('detailSetoran.sampah.harga')->get();

        foreach ($setorans as $setoran) {
            $bulan = Carbon::parse($setoran->tanggal_setor)->format('F');

            foreach ($setoran->detailSetoran as $detail) {
                $jenis = strtolower($detail->sampah->kategori);
                $berat = $detail->berat;
                $hargaPerKg = $detail->sampah->harga->harga ?? 0;
                $harga = $berat * $hargaPerKg;

                if ($rekapBulanan[$bulan]['total_kg'] === '-') {
                    $rekapBulanan[$bulan]['total_kg'] = 0;
                    $rekapBulanan[$bulan]['total_rp'] = 0;
                }

                if (!isset($rekapBulanan[$bulan][$jenis . '_kg']) || $rekapBulanan[$bulan][$jenis . '_kg'] === '-') {
                    $rekapBulanan[$bulan][$jenis . '_kg'] = 0;
                    $rekapBulanan[$bulan][$jenis . '_rp'] = 0;
                }

                $rekapBulanan[$bulan][$jenis . '_kg'] += $berat;
                $rekapBulanan[$bulan][$jenis . '_rp'] += $harga;
                $rekapBulanan[$bulan]['total_kg'] += $berat;
                $rekapBulanan[$bulan]['total_rp'] += $harga;
            }
        }

        return $rekapBulanan;
    }
}
