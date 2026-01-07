@extends('layouts.customer')

@section('content')
    <!-- AlpineJS Component untuk Gallery -->
    <div x-data="galleryApp()" @keydown.escape="closeModal">
        <!-- Hero Slider Section -->
        <section class="relative h-screen max-h-[500px] overflow-hidden bg-gradient-to-br from-teal-600 to-indigo-700">
            <div class="absolute inset-0 bg-black/20 z-10"></div>
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentSlide === index" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full">
                    <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover">
                </div>
            </template>

            <div class="relative z-20 h-full flex items-center">
                <div class="container mx-auto px-4 text-white">
                    <div class="max-w-2xl">
                        <h1 x-text="slides[currentSlide].title"
                            class="text-xl md:text-4xl font-bold mb-4 font-montserrat animate-fade-in"></h1>
                        <p x-text="slides[currentSlide].subtitle"
                            class="text-sm md:text-xl mb-8 text-gray-100 animate-fade-in animate-delay-100"></p>
                    </div>
                </div>
            </div>

            <!-- Slider Controls -->
            <button @click="prevSlide"
                class="absolute left-4 top-1/2 z-30 -translate-y-1/2 bg-white/30 text-white p-3 rounded-full hover:bg-white/50 transition backdrop-blur-sm">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button @click="nextSlide"
                class="absolute right-4 top-1/2 z-30 -translate-y-1/2 bg-white/30 text-white p-3 rounded-full hover:bg-white/50 transition backdrop-blur-sm">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Slider Indicators -->
            <div class="absolute bottom-8 left-1/2 z-30 -translate-x-1/2 flex space-x-2">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="currentSlide = index" class="w-3 h-3 rounded-full transition duration-300"
                        :class="{ 'bg-white w-6': currentSlide === index, 'bg-white/50': currentSlide !== index }"></button>
                </template>
            </div>
        </section>

        <section class="py-20 bg-white">
            <div class="container mx-auto px-4 max-w-screen-xl">
                <div class="mb-10 text-center" data-aos="fade-up" data-aos-duration="1000">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-2 font-montserrat relative inline-block">
                        Gallery
                        <span class="absolute bottom-0 left-0 w-full h-2 bg-blue-400 opacity-70 -z-1"></span>
                    </h2>
                    <p class="text-lg text-gray-700">{{ __('user.Temukan keindahan setiap sudut Arjasa dalam galeri foto kami.') }}</p>
                </div>

                <!-- Improved Category Filter -->
                <div class="mb-8 flex flex-wrap justify-center gap-3" id="category-filters">
                    <button data-category=""
                        class="filter-btn px-5 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ !request()->has('category') ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ __('user.Semua Kategori') }}
                    </button>
                    @foreach ($categories as $category)
                        <button data-category="{{ $category->slug }}"
                            class="filter-btn px-5 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ request('category') == $category->slug ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>

                <!-- Loading indicator -->
                <div id="loading" class="hidden text-center py-8">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                    <p class="mt-2 text-gray-600">Memuat galeri...</p>
                </div>

                <!-- Gallery Grid -->
                <div id="gallery-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                    @include('user.gallery.partials.gallery-grid', ['galleries' => $galleries])
                </div>

                <!-- Empty state -->
                <div id="empty-state" class="hidden text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-images text-4xl"></i>
                    </div>
                    <p class="text-gray-600">Tidak ada foto yang ditemukan untuk kategori ini.</p>
                </div>
            </div>
        </section>

        <!-- Enhanced Modal Popup -->
        <div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-90" @click.self="closeModal">
            <div class="relative bg-white rounded-xl max-w-6xl w-full max-h-[90vh] overflow-hidden shadow-2xl">
                <!-- Close Button -->
                <button @click="closeModal"
                    class="absolute top-4 right-4 z-10 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                <!-- Modal Content -->
                <div class="flex flex-col md:flex-row h-full">
                    <!-- Image Section -->
                    <div class="md:w-2/3 bg-gray-100 flex items-center justify-center p-4">
                        <img x-bind:src="currentImage" x-bind:alt="currentTitle"
                            class="w-full h-auto max-h-[80vh] object-contain rounded-lg">
                    </div>

                    <!-- Info Section -->
                    <div class="md:w-1/3 p-6 overflow-y-auto">
                        <div x-show="currentCategory" class="mb-4">
                            <span class="inline-block px-3 py-1 text-xs font-bold bg-blue-500 text-white rounded-full">
                                <span x-text="currentCategory"></span>
                            </span>
                        </div>

                        <h3 x-text="currentTitle" class="text-2xl font-bold text-gray-800 mb-3"></h3>

                        <div x-show="currentLocation" class="flex items-center mb-4 text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                            <span x-text="currentLocation" class="text-sm"></span>
                        </div>

                        <div class="prose prose-sm text-gray-600 mb-6">
                            <p x-text="currentDescription"></p>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <button @click="closeModal"
                                class="w-full py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function galleryApp() {
            return {
                isOpen: false,
                currentTitle: '',
                currentImage: '',
                currentDescription: '',
                currentLocation: '',
                currentCategory: '',

                openModal(title, image, description, location, category) {
                    this.currentTitle = title;
                    this.currentImage = image;
                    this.currentDescription = description;
                    this.currentLocation = location;
                    this.currentCategory = category;
                    this.isOpen = true;
                    document.body.classList.add('overflow-hidden');
                },

                closeModal() {
                    this.isOpen = false;
                    document.body.classList.remove('overflow-hidden');
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const galleryGrid = document.getElementById('gallery-grid');
            const loading = document.getElementById('loading');
            const emptyState = document.getElementById('empty-state');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');

                    filterButtons.forEach(btn => {
                        btn.classList.remove('bg-blue-600', 'text-white', 'shadow-md');
                        btn.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                    });

                    this.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                    this.classList.add('bg-blue-600', 'text-white', 'shadow-md');

                    loading.classList.remove('hidden');
                    galleryGrid.classList.add('opacity-50');
                    emptyState.classList.add('hidden');

                    fetch(`{{ route('gallery.index') }}?category=${category}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        loading.classList.add('hidden');
                        galleryGrid.classList.remove('opacity-50');

                        galleryGrid.innerHTML = data.html;

                        if (data.galleries.length === 0) {
                            emptyState.classList.remove('hidden');
                        }

                        if (typeof AOS !== 'undefined') {
                            AOS.refresh();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        loading.classList.add('hidden');
                        galleryGrid.classList.remove('opacity-50');

                        galleryGrid.innerHTML = `
                            <div class="col-span-full text-center py-12">
                                <div class="text-red-500 mb-4">
                                    <i class="fas fa-exclamation-triangle text-4xl"></i>
                                </div>
                                <p class="text-red-600">Terjadi kesalahan saat memuat galeri. Silakan coba lagi.</p>
                            </div>
                        `;
                    });
                });
            });
        });
    </script>
@endpush
