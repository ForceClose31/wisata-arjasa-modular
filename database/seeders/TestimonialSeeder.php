<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'name' => 'Budi Santoso',
                'position' => 'Travel Blogger',
                'content' => 'Pengalaman menginap di cottage sangat menyenangkan. Pemandangan indah dan pelayanan memuaskan.',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'name' => 'Anita Rahayu',
                'position' => 'Keluarga',
                'content' => 'Paket wisatanya sangat cocok untuk keluarga. Anak-anak senang dengan aktivitasnya.',
                'rating' => 4,
                'is_featured' => true,
            ],
            [
                'name' => 'Rudi Hermawan',
                'position' => null,
                'content' => 'Tempatnya asri dan tenang, cocok untuk melepas penat dari kesibukan kota.',
                'rating' => 5,
                'is_featured' => false,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        $this->command->info('Testimonials seeded successfully!');
    }
}
