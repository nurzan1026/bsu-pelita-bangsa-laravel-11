<?php
 namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use App\Models\Admin;
 use App\Models\Nasabah;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Hash;
 
 class AuthController extends Controller
 {
     // Show login forms
     public function showAdminLoginForm()
     {
         return view('auth.admin-login');
     }
 
     public function showNasabahLoginForm()
     {
         return view('auth.nasabah-login');
     }
 
     // Handle login
     public function adminLogin(Request $request)
     {
         $credentials = $request->only('email', 'password');
         if (Auth::guard('admin')->attempt($credentials)) {
             return redirect()->intended('/admin/dashboard');
         }
         return back()->withErrors([
             'email' => 'The provided credentials do not match our records.',
         ]);
     }
 
     public function nasabahLogin(Request $request)
     {
         $credentials = $request->only('email', 'password');
         if (Auth::guard('nasabah')->attempt($credentials)) {
             return redirect()->intended('/nasabah/dashboard');
         }
         return back()->withErrors([
             'email' => 'The provided credentials do not match our records.',
         ]);
     }
 
     // Show register forms
     public function showAdminRegisterForm()
     {
         return view('auth.admin-register');
     }
 
     public function showNasabahRegisterForm()
     {
         return view('auth.nasabah-register');
     }
 
     // Handle register
     public function adminRegister(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:admins',
             'password' => 'required|string|min:8|confirmed',
         ]);
 
         $admin = Admin::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);
 
         Auth::guard('admin')->login($admin);
 
         return redirect('/admin/dashboard');
     }
 
     public function nasabahRegister(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:nasabahs',
             'password' => 'required|string|min:8|confirmed',
         ]);
 
         $nasabah = Nasabah::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);
 
         Auth::guard('nasabah')->login($nasabah);
 
         return redirect('/nasabah/dashboard');
     }
 }
 