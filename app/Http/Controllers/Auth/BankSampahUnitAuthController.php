<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UnitResetPasswordNotification; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\BankSampahUnitAccount;

class BankSampahUnitAuthController extends Controller
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

        return redirect()->back()->with('error', 'Email atau password salah.');
    }

    public function showRegistrationForm()
    {
        return view('auth.bank_sampah_unit_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:bank_sampah_unit_accounts'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
        ]);

        BankSampahUnitAccount::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request['address'],
            'phone' => $request['phone'],
        ]);

        return redirect('/unit/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::guard('bank_sampah_unit')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/unit/login');
    }

    

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email', ['guard' => 'unit']);
    }

    public function broker()
    {
        return Password::broker('bank_sampah_unit_accounts');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = BankSampahUnitAccount::where('email', $request->email)->first();

        if ($user) {
            $user->notify(new UnitResetPasswordNotification(Password::getRepository()->create($user)));
            return back()->with('status', 'We have emailed your password reset link!');
        }

        return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email, 'guard' => 'unit']
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $status = Password::broker('bank_sampah_unit_accounts')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('unit.login')->with('status', 'Password has been reset!')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
