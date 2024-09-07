<?php

namespace App\Http\Controllers\BankSampahPusat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermintaanPengangkutan;

class PermintaanPengangkutanController extends Controller
{
    public function index()
    {
        $permintaan = PermintaanPengangkutan::with('account')->get();
        return view('bank_sampah_pusat.daftar_permintaan_pengangkutan', compact('permintaan'));
    }
}
