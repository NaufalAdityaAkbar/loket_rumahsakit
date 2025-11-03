<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Auth - RS')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .notification {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
    :class="darkMode ? 'bg-gray-900' : 'bg-gradient-to-br from-blue-50 via-white to-blue-100'"
    class="min-h-screen flex items-center justify-center p-4" 
    x-init="
        $watch('darkMode', val => {
            localStorage.setItem('darkMode', val);
        });
        if (localStorage.getItem('darkMode') === null) {
            darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        }
    ">

    <div class="w-full max-w-6xl">
        <!-- Header -->
        <div class="text-center mb-8 fade-in">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4"
                :class="darkMode ? 'bg-blue-900' : 'bg-gradient-to-br from-blue-600 to-blue-700'">
                <i class="fas fa-hospital-alt text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold mb-2" :class="darkMode ? 'text-white' : 'text-gray-800'">
                Rumah Sakit
            </h1>
            <p class="text-sm" :class="darkMode ? 'text-gray-400' : 'text-gray-600'">
                Sistem Manajemen Antrian Digital
            </p>
        </div>

        <!-- Main Card -->
        <div class="rounded-2xl shadow-xl overflow-hidden fade-in" style="animation-delay: 0.2s">
            <div class="grid grid-cols-1 lg:grid-cols-5">
                
                <!-- Left Sidebar -->
                <div class="lg:col-span-2 p-8 lg:p-12 relative overflow-hidden"
                    :class="darkMode ? 'bg-gradient-to-br from-blue-900 to-blue-800' : 'bg-gradient-to-br from-blue-600 to-blue-700'">
                    
                    <!-- Content -->
                    <div class="relative z-10">
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-white mb-3">Selamat Datang</h2>
                            <p class="text-blue-100 leading-relaxed">
                                Sistem manajemen antrian untuk pelayanan yang lebih efisien dan terorganisir.
                            </p>
                        </div>

                        <!-- Features -->
                        <div class="space-y-4 mb-8">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-white">Efisien</div>
                                    <div class="text-sm text-blue-100">Hemat waktu tunggu pasien</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-chart-line text-white"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-white">Terorganisir</div>
                                    <div class="text-sm text-blue-100">Manajemen antrian yang rapi</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-shield-alt text-white"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-white">Aman</div>
                                    <div class="text-sm text-blue-100">Data terlindungi dengan baik</div>
                                </div>
                            </div>
                        </div>

                        <!-- Illustration -->
                        <div class="hidden lg:block">
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                                <div class="flex items-center justify-center h-32">
                                    <i class="fas fa-user-md text-white text-6xl opacity-40"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-10 left-10 w-20 h-20 rounded-full bg-white"></div>
                        <div class="absolute bottom-20 right-10 w-32 h-32 rounded-full bg-white"></div>
                        <div class="absolute top-1/2 left-1/4 w-24 h-24 rounded-full bg-white"></div>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="lg:col-span-3 p-8 lg:p-12" :class="darkMode ? 'bg-gray-800' : 'bg-white'">
                    
                    <!-- Dark Mode Toggle -->
                    <div class="flex justify-end mb-6">
                        <button @click="darkMode = !darkMode" 
                            class="p-2.5 rounded-lg transition-colors duration-200"
                            :class="darkMode ? 'bg-gray-700 text-yellow-400 hover:bg-gray-600' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'">
                            <i :class="darkMode ? 'fas fa-sun' : 'fas fa-moon'"></i>
                        </button>
                    </div>

                    <!-- Content Area -->
                    <div class="max-w-md mx-auto">
                        @yield('content')
                    </div>

                    <!-- Footer -->
                    <div class="mt-12 text-center">
                        <p class="text-sm" :class="darkMode ? 'text-gray-500' : 'text-gray-500'">
                            &copy; {{ date('Y') }} Rumah Sakit. Semua hak dilindungi.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Notifications -->
    <div id="notification-area" class="fixed bottom-4 right-4 z-50 space-y-3">
        @if(session('error'))
        <div class="notification bg-red-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 max-w-md">
            <i class="fas fa-exclamation-circle text-xl"></i>
            <span class="flex-1">{{ session('error') }}</span>
            <button class="hover:bg-red-600 p-1 rounded" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        @if(session('success'))
        <div class="notification bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 max-w-md">
            <i class="fas fa-check-circle text-xl"></i>
            <span class="flex-1">{{ session('success') }}</span>
            <button class="hover:bg-green-600 p-1 rounded" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        @if(session('warning'))
        <div class="notification bg-yellow-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 max-w-md">
            <i class="fas fa-exclamation-triangle text-xl"></i>
            <span class="flex-1">{{ session('warning') }}</span>
            <button class="hover:bg-yellow-600 p-1 rounded" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        @if(session('info'))
        <div class="notification bg-blue-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 max-w-md">
            <i class="fas fa-info-circle text-xl"></i>
            <span class="flex-1">{{ session('info') }}</span>
            <button class="hover:bg-blue-600 p-1 rounded" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif
    </div>

    <script>
        // Auto-dismiss notifications
        document.addEventListener('DOMContentLoaded', () => {
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => notification.remove(), 300);
                }, 5000);
            });
        });
    </script>
</body>

</html>
