<footer class="bg-blue-400 text-white py-12">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-x-12 gap-y-10">
        <div class="flex flex-col">
            <div>
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="h-16 mb-4">
            </div>
            <p class="text-sm">{{ __('layouts.Budaya adalah warisan yang lebih berharga dari permata.') }}</p>
        </div>

        <div>
            <h4 class="text-lg font-bold mb-5">{{ __('layouts.Alamat') }}</h4>
            <div class="flex items-start space-x-3 mb-4">
                <i class="fas fa-map-marker-alt mt-1 text-white text-base"></i>
                <p class="text-sm leading-relaxed mt-1">
                    Jl. Rengganis No.1, Bendelan, Arjasa, Kabupaten Jember, Jawa Timur 68121
                </p>
            </div>

            <div class="flex space-x-3 mt-6">
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
                    <i class="fab fa-twitter text-lg"></i>
                </a>
                <a href="https://www.youtube.com/@DesaWisataAdatArjasa" target="_blank"
                    class="bg-white text-red-600 rounded-full w-9 h-9 flex items-center justify-center hover:bg-blue-200 transition">
                    <i class="fab fa-youtube text-lg"></i>
                </a>
            </div>
        </div>

        <div>
            <h4 class="text-lg font-bold mb-5">{{ __('layouts.Kontak') }}</h4>
            <div class="flex items-center text-sm mb-3 space-x-3">
                <i class="fab fa-whatsapp text-base"></i>
                <span>
                    <a href="https://wa.me/6285185196301" target="_blank" class="hover:underline">0851 8519 6301</a> (Admin)<br>
                    <a href="https://wa.me/6282123577199" target="_blank" class="hover:underline">0821 2357 7199</a> (Pokdarwis)
                </span>
            </div>
            <div class="flex items-center text-sm mb-3 space-x-3">
                <i class="fas fa-envelope text-base"></i>
                <span>
                    <a href="mailto:desaadatarijasa@gmail.com" class="hover:underline">desaadatarjasa@gmail.com</a>
                </span>
            </div>
        </div>
    </div>

    <div class="mt-12 pt-6 border-t border-white-400 text-center text-sm text-white">
        <p>&copy; {{ __('layouts.2025 Desa Wisata Adat Arjasa. Hak Cipta Dilindungi Undang-Undang.') }}</p>
    </div>
</footer>
