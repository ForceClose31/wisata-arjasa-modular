<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard - Arjasa Cultural</title>

    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @stack('styles')
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-blue-800">
                <div class="flex items-center justify-center h-16 px-4 bg-blue-900">
                    <img src="{{ asset('assets/img/logo.png') }}" class="h-10" alt="Logo">
                    <span class="ml-2 text-xl font-bold text-white">Arjasa Admin</span>
                </div>
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    <nav class="flex-1 space-y-2">
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-900' : 'hover:bg-blue-700' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>

                        <a href="{{ route('admin.destinations.index') }}"
                            class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg group {{ request()->routeIs('admin.destinations.*') ? 'bg-blue-900' : 'hover:bg-blue-700' }}">
                            <i class="fas fa-map-marked-alt mr-3"></i>
                            Destinasi Wisata
                        </a>

                        <a href="{{ route('admin.tour-packages.index') }}"
                            class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg group {{ request()->routeIs('admin.tour-packages.*') ? 'bg-blue-900' : 'hover:bg-blue-700' }}">
                            <i class="fas fa-suitcase-rolling mr-3"></i>
                            Paket Wisata
                        </a>

                        <a href="{{ route('admin.galleries.index') }}"
                            class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg group {{ request()->routeIs('admin.galleries.*') ? 'bg-blue-900' : 'hover:bg-blue-700' }}">
                            <i class="fas fa-images mr-3"></i>
                            Galeri
                        </a>

                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 rounded-lg group">
                            <i class="fas fa-users-cog mr-3"></i>
                            Pengguna
                        </a>
                    </nav>
                </div>
                <div class="p-4 border-t border-blue-700">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 rounded-lg">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <button class="md:hidden text-gray-500 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="ml-4 text-lg font-semibold text-gray-800">@yield('title')</h1>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <button class="flex items-center text-gray-500 focus:outline-none">
                            <i class="fas fa-bell"></i>
                        </button>
                    </div>
                    <div class="ml-4">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container px-6 py-8 mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <div class="fixed inset-0 z-40 md:hidden" style="display: none;">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
        <div class="fixed inset-y-0 left-0 flex max-w-xs w-full">
            <div class="flex flex-col w-64 bg-blue-800">
                <div class="flex items-center justify-center h-16 px-4 bg-blue-900">
                    <img src="{{ asset('assets/img/logo.png') }}" class="h-10" alt="Logo">
                    <span class="ml-2 text-xl font-bold text-white">Arjasa Admin</span>
                </div>
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    <nav class="flex-1 space-y-2">
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-900 rounded-lg group">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>

                        <a href="{{ route('admin.destinations.index') }}"
                            class="flex items-center px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 rounded-lg group">
                            <i class="fas fa-map-marked-alt mr-3"></i>
                            Destinasi Wisata
                        </a>

                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 rounded-lg group">
                            <i class="fas fa-suitcase-rolling mr-3"></i>
                            Paket Wisata
                        </a>

                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 rounded-lg group">
                            <i class="fas fa-images mr-3"></i>
                            Galeri
                        </a>
                    </nav>
                </div>
                <div class="p-4 border-t border-blue-700">
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 rounded-lg">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.md\\:hidden button');
            const mobileMenu = document.querySelector('.fixed.inset-0.z-40');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.style.display = mobileMenu.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>

</html>
