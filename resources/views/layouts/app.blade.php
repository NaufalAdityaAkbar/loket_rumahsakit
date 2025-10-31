<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Antrian')</title>
    <!-- Tailwind / Bootstrap / custom CSS boleh ditambahkan di sini -->
    <link rel="stylesheet" href="/css/app.css">
    <!-- Livewire styles (jika pakai Livewire) -->
    @if (class_exists(\Livewire\Livewire::class))
    @livewireStyles
    @endif
</head>

<body>
    <div id="app" class="min-h-screen flex flex-col">
        <header class="bg-blue-700 text-white p-4">
            <div class="container mx-auto flex items-center justify-between">
                <h1 class="text-lg font-semibold">Sistem Antrian</h1>
                <nav>
                    <a href="/" class="mr-4">Home</a>
                    <a href="{{ route('patient') }}" class="mr-4">Patient</a>
                    <a href="{{ route('petugas') }}" class="mr-4">Petugas</a>
                    <a href="{{ route('display') }}">Display</a>
                </nav>
            </div>
        </header>

        <main class="flex-1 container mx-auto p-6">
            @yield('content')
        </main>

        <footer class="bg-gray-100 text-center p-4">
            <small>© {{ date('Y') }} Rumah Sakit - Skeleton</small>
        </footer>
    </div>

    <script src="/js/app.js"></script>
    @if (class_exists(\Livewire\Livewire::class))
    @livewireScripts
    @endif
</body>

</html>