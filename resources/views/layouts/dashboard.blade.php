<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Antrian') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        /* minor overrides for dashboard look */
        .sidebar-link.active { background-color: rgba(255,255,255,0.06); }
    </style>
</head>
<body class="min-h-screen bg-gray-100 font-sans">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-700 text-white min-h-screen">
            <div class="px-6 py-5 flex items-center gap-3 border-b border-blue-600">
                <div class="w-10 h-10 bg-white/20 rounded flex items-center justify-center font-bold">RS</div>
                <div>
                    <div class="text-sm font-semibold">Rumah Sakit</div>
                    <div class="text-xs opacity-90">Sistem Antrian</div>
                </div>
            </div>

            <nav class="px-3 py-6">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('petugas.dashboard') }}" class="sidebar-link flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10 2a2 2 0 00-2 2v2H6a2 2 0 00-2 2v4h12V8a2 2 0 00-2-2h-2V4a2 2 0 00-2-2z"/></svg>
                            <span class="text-sm">Petugas (Queue)</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('petugas.loket') }}" class="sidebar-link flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('petugas.loket') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3h12v2H4V3z"/></svg>
                            <span class="text-sm">Master Data Loket</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Profile and Logout -->
            <div class="mt-auto border-t border-blue-600">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <div class="text-sm font-medium">{{ Auth::user()->name ?? 'User' }}</div>
                            <div class="text-xs text-blue-200">{{ Auth::user()->email ?? '' }}</div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-sm text-white bg-blue-600 hover:bg-blue-500 rounded transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="px-4 py-3 text-xs text-blue-200">
                &copy; {{ date('Y') }} Rumah Sakit
            </div>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-8">
            <div class="max-w-6xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
