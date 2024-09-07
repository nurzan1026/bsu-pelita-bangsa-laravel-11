<?php

namespace App\Http\Controllers\BankSampahPusat\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BankSampahPusatAccount;
use Illuminate\Support\Facades\Validator;

class PusatLoginController extends Controller
{
    use \Illuminate\Foundation\Validation\ValidatesRequests;

    public function showLoginForm()
    {
        return view('bank_sampah_pusat.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('bank_sampah_pusat')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('pusat.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('bank_sampah_pusat')->logout();
        return redirect()->route('pusat.login');
    }
}
