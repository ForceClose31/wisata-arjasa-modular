<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            TagSeeder::class,
            PackageTypeSeeder::class,
            TourPackageSeeder::class,
            ArticleSeeder::class,
            CottageSeeder::class,
            TestimonialSeeder::class,
            CategorySeeder::class,
            DestinationSeeder::class,
            // ContentSeeder::class,
            GalleryCategorySeeder::class,
            GallerySeeder::class,
            TransportSeeder::class,
        ]);
    }
}
