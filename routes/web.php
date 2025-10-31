<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Login logic will be implemented here
    return redirect('/');
})->name('login.post');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    // Register logic will be implemented here
    return redirect('/login');
})->name('register.post');

Route::get('/login/google', function () {
    // Google login logic will be implemented here
    return redirect('/');
})->name('login.google');

// Frontend pages (Livewire components will be mounted in these views)
Route::get('/patient', function () {
    return view('patient');
})->name('patient');

Route::get('/petugas', function () {
    return view('petugas');
})->name('petugas');

Route::get('/display', function () {
    return view('display');
})->name('display');