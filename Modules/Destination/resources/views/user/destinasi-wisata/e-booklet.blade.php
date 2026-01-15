@extends('layouts.customer')

@section('content')
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 max-w-screen-xl">
            <div class="mb-12 text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 font-montserrat">
                    {{ __('E-Booklet Desa Wisata Adat Arjasa') }}
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ __('user.Jelajahi booklet digital kami untuk informasi lengkap tentang paket wisata dan budaya') }}
                </p>
            </div>

            <!-- E-Booklet Viewer -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up">
                <div class="flex justify-between items-center bg-gray-100 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Booklet Desa Wisata Adat Arjasa 2025</h2>
                </div>

                <div class="relative h-[70vh] overflow-hidden bg-gray-200">
                    <iframe
                        src="https://heyzine.com/flip-book/5e2f2a0046.html"
                        style="width:100%; height:100%; border:none;"
                        allowfullscreen="true" scrolling="no">
                    </iframe>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8" data-aos="fade-up">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">{{ __('user.Isi Booklet') }}</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-circle text-blue-500 text-xs"></i>
                            </div>
                            <span class="text-gray-700">{{ __('user.Sejarah Desa Wisata Adat Arjasa') }}</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-circle text-blue-500 text-xs"></i>
                            </div>
                            <span class="text-gray-700">{{ __('user.Peta Sebaran') }}</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-circle text-blue-500 text-xs"></i>
                            </div>
                            <span class="text-gray-700">{{ __('user.Wisata Budaya') }}</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-circle text-blue-500 text-xs"></i>
                            </div>
                            <span class="text-gray-700">{{ __('user.Destinasi Wisata') }}</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-circle text-blue-500 text-xs"></i>
                            </div>
                            <span class="text-gray-700">{{ __('user.Barang yang Dihasilkan') }}</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-circle text-blue-500 text-xs"></i>
                            </div>
                            <span class="text-gray-700">{{ __('user.Paket Wisata') }}</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-circle text-blue-500 text-xs"></i>
                            </div>
                            <span class="text-gray-700">{{ __('user.Penghargaan') }}</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-circle text-blue-500 text-xs"></i>
                            </div>
                            <span class="text-gray-700">{{ __('user.Koleksi Foto') }}</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                <i class="fas fa-circle text-blue-500 text-xs"></i>
                            </div>
                            <span class="text-gray-700">{{ __('user.Orang yang Dapat Dihubungi') }}</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">{{ __('user.Panduan') }}</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-amber-100 p-2 rounded-full mr-3 flex-shrink-0">
                                <i class="fas fa-mobile-alt text-amber-500"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">{{ __('user.Kompatibilitas Perangkat') }}</h4>
                                <p class="text-sm text-gray-600">{{ __('user.Booklet dapat dibuka di smartphone, tablet, dan komputer') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-amber-100 p-2 rounded-full mr-3 flex-shrink-0">
                                <i class="fas fa-question-circle text-amber-500"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">{{ __('user.Bantuan') }}</h4>
                                <p class="text-sm text-gray-600">{{ __('user.Jika booklet tidak terbuka, pastikan perangkat Anda memiliki internet yang lancar') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    iframe {
        min-height: 70vh;
    }
    .booklet-info li {
        transition: all 0.3s ease;
    }
    .booklet-info li:hover {
        transform: translateX(5px);
    }
</style>
@endpush
