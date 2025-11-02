@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Selamat Datang, {{ auth()->user()->name }}</h1>
        <div class="flex items-center space-x-4">
            <img src="{{ auth()->user()->avatar }}" alt="Profile" class="w-10 h-10 rounded-full">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <!-- Card Menuju Display Antrian -->
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center justify-center hover:shadow-lg transition-shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7" />
            </svg>
            <h3 class="text-xl font-semibold mb-2">Display Antrian</h3>
            <p class="text-gray-600 text-center mb-4">Lihat status antrian yang sedang berjalan</p>
            <a href="{{ route('user.display') }}" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition-colors">
                Lihat Display
            </a>
        </div>

        <!-- Card Ambil Nomor Antrian -->
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center justify-center hover:shadow-lg transition-shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
            </svg>
            <h3 class="text-xl font-semibold mb-2">Ambil Nomor Antrian</h3>
            <p class="text-gray-600 text-center mb-4">Ambil nomor antrian baru</p>
            <a href="{{ route('user.patient') }}" class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition-colors">
                Ambil Nomor
            </a>
        </div>
    </div>

    <!-- Riwayat Antrian User -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold mb-4">Riwayat Antrian Anda</h2>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loket</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach(App\Models\Antrian::where('patient_name', auth()->user()->name)
                                             ->orderBy('created_at', 'desc')
                                             ->take(5)
                                             ->get() as $antrian)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $antrian->nomor }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $antrian->loket->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($antrian->status == 'waiting')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu
                                </span>
                            @elseif($antrian->status == 'called')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Dipanggil
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Selesai
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $antrian->created_at->format('d M Y H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection