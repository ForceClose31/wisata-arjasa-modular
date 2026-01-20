@extends('layouts.customer')

@section('content')
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

        <button @click="prevSlide"
            class="absolute left-4 top-1/2 z-30 -translate-y-1/2 bg-white/30 text-white p-3 rounded-full hover:bg-white/50 transition backdrop-blur-sm">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button @click="nextSlide"
            class="absolute right-4 top-1/2 z-30 -translate-y-1/2 bg-white/30 text-white p-3 rounded-full hover:bg-white/50 transition backdrop-blur-sm">
            <i class="fas fa-chevron-right"></i>
        </button>

        <div class="absolute bottom-8 left-1/2 z-30 -translate-x-1/2 flex space-x-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="currentSlide = index" class="w-3 h-3 rounded-full transition duration-300"
                    :class="{ 'bg-white w-6': currentSlide === index, 'bg-white/50': currentSlide !== index }"></button>
            </template>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-screen-xl">
            <div class="mb-12 text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-2 font-montserrat">
                    {{ __('user.Paket Tour') }}
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ __('user.Desa Wisata Adat Arjasa menawarkan 5 paket tour yaitu') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($featuredPackages as $index => $package)
                    <div data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}"
                        class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 flex flex-col">

                        <!-- Image Container dengan aspect ratio natural tanpa crop -->
                        <div class="relative overflow-hidden flex-shrink-0">
                            @if (isset($package->images) && count($package->images) > 0)
                                <img src="/storage/{{ $package->images[0] }}" alt="{{ $package->name }}"
                                    class="w-full h-auto transition-transform duration-700 group-hover:scale-105">
                            @else
                                <img src="https://source.unsplash.com/random/600x400?indonesia,tour"
                                    alt="{{ $package->name }}"
                                    class="w-full h-auto transition-transform duration-700 group-hover:scale-105">
                            @endif

                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                            </div>

                            <!-- Badges -->
                            <div class="absolute top-4 right-4 flex flex-col space-y-2">
                                <span class="bg-white/95 text-gray-800 text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg backdrop-blur-sm">
                                    {{ $package->duration }}
                                </span>
                                <span class="bg-blue-500/95 text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg backdrop-blur-sm">
                                    {{ $package->packageType->name }}
                                </span>
                            </div>

                            <!-- Title Overlay -->
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-white font-bold text-lg leading-tight drop-shadow-lg">
                                    {{ $package->name }}
                                </h3>
                            </div>
                        </div>

                        <!-- Content dengan flex-grow untuk membuat tinggi card sama -->
                        <div class="p-6 flex flex-col flex-grow">
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ $package->short_description ?? $package->description }}
                            </p>

                            <div class="mb-4">
                                <h4 class="text-sm font-semibold text-gray-500 mb-2 flex items-center">
                                    <i class="fas fa-sparkles text-amber-400 mr-2"></i> {{ __('user.Highlights') }}
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach (array_slice($package->highlights ?? [], 0, 3) as $highlight)
                                        <span class="bg-amber-50 text-amber-800 text-xs px-3 py-1 rounded-full border border-amber-100">
                                            {{ $highlight }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Spacer untuk mendorong price dan button ke bawah -->
                            <div class="flex-grow"></div>

                            <div class="mb-6">
                                <h4 class="font-bold text-gray-800 mb-2 flex items-center">
                                    <i class="fas fa-tag text-blue-500 mr-2"></i> {{ __('user.Harga Mulai Dari') }}
                                </h4>
                                <div class="text-2xl font-bold text-blue-600">
                                    Rp {{ number_format($package->pricings->sortBy('price')->first()->price ?? 0, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="text-center mt-auto">
                                @if ($package->pdf_url)
                                    <a href="/storage/{{ $package->pdf_url }}" target="_blank"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        {{ __('user.Detail Paket') }} (PDF)
                                        <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                                    </a>
                                @else
                                    <span class="text-gray-500 text-sm">Detail paket tidak tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10" data-aos="fade-up">
                        <div class="bg-white p-8 rounded-xl shadow-md max-w-md mx-auto">
                            <i class="fas fa-compass text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-medium text-gray-700">{{ __('user.Belum ada paket tersedia') }}</h3>
                            <p class="text-gray-500 mt-2">
                                {{ __('user.Kami sedang mempersiapkan paket wisata terbaik untuk Anda.') }}</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-12" data-aos="fade-up">
                {{ $featuredPackages->links() }}
            </div>

            @if(isset($showcaseGalleries) && $showcaseGalleries->count() > 0)
                <div class="mt-20" data-aos="fade-up">
                    <div class="text-center mb-10">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 font-montserrat">
                            {{ __('user.Galeri Wisata') }}
                        </h2>
                        <p class="text-gray-600">
                            {{ __('user.Lihat momen-momen indah dari pengalaman wisatawan') }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($showcaseGalleries as $gallery)
                            <div class="relative group overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                                <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                     alt="{{ $gallery->title }}"
                                     class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-4 left-4 right-4">
                                        <h3 class="text-white font-bold text-sm line-clamp-2">
                                            {{ $gallery->title }}
                                        </h3>
                                        @if($gallery->galleryCategory)
                                            <span class="inline-block mt-2 px-2 py-1 bg-blue-500 text-white text-xs rounded-full">
                                                {{ $gallery->galleryCategory->name }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-8">
                        <a href="{{ route('gallery.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            {{ __('user.Lihat Semua Galeri') }}
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
