<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;

class ContentSeeder extends Seeder
{
    public function run()
    {
        $contents = [
            [
                'title' => 'Tentang Kami',
                'slug' => 'tentang-kami',
                'content' => '<h1>Tentang Desa Wisata Kami</h1><p>Desa wisata kami berdiri sejak tahun 2010 dengan tujuan melestarikan alam dan budaya lokal sambil memberikan pengalaman wisata yang autentik.</p>',
                'page_type' => 'about',
                'is_published' => true,
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'content' => '<h1>Hubungi Kami</h1><p>Email: info@desawisata.com</p><p>Telepon: 08123456789</p><p>Alamat: Jl. Desa Wisata No. 123, Kecamatan, Kabupaten</p>',
                'page_type' => 'contact',
                'is_published' => true,
            ],
            [
                'title' => 'Welcome to Arjasa',
                'subtitle' => 'Discover the hidden gem of East Java',
                'slug' => 'tes',
                'cta' => 'Explore Now',
                'image' => 'slider/slide1.jpg',
                'content' => '',
                'page_type' => 'home_slider',
                'is_published' => true,
            ],
            [
                'title' => 'Cultural Heritage',
                'subtitle' => 'Experience rich traditions and history',
                'slug' => 'tes2',
                'cta' => 'Learn More',
                'image' => 'slider/slide2.jpg',
                'content' => '',
                'page_type' => 'home_slider',
                'is_published' => true,
            ],
            [
                'title' => 'Natural Wonders',
                'subtitle' => 'Explore breathtaking landscapes',
                'slug' => 'tes3',
                'cta' => 'Discover Now',
                'image' => 'slider/slide3.jpg',
                'content' => '',
                'page_type' => 'home_slider',
                'is_published' => true,
            ],
        ];

        foreach ($contents as $content) {
            Content::create($content);
        }

        $this->command->info('Contents seeded successfully!');
    }
}
