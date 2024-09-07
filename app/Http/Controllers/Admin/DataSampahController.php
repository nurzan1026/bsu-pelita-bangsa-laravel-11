<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataSampah;
use Illuminate\Support\Facades\Storage;

class DataSampahController extends Controller
{
    public function index()
    {
        $dataSampahs = DataSampah::all();
        return view('admin.data_sampah', compact('dataSampahs'));
    }

    public function create()
    {
        return view('admin.data_sampah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:data_sampahs,id',
            'kategori' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('foto')->store('sampah', 'public');

        DataSampah::create([
            'id' => $request->id,
            'kategori' => $request->kategori,
            'jenis' => $request->jenis,
            'foto' => $path,
        ]);

        return redirect()->route('admin.data_sampah')->with('success', 'Data sampah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sampah = DataSampah::findOrFail($id);
        return view('admin.data_sampah.edit', compact('sampah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|unique:data_sampahs,id,' . $id,
            'kategori' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $sampah = DataSampah::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($sampah->foto) {
                Storage::disk('public')->delete($sampah->foto);
            }

            $path = $request->file('foto')->store('sampah', 'public');
            $sampah->foto = $path;
        }

        $sampah->id = $request->id;
        $sampah->kategori = $request->kategori;
        $sampah->jenis = $request->jenis;
        $sampah->save();

        return redirect()->route('admin.data_sampah')->with('success', 'Data sampah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sampah = DataSampah::findOrFail($id);

        // Hapus foto jika ada
        if ($sampah->foto) {
            Storage::disk('public')->delete($sampah->foto);
        }

        $sampah->delete();
        return redirect()->route('admin.data_sampah')->with('success', 'Data sampah berhasil dihapus.');
    }
}
