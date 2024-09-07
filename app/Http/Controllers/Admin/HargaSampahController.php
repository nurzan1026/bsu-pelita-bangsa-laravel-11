<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataSampah;
use App\Models\WastePrice;
use Illuminate\Http\Request;


class HargaSampahController extends Controller
{
    public function index()
    {
        $dataSampahs = DataSampah::all();
        $wastePrices = WastePrice::all();
        return view('admin.daftar_harga_sampah_pusat', compact('dataSampahs', 'wastePrices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'waste_id' => 'required',
            'price' => 'required'
        ]);

        WastePrice::create([
            'waste_id' => $request->waste_id,
            'price' => $request->price
        ]);

        return redirect()->route('admin.daftar_harga_sampah_pusat')->with('success', 'Harga sampah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $wastePrice = WastePrice::findOrFail($id);
        $dataSampahs = DataSampah::all();
        return view('admin.waste_prices.edit', compact('wastePrice', 'dataSampahs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'waste_id' => 'required|exists:data_sampahs,id',
            'price' => 'required|numeric',
        ]);

        $wastePrice = WastePrice::findOrFail($id);
        $wastePrice->update($request->all());

        return redirect()->route('admin.daftar_harga_sampah_pusat')->with('success', 'Harga sampah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $wastePrice = WastePrice::findOrFail($id);
        $wastePrice->delete();

        return redirect()->route('admin.daftar_harga_sampah_pusat')->with('success', 'Harga sampah berhasil dihapus');
    }
}
