<?php

namespace App\Http\Controllers;

use App\Models\PenarikanSaldo;
use Illuminate\Http\Request;
use App\Services\TelegramService;

class PenarikanSaldoController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

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

        $message = "Penarikan saldo diajukan:\nTanggal: {$request->tanggal}\nJumlah: {$request->jumlah}";
        $this->telegramService->sendNotification($message);

        return redirect()->back()->with('success', 'Penarikan saldo berhasil diajukan.');
    }

    public function index()
    {
        $riwayat = PenarikanSaldo::all();
        return view('nasabah-page.riwayat-penarikan-saldo.riwayat-penarikan-saldo', compact('riwayat'));
    }
}


