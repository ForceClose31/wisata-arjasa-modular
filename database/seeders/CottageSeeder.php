<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cottage;

class CottageSeeder extends Seeder
{
    public function run()
    {
        $cottages = [
            [
                'name' => [
                    'en' => 'Bamboo Cottage',
                    'id' => 'Cottage Bambu'
                ],
                'slug' => 'cottage-bambu',
                'description' => [
                    'en' => 'Cozy cottage built with eco-friendly bamboo.',
                    'id' => 'Cottage nyaman dengan bahan utama bambu yang ramah lingkungan.'
                ],
                'price' => 350000,
                'capacity' => 2,
                'facilities' => [
                    'en' => ['Queen size bed', 'Private bathroom', 'AC', 'WiFi', 'Kitchenette'],
                    'id' => ['Kasur queen size', 'Kamar mandi dalam', 'AC', 'WiFi', 'Dapur kecil']
                ],
                'images' => ['cottages/bambu1.jpg', 'cottages/bambu2.jpg'],
                'is_available' => true,
            ],

        ];

        foreach ($cottages as $cottage) {
            Cottage::create($cottage);
        }

        $this->command->info('Cottages seeded successfully!');
    }
}
