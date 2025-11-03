@extends('layouts.dashboard')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold">Dashboard Petugas</h2>
        <div class="text-sm text-gray-500">Halo, Petugas</div>
    </div>

    <div class="bg-white rounded shadow p-6">
        <livewire:petugas-queue />
    </div>
@endsection
