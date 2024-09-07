<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        return view('admin.daftar_akun_bank_sampah_unit');
    }

    public function bankSampahUnit()
    {
        return view('admin.daftar_akun_bank_sampah_unit');
    }

    public function nasabah()
    {
        return view('admin.daftar_akun_nasabah');
    }
}
