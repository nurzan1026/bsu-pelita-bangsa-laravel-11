<?php
namespace App\Http\Controllers\BankSampahPusat;

use App\Http\Controllers\Controller;
use App\Models\PermintaanPengangkutan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\DataSampah;
use App\Models\WastePrice;

class DaftarPermintaanPengangkutanController extends Controller
{
    public function index()
    {
        $permintaanPengangkutan = PermintaanPengangkutan::where('status', '!=', 'Selesai')->get();
        return view('bank_sampah_pusat.daftar_permintaan_pengangkutan', compact('permintaanPengangkutan'));
    }

    public function konfirmasi($id)
    {
        $permintaan = PermintaanPengangkutan::findOrFail($id);
        $permintaan->status = 'Diproses';
        $permintaan->save();

        return redirect()->route('pusat.permintaan_pengangkutan')
                         ->with('success', 'Permintaan telah dikonfirmasi.');
    }

    public function aturJadwal(Request $request, $id)
    {
        $permintaan = PermintaanPengangkutan::findOrFail($id);
        $permintaan->tanggal_pengambilan = $request->tanggal_pengambilan;
        $permintaan->waktu_pengambilan = $request->waktu_pengambilan;
        $permintaan->status = 'Tanggal Pengambilan Telah Terbit';
        $permintaan->save();

        return redirect()->route('pusat.permintaan_pengangkutan')->with('success', 'Jadwal pengambilan telah diatur.');
    }

    public function menujuTempat($id)
    {
        $permintaan = PermintaanPengangkutan::findOrFail($id);
        $permintaan->status = 'Menuju Tempat Anda';
        $permintaan->save();

        return redirect()->back()->with('success', 'Status telah diperbarui menjadi Menuju Tempat Anda.');
    }

    public function selesaiPengangkutan($id)
    {
        $pengangkutan = PermintaanPengangkutan::findOrFail($id);
        $pengangkutan->status = 'Selesai';
        $pengangkutan->save();

        return redirect()->route('pusat.jadwal_pengangkutan')->with('success', 'Pengangkutan telah selesai dan dipindahkan ke riwayat.');
    }

    public function edit($id)
    {
        $permintaan = PermintaanPengangkutan::findOrFail($id);
        return view('bank_sampah_pusat.edit_permintaan', compact('permintaan'));
    }

    public function update(Request $request, $id)
{
    $permintaan = PermintaanPengangkutan::findOrFail($id);

    $validated = $request->validate([
        'sampah' => 'sometimes|array',
        'sampah.*.kategori_sampah' => 'sometimes|string',
        'sampah.*.nama_sampah' => 'sometimes|string',
        'sampah.*.berat' => 'sometimes|numeric',
        'total_berat' => 'required|numeric',
        'status' => 'required|string',
    ]);

    $sampah = [];
    $total_harga = 0;
    foreach ($validated['sampah'] as $index => $detailSampah) {
        // Cek apakah waste_id ada di dalam array detailSampah
        if (isset($detailSampah['waste_id'])) {
            $harga = WastePrice::where('waste_id', $detailSampah['waste_id'])->first();
            $sampah[] = [
                'kategori_sampah' => $detailSampah['kategori_sampah'],
                'nama_sampah' => $detailSampah['nama_sampah'],
                'berat' => $detailSampah['berat'],
                'waste_id' => $detailSampah['waste_id'],
                'harga' => $harga ? $harga->price : 0, // Tambahkan harga
            ];
            $total_harga += $detailSampah['berat'] * ($harga ? $harga->price : 0);
        } else {
            // Ambil data sampah yang sudah ada dari database jika waste_id tidak ada
            $existingSampah = collect($permintaan->sampah)->firstWhere('nama_sampah', $detailSampah['nama_sampah']);
            if ($existingSampah) {
                $harga = WastePrice::where('waste_id', $existingSampah['waste_id'])->first();
                $sampah[] = [
                    'kategori_sampah' => $detailSampah['kategori_sampah'],
                    'nama_sampah' => $detailSampah['nama_sampah'],
                    'berat' => $detailSampah['berat'],
                    'waste_id' => $existingSampah['waste_id'],
                    'harga' => $harga ? $harga->price : 0, // Tambahkan harga
                ];
                $total_harga += $detailSampah['berat'] * ($harga ? $harga->price : 0);
            }
        }
    }

    $permintaan->update([
        'sampah' => $sampah,
        'total_berat' => $validated['total_berat'],
        'total_harga' => $total_harga,
        'status' => $validated['status'],
    ]);

    return redirect()->route('pusat.permintaan_pengangkutan')->with('success', 'Permintaan berhasil diperbarui!');
}

    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'required|exists:bank_sampah_unit_accounts,id',
            'sampah' => 'required|array',
            'sampah.*.kategori_sampah' => 'required|string',
            'sampah.*.nama_sampah' => 'required|string',
            'sampah.*.berat' => 'required|numeric',
            'sampah.*.waste_id' => 'required|string',
            'total_berat' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $sampah = [];
        foreach ($validated['sampah'] as $index => $detailSampah) {
            $harga = WastePrice::where('waste_id', $detailSampah['waste_id'])->first();
            $sampah[] = [
                'kategori_sampah' => $detailSampah['kategori_sampah'],
                'nama_sampah' => $detailSampah['nama_sampah'],
                'berat' => $detailSampah['berat'],
                'waste_id' => $detailSampah['waste_id'],
                'harga' => $harga ? $harga->price : 0, // Tambahkan harga
            ];
        }

        $permintaan = PermintaanPengangkutan::create([
            'account_id' => $validated['account_id'],
            'sampah' => $sampah,
            'total_berat' => $validated['total_berat'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('pusat.permintaan_pengangkutan')->with('success', 'Permintaan berhasil ditambahkan!');
    }

    public function riwayatPengangkutan()
    {
        $permintaanSelesai = PermintaanPengangkutan::where('status', 'Selesai')->get();
        return view('bank_sampah_pusat.riwayat_pengambilan', compact('permintaanSelesai'));
    }

    public function cetakPdf($id)
    {
        $permintaan = PermintaanPengangkutan::findOrFail($id);

        // Pastikan setiap item sampah memiliki harga yang sesuai
        $permintaan->sampah = array_map(function ($item) {
            $harga = WastePrice::where('waste_id', $item['waste_id'] ?? '')->first();
            return [
                'waste_id' => $item['waste_id'] ?? 'N/A',
                'nama_sampah' => $item['nama_sampah'] ?? 'N/A',
                'kategori' => $item['kategori_sampah'] ?? 'N/A',
                'harga' => $harga ? $harga->price : 0,
                'berat' => $item['berat'] ?? 0,
            ];
        }, $permintaan->sampah);

        $pdf = Pdf::loadView('bank_sampah_pusat.cetak_pdf', compact('permintaan'));
        return $pdf->download('riwayat_pengangkutan.pdf');
    }
}
