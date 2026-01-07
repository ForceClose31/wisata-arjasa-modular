<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            ['name' => 'Wisata Alam', 'slug' => 'wisata-alam'],
            ['name' => 'Petualangan', 'slug' => 'petualangan'],
            ['name' => 'Keluarga', 'slug' => 'keluarga'],
            ['name' => 'Romantis', 'slug' => 'romantis'],
            ['name' => 'Budaya', 'slug' => 'budaya'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }

        $this->command->info('Tags seeded successfully!');
    }
}
