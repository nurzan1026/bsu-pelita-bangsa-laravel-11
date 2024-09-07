<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataSampah;
use App\Models\PermintaanPengangkutan;
use App\Models\WastePrice;

class PermintaanPengangkutanController extends Controller
{
    public function create()
    {
        $dataSampahs = DataSampah::all()->groupBy('kategori');
        return view('bank_sampah_unit.permintaan_pengangkutan', compact('dataSampahs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sampah' => 'required|array',
            'total_berat' => 'required|numeric',
        ]);

        $sampah = [];
        $total_harga = 0;
        foreach ($validated['sampah'] as $index => $detailSampah) {
            $kategoriSampah = $detailSampah['kategori'];
            foreach ($detailSampah as $namaSampah => $berat) {
                if ($namaSampah !== 'kategori' && $berat > 0) {
                    $waste = DataSampah::where('kategori', $kategoriSampah)->where('jenis', $namaSampah)->first();
                    if ($waste) {
                        $wastePrice = WastePrice::where('waste_id', $waste->id)->first();
                        if ($wastePrice) {
                            $harga = $wastePrice->price;
                            $sampah[] = [
                                'kategori_sampah' => $kategoriSampah,
                                'nama_sampah' => $namaSampah,
                                'berat' => $berat,
                                'waste_id' => $waste->id,
                                'harga' => $harga,
                            ];
                            $total_harga += $berat * $harga;
                        } else {
                            return redirect()->back()->withErrors(['error' => 'Harga tidak ditemukan untuk kategori: ' . $kategoriSampah . ' dan jenis: ' . $namaSampah]);
                        }
                    } else {
                        return redirect()->back()->withErrors(['error' => 'Sampah tidak ditemukan untuk kategori: ' . $kategoriSampah . ' dan jenis: ' . $namaSampah]);
                    }
                }
            }
        }

        PermintaanPengangkutan::create([
            'account_id' => Auth::guard('bank_sampah_unit')->id(),
            'account_name' => Auth::guard('bank_sampah_unit')->user()->name,
            'sampah' => $sampah,
            'total_berat' => $validated['total_berat'],
            'total_harga' => $total_harga,
            'status' => 'Menunggu Konfirmasi',
        ]);

        return redirect()->back()->with('success', 'Permintaan berhasil disimpan!');
    }

    public function riwayat()
    {
        $permintaans = PermintaanPengangkutan::where('account_id', Auth::guard('bank_sampah_unit')->id())
                            ->where('status', '!=', 'Selesai')
                            ->get();
        return view('bank_sampah_unit.riwayat_pengangkutan', compact('permintaans'));
    }

    public function edit($id)
    {
        $permintaan = PermintaanPengangkutan::findOrFail($id);
        return response()->json($permintaan);
    }

    public function update(Request $request, $id)
    {
        $permintaan = PermintaanPengangkutan::findOrFail($id);

        $validated = $request->validate([
            'sampah' => 'sometimes|array',
            'sampah.*.jenis' => 'sometimes|string',
            'total_berat' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $sampah = [];
        $total_harga = 0;
        foreach ($validated['sampah'] as $index => $detailSampah) {
            $waste = DataSampah::where('kategori', $detailSampah['kategori_sampah'])->where('jenis', $detailSampah['nama_sampah'])->first();
            if ($waste) {
                $harga = WastePrice::where('waste_id', $waste->id)->first();
                if ($harga) {
                    $harga = $harga->price;
                    $sampah[] = [
                        'kategori_sampah' => $detailSampah['kategori_sampah'],
                        'nama_sampah' => $detailSampah['nama_sampah'],
                        'berat' => $detailSampah['berat'],
                        'waste_id' => $waste->id,
                        'harga' => $harga,
                    ];
                    $total_harga += $detailSampah['berat'] * $harga;
                } else {
                    return redirect()->back()->withErrors(['error' => 'Harga tidak ditemukan untuk kategori: ' . $detailSampah['kategori_sampah'] . ' dan jenis: ' . $detailSampah['nama_sampah']]);
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Sampah tidak ditemukan untuk kategori: ' . $detailSampah['kategori_sampah'] . ' dan jenis: ' . $detailSampah['nama_sampah']]);
            }
        }

        $permintaan->update([
            'sampah' => $sampah,
            'total_berat' => $validated['total_berat'],
            'total_harga' => $total_harga,
            'status' => $validated['status'],
        ]);

        return redirect()->route('permintaan.pengangkutan.riwayat')->with('success', 'Permintaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $permintaan = PermintaanPengangkutan::findOrFail($id);
        $permintaan->delete();

        return redirect()->route('permintaan.pengangkutan.riwayat')->with('success', 'Permintaan berhasil dihapus!');
    }

    public function permintaanSelesai()
{
    $accountId = Auth::guard('bank_sampah_unit')->id();
    $permintaanSelesai = PermintaanPengangkutan::where('account_id', $accountId)
                        ->where('status', 'Selesai')
                        ->get();
    return view('bank_sampah_unit.permintaan_selesai', compact('permintaanSelesai'));
}

}
