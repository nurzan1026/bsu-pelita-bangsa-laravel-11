<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SampahUnit;

class SampahUnitController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jenis_sampah' => 'required|string|max:255',
        ]);

        SampahUnit::create([
            'account_id' => Auth::guard('bank_sampah_unit')->id(),
            'jenis_sampah' => $request->jenis_sampah,
        ]);

        return redirect()->back()->with('success', 'Jenis sampah berhasil ditambahkan!');
    }

    public function index()
    {
        $sampah_units = SampahUnit::where('account_id', Auth::guard('bank_sampah_unit')->id())->get();
        return view('bank_sampah_unit.dashboard', compact('sampah_units'));
    }
}
