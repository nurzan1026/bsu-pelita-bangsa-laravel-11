<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankSampahUnitAccount;
use Illuminate\Http\Request;

class AdminAkunController extends Controller
{
    public function index()
    {
        $accounts =  BankSampahUnit::all();
        return view('admin.daftar_akun_bank_sampah_unit', compact('accounts'));
    }
}
