@extends('layouts.customer')

@section('content')
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Breadcrumb Navigation -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <i class="fas fa-home mr-2"></i>
                            {{ __('user.Beranda') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400"></i>
                            <a href="{{ route('tourist-destination.index') }}"
                                class="ml-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                                {{ __('user.Destinasi Wisata') }}
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400"></i>
                            <span class="ml-2 text-sm font-medium text-gray-500">
                                {{ $destination->getTranslation('title', app()->getLocale()) }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="relative h-96">
                    <img src="{{ asset('storage/'. $destination->image) }}"
                        alt="{{ $destination->getTranslation('title', app()->getLocale()) }}"
                        class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                        <div class="flex justify-between items-end">
                            <div>
                                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                                    {{ $destination->getTranslation('title', app()->getLocale()) }}
                                </h1>
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center text-white">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        {{ $destination->getTranslation('location', app()->getLocale()) }}
                                    </span>
                                    <span class="flex items-center text-white">
                                        <i class="fas fa-clock mr-2"></i>
                                        {{ $destination->getTranslation('operational_hours', app()->getLocale()) }}
                                    </span>
                                </div>
                            </div>
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $destination->getTranslation('type', app()->getLocale()) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-6">
                    <div class="lg:col-span-2">
                        <div class="flex justify-between items-center mb-6">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $destination->category?->getTranslation('name', app()->getLocale()) }}
                            </span>
                            <div class="flex items-center text-gray-500">
                                <i class="fas fa-eye mr-2"></i>
                                <span>{{ $destination->views_count }} {{ __('user.Lihat') }}</span>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ __('user.Deskripsi') }}</h2>
                            <div class="prose max-w-none text-gray-700">
                                {!! nl2br(e($destination->getTranslation('description', app()->getLocale()))) !!}
                            </div>
                        </div>

                        @if ($destination->facilities && isset($destination->facilities[app()->getLocale()]))
                            <div class="mb-8">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ __('user.Fasilitas') }}</h2>
                                <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach ($destination->facilities[app()->getLocale()] as $facility)
                                        <li class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <span class="text-gray-700">{{ $facility }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-blue-50 rounded-lg p-6 mb-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">{{ __('user.Informasi Kunjungan') }}</h3>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-semibold text-gray-700">{{ __('user.Jam Operasional') }}:</h4>
                                    <p class="text-gray-600">
                                        {{ $destination->getTranslation('operational_hours', app()->getLocale()) }}</p>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-700">{{ __('user.Tipe Wisata') }}:</h4>
                                    <p class="text-gray-600">{{ $destination->getTranslation('type', app()->getLocale()) }}
                                    </p>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-700">{{ __('user.Kategori') }}:</h4>
                                    <p class="text-gray-600">
                                        {{ $destination->category?->getTranslation('name', app()->getLocale()) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">{{ __('user.Bagikan') }}</h3>
                            <div class="flex space-x-3">
                                <a href="#"
                                    class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#"
                                    class="bg-blue-400 text-white p-2 rounded-full hover:bg-blue-500 transition">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#"
                                    class="bg-red-600 text-white p-2 rounded-full hover:bg-red-700 transition">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                                <a href="#"
                                    class="bg-green-500 text-white p-2 rounded-full hover:bg-green-600 transition">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">{{ __('user.Destinasi Terdekat') }}</h3>
                            <div class="space-y-4">
                                @foreach ($nearbyDestinations as $nearby)
                                    <a href="{{ route('tourist-destination.show', $nearby->slug) }}"
                                        class="flex items-center group">
                                        <img src="{{ asset('storage/'. $nearby->image) }}"
                                            alt="{{ $nearby->getTranslation('title', app()->getLocale()) }}"
                                            class="w-16 h-16 object-cover rounded-lg mr-3">
                                        <div>
                                            <h4 class="font-semibold text-gray-800 group-hover:text-blue-600 transition">
                                                {{ $nearby->getTranslation('title', app()->getLocale()) }}
                                            </h4>
                                            <p class="text-sm text-gray-500">
                                                {{ $nearby->getTranslation('location', app()->getLocale()) }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
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
        .prose {
            line-height: 1.75;
        }

        .prose p {
            margin-bottom: 1rem;
        }
    </style>
@endpush
