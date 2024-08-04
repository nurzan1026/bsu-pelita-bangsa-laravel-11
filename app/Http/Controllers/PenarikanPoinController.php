<?php

namespace App\Http\Controllers;

use App\Models\PenarikanPoin;
use Illuminate\Http\Request;

class PenarikanPoinController extends Controller
{
    public function index()
    {
        $riwayat = PenarikanPoin::all();
        return view('nasabah-page.riwayat-penarikan-poin.riwayat-penarikan-poin', compact('riwayat'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'opsi' => 'required|in:minyak,sembako',
            'jumlah' => 'required|integer|min:1',
        ]);

        PenarikanPoin::create([
            'tanggal' => $request->tanggal,
            'opsi' => $request->opsi,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Penarikan poin berhasil diajukan.');
    }
}

