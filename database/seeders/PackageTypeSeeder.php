<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\TourPackage\Models\PackageType;

class PackageTypeSeeder extends Seeder
{
    public function run()
    {
        $packageTypes = [
            [
                'name' => ['en' => 'One Day Tour', 'id' => 'Tur Sehari'],
                'slug' => 'one-day-tour',
                'description' => [
                    'en' => 'Full day tour packages exploring local attractions',
                    'id' => 'Paket tur sehari penuh menjelajahi atraksi lokal'
                ],
                'is_active' => true
            ],
            [
                'name' => ['en' => 'Heritage & Art Camp', 'id' => 'Kemah Warisan & Seni'],
                'slug' => 'heritage-art-camp',
                'description' => [
                    'en' => 'Multi-day immersive cultural experiences',
                    'id' => 'Pengalaman budaya imersif beberapa hari'
                ],
                'is_active' => true
            ],
            [
                'name' => ['en' => 'Research Tour', 'id' => 'Tur Penelitian'],
                'slug' => 'research-tour',
                'description' => [
                    'en' => 'In-depth cultural and heritage research programs',
                    'id' => 'Program penelitian budaya dan warisan mendalam'
                ],
                'is_active' => true
            ],
            [
                'name' => ['en' => 'Hyang Argopuro Festival', 'id' => 'Festival Hyang Argopuro'],
                'slug' => 'hyang-argopuro-festival',
                'description' => [
                    'en' => 'Special packages for cultural festival events',
                    'id' => 'Paket khusus untuk acara festival budaya'
                ],
                'is_active' => true
            ]
        ];

        foreach ($packageTypes as $type) {
            PackageType::create($type);
        }
    }
}
