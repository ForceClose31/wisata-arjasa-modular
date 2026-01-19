<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            PackageTypeSeeder::class,
            TourPackageSeeder::class,
            CategorySeeder::class,
            DestinationSeeder::class,
            GalleryCategorySeeder::class,
            GallerySeeder::class,
        ]);
    }
}
