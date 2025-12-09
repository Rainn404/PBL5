<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['showResetRequestForm','sendResetLink','showResetForm','resetPassword']);
    }

    public function show(Request $request)
    {
        return view('auth.profile.show', ['user' => $request->user()]);
    }

    public function edit(Request $request)
    {
        return view('auth.profile.edit', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->fill($data);
        $user->save();

        return redirect()->route('profile.show')->with('success','Profil berhasil diperbarui.');
    }

    public function uploadAvatar(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $file = $request->file('avatar');
        $filename = Str::slug($user->id . '-' . $user->name) . '-' . time() . '.' . $file->getClientOriginalExtension();

        $targetDir = public_path('storage/avatars');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        // delete old avatar if exists
        if ($user->avatar && file_exists(public_path('storage/avatars/' . $user->avatar))) {
            @unlink(public_path('storage/avatars/' . $user->avatar));
        }

        $user->avatar = $filename;
        $user->save();

        return redirect()->route('profile.show')->with('success','Foto profil diperbarui.');
    }

    public function removeAvatar(Request $request)
    {
        $user = $request->user();
        if ($user->avatar && file_exists(public_path('storage/avatars/' . $user->avatar))) {
            @unlink(public_path('storage/avatars/' . $user->avatar));
        }
        $user->avatar = null;
        $user->save();

        return redirect()->route('profile.show')->with('success','Foto profil dihapus.');
    }

    public function showChangePassword(Request $request)
    {
        return view('auth.profile.password', ['user' => $request->user()]);
    }

    public function changePassword(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        return redirect()->route('profile.show')->with('success','Password berhasil diubah.');
    }

    // Password reset (public)
    public function showResetRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
