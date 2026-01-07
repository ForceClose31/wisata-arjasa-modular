@extends('layouts.customer')

@section('content')
    <section class="relative h-screen max-h-[800px] overflow-hidden bg-gradient-to-br from-teal-600 to-indigo-700">
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
                        class="text-4xl md:text-6xl font-bold mb-4 font-montserrat animate-fade-in"></h1>
                    <p x-text="slides[currentSlide].subtitle"
                        class="text-xl md:text-2xl mb-8 text-gray-100 animate-fade-in animate-delay-100"></p>
                    <a :href="getSlideLink(slides[currentSlide].cta)" ...
                        class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 hover:text-blue-800 transition duration-300 animate-fade-in animate-delay-200 inline-flex items-center shadow-lg">
                        <span x-text="slides[currentSlide].cta"></span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
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

    <section class="py-20 bg-gray-50" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2
                    class="text-3xl md:text-4xl font-bold text-gray-800 mb-6 font-montserrat relative inline-block text-underline-animated-explore">
                    <span class="relative z-10">{{ __('user.Apa itu Desa Wisata Adat Arjasa?') }}</span>
                    <span class="absolute bottom-0 left-0 w-full h-2 bg-blue-400 z-0 opacity-30"></span>
                </h2>
                <p class="text-lg text-gray-600 w-3/4 mx-auto">
                    {{ __('user.Desa Wisata Adat Arjasa merupakan desa wisata  sejarah. Disebut demikian karena di Desa Arjasa banyak ditemukan peninggalan cagar budaya nenek moyang yang terdiri dari Batu Kenong, Dolmein dan Menhir. Disamping itu, Desa Arjasa juga memiliki kesenian asli Kabupaten Jember yang dikenal dengan kesenian Ta\'bhutaan yang telah tercatat sebagai “Warisan Budaya Tak Benda Nasional”. Desa Wisata Adat Arjasa juga memiliki eksotisme alam yang luar biasa karena Desa Wisata Adat Arjasa berada tepat di bawah lereng Pegunungan Argopuro sehingga memiliki suasana yang asri, hawa sejuk serta hamparan sawah yang sangat luas.') }}
                </p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div x-data="counter({{ $situsBudayaCount }}, 3000)" x-intersect.once="start()" x-text="count"
                        class="text-4xl font-bold text-teal-600 mb-2">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ __('user.Situs Budaya') }}</h3>
                </div>

                <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div x-data="counter({{ $acaraLokalCount }}, 3000)" x-intersect.once="start()" x-text="count"
                        class="text-4xl font-bold text-indigo-600 mb-2">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ __('user.Acara Lokal') }}</h3>
                </div>

                <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div x-data="counter({{ $paketWisataCount }}, 3000)" x-intersect.once="start()" x-text="count"
                        class="text-4xl font-bold text-amber-600 mb-2">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ __('user.Paket Wisata') }}</h3>
                </div>

                <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div x-data="counter({{ $dayaTarikAlamCount }}, 3000)" x-intersect.once="start()" x-text="count"
                        class="text-4xl font-bold text-emerald-600 mb-2">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ __('user.Daya Tarik Alam') }}</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50 text-gray-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 font-montserrat">
                {{ __('user.Siap Jelajahi Desa Wisata Arjasa?') }}
            </h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                {{ __('user.Bergabunglah dengan komunitas penjelajah budaya kami dan mulai petualangan Anda di Arjasa hari ini') }}
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/about"
                    class="px-8 py-3 border-2 border-blue-400 bg-blue-400 text-white font-bold rounded-lg hover:bg-white hover:text-blue-400 transition duration-300">
                    {{ __('user.Pelajari Lebih Lanjut') }}
                </a>
            </div>
        </div>
    </section>
@endsection
