@extends('layouts.customer')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-8 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden border border-blue-200">
            <div class="flex flex-col lg:flex-row h-full">
                <div
                    class="lg:w-1/2 bg-gradient-to-br from-blue-500 to-indigo-600 p-8 md:p-12 flex flex-col justify-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10">
                        <div class="absolute -top-24 -right-24 w-64 h-64 rounded-full bg-white"></div>
                        <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-white"></div>
                    </div>

                    <div class="relative z-10 text-center">
                        <img src="{{ asset('assets/img/logo.png') }}"
                            class="max-w-[180px] mx-auto mb-6 drop-shadow-lg hover:scale-105 transition-transform duration-300"
                            alt="Logo">
                        <h2 class="text-white text-2xl font-bold mb-4">Selamat Datang Kembali</h2>
                        <p class="text-blue-100 text-lg">Eksplorasi seluruh kekayaan budaya Arjasa dengan akun Anda</p>
                    </div>

                    <div class="absolute bottom-0 left-0 w-full h-2 bg-gradient-to-r from-blue-400 to-indigo-500"></div>
                </div>

                <div class="lg:w-1/2 p-8 md:p-10 flex flex-col justify-center">
                    <div class="text-center mb-8">
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">Masuk ke Akun Anda</h1>
                        <p class="text-gray-600">Silakan masuk untuk melanjutkan</p>
                    </div>

                    <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-gray-700 mb-2 font-medium">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-blue-500"></i>
                                </div>
                                <input type="email" name="email" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Masukkan email Anda" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-gray-700 mb-2 font-medium">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-blue-500"></i>
                                </div>
                                <input type="password" name="password" id="password" required
                                    class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Masukkan password Anda">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" onclick="togglePassword()"
                                        class="text-gray-500 hover:text-blue-500 focus:outline-none">
                                        <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember" name="remember"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center shadow-md hover:shadow-lg">
                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-gray-600 hover:text-blue-600 transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Valid',
                html: `Harap periksa kembali data yang Anda masukkan`,
                confirmButtonColor: '#3B82F6',
                background: '#ffffff',
                color: '#1F2937'
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#3B82F6',
                background: '#ffffff',
                color: '#1F2937'
            });
        @elseif (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3B82F6',
                background: '#ffffff',
                color: '#1F2937'
            });
        @endif

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        }
    </script>
@endsection
