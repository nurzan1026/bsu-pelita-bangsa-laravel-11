<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardNasabahController extends Controller
{
    public function index()
    {
        $nasabah = Auth::guard('nasabah')->user();
        $totalBerat = Setoran::where('nasabah_id', $nasabah->id)
            ->join('detail_setorans', 'setorans.id', '=', 'detail_setorans.setoran_id')
            ->sum('detail_setorans.berat');

        $totalPoin = Setoran::where('nasabah_id', $nasabah->id)
            ->join('detail_setorans', 'setorans.id', '=', 'detail_setorans.setoran_id')
            ->sum('detail_setorans.poin');

        $penarikanPoinDisetujui = $nasabah
            ->penarikanPoin()
            ->where('status', 'Disetujui')
            ->get()
            ->reduce(function ($carry, $penarikanPoin) {
                return $carry + $penarikanPoin->rewardItem->poin;
            }, 0);
        $totalPoin -= $penarikanPoinDisetujui;

        $totalSaldo = Setoran::where('nasabah_id', $nasabah->id)
            ->join('detail_setorans', 'setorans.id', '=', 'detail_setorans.setoran_id')
            ->join('harga_sampah_units', 'detail_setorans.waste_id', '=', 'harga_sampah_units.waste_id')
            ->sum(DB::raw('detail_setorans.berat * harga_sampah_units.price'));

        $penarikanSaldoDisetujui = $nasabah->penarikanSaldo()->where('status', 'Disetujui')->sum('jumlah');
        $totalSaldo -= $penarikanSaldoDisetujui;

        return view('nasabah-page.dashboard.dashboard', compact('nasabah', 'totalBerat', 'totalPoin', 'totalSaldo'));
    }
}
