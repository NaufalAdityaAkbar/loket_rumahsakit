@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Dashboard Petugas</h1>
        <div class="flex items-center space-x-4">
            <img src="{{ auth()->user()->avatar }}" alt="Profile" class="w-10 h-10 rounded-full">
            <span>{{ auth()->user()->name }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Assigned Loket Card -->
        @if(auth()->user()->assignedLoket)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-4">Loket Anda</h3>
            <p class="text-gray-600">{{ auth()->user()->assignedLoket->name }}</p>
            <a href="{{ route('petugas.loket', auth()->user()->assigned_loket_id) }}" 
               class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Ke Halaman Loket
            </a>
        </div>
        @endif

        <!-- Quick Stats -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-4">Statistik Hari Ini</h3>
            <div class="space-y-3">
                <p class="flex justify-between">
                    <span class="text-gray-600">Total Antrian</span>
                    <span class="font-semibold">{{ App\Models\Antrian::whereDate('created_at', today())->count() }}</span>
                </p>
                <p class="flex justify-between">
                    <span class="text-gray-600">Menunggu</span>
                    <span class="font-semibold">{{ App\Models\Antrian::where('status', 'waiting')->count() }}</span>
                </p>
                <p class="flex justify-between">
                    <span class="text-gray-600">Selesai</span>
                    <span class="font-semibold">{{ App\Models\Antrian::where('status', 'finished')->whereDate('created_at', today())->count() }}</span>
                </p>
            </div>
        </div>

        <!-- Master Data Links -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-4">Master Data</h3>
            <div class="space-y-3">
                <a href="{{ route('master.loket') }}" 
                   class="block bg-gray-100 p-3 rounded hover:bg-gray-200">
                    Master Loket
                </a>
            </div>
        </div>
    </div>
</div>
@endsection