<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $galleries = [
            [
                'title' => 'Ngurbloat Beach',
                'description' => 'The finest white sand in the world',
                'image_path' => 'gallery/1.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Pulau Adranan',
                'description' => 'Hidden gem with crystal clear water',
                'image_path' => 'gallery/2.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ohoilertawun Beach',
                'description' => 'Swing by the beach',
                'image_path' => 'gallery/3.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Sand',
                'description' => 'Kei Islands Wonder',
                'image_path' => 'gallery/4.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Paddleboard',
                'description' => 'The finest white sand in the world',
                'image_path' => 'gallery/5.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Goa Hawang',
                'description' => 'Mystical Cave Pool',
                'image_path' => 'gallery/6.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Sunset 2',
                'description' => 'Golden Hour Beauty',
                'image_path' => 'gallery/7.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach People',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/8.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/9.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/10.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/11.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/12.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/13.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/14.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/15.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/16.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/17.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/18.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/19.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/20.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/21.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/22.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/23.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Wide',
                'description' => 'The finest white sand',
                'image_path' => 'gallery/24.JPG',
                'location' => 'Arjasa, Kei Islands'
            ],
            [
                'title' => 'Ngurbloat Beach Paddleboard Group',
                'description' => 'SUP Fun',
                'image_path' => 'gallery/25.JPG',
                'location' => 'Arjasa, Kei Islands'
            ]
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
