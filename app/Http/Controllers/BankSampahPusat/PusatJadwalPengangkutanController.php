<?php

namespace App\Http\Controllers\BankSampahPusat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermintaanPengangkutan;

class PusatJadwalPengangkutanController extends Controller
{
    public function index()
    {
        $jadwalPengangkutan = PermintaanPengangkutan::where('status', 'Tanggal Pengambilan Telah Terbit')
                                                    ->orWhere('status', 'Menuju Tempat Anda')
                                                    ->get();
        return view('bank_sampah_pusat.jadwal_pengangkutan', compact('jadwalPengangkutan'));
    }

    public function selesaiPengangkutan($id)
    {
        $pengangkutan = PermintaanPengangkutan::findOrFail($id);
        $pengangkutan->status = 'Selesai';
        $pengangkutan->save();

        return redirect()->route('pusat.jadwal_pengangkutan')->with('success', 'Pengangkutan telah selesai dan dipindahkan ke riwayat.');
    }

    public function riwayatPengangkutan()
    {
        $riwayatPengangkutan = PermintaanPengangkutan::where('status', 'Selesai')->get();
        return view('bank_sampah_pusat.riwayat_pengangkutan', compact('riwayatPengangkutan'));
    }
}
