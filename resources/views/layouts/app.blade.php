<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Antrian')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-blue-50">
    <div id="app" class="min-h-screen flex flex-col">
        <!-- Modern Header -->
        <header class="bg-white border-b border-blue-100 shadow-sm">
            <div class="container mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold text-gray-800">Sistem Antrian</h1>
                    </div>
                    <nav class="flex gap-2">
                        <a href="{{ route('patient') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                            Patient
                        </a>
                        <a href="{{ route('display') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                            Display
                        </a>
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-1 container mx-auto px-6 py-8">
            @yield('content')
        </main>

        <!-- Modern Footer -->
        <footer class="bg-white border-t border-blue-100 py-4">
            <div class="container mx-auto px-6 text-center text-sm text-gray-500">
                © {{ date('Y') }} Rumah Sakit - Sistem Antrian Digital
            </div>
        </footer>
    </div>

    @livewireScripts
</body>

</html>