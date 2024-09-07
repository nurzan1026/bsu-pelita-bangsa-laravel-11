<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Nasabah;
use App\Models\Setoran;
use App\Models\DataSampah;
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
        $setoran = Setoran::with('nasabah', 'detailSetoran.sampah')->paginate(10);
        $sampah = DataSampah::all();
        return view('bank_sampah_unit.setoran.index', compact('setoran', 'sampah'));
    }

    public function rekapSetoran(Request $request)
    {
        $query = Setoran::with(['nasabah', 'detailSetoran.sampah.harga']);

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_setor', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_setor', $request->bulan);
        }

        $paginatedSetoran = $query->paginate(10);

        $years = Setoran::selectRaw('distinct YEAR(tanggal_setor) as year')->pluck('year');
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        return view('bank_sampah_unit.laporan.laporanSetoran', compact('paginatedSetoran', 'years', 'months'));
    }

    public function search(Request $request)
    {
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
            'detail_setoran.*.waste_id' => 'required|exists:data_sampahs,id',
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
            $detailSetoran->waste_id = $detail['waste_id'];
            $detailSetoran->berat = $detail['berat'];
            $detailSetoran->poin = $this->hitungPoin($detail['berat'], $detail['waste_id']);
            $detailSetoran->save();
        }

        return redirect()->route('setoran.index')->with('success', 'Setoran berhasil ditambahkan');
    }

    public function destroy($id)
    {
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
        $setoran = Setoran::with('nasabah', 'detailSetoran.sampah')->findOrFail($id);
        $sampah = DataSampah::all();
        return response()->json(['setoran' => $setoran, 'sampah' => $sampah]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'tanggal_setor' => 'required|date',
            'detail_setoran' => 'required|array',
            'detail_setoran.*.waste_id' => 'required|exists:data_sampahs,id',
            'detail_setoran.*.berat' => 'required|numeric|min:0.01',
        ]);

        $setoran = Setoran::findOrFail($id);
        $setoran->nasabah_id = $request->nasabah_id;
        $setoran->tanggal_setor = $request->tanggal_setor;
        $setoran->save();

        DetailSetoran::where('setoran_id', $id)->delete();

        foreach ($request->detail_setoran as $detail) {
            $detailSetoran = new DetailSetoran();
            $detailSetoran->setoran_id = $setoran->id;
            $detailSetoran->sampah_id = $detail['waste_id'];
            $detailSetoran->berat = $detail['berat'];
            $detailSetoran->poin = $this->hitungPoin($detail['berat'], $detail['waste_id']);
            $detailSetoran->save();
        }

        return redirect()->route('setoran.index')->with('success', 'Data setoran berhasil diperbarui');
    }

    private function hitungPoin($berat, $sampahId)
    {
        $sampah = DataSampah::where('id', $sampahId)->first();

        if ($sampah) {
            return $berat * $sampah->poin;
        }

        return 0;
    }

    public function setoranExportPDF(Request $request)
    {
        $query = Setoran::with('nasabah', 'detailSetoran.sampah.harga');

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_setor', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_setor', $request->bulan);
        }

        $setoran = $query->get();

        $totalBerat = $setoran->sum(function ($item) {
            return $item->detailSetoran->sum('berat');
        });

        $totalHarga = $setoran->sum(function ($item) {
            return $item->detailSetoran->sum(function ($detail) {
                return (float) $detail->sampah->harga->price * $detail->berat;
            });
        });

        $html = view('bank_sampah_unit.laporan.pdf.pdfSetoran', compact('setoran', 'totalBerat', 'totalHarga'))->render();

        $mpdf = new Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('setoran_sampah_nasabah.pdf', 'I');
    }

    public function setoranExportExcel(Request $request)
    {
        $query = Setoran::with('nasabah', 'detailSetoran.sampah.harga');

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_setor', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_setor', $request->bulan);
        }

        $setoran = $query->get();

        return Excel::download(new LaporanSetoranExport($setoran), 'laporan_setoran.xlsx');
    }

    public function rekapTahunan(Request $request)
    {
        $query = Setoran::with('detailSetoran.sampah.harga');

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_setor', $request->tahun);
        }

        $setorans = $query->get();

        $rekapBulanan = $this->getRekapBulanan($setorans);
        $types = DataSampah::distinct()->pluck('kategori')->toArray();
        $years = Setoran::selectRaw('distinct YEAR(tanggal_setor) as year')->pluck('year');

        return view('bank_sampah_unit.laporan.laporanTahunan', compact('rekapBulanan', 'types', 'years'));
    }

    public function rekapTahunanExportPDF(Request $request)
    {
        $query = Setoran::with('detailSetoran.sampah.harga');

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_setor', $request->tahun);
        }

        $setorans = $query->get();
        $rekapBulanan = $this->getRekapBulanan($setorans);
        $types = DataSampah::distinct()->pluck('kategori')->toArray();

        $html = view('bank_sampah_unit.laporan.pdf.pdfTahunan', compact('rekapBulanan', 'types'))->render();

        $mpdf = new Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('rekap_setoran_tahunan.pdf', 'I');
    }

    public function rekapTahunanExportExcel(Request $request)
    {
        $query = Setoran::with('detailSetoran.sampah.harga');

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_setor', $request->tahun);
        }

        $setorans = $query->get();
        $rekapBulanan = $this->getRekapBulanan($setorans);
        $types = DataSampah::distinct()->pluck('kategori')->toArray();

        return Excel::download(new LaporanTahunanExport($rekapBulanan, $types), 'rekap_tahunan.xlsx');
    }

    private function getRekapBulanan($setorans)
    {
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

        foreach ($setorans as $setoran) {
            $bulan = Carbon::parse($setoran->tanggal_setor)->format('F');

            foreach ($setoran->detailSetoran as $detail) {
                $jenis = strtolower($detail->sampah->kategori);
                $berat = $detail->berat;

                $hargaPerKg = (float) ($detail->sampah->harga->price ?? 0);
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
