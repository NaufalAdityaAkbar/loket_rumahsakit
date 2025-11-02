<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\GoogleController;

// Public routes (no auth required) - Dapat diakses oleh semua user tanpa login
Route::get('/', function () {
    return view('dashboard');
})->name('home');

// Queue management routes - Dapat diakses oleh semua user tanpa login
Route::group(['as' => 'queue.'], function () {
    Route::get('/display', function () {
        return view('display');
    })->name('display');

    Route::get('/patient', function () {
        return view('patient');
    })->name('patient');
});

// Auth routes (for petugas only) - Tetap bisa diakses manual, tapi hanya untuk petugas
Route::group(['prefix' => 'petugas', 'as' => 'petugas.'], function () {
    // Login routes
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])
        ->name('login')
        ->middleware('guest');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])
        ->name('login.post')
        ->middleware('guest');
    
    // Register routes
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register')->middleware('guest');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])
        ->name('register.post')
        ->middleware('guest');

    // Google OAuth Routes
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])
        ->name('login.google')
        ->middleware('guest');
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])
        ->name('login.google.callback')
        ->middleware('guest');
        
    // Logout route
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('petugas.login');
    })->name('logout')->middleware('auth');
});

// Protected petugas routes - Hanya bisa diakses oleh petugas yang sudah login
Route::group(['prefix' => 'petugas', 'as' => 'petugas.', 'middleware' => ['auth', 'role:petugas']], function () {
    Route::get('/dashboard', function () {
        return view('petugas.dashboard');
    })->name('dashboard');

    Route::get('/master/loket', function () {
        return view('petugas.master.loket');
    })->name('master.loket');

    Route::get('/loket/{loket}', function ($loket) {
        return view('petugas.loket', compact('loket'));
    })->name('loket');
});