@extends('layouts.app')

@section('title', 'Patient')

@section('content')
    <h2 class="text-2xl mb-4">Halaman Pasien - Ambil Nomor Antrian</h2>

    <div>
        {{-- Mount Livewire component untuk patient --}}
        @if (class_exists(\Livewire\Livewire::class))
            @livewire('patient-queue')
        @else
            <p>Livewire tidak terdeteksi. Silakan install Livewire untuk interaksi real-time.</p>
        @endif
    </div>
@endsection
