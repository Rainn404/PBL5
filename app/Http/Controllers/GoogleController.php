<?php

namespace App\Http\Controllers;

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
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Ambil atau buat user
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'      => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar'    => $googleUser->getAvatar(),
                    'password'  => bcrypt('google_login'),
                    'role'      => 'mahasiswa',
                ]
            );

            // =========================
            // ROLE BERDASARKAN EMAIL
            // =========================
            if ($user->email === 'superadmn.himati@gmail.com') {
                $user->role = 'super_admin';
            } elseif ($user->email === 'tipolitalaa@gmail.com') {
                $user->role = 'admin';
            } else {
                $user->role = 'mahasiswa';
            }

            $user->save();

            Auth::login($user, true);

            // =========================
            // REDIRECT YANG BENAR
            // =========================
            if (in_array($user->role, ['admin', 'super_admin'])) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect('/login')
                ->with('error', 'Login dengan Google gagal. Silakan coba lagi.');
        }
    }
}
