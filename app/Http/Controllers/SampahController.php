<?php

namespace App\Http\Controllers;

use App\Models\DataSampah;
use Illuminate\Http\Request;

class SampahController extends Controller
{
    public function indexKategori()
    {
        $sampah = DataSampah::with('harga')->get();
        $sampahByKategori = $sampah->groupBy('kategori');

        // Array warna untuk setiap kategori
        $kategoriColors = [
            'Plastik' => 'bg-green-500',
            'Logam' => 'bg-blue-500',
            'Kertas' => 'bg-yellow-500',
            'Botol Kaca' => 'bg-red-500',
            'Minyak' => 'bg-purple-500',
        ];

        return view('bank_sampah_unit.kategori', compact('sampahByKategori', 'kategoriColors'));
    }
}
