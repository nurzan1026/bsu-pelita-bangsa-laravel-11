<?php

namespace App\Http\Controllers;

use App\Models\PenarikanPoin;
use Illuminate\Http\Request;
use App\Services\TelegramService;

class PenarikanPoinController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

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
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'opsi' => $request->opsi,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
        ]);

        $message = "Penarikan poin diajukan:\nNama: {$request->nama}\nTanggal: {$request->tanggal}\nOpsi: {$request->opsi}\nJumlah: {$request->jumlah}";
        $this->telegramService->sendNotification($message);

        return redirect()->back()->with('success', 'Penarikan poin berhasil diajukan.');
    }
}
