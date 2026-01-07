<?php

namespace Database\Seeders;

use App\Models\PackageType;
use App\Models\TourPackage;
use Illuminate\Database\Seeder;

class TourPackageSeeder extends Seeder
{
    public function run()
    {
        // DAY ONE DAY TOUR
        $oneDayTour = TourPackage::create([
            'package_type_id' => PackageType::where('slug', 'one-day-tour')->first()->id,
            'name' => [
                'en' => 'FULL DAY TOUR OF ARJASA TRADITIONAL VILLAGE',
                'id' => 'TUR SEHARI PENUH DESA WISATA ADAT ARJASA'
            ],
            'slug' => 'day-one-tour-arjasa',
            'pdf_url' => 'tour-pdf/dayonetour.pdf',
            'description' => [
                'en' => 'A full day tour package exploring the cultural heritage of Arjasa Traditional Village, including art galleries, sacred springs, and local crafts activities.',
                'id' => 'Paket wisata sehari penuh menjelajahi warisan budaya Desa Adat Arjasa, termasuk galeri seni, mata air suci, dan aktivitas kerajinan lokal.'
            ],
            'duration' => '1 Hari / 1 Day',
            'images' => [
                'tour-packages/gandrung.jpg',
                'tour-packages/gandrung.jpg',
                'tour-packages/gandrung.jpg',
            ],
            'highlights' => [
                'en' => [
                    'Local cultural experience',
                    'Visit to heritage sites',
                    'Art and craft activities',
                    'Water tourism at Citra Mandiri'
                ],
                'id' => [
                    'Pengalaman budaya lokal',
                    'Kunjungan ke situs heritage',
                    'Aktivitas seni dan kerajinan',
                    'Wisata air di Citra Mandiri'
                ]
            ],
            'is_featured' => true,
            'is_available' => true
        ]);

        // Pricing for One Day Tour
        $oneDayTour->pricings()->createMany([
            ['group_size' => '20 pack', 'price' => 150000, 'variant' => 'non cooking class'],
            ['group_size' => '20 pack', 'price' => 200000, 'variant' => 'cooking class'],
            ['group_size' => '30 pack', 'price' => 145000, 'variant' => 'non cooking class'],
            ['group_size' => '30 pack', 'price' => 195000, 'variant' => 'cooking class'],
            ['group_size' => '40 pack', 'price' => 140000, 'variant' => 'non cooking class'],
            ['group_size' => '40 pack', 'price' => 190000, 'variant' => 'cooking class'],
            ['group_size' => '50 pack', 'price' => 135000, 'variant' => 'non cooking class'],
            ['group_size' => '50 pack', 'price' => 185000, 'variant' => 'cooking class'],
            ['group_size' => '60 pack', 'price' => 130000, 'variant' => 'non cooking class'],
            ['group_size' => '60 pack', 'price' => 180000, 'variant' => 'cooking class']
        ]);

        // HERITAGE AND ART CAMP (2D1N)
        $heritageCamp = TourPackage::create([
            'package_type_id' => PackageType::where('slug', 'heritage-art-camp')->first()->id,
            'name' => [
                'en' => 'HERITAGE AND ART CAMP TOUR PACKAGE (2D1N)',
                'id' => 'PAKET WISATA HERITAGE AND ART CAMP (2H1M)'
            ],
            'slug' => 'heritage-art-camp',
            'pdf_url' => 'tour-pdf/heritage.pdf',
            'description' => [
                'en' => 'A 2-day 1-night immersive experience exploring Arjasa\'s cultural heritage and art, including traditional performances, megalithic sites visit, and gamelan learning.',
                'id' => 'Pengalaman 2 hari 1 malam mendalami warisan budaya dan seni Arjasa, termasuk pagelaran tradisional, kunjungan situs megalitikum, dan belajar gamelan.'
            ],
            'duration' => '2 Hari 1 Malam / 2 Days 1 Night',
            'images' => [
                'tour-packages/gandrung.jpg',
                'tour-packages/gandrung.jpg',
                'tour-packages/gandrung.jpg',
            ],
            'highlights' => [
                'en' => [
                    'Camping ground overnight experience',
                    'Direct art and cultural activities',
                    'Gudug vegetable cooking class',
                    'Traditional art performances'
                ],
                'id' => [
                    'Pengalaman menginap di camping ground',
                    'Aktivitas seni dan budaya langsung',
                    'Cooking class sayur gudug',
                    'Pagelaran seni tradisional'
                ]
            ],
            'is_featured' => true,
            'is_available' => true
        ]);

        // Pricing for Heritage and Art Camp
        $heritageCamp->pricings()->createMany([
            ['group_size' => '20 pack', 'price' => 530000],
            ['group_size' => '30 pack', 'price' => 525000],
            ['group_size' => '40 pack', 'price' => 520000],
            ['group_size' => '50 pack', 'price' => 515000],
            ['group_size' => '60 pack', 'price' => 510000]
        ]);

        // RESEARCH TOUR (3D2N)
        $researchTour = TourPackage::create([
            'package_type_id' => PackageType::where('slug', 'research-tour')->first()->id,
            'name' => [
                'en' => 'CULTURAL RESEARCH TOUR PACKAGE (3D2N)',
                'id' => 'PAKET WISATA PENELITIAN BUDAYA (3H2M)'
            ],
            'slug' => 'research-tour',
            'pdf_url' => 'tour-pdf/research.pdf',
            'description' => [
                'en' => 'A 3-day 2-night package for in-depth cultural and heritage research in Arjasa, including museum visits, traditional performances, and direct interaction with local culture.',
                'id' => 'Paket 3 hari 2 malam untuk penelitian mendalam budaya dan heritage Arjasa, termasuk kunjungan museum, pagelaran tradisional, dan interaksi langsung dengan budaya lokal.'
            ],
            'duration' => '3 Hari 2 Malam / 3 Days 2 Nights',
            'images' => [
                'tour-packages/gandrung.jpg',
                'tour-packages/gandrung.jpg',
                'tour-packages/gandrung.jpg',
            ],
            'highlights' => [
                'en' => [
                    'In-depth research experience',
                    'Access to heritage sites',
                    'Direct interaction with local culture',
                    'Tobacco/Letter Museum visit'
                ],
                'id' => [
                    'Pengalaman penelitian mendalam',
                    'Akses ke situs heritage',
                    'Interaksi langsung dengan budaya lokal',
                    'Kunjungan museum tembakau/huruf'
                ]
            ],
            'is_featured' => true,
            'is_available' => true
        ]);

        // Pricing for Research Tour
        $researchTour->pricings()->createMany([
            ['group_size' => '20 pack', 'price' => 1000000],
            ['group_size' => '30 pack', 'price' => 955000],
            ['group_size' => '40 pack', 'price' => 950000],
            ['group_size' => '50 pack', 'price' => 945000],
            ['group_size' => '60 pack', 'price' => 940000]
        ]);

        // HYANG ARGOPURO FESTIVAL
        $festival = TourPackage::create([
            'package_type_id' => PackageType::where('slug', 'hyang-argopuro-festival')->first()->id,
            'name' => [
                'en' => 'HYANG ARGOPURO FESTIVAL EVENT PACKAGE (2D1N)',
                'id' => 'PAKET EVENT HYANG ARGOPURO FESTIVAL (2H1M)'
            ],
            'slug' => 'hyang-argopuro-festival',
            'pdf_url' => 'tour-pdf/hyang.pdf',
            'description' => [
                'en' => 'Special package to witness the Hyang Argopuro cultural festival, including special access to cultural performances and comfortable accommodation.',
                'id' => 'Paket khusus untuk menyaksikan festival budaya Hyang Argopuro, termasuk akses khusus ke pagelaran budaya dan penginapan yang nyaman.'
            ],
            'duration' => '2 Hari 1 Malam / 2 Days 1 Night',
            'images' => [
                'tour-packages/gandrung.jpg',
                'tour-packages/gandrung.jpg',
                'tour-packages/gandrung.jpg',
            ],
            'highlights' => [
                'en' => [
                    'Exclusive cultural festival experience',
                    'Special access to Hyang Argopuro events',
                    'Comfortable hotel accommodation',
                    'Special cultural performances'
                ],
                'id' => [
                    'Pengalaman festival budaya eksklusif',
                    'Akses khusus ke acara Hyang Argopuro',
                    'Penginapan nyaman di hotel',
                    'Pagelaran seni budaya spesial'
                ]
            ],
            'is_featured' => true,
            'is_available' => true
        ]);

        // Pricing for Festival
        $festival->pricings()->createMany([
            ['group_size' => '1 pack', 'price' => 1000000, 'variant' => 'VIP'],
            ['group_size' => '1 pack', 'price' => 600000, 'variant' => 'Reguler']
        ]);
    }
}
