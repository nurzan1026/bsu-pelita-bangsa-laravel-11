<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class NasabahAkunController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.nasabah-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Cek apakah email sudah terdaftar
        $nasabah = Nasabah::where('email', $request->email)->first();

        if (!$nasabah) {
            // Jika email belum terdaftar
            return redirect()->back()->withErrors(['email' => 'Email belum terdaftar silahkan registrasi terlebih dahulu.'])->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $nasabah->password)) {
            // Jika password salah
            return redirect()->back()->withErrors(['password' => 'Password yang anda masukkan salah.'])->withInput();
        }

        // Login pengguna jika email dan password benar
        Auth::guard('nasabah')->login($nasabah);
        return redirect()->route('nasabah.dashboard')->with('nasabah', $nasabah);
    }

    public function showRegisterForm()
    {
        return view('auth.nasabah-register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nomor_induk' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:nasabahs',
            'email' => 'required|string|email|max:255|unique:nasabahs',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Nasabah::create([
            'nama' => $request->nama,
            'nomor_induk' => $request->nomor_induk,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'foto' => $request->foto ?? null,
        ]);

        return redirect()->route('nasabah.login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function showChangeForm()
    {
        return view('auth.passwords.change');
    }

    public function change(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:nasabahs,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $nasabah = Nasabah::where('email', $request->input('email'))->first();

    if ($nasabah) {
        if (Hash::check($request->input('password'), $nasabah->password)) {
            return redirect()->back()->withErrors(['password' => 'Password baru tidak boleh sama dengan password lama.'])->withInput();
        }

        $nasabah->password = Hash::make($request->input('password'));
        $nasabah->save();

        return redirect()->route('nasabah.login')->with('status', 'Password berhasil diubah. Silakan login kembali.');
    }

    // pesan jika email tidak terdaftar
    return redirect()->back()->withErrors(['email' => 'Email ini belum pernah digunakan.'])->withInput();
}

}
