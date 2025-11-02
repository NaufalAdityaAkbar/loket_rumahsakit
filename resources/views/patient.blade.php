@extends('layouts.app')

@section('title', 'Patient')

@section('content')
    <h2 class="text-2xl mb-4">Halaman Pasien - Ambil Nomor Antrian</h2>

    <div>
        <livewire:patient-queue />
    </div>
@endsection
