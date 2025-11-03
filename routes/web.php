<?php

use Illuminate\Support\Facades\Route;

// Redirect root to login page so users land on the login immediately after running the app
Route::get('/', function () {
    return redirect()->route('patient');
});

// Auth routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);

// Frontend pages (Livewire components will be mounted in these views)
Route::get('/patient', function () {
    return view('patient');
})->name('patient');

// Petugas dashboard and master loket routes
Route::middleware(['auth', 'can:access-petugas'])->group(function () {
    Route::get('/petugas', function () {
        return view('petugas.dashboard');
    })->name('petugas.dashboard');

    Route::get('/petugas/loket', function () {
        return view('petugas.master-loket');
    })->name('petugas.loket');
});

Route::get('/display', function () {
    return view('display');
})->name('display');

// Temporary route for debugging
// (debug route removed)