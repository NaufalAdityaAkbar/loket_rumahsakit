@extends('layouts.app')

@section('title', 'Display Antrian')

@section('content')
    <h2 class="text-2xl mb-4">Display Antrian</h2>

    <div>
        @if (class_exists(\Livewire\Livewire::class))
            @livewire('display-queue')
        @else
            <p>Livewire tidak terdeteksi. Silakan install Livewire untuk interaksi real-time.</p>
        @endif
    </div>
@endsection
