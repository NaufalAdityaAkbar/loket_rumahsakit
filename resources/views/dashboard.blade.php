@extends('layouts.public')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">
            Selamat Datang di Sistem Antrian
        </h1>
        <p class="text-xl text-gray-600">
            Silakan pilih layanan yang Anda butuhkan
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
        <!-- Display Antrian Card -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="text-center">
                <div class="bg-blue-100 inline-block p-3 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Display Antrian</h3>
                <p class="text-gray-600 mb-6">Lihat nomor antrian yang sedang dilayani dan nomor berikutnya</p>
                <a href="{{ route('queue.display') }}"
                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 w-full transition duration-150">
                    Lihat Display
                </a>
            </div>
        </div>

        <!-- Ambil Nomor Card -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="text-center">
                <div class="bg-green-100 inline-block p-3 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Ambil Nomor Antrian</h3>
                <p class="text-gray-600 mb-6">Dapatkan nomor antrian Anda untuk layanan yang diinginkan</p>
                <a href="{{ route('queue.patient') }}"
                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 w-full transition duration-150">
                    Ambil Nomor
                </a>
            </div>
        </div>
    </div>

    <!-- Informasi Antrian Terkini -->
    <div class="mt-12 max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-4">Status Antrian Terkini</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach(App\Models\Loket::with(['antrians' => function($q) {
                $q->where('status', 'called')->latest('called_at');
                }])->get() as $loket)
                <div class="p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-medium text-gray-700">{{ $loket->name }}</h4>
                    <p class="text-2xl font-bold text-blue-600 mt-2">
                        {{ $loket->antrians->first()->nomor ?? '-' }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection