<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Auth - RS')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js untuk interaktivitas -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Animate.css untuk animasi -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
    /* Animasi sederhana untuk form */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-animate {
        animation: fadeIn 0.5s ease-out forwards;
    }

    .form-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        transition: all 0.3s ease;
    }

    .btn-animate {
        transition: all 0.3s ease;
    }

    .btn-animate:hover {
        transform: translateY(-2px);
    }

    .notification {
        transition: opacity 0.3s ease;
    }
    </style>
</head>

<body x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
    :class="darkMode ? 'bg-gray-900' : 'bg-gradient-to-br from-blue-50 to-indigo-100'"
    class="min-h-screen flex items-center justify-center p-4" x-init="
        $watch('darkMode', val => {
            localStorage.setItem('darkMode', val);
            document.documentElement.classList.toggle('dark', val);
        });
        
        // Sync dark mode with system preference if not set
        if (localStorage.getItem('darkMode') === null) {
            darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        }
      ">

    <div class="w-full max-w-4xl">
        <div class="text-center mb-4">
            <h1 class="text-2xl font-bold" :class="darkMode ? 'text-white' : 'text-blue-800'">
                <i class="fas fa-hospital-alt mr-2"></i>Rumah Sakit
            </h1>
            <p class="text-sm mt-1" :class="darkMode ? 'text-gray-300' : 'text-gray-600'">Sistem Manajemen Antrian</p>
        </div>

        <div class="rounded-lg shadow-md overflow-hidden" :class="darkMode ? 'bg-gray-800' : 'bg-white'">
            <div class="flex flex-col md:flex-row">
                <!-- Sidebar Kiri - Logo/Info -->
                <div class="p-6 md:w-2/5 relative" :class="darkMode ? 'bg-blue-800' : 'bg-blue-600'">
                    <div class="relative">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-hospital-alt text-white text-2xl mr-2"></i>
                            <h1 class="text-xl font-bold text-white">Rumah Sakit</h1>
                        </div>

                        <div class="mb-6">
                            <h2 class="text-lg font-medium text-white mb-2">Selamat Datang</h2>
                            <p class="text-blue-100 text-sm">Sistem manajemen antrian untuk pelayanan yang lebih
                                efisien.</p>
                        </div>

                        <div class="mb-6 flex justify-center">
                            <img src="/images/doctor.jpg" alt="Doctor" class="w-full max-w-xs rounded-md shadow-md">
                        </div>

                        <div class="border-t border-blue-400 pt-4 mt-4">
                            <p class="text-sm text-blue-100">
                                @if(Route::currentRouteName() === 'petugas.login')
                                Belum punya akun?
                                <a href="{{ route('petugas.register') }}"
                                    class="text-white hover:underline font-bold transition-all hover:text-blue-200">
                                    Register <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                                @else
                                Sudah punya akun?
                                <a href="{{ route('login') }}"
                                    class="text-white hover:underline font-bold transition-all hover:text-blue-200">
                                    Login <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Background Pattern -->
                    <div class="absolute top-0 left-0 w-full h-full opacity-10">
                        <div class="absolute top-10 left-10 w-20 h-20 rounded-full bg-white"></div>
                        <div class="absolute bottom-10 right-10 w-40 h-40 rounded-full bg-white"></div>
                        <div class="absolute top-1/2 left-1/4 w-30 h-30 rounded-full bg-white"></div>
                    </div>
                </div>

                <!-- Content Kanan - Form -->
                <div class="p-8 md:w-3/5" :class="darkMode ? 'bg-gray-800 text-white' : 'bg-white'">
                    <div class="flex justify-end mb-4">
                        <button @click="darkMode = !darkMode" class="p-2 rounded-full"
                            :class="darkMode ? 'bg-gray-700 text-yellow-300' : 'bg-gray-200 text-gray-700'">
                            <i :class="darkMode ? 'fas fa-sun' : 'fas fa-moon'"></i>
                        </button>
                    </div>

                    <div class="animate__animated animate__fadeIn">
                        @yield('content')
                    </div>

                    <div class="mt-8 text-center">
                        <p class="text-sm" :class="darkMode ? 'text-gray-400' : 'text-gray-500'">
                            &copy; {{ date('Y') }} Rumah Sakit. Semua hak dilindungi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    <div id="notification-area" class="fixed bottom-4 right-4 z-50">
        @if(session('error'))
        <div class="notification bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg mb-3 flex items-center"
            role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span>{{ session('error') }}</span>
            <button class="ml-auto focus:outline-none" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        @if(session('success'))
        <div class="notification bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg mb-3 flex items-center"
            role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            <span>{{ session('success') }}</span>
            <button class="ml-auto focus:outline-none" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        @if(session('warning'))
        <div class="notification bg-yellow-500 text-white px-6 py-3 rounded-lg shadow-lg mb-3 flex items-center"
            role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <span>{{ session('warning') }}</span>
            <button class="ml-auto focus:outline-none" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        @if(session('info'))
        <div class="notification bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg mb-3 flex items-center"
            role="alert">
            <i class="fas fa-info-circle mr-2"></i>
            <span>{{ session('info') }}</span>
            <button class="ml-auto focus:outline-none" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif
    </div>

    <script>
    // Auto-dismiss notifications after 5 seconds
    document.addEventListener('DOMContentLoaded', () => {
        const notifications = document.querySelectorAll('.notification');
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 5000);
        });

        // Add animation to form inputs
        const formInputs = document.querySelectorAll('input, select, textarea');
        formInputs.forEach((input, index) => {
            input.classList.add('form-input', 'transition-all', 'duration-300');
            input.style.animationDelay = `${index * 0.1}s`;
        });

        // Add animation to buttons
        const buttons = document.querySelectorAll('button[type="submit"]');
        buttons.forEach(button => {
            button.classList.add('auth-button');
        });
    });
    </script>
</body>

</html>