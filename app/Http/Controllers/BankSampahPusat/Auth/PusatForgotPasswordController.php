<?php

namespace App\Http\Controllers\BankSampahPusat\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PusatForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('bank_sampah_pusat.auth.password.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('bank_sampah_pusat_accounts')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token = null)
{
    return view('bank_sampah_pusat.auth.password.reset')->with(
        ['token' => $token, 'email' => $request->email]
    );
}

protected function broker()
{
    return Password::broker('bank_sampah_pusat_accounts');
}

}
