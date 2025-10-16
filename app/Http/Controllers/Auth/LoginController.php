<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();

        $user = Auth::user();
        
        // Redirect berdasarkan role
        if ($user->role === 'admin' || $user->role === 'super_admin') {
            return redirect()->route('admin.dashboard');
        }

        // Mahasiswa / user biasa langsung ke pendaftaran
        return redirect()->route('pendaftaran.create');
    }

    return back()->withErrors([
        'email' => 'Email atau password yang dimasukkan salah.',
    ])->onlyInput('email');
}
}