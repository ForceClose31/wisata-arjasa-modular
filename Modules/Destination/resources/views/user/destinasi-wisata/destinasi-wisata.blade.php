@extends('layouts.customer')

@section('content')
    {{-- Bagian Banner Atas --}}
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

    <section class="py-10 bg-gray-50">
        <div class="container mx-auto px-4 max-w-screen-xl">
            <div class="mb-10 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-5 font-montserrat relative inline-block">
                    {{ __('user.Destinasi Wisata') }}
                    <span class="absolute bottom-0 left-0 w-full h-2 bg-blue-400 opacity-70 -z-1"></span>
                </h2>
                <p class="text-lg text-gray-700" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    {{ __('user.Desa Wisata Adat Arjasa menawarkan 8 destinasi wisata bagi pengunjung, yaitu Wisata Citra Mandiri Waterpark, Situs Calok, Punden Berundak, Kampung Wisata Kesseh Gumitir, Gallery Lukis Bakar, Sendang Tirta Amertha Rajasa, Sanggar Seni Desa Arjasa, Event Hyang Argopuro Festival.') }}
                </p>
            </div>

            <div id="destination-categories" class="flex flex-wrap justify-center gap-4 mb-16">
                <button
                    class="category-btn bg-blue-500 text-white px-5 py-3 rounded-full font-semibold text-sm hover:hover:bg-gray-100 transition duration-300 shadow-md"
                    data-category="all">
                    {{ __('user.Semua Destinasi') }}
                </button>

                @foreach ($categories as $category)
                    <button
                        class="category-btn bg-white text-gray-800 px-5 py-3 rounded-full font-semibold text-sm border border-gray-300 hover:bg-gray-100 transition duration-300 shadow-md"
                        data-category="{{ $category->getTranslation('name', app()->getLocale()) }}">
                        {{ $category->getTranslation('name', app()->getLocale()) }}
                    </button>
                @endforeach
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($destinations as $destination)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group transform transition-transform duration-300 hover:-translate-y-2 hover:shadow-2xl destination-card"
                        data-aos="fade-up" data-aos-delay="{{ 800 + $loop->index * 100 }}" data-aos-duration="1000"
                        data-category="{{ $destination->category?->getTranslation('name', app()->getLocale()) }}">

                        <div class="relative">
                            <img src="storage/{{ $destination->image }}"
                                alt="{{ $destination->getTranslation('title', app()->getLocale()) }}"
                                class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                <h3 class="text-xl font-bold text-white">
                                    {{ $destination->getTranslation('title', app()->getLocale()) }}
                                </h3>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <span class="text-sm text-gray-600 mr-3">
                                    <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                    {{ $destination->getTranslation('location', app()->getLocale()) }}
                                </span>
                                <span class="text-sm text-gray-600">
                                    <i class="fas fa-clock text-gray-400 mr-2"></i>
                                    {{ $destination->getTranslation('operational_hours', app()->getLocale()) }}
                                </span>
                            </div>

                            <p class="text-gray-700 text-sm mb-4">
                                {{ Str::limit($destination->getTranslation('description', app()->getLocale()), 150) }}
                            </p>

                            <div class="flex justify-between items-center mt-4">
                                <a href="{{ route('tourist-destination.show', $destination->slug) }}"
                                    class="bg-blue-400 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-500 transition duration-300 shadow-md transform hover:-translate-y-1">
                                    {{ __('user.LIHAT DETAIL') }}
                                </a>

                                <span class="text-sm font-semibold bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                                    {{ $destination->getTranslation('type', app()->getLocale()) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryButtons = document.querySelectorAll('.category-btn');
            const destinationCards = document.querySelectorAll('.destination-card');

            function filterDestinations(category) {
                destinationCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    if (category === 'all' || cardCategory === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
                AOS.refreshHard();
            }

            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('bg-blue-500', 'text-white');
                        btn.classList.add('bg-white', 'text-gray-800');
                    });

                    this.classList.add('bg-blue-500', 'text-white');
                    this.classList.remove('bg-white', 'text-gray-800');

                    const selectedCategory = this.getAttribute('data-category');
                    filterDestinations(selectedCategory);
                });
            });

            document.querySelector('.category-btn[data-category="all"]').click();
        });
    </script>
@endpush
