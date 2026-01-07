@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="space-y-6">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div
                class="p-6 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg transform transition-all duration-300 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Paket Wisata</p>
                        <p class="mt-1 text-3xl font-bold text-white">{{ $tourPackageCount }}</p>
                        <div class="mt-2 flex items-center text-blue-100 text-sm">
                            <i class="fas fa-chart-line mr-1"></i>
                            <span>{{ $weeklyStats['tour_packages']->sum() }} baru minggu ini</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                        <i class="text-white fas fa-suitcase-rolling text-2xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="p-6 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl shadow-lg transform transition-all duration-300 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Total Destinasi</p>
                        <p class="mt-1 text-3xl font-bold text-white">{{ $destinationCount }}</p>
                        <div class="mt-2 flex items-center text-green-100 text-sm">
                            <i class="fas fa-eye mr-1"></i>
                            <span>{{ $totalViews }} total views</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                        <i class="text-white fas fa-map-marked-alt text-2xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="p-6 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl shadow-lg transform transition-all duration-300 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Galeri Foto</p>
                        <p class="mt-1 text-3xl font-bold text-white">{{ $galleryCount }}</p>
                        <div class="mt-2 flex items-center text-purple-100 text-sm">
                            <i class="fas fa-images mr-1"></i>
                            <span>Koleksi foto destinasi</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                        <i class="text-white fas fa-images text-2xl"></i>
                    </div>
                </div>
            </div>

            <div
                class="p-6 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl shadow-lg transform transition-all duration-300 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-sm font-medium">Total Views</p>
                        <p class="mt-1 text-3xl font-bold text-white">{{ number_format($totalViews) }}</p>
                        <div class="mt-2 flex items-center text-white text-sm">
                            <i class="fas fa-users mr-1"></i>
                            <span>Pengunjung website</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                        <i class="text-white fas fa-chart-bar text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Popular Destinations -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Destinasi Populer</h3>
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            Berdasarkan Views
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @forelse($popularDestinations as $destination)
                            <div
                                class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex items-center space-x-3">
                                    @if($destination->image)
                                        <img src="{{ asset('storage/' . $destination->image) }}"
                                            alt="{{ $destination->getTranslation('title', 'id') }}"
                                            class="w-10 h-10 rounded-lg object-cover">
                                    @else
                                        <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $destination->getTranslation('title', 'id') }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            @if($destination->category)
                                                {{ $destination->category->getTranslation('name', 'id') }}
                                            @else
                                                Uncategorized
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-blue-600">
                                        {{ number_format($destination->views_count) }}
                                    </p>
                                    <p class="text-xs text-gray-500">views</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="fas fa-map-marked-alt text-3xl text-gray-300 mb-2"></i>
                                <p class="text-gray-500">Belum ada data destinasi</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            Real-time
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div id="activities-section">
                        @include('admin.partials.activities', ['recentActivities' => $recentActivities])
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('admin.tour-packages.create') }}"
                        class="flex items-center justify-center p-4 bg-blue-50 rounded-xl border border-blue-200 hover:bg-blue-100 transition-colors duration-200 group">
                        <div class="text-center">
                            <div
                                class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-blue-200 transition-colors duration-200">
                                <i class="fas fa-plus text-blue-600 text-xl"></i>
                            </div>
                            <p class="text-sm font-medium text-blue-700">Tambah Paket</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.destinations.create') }}"
                        class="flex items-center justify-center p-4 bg-green-50 rounded-xl border border-green-200 hover:bg-green-100 transition-colors duration-200 group">
                        <div class="text-center">
                            <div
                                class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-green-200 transition-colors duration-200">
                                <i class="fas fa-map-marker-alt text-green-600 text-xl"></i>
                            </div>
                            <p class="text-sm font-medium text-green-700">Tambah Destinasi</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.galleries.create') }}"
                        class="flex items-center justify-center p-4 bg-purple-50 rounded-xl border border-purple-200 hover:bg-purple-100 transition-colors duration-200 group">
                        <div class="text-center">
                            <div
                                class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-purple-200 transition-colors duration-200">
                                <i class="fas fa-camera text-purple-600 text-xl"></i>
                            </div>
                            <p class="text-sm font-medium text-purple-700">Tambah Foto</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.activities') }}"
                        class="flex items-center justify-center p-4 bg-red-50 rounded-xl border border-orange-200 hover:bg-orange-100 transition-colors duration-200 group">
                        <div class="text-center">
                            <div
                                class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-orange-200 transition-colors duration-200">
                                <i class="fas fa-chart-line text-red-600 text-xl"></i>
                            </div>
                            <p class="text-sm font-medium text-red-700">Lihat Laporan</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    <script>
        setInterval(function () {
            fetch('{{ route("admin.activities.refresh") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('activities-section').innerHTML = data.html;
                })
                .catch(error => {
                    console.error('Error refreshing activities:', error);
                });
        }, 60000);
    </script>
@endsection
