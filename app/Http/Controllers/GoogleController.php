<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt('google_login'),
                    'role' => 'mahasiswa', // Default role untuk user Google baru
                ]
            );

            Auth::login($user);

            // 🔥 Jika email admin HIMA
            if ($user->email === 'himapolitala.ti@gmail.com') {

                // Pastikan role admin disimpan
                if ($user->role !== 'admin') {
                    $user->role = 'admin';
                    $user->save();
                }

                return redirect()->route('admin.dashboard');
            }

            // 🔥 User biasa ke beranda
            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login dengan Google gagal. Silakan coba lagi.');
        }
    }
}
