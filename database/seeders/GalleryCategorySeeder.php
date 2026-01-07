<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Aktivitas',
            'Event',
            'Budaya',
            'Kuliner',
            'Sejarah'
        ];

        foreach ($categories as $category) {
            GalleryCategory::create([
                'name' => $category,
                'slug' => \Str::slug($category)
            ]);
        }
    }
}
