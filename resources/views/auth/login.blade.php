@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold mb-2" :class="darkMode ? 'text-white' : 'text-gray-800'">
            Login Petugas
        </h2>
        <p class="text-sm" :class="darkMode ? 'text-gray-400' : 'text-gray-600'">
            Masukkan kredensial Anda untuk melanjutkan
        </p>
    </div>

    <!-- Login Form -->
    <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-semibold mb-2" 
                :class="darkMode ? 'text-gray-200' : 'text-gray-700'">
                Email
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope" :class="darkMode ? 'text-gray-500' : 'text-gray-400'"></i>
                </div>
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    value="{{ old('email') }}"
                    required
                    class="block w-full pl-10 pr-4 py-3 rounded-xl border-2 transition-all duration-200 focus:outline-none focus:ring-4"
                    :class="darkMode ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500/20' : 'bg-white border-gray-200 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500/20'"
                    placeholder="nama@email.com"
                >
            </div>
            @error('email')
            <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                <i class="fas fa-exclamation-circle"></i>
                {{ $message }}
            </p>
            @enderror
        </div>

        <!-- Password Field -->
        <div>
            <label for="password" class="block text-sm font-semibold mb-2" 
                :class="darkMode ? 'text-gray-200' : 'text-gray-700'">
                Password
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock" :class="darkMode ? 'text-gray-500' : 'text-gray-400'"></i>
                </div>
                <input 
                    type="password" 
                    name="password"
                    id="password"
                    required
                    class="block w-full pl-10 pr-4 py-3 rounded-xl border-2 transition-all duration-200 focus:outline-none focus:ring-4"
                    :class="darkMode ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500/20' : 'bg-white border-gray-200 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500/20'"
                    placeholder="••••••••"
                >
            </div>
            @error('password')
            <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                <i class="fas fa-exclamation-circle"></i>
                {{ $message }}
            </p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label class="flex items-center cursor-pointer">
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember"
                    class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:ring-2"
                >
                <span class="ml-2 text-sm" :class="darkMode ? 'text-gray-300' : 'text-gray-700'">
                    Ingat saya
                </span>
            </label>
        </div>

        <!-- Submit Button -->
        <button 
            type="submit" 
            class="w-full flex justify-center items-center gap-2 py-3.5 px-4 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500/50 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl"
        >
            <i class="fas fa-sign-in-alt"></i>
            <span>Login</span>
        </button>
    </form>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t" :class="darkMode ? 'border-gray-700' : 'border-gray-300'"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 py-1 rounded-full" 
                :class="darkMode ? 'bg-gray-800 text-gray-400' : 'bg-white text-gray-500'">
                atau
            </span>
        </div>
    </div>

    <!-- Google Login -->
    <a 
        href="{{ route('login.google') }}" 
        class="flex items-center justify-center gap-3 py-3.5 px-4 rounded-xl border-2 font-medium transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-sm hover:shadow-md"
        :class="darkMode ? 'bg-gray-700 border-gray-600 text-white hover:bg-gray-600' : 'bg-white border-gray-200 text-gray-700 hover:bg-gray-50'"
    >
        <img src="https://www.google.com/favicon.ico" alt="Google" class="w-5 h-5">
        <span>Login dengan Google</span>
    </a>
</div>
@endsection