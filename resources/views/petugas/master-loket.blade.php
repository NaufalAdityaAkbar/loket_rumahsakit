@extends('layouts.dashboard')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold">Master Data Loket</h2>
        <div class="text-sm text-gray-500">Kelola data loket</div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded shadow p-6">
            <h3 class="font-semibold mb-4">Tambah Loket</h3>
            <livewire:master-loket />
        </div>

        <div class="bg-white rounded shadow p-6">
            <h3 class="font-semibold mb-4">Daftar Loket</h3>
            <livewire:master-loket :showList="true" />
        </div>
    </div>
@endsection
