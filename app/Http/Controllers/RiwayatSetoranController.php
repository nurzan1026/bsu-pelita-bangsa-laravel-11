<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use Illuminate\Support\Facades\Auth;

class RiwayatSetoranController extends Controller
{
    public function index()
    {
        // Mengambil ID nasabah yang sedang login
        $nasabahId = Auth::guard('nasabah')->id();

        // Mengambil data setoran terkait nasabah tersebut, beserta detail setoran dan harga sampah
        // dengan menggunakan relasi yang tepat
        $setoranSampah = Setoran::where('nasabah_id', $nasabahId)
            ->with(['detailSetoran.sampah.harga'])
            ->get();

        // Mengembalikan view dengan data setoran
        return view('nasabah-page.riwayat-setoran-sampah.riwayat-setoran-sampah', compact('setoranSampah'));
    }
}
