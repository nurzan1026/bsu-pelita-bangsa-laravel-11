<?php

namespace App\Http\Controllers\BankSampahPusat;

use App\Http\Controllers\Controller;
use App\Models\BankSampahUnit;

class BankSampahUnitController extends Controller
{
    public function index()
    {
        $units = BankSampahUnit::all();
        return view('bank_sampah_pusat.units', compact('units'));
    }
}
