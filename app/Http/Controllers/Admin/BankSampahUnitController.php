<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HargaSampahUnit;
use App\Models\DataSampah;

class BankSampahUnitController extends Controller
{
    public function index()
    {
        $hargaSampah = HargaSampahUnit::with('dataSampah')->get();
        $dataSampahs = DataSampah::all();
        return view('admin.daftar_harga_sampah_unit', compact('hargaSampah', 'dataSampahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'waste_id' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        HargaSampahUnit::create([
            'waste_id' => $request->waste_id,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.daftar_harga_sampah_unit')->with('success', 'Harga sampah berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'waste_id' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $harga = HargaSampahUnit::findOrFail($id);
        $harga->update([
            'waste_id' => $request->waste_id,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.daftar_harga_sampah_unit')->with('success', 'Harga sampah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $harga = HargaSampahUnit::findOrFail($id);
        $harga->delete();

        return redirect()->route('admin.daftar_harga_sampah_unit')->with('success', 'Harga sampah berhasil dihapus');
    }
}
