@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<h2 class="text-2xl font-bold mb-4 text-center" :class="darkMode ? 'text-white' : 'text-gray-800'">
    <i class="fas fa-user-plus text-blue-500 mr-2"></i>Daftar
</h2>
<div class="rounded-md border" :class="darkMode ? 'border-gray-700' : 'border-gray-300'">
    <form method="POST" action="{{ route('register') }}" class="space-y-4 p-5 rounded-md form-animate" :class="darkMode ? 'bg-gray-800' : 'bg-white'" x-data="{ name: '', email: '', password: '', password_confirmation: '', terms: false }">
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
</form>
</div>
<div class="mt-4 text-center">
    <p class="text-sm" :class="darkMode ? 'text-gray-400' : 'text-gray-600'">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login sekarang</a>
    </p>
</div>
@endsection