@extends('layouts.customer') {{-- Asumsi ini adalah layout utama Anda --}}

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
                    {{-- <a href="{{ route('about.index') }}"
                        class="px-8 py-4 bg-white text-teal-700 font-bold rounded-lg hover:bg-gray-100 hover:text-teal-800 transition duration-300 animate-fade-in animate-delay-200 inline-flex items-center shadow-lg">
                        <span x-text="slides[currentSlide].cta"></span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a> --}}
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

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-screen-xl">
            <div class="mb-10 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-2 font-montserrat relative inline-block">
                    <span>Komoda</span> {{ __('user.Transportasi') }}
                    <span class="absolute bottom-0 left-0 w-full h-2 bg-blue-400 opacity-70 -z-1"></span>
                </h2>
                <p class="text-lg text-gray-700">{{ __('user.Daftar Harga Sewa Transportasi Desa Wisata Adat Arjasa.') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($transportations as $transport)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group transform transition-transform duration-300 hover:-translate-y-2 hover:shadow-2xl"
                        data-aos="fade-up">
                        <div class="relative">
                            <img src="{{ $transport->image }}" alt="{{ $transport->getTranslation('name', $locale) }}"
                                class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-105">
                            <div
                                class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold py-2 px-4 rounded-bl-lg">
                                {{ __('user.SEWA MOBIL') }}
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <div class="flex justify-between items-center text-xs text-gray-600 mb-6">
                                <div class="flex items-center">
                                    <i class="fas fa-phone-alt mr-2 text-blue-500"></i>
                                    <span>{{ $transport->phone }}</span>
                                </div>
                            </div>
                            <h3 class="text-2xl font-extrabold text-gray-800 mb-4">
                                {{ $transport->getTranslation('name', $locale) }}
                            </h3>
                            <div class="flex justify-around items-center text-gray-700 text-sm mb-6">
                                @foreach ($transport->facilities as $facility)
                                    <div class="flex flex-col items-center">
                                        {{-- Optional: tambahkan icon berdasar nama fasilitas --}}
                                        <i class="fas fa-check-circle text-blue-500 text-lg mb-1"></i>
                                        <span>{{ $facility }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex justify-between items-center mt-6">
                                <button
                                    class="bg-blue-400 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-500 transition duration-300 shadow-md transform hover:-translate-y-1">
                                    Book Now
                                </button>
                                <div class="text-xl font-bold text-gray-800">
                                    Rp {{ number_format($transport->price, 0, ',', '.') }} <span
                                        class="text-lg text-gray-600">/ {{ $transport->duration }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
