@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<h2 class="text-2xl font-bold mb-4 text-center" :class="darkMode ? 'text-white' : 'text-gray-800'">
    <i class="fas fa-user-plus text-blue-500 mr-2"></i>Daftar
</h2>
<div class="rounded-md border" :class="darkMode ? 'border-gray-700' : 'border-gray-300'">
    <form method="POST" action="{{ route('register.post') }}" class="space-y-4 p-5 rounded-md form-animate" :class="darkMode ? 'bg-gray-800' : 'bg-white'" x-data="{ name: '', email: '', password: '', password_confirmation: '', terms: false }">
    @csrf
    <div class="group">
        <label class="block mb-2 font-medium" :class="darkMode ? 'text-gray-300' : 'text-gray-700'">
            <i class="far fa-user mr-1 text-blue-500"></i>Nama
        </label>
        <div class="relative">
            <input 
                type="text" 
                name="name" 
                x-model="name"
                class="border p-2 w-full rounded-md pl-10"
                :class="darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-gray-50 border-gray-300 text-gray-900'"
                required 
                autofocus
            >
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-user text-gray-400"></i>
            </div>
        </div>
    </div>
    
    <div class="group">
        <label class="block mb-2 font-medium" :class="darkMode ? 'text-gray-300' : 'text-gray-700'">
            <i class="far fa-envelope mr-1 text-blue-500"></i>Email
        </label>
        <div class="relative">
            <input 
                type="email" 
                name="email" 
                x-model="email"
                class="border p-2 w-full rounded-md pl-10"
                :class="darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-gray-50 border-gray-300 text-gray-900'"
                required
            >
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-envelope text-gray-400"></i>
            </div>
        </div>
    </div>
    
    <div class="group">
        <label class="block mb-2 font-medium" :class="darkMode ? 'text-gray-300' : 'text-gray-700'">
            <i class="fas fa-lock mr-1 text-blue-500"></i>Password
        </label>
        <div class="relative" x-data="{ showPassword: false }">
            <input 
                :type="showPassword ? 'text' : 'password'" 
                name="password" 
                x-model="password"
                class="border p-2 w-full rounded-md pl-10"
                :class="darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-gray-50 border-gray-300 text-gray-900'"
                required
            >
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
            <button 
                type="button"
                class="absolute inset-y-0 right-0 flex items-center pr-3"
                :class="darkMode ? 'text-gray-300' : 'text-gray-600'"
                @click="showPassword = !showPassword"
            >
                <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
            </button>
        </div>
    </div>
    
    <div class="group">
        <label class="block mb-2 font-medium" :class="darkMode ? 'text-gray-300' : 'text-gray-700'">
            <i class="fas fa-lock mr-1 text-blue-500"></i>Konfirmasi Password
        </label>
        <div class="relative" x-data="{ showPassword: false }">
            <input 
                :type="showPassword ? 'text' : 'password'" 
                name="password_confirmation" 
                x-model="password_confirmation"
                class="border p-2 w-full rounded-md pl-10"
                :class="darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-gray-50 border-gray-300 text-gray-900'"
                required
            >
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
            <button 
                type="button" 
                class="absolute inset-y-0 right-0 flex items-center pr-3"
                :class="darkMode ? 'text-gray-300' : 'text-gray-600'"
                @click="showPassword = !showPassword"
            >
                <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
            </button>
        </div>
    </div>
    
    <div class="flex items-center">
        <input 
            type="checkbox" 
            name="terms" 
            id="terms" 
            class="mr-2"
            required
        />
        <label for="terms" class="text-sm" :class="darkMode ? 'text-gray-300' : 'text-gray-700'">
            Saya setuju dengan <a href="#" class="text-blue-500 hover:underline">syarat dan ketentuan</a>
        </label>
    </div>
    
    <button 
        type="submit" 
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md w-full flex items-center justify-center transition-colors duration-200 btn-animate"
    >
        <i class="fas fa-user-plus mr-2"></i>Daftar
    </button>
    
    <div class="relative my-4">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t" :class="darkMode ? 'border-gray-700' : 'border-gray-300'"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2" :class="darkMode ? 'bg-gray-800 text-gray-400' : 'bg-white text-gray-500'">Atau daftar dengan</span>
        </div>
    </div>

    <a href="{{ route('login.google') }}" 
       class="flex items-center justify-center gap-2 border px-4 py-2 rounded-md w-full transition-colors duration-200"
       :class="darkMode ? 'bg-gray-700 border-gray-600 text-white hover:bg-gray-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50'"
    >
        <svg class="w-5 h-5" viewBox="0 0 24 24">
            <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
            <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
            <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
            <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
            <path fill="currentColor" d="M1 1h22v22H1z" fill="none" />
        </svg>
        Google
    </a>
</form>
</div>
<div class="mt-4 text-center">
    <p class="text-sm" :class="darkMode ? 'text-gray-400' : 'text-gray-600'">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login sekarang</a>
    </p>
</div>
@endsection