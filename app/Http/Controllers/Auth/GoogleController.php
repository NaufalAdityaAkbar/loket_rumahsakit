<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
            
            $user = User::where('google_id', $googleUser->id)->first();

            if (!$user) {
                // Create new user automatically as petugas
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'role' => 'petugas', // Automatically set as petugas
                    'password' => bcrypt(str()->random(16)),
                ]);
            }

            Auth::login($user);

            // Redirect based on role
            if ($user->isPetugas()) {
                return redirect()->route('petugas.dashboard');
            }
            
            return redirect()->route('user.dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Something went wrong with Google login');
        }
    }
}