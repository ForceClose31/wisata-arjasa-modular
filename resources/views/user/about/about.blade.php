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
                    {{-- <a href="{{ route('user.index') }}"
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

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 max-w-screen-xl">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/3 mx-auto max-w-xs md:max-w-sm lg:max-w-md" data-aos="fade-right"
                    data-aos-duration="1000">
                    <div
                        class="relative rounded-xl overflow-hidden shadow-2xl transform hover:scale-105 transition duration-500 ease-in-out">
                        <img src="storage/profile/DSC_0312.JPG"
                            alt="Kisah Kami Dewi Arjasa" class="w-full h-auto object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 text-white">
                            <p class="text-sm font-semibold font-lato tracking-wide">
                                {{ __('user.Desa Wisata Adat Arjasa - Jejak Sejarah Sejak 1920') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-2/3" data-aos="fade-left" data-aos-duration="1000">
                    <div class="max-w-2xl mx-auto lg:mx-0">
                        <h2 class="text-4xl md:text-4xl font-bold text-gray-800 mb-2 font-montserrat relative inline-block">
                            {{ __('user.Sejarah Singkat Kami') }}
                            <span class="absolute bottom-0 left-0 w-full h-2 bg-blue-400 opacity-70 -z-1"></span>
                        </h2>
                        <p class="text-lg text-gray-600 mb-6 leading-relaxed font-lato">
                            <span class="text-blue-500 font-bold">{{ __('Desa Wisata Adat Arjasa') }}</span>
                            {{ __('user.dibentuk pada tahun 1920, pada era kepemimpinan kepala Desa Arjasa kedua yaitu bapak Seha. Beliau memimpin dari tahun 1915 sampai dengan tahun 1946. Bapak Seha merupakan penggerak dan penginisiasi berdirinya  desa adat ini dengan nama Desa Wisata Adat. Dengan berkembangnya pariwisata dan minat masyarakat untuk berkunjung, maka Kelompok Sadar Wisata Arjasa mengelola dan membuka desa wisata ini untuk masyarakat luas. Grand launching pendirian Desa Wisata Adat Arjasa tanggal 25 November 2019 dengan brand “Desa Wisata Adat Arjasa“. Nama baru ini menjadi branding bagi desa ini untuk menjadi salah satu destinasi wisata baru yang ada di Jember.') }}
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
                            <div class="text-center p-4 bg-teal-50 rounded-lg shadow-sm animate-fade-in delay-100">
                                <div class="text-3xl font-bold text-teal-700 font-montserrat">14+</div>
                                <div class="text-gray-700 text-sm font-lato">{{ __('user.Tahun Pengalaman') }}</div>
                            </div>
                            <div class="text-center p-4 bg-indigo-50 rounded-lg shadow-sm animate-fade-in delay-200">
                                <div class="text-3xl font-bold text-indigo-700 font-montserrat">5000+</div>
                                <div class="text-gray-700 text-sm font-lato">{{ __('user.Wisatawan Puas') }}</div>
                            </div>
                            <div class="text-center p-4 bg-amber-50 rounded-lg shadow-sm animate-fade-in delay-300">
                                <div class="text-3xl font-bold text-amber-700 font-montserrat">50+</div>
                                <div class="text-gray-700 text-sm font-lato">{{ __('user.Destinasi Unggulan') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
