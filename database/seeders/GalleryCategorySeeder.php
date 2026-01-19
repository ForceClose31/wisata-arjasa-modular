<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Gallery\Models\GalleryCategory;

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
