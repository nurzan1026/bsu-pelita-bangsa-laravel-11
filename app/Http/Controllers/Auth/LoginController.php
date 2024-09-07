<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.bank_sampah_unit_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('bank_sampah_unit')->attempt($credentials)) {
            return redirect()->intended('/unit/dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('bank_sampah_unit')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/unit/login');
    }
}
