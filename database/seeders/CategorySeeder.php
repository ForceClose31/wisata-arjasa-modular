<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Destination\Models\DestinationCategory;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'en' => 'Performing Arts',
                'id' => 'Seni Pertunjukan',
            ],
            [
                'en' => 'Festival',
                'id' => 'Festival',
            ],
            [
                'en' => 'Workshops & Exhibitions',
                'id' => 'Workshop & Pameran',
            ],
            [
                'en' => 'Traditional Ceremony',
                'id' => 'Upacara Adat',
            ],
            [
                'en' => 'Sports & Competitions',
                'id' => 'Olahraga & Perlombaan',
            ],
        ];

        foreach ($categories as $category) {
            DestinationCategory::create([
                'name' => $category,
            ]);
        }
    }
}
