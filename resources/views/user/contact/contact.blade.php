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

    <section class="py-20 bg-gray-50 text-gray-800">

        <div class="container mx-auto px-4 max-w-screen-xl">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold font-montserrat mb-4">
                    <span class="relative inline-block text-underline-animated-contact-heading">
                        {{ __('user.Hubungi Kami') }}
                        <span class="absolute bottom-0 left-0 w-full h-2 bg-blue-400 opacity-70 -z-1"></span>
                    </span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ __('user.Ada pertanyaan, saran, atau ingin berkolaborasi? Jangan ragu untuk menghubungi kami. Tim kami siap membantu petualangan Anda di Arjasa!') }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <div class="bg-white p-8 rounded-xl shadow-lg" data-aos="fade-right" data-aos-delay="100">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 font-montserrat">{{ __('user.Kirim Pesan kepada Kami') }}</h3>
                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('user.Nama Lengkap') }}</label>
                            <input type="text" id="name" name="name" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-400 focus:border-blue-400 sm:text-sm"
                                placeholder="{{ __('user.Contoh') }}: Budi Santoso">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('user.Alamat Email') }}</label>
                            <input type="email" id="email" name="email" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-400 focus:border-blue-400 sm:text-sm"
                                placeholder="{{ __('user.Contoh') }}: {{ __('user.nama@example.com') }}">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">{{ __('user.Subjek') }}</label>
                            <input type="text" id="subject" name="subject"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-400 focus:border-blue-400 sm:text-sm"
                                placeholder="{{ __('user.Contoh: Pertanyaan tentang paket wisata') }}">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">{{ __('user.Pesan Anda') }}</label>
                            <textarea id="message" name="message" rows="5" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-400 focus:border-blue-400 sm:text-sm"
                                placeholder="{{ __('user.Tulis pesan Anda di sini') }}..."></textarea>
                        </div>
                        <div>
                            <button type="submit"
                                class="inline-flex justify-center items-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-400 hover:bg-blue-500 transition duration-300">
                                {{ __('user.Kirim Pesan') }}
                                <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="space-y-10">
                    <div class="bg-white p-8 rounded-xl shadow-lg" data-aos="fade-left" data-aos-delay="200">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 font-montserrat">{{ __('user.Informasi Kontak') }}</h3>
                        <div class="space-y-4 text-gray-700">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-red-400 mr-3 mt-1 text-lg"></i>
                                <span>{{ __('user.Alamat') }}: Jl. Rengganis No.1, Bendelan, Arjasa, Kabupaten Jember, Jawa Timur
                                    68121</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fab fa-whatsapp text-blue-400 mr-3 mt-1 text-lg"></i>
                                <div>
                                    <p>WhatsApp:</p>
                                    <p><a href="https://wa.me/6285185196301" target="_blank"
                                            class="text-blue-600 hover:underline">0851 8519 6301</a> (Admin Desa Wisata Adat
                                        Arjasa)</p>
                                    <p><a href="https://wa.me/6282123577199" target="_blank"
                                            class="text-blue-600 hover:underline">0821 2357 7199</a> (Pokdarwis Desa Wisata
                                        Adat Arjasa)</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-blue-400 mr-3 text-lg"></i>
                                <span>Email: <a href="mailto:desaadatarjasa@gmail.com"
                                        class="text-blue-600 hover:underline">desaadatarjasa@gmail.com</a></span>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3">{{ __('user.Sosial Media') }}</h4>
                            <div class="flex space-x-4">
                                <a href="https://www.instagram.com/desaadatwisata_arjasa" target="_blank"
                                    class="bg-white text-red-600 rounded-full w-9 h-9 flex items-center justify-center hover:bg-blue-200 transition">
                                    <i class="fab fa-instagram text-lg"></i>
                                </a>
                                <a href="https://www.tiktok.com/@dewiarjasa12" target="_blank"
                                    class="bg-white text-black rounded-full w-9 h-9 flex items-center justify-center hover:bg-blue-200 transition">
                                    <i class="fab fa-tiktok text-lg"></i>
                                </a>
                                <a href="https://twitter.com/AdatArjasa83936" target="_blank"
                                    class="bg-white text-blue-400 rounded-full w-9 h-9 flex items-center justify-center hover:bg-blue-200 transition">
                                    <i class="fab fa-twitter-square text-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow-lg overflow-hidden" data-aos="fade-left"
                        data-aos-delay="300">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4 font-montserrat">{{ __('user.Lokasi Kami') }}</h3>
                        <div class="w-full h-64 rounded-lg overflow-hidden border border-gray-300">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15786.136089312011!2d113.6766453!3d-8.09312215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd698b64e56720d%3A0x63345d817f573216!2sArjasa%2C%20Jember%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1721820646197!5m2!1sen!2sid"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
