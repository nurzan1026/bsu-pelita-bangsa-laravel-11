<?php

namespace App\Http\Controllers;

use App\Models\PenarikanSaldo;
use Illuminate\Http\Request;

class PenarikanSaldoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ]);

        PenarikanSaldo::create([
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Penarikan saldo berhasil diajukan.');
    }

    public function index()
    {
        $riwayat = PenarikanSaldo::all(); // Ambil semua data penarikan saldo
        return view('nasabah-page.riwayat-penarikan-saldo.riwayat-penarikan-saldo', compact('riwayat'));
    }
    
}


