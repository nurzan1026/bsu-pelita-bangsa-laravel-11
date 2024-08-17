<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\NasabahAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NasabahAkunController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.nasabah-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('nasabah')->attempt($credentials)) {
            return redirect()->route('nasabah.dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function showRegisterForm()
    {
        return view('auth.nasabah-register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:nasabah_akuns',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        NasabahAkun::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
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
            'email' => 'required|email|exists:nasabah_akuns,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = NasabahAkun::where('email', $request->input('email'))->first();

        if ($user) {
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return redirect()->route('nasabah.login')->with('status', 'Password berhasil diubah. Silakan login.');
        }

        return back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }
}
