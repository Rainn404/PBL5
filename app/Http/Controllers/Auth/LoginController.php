<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Jika autentikasi berhasil
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {

            $request->session()->regenerate();
            $user = Auth::user();

            // =============== REDIRECT BERDASARKAN ROLE ===============
            
            // Jika admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Jika super admin (jika kamu punya)
            if ($user->role === 'super_admin') {
                return redirect()->route('admin.dashboard');
            }

            // Jika user biasa
            return redirect()->route('dashboard');
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
