<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <style>
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        [x-cloak] {
            display: none !important;
        }

        .dropdown-menu {
            transition: opacity 0.2s ease-out, transform 0.2s ease-out;
            opacity: 0;
            transform: translateY(-10px);
            pointer-events: none;
        }

        .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .mobile-dropdown-menu {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out, opacity 0.2s ease-out;
        }

        .mobile-dropdown-menu.show {
            opacity: 1;
            max-height: 300px;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        budanes: '#A41313',
                        'budanes-dark': '#e4e00c',
                        'budanes-darker': '#c30000',
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="font-poppins bg-gray-50" x-data="mainLayout()">

    @if (!request()->is('admin/login') && !request()->is('admin/login/*'))
        @include('layouts.navbar')
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    @if (!request()->is('admin/login') && !request()->is('admin/login/*'))
        @include('layouts.footer')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 800,
            once: true,
        });
    </script>

    <script>
        function mainLayout() {
            return {
                mobileMenuOpen: false,

                currentSlide: 0,
                slides: [
                    {
                        title: '{{ __("layouts.Jelajahi Keindahan Desa Wisata Adat Arjasa") }}',
                        subtitle: '{{ __("layouts.Dari Suara Lokal ke Kebanggaan Global.") }}',
                        image: 'assets/img/gandrung.jpg',
                        cta: '{{ __("layouts.Mulai Jelajahi") }}'
                    },
                    {
                        title: '{{ __("layouts.Ikuti Event Budaya Terdekat") }}',
                        subtitle: '{{ __("layouts.Bergabunglah dengan komunitas pelestari budaya") }}',
                        image: 'assets/img/event.jpg',
                        cta: '{{ __("layouts.Lihat Event") }}'
                    }
                ],

                nextSlide() {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                },

                prevSlide() {
                    this.currentSlide =
                        (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                },

                getSlideLink(cta) {
                    if (cta === '{{ __("layouts.Mulai Jelajahi") }}')
                        return '{{ url('/about') }}';

                    if (cta === '{{ __("layouts.Lihat Event") }}')
                        return '{{ url('/event-budaya') }}';

                    return '#';
                },

                init() {
                    setInterval(() => {
                        this.nextSlide();
                    }, 5000);
                }
            }
        }

        document.addEventListener('alpine:init', () => {
            Alpine.data('counter', (target, duration = 3000) => ({
                count: 0,
                start() {
                    const increment = target / (duration / 10);
                    let startTime;

                    const update = (timestamp) => {
                        if (!startTime) startTime = timestamp;
                        const progress = timestamp - startTime;

                        this.count = Math.min(target, Math.ceil(progress * increment));

                        if (progress < duration) {
                            requestAnimationFrame(update);
                        }
                    };

                    requestAnimationFrame(update);
                }
            }));
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const mobileBtn = document.getElementById("mobile-menu-button");
            const mobileMenu = document.getElementById("mobile-menu");
            const mobileMenuOpenIcon = document.getElementById("mobile-menu-open");
            const mobileMenuCloseIcon = document.getElementById("mobile-menu-close");

            if (mobileBtn && mobileMenu) {
                mobileBtn.addEventListener("click", () => {
                    mobileMenu.classList.toggle("hidden");
                    mobileMenuOpenIcon.classList.toggle("hidden");
                    mobileMenuCloseIcon.classList.toggle("hidden");
                });
            }

            document.querySelectorAll("[data-dropdown]").forEach((dropdown) => {
                const toggle = dropdown.querySelector("[data-toggle]");
                const menu = dropdown.querySelector("[data-menu]");

                if (toggle && menu) {
                    toggle.addEventListener("click", (e) => {
                        e.stopPropagation();
                        document.querySelectorAll("[data-menu]").forEach(m => {
                            if (m !== menu) m.classList.remove("show");
                        });
                        menu.classList.toggle("show");
                    });
                }
            });

            document.addEventListener("click", (e) => {
                if (!e.target.closest("[data-dropdown]")) {
                    document.querySelectorAll("[data-menu]").forEach(menu => {
                        menu.classList.remove("show");
                    });
                }
            });

            document.querySelectorAll("[data-mobile-dropdown]").forEach((dropdown) => {
                const toggle = dropdown.querySelector("[data-mobile-toggle]");
                const menu = dropdown.querySelector("[data-mobile-menu]");

                if (toggle && menu) {
                    toggle.addEventListener("click", () => {
                        menu.classList.toggle("show");
                    });
                }
            });
        });

    </script>
    @stack('scripts')
</body>

</html>
