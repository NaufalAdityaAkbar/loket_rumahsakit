@extends('layouts.app')

@section('title', 'Petugas Loket')

@section('content')
    <h2 class="text-2xl mb-4">Halaman Petugas Loket</h2>

    <div>
        <livewire:petugas-queue />
    </div>
@endsection
