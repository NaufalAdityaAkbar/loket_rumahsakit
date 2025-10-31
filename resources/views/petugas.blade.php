@extends('layouts.app')

@section('title', 'Petugas Loket')

@section('content')
    <h2 class="text-2xl mb-4">Halaman Petugas Loket</h2>

    <div>
        @if (class_exists(\Livewire\Livewire::class))
            @livewire('petugas-queue')
        @else
            <p>Livewire tidak terdeteksi. Silakan install Livewire untuk interaksi real-time.</p>
        @endif
    </div>
@endsection
