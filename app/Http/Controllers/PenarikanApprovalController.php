<?php

namespace App\Http\Controllers;

use App\Models\PenarikanPoin;
use App\Models\PenarikanSaldo;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PenarikanApprovalController extends Controller
{
    public function index()
    {
        $penarikansPoin = PenarikanPoin::where('status', 'Pending')->get();
        $penarikansSaldo = PenarikanSaldo::where('status', 'Pending')->get();

        return view('bank_sampah_unit.transaksi.index', compact('penarikansPoin', 'penarikansSaldo'));
    }

    public function approvePoin($id)
    {
        Log::info("approvePoin dipanggil dengan ID: $id");

        $penarikanPoin = PenarikanPoin::findOrFail($id);
        $nasabah = $penarikanPoin->nasabah;

        Log::info('Data Nasabah:', ['nasabah' => $nasabah]);

        $poinNasabah = $nasabah->setoran->reduce(function ($carry, $setoran) {
            return $carry + $setoran->detailSetoran->sum('poin');
        }, 0);

        Log::info('Poin yang dimiliki Nasabah:', ['poin' => $poinNasabah]);
        Log::info('Poin yang dibutuhkan untuk penarikan:', ['poin_dibutuhkan' => $penarikanPoin->rewardItem->poin]);

        if ($poinNasabah < $penarikanPoin->rewardItem->poin) {
            Log::error('Poin tidak cukup untuk penarikan.');
            return redirect()->route('unit.persetujuan-penarikan.index')->with('error', 'Poin tidak cukup untuk penarikan.');
        }

        $penarikanPoin->update(['status' => 'Disetujui']);
        $poinNasabah -= $penarikanPoin->rewardItem->poin;

        Log::info('Penarikan poin disetujui. Poin Nasabah setelah penarikan:', ['poin' => $poinNasabah]);

        return redirect()->route('unit.persetujuan-penarikan.index')->with('success', 'Penarikan poin disetujui.');
    }

    public function rejectPoin($id)
    {
        Log::info("rejectPoin dipanggil dengan ID: $id");

        $penarikanPoin = PenarikanPoin::findOrFail($id);
        $penarikanPoin->update(['status' => 'Ditolak']);

        Log::info('Penarikan poin ditolak.');

        return redirect()->route('unit.persetujuan-penarikan.index')->with('success', 'Penarikan poin ditolak.');
    }

    public function approveSaldo($id)
    {
        Log::info("approveSaldo dipanggil dengan ID: $id");

        $penarikanSaldo = PenarikanSaldo::findOrFail($id);
        $nasabah = $penarikanSaldo->nasabah;

        Log::info('Data Nasabah:', ['nasabah' => $nasabah]);

        $saldoNasabah = $nasabah->setoran->reduce(function ($carry, $setoran) {
            return $carry +
                $setoran->detailSetoran->sum(function ($detail) {
                    return $detail->berat * ($detail->sampah->harga->price ?? 0);
                });
        }, 0);

        Log::info('Saldo yang dimiliki Nasabah:', ['saldo' => $saldoNasabah]);
        Log::info('Saldo yang dibutuhkan untuk penarikan:', ['saldo_dibutuhkan' => $penarikanSaldo->jumlah]);

        if ($saldoNasabah < $penarikanSaldo->jumlah) {
            Log::error('Saldo tidak cukup untuk penarikan.');
            return redirect()->route('unit.persetujuan-penarikan.index')->with('error', 'Saldo tidak cukup untuk penarikan.');
        }

        $penarikanSaldo->update(['status' => 'Disetujui']);
        $saldoNasabah -= $penarikanSaldo->jumlah;

        Log::info('Penarikan saldo disetujui. Saldo Nasabah setelah penarikan:', ['saldo' => $saldoNasabah]);

        return redirect()->route('unit.persetujuan-penarikan.index')->with('success', 'Penarikan saldo disetujui.');
    }

    public function rejectSaldo($id)
    {
        Log::info("rejectSaldo dipanggil dengan ID: $id");

        $penarikanSaldo = PenarikanSaldo::findOrFail($id);
        $penarikanSaldo->update(['status' => 'Ditolak']);

        Log::info('Penarikan saldo ditolak.');

        return redirect()->route('unit.persetujuan-penarikan.index')->with('success', 'Penarikan saldo ditolak.');
    }
}
