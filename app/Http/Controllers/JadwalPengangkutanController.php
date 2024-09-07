<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataSampah;
use App\Models\PermintaanPengangkutan;

class JadwalPengangkutanController extends Controller
{
    public function index()
    {
        $jadwalPengangkutan = PermintaanPengangkutan::where('account_id', Auth::guard('bank_sampah_unit')->id())
                            ->where('status', 'Tanggal Pengambilan Telah Terbit')
                            ->orWhere('status', 'Menuju Tempat Anda')
                            ->get();
        return view('bank_sampah_unit.jadwal_pengangkutan', compact('jadwalPengangkutan'));
    }

    public function markAsCompleted($id)
    {
        $permintaan = PermintaanPengangkutan::findOrFail($id);
        $permintaan->update([
            'status' => 'Selesai'
        ]);

        return redirect()->route('unit.jadwal_pengangkutan')->with('success', 'Permintaan telah diselesaikan dan dipindahkan ke Permintaan Selesai.');
    }
}
