<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Petugas')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @livewireStyles
</head>

<body class="min-h-screen bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-800 text-white">
            <div class="p-4">
                <h1 class="text-xl font-bold">Sistem Antrian</h1>
            </div>
            <nav class="mt-4">
                <a href="{{ route('petugas.dashboard') }}" class="block px-4 py-2 hover:bg-blue-700 {{ request()->routeIs('petugas.dashboard') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                @if(auth()->user()->assignedLoket)
                <a href="{{ route('petugas.loket', auth()->user()->assigned_loket_id) }}" class="block px-4 py-2 hover:bg-blue-700 {{ request()->routeIs('petugas.loket') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-door-open mr-2"></i> Loket Saya
                </a>
                @endif
                <a href="{{ route('petugas.master.loket') }}" class="block px-4 py-2 hover:bg-blue-700 {{ request()->routeIs('petugas.master.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-cog mr-2"></i> Master Data
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                    <div class="flex items-center">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2">
                                <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.auth()->user()->name }}" 
                                     alt="Profile" 
                                     class="w-8 h-8 rounded-full">
                                <span class="text-gray-700">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-gray-500"></i>
                            </button>
                            <div x-show="open" 
                                 @click.away="open = false"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>