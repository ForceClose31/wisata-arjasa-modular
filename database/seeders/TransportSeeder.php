<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transportation;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transportation::create([
            'name' => ['en' => 'Toyota Avanza', 'id' => 'Toyota Avanza'],
            'description' => ['en' => 'Comfortable car', 'id' => 'Mobil nyaman'],
            'image' => 'https://example.com/image.jpg',
            'phone' => '0811477719',
            'price' => 750000,
            'duration' => ['en' => '12 Hours', 'id' => '12 Jam'],
            'facilities' => ['en' => ['Driver', 'BBM', 'Car'], 'id' => ['Supir', 'BBM', 'Mobil']],
        ]);
    }
}
