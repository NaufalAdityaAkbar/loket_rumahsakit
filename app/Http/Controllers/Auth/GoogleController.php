<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // Set SSL verification ke false untuk development
        $config = [
            'client_id' => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
            'redirect' => config('services.google.redirect'),
            'guzzle' => [
                'verify' => false, // Disable SSL verification
                'curl' => [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false
                ]
            ]
        ];
        
        return Socialite::buildProvider(
            \Laravel\Socialite\Two\GoogleProvider::class, 
            $config
        )
        ->with(['prompt' => 'select_account'])
        ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Gunakan provider yang sama dengan SSL verification disabled
            $config = [
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                'redirect' => config('services.google.redirect'),
                'guzzle' => [
                    'verify' => false,
                    'curl' => [
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false
                    ]
                ]
            ];
            
            $googleUser = Socialite::buildProvider(
                \Laravel\Socialite\Two\GoogleProvider::class, 
                $config
            )->user();

            // Validasi data yang diterima dari Google
            if (!$googleUser->email) {
                throw new \Exception('Email tidak ditemukan dari akun Google');
            }

            // Cari user berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->id)
                       ->orWhere('email', $googleUser->email)
                       ->first();

            if (!$user) {
                // Generate random password untuk login manual
                $defaultPassword = \Str::random(12);
                
                // Buat user baru
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'password' => bcrypt($defaultPassword),
                    'email_verified_at' => now(),
                ]);

                // Tampilkan password ke user hanya saat pertama kali login
                session()->flash('success', 'Akun berhasil dibuat! Password untuk login manual anda adalah: ' . $defaultPassword . '. Harap simpan password ini.');
            } 
            // Update google_id jika user sudah ada tapi belum punya google_id
            else if (!$user->google_id) {
                $user->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'email_verified_at' => now(),
                ]);
            }

            Auth::login($user);

            return redirect()->route('petugas.dashboard')->with('success', 'Login berhasil!');

        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Google Login Error: ' . $e->getMessage());
            
            return redirect()
                ->route('login')
                ->with('error', 'Terjadi kesalahan saat login dengan Google: ' . $e->getMessage());
        }
    }
}