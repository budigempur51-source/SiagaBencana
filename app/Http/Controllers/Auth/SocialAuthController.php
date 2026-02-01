<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    // Mengarahkan User ke Halaman Login Google/FB
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Menangani Data Balikan (Callback) dari Google/FB
    public function callback($provider)
    {
        try {
            // Ambil user dari Google/Facebook
            $socialUser = Socialite::driver($provider)->user();

            // Cek apakah user dengan email ini sudah ada?
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // Jika user sudah ada, update ID social-nya (Link Account)
                $user->update([
                    "{$provider}_id" => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            } else {
                // Jika user belum ada, buat akun baru
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(Str::random(16)), // Password acak
                    "{$provider}_id" => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'role' => 'user', // Default role user
                    'email_verified_at' => now(), // Auto verify karena dari Google/FB
                ]);
            }

            // LOGIN-KAN USER
            // Parameter 'true' di sini adalah kuncinya untuk "Remember Me" (Simpan Cookie)
            Auth::login($user, true);

            // Redirect sesuai role
            if ($user->role === 'admin') {
                return redirect()->intended(route('dashboard'));
            }

            return redirect()->intended(route('user.selection'));

        } catch (\Exception $e) {
            // Jika batal atau error, kembalikan ke login dengan pesan
            return redirect()->route('login')->withErrors(['email' => 'Gagal login dengan ' . ucfirst($provider) . '. Silakan coba lagi.']);
        }
    }
}