<?php

namespace App\Http\Controllers;

use App\Models\RewardItem;
use Illuminate\Http\Request;
use App\Models\PenarikanPoin;
use App\Models\PenarikanSaldo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenarikanController extends Controller
{
    public function createPoin()
    {
        $rewardItems = RewardItem::all();
        return view('nasabah-page.penarikan-poin.penarikan-poin', compact('rewardItems'));
    }

    public function storePoin(Request $request)
    {
        $nasabahId = Auth::guard('nasabah')->id();
        $rewardItem = RewardItem::find($request->reward_item_id);

        PenarikanPoin::create([
            'nasabah_id' => $nasabahId,
            'reward_item_id' => $rewardItem->id,
            'tanggal' => $request->tanggal,
            'status' => 'Pending',
        ]);

        return redirect()->route('nasabah.penarikan-poin.create')->with('success', 'Permintaan penarikan poin berhasil diajukan.');
    }

    public function createSaldo()
    {
        return view('nasabah-page.penarikan-saldo.penarikan-saldo');
    }

    public function storeSaldo(Request $request)
    {
        $nasabahId = Auth::guard('nasabah')->id();

        PenarikanSaldo::create([
            'nasabah_id' => $nasabahId,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'status' => 'Pending',
        ]);

        return redirect()->route('nasabah.penarikan-saldo.create')->with('success', 'Permintaan penarikan saldo berhasil diajukan.');
    }

    public function riwayatPenarikan()
    {
        $nasabahId = Auth::guard('nasabah')->id();

        $penarikanPoin = PenarikanPoin::where('nasabah_id', $nasabahId)->with('rewardItem')->get();

        $penarikanSaldo = PenarikanSaldo::where('nasabah_id', $nasabahId)->get();

        return view('nasabah-page.riwayat-penarikan.riwayat-penarikan', compact('penarikanPoin', 'penarikanSaldo'));
    }
}
