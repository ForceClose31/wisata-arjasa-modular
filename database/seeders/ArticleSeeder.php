<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Tag;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'title' => 'Menikmati Keindahan Alam Pedesaan',
                'slug' => 'menikmati-keindahan-alam-pedesaan',
                'excerpt' => 'Temukan keindahan alam pedesaan yang masih asri dan belum terjamah.',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p><p>Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>',
                'image' => 'tour-packages/gandrung.jpg',
                'category' => 'Outdoor',
                'published_at' => Carbon::now(),
                'is_published' => true,
            ],
            [
                'title' => 'Tips Berkemah untuk Pemula',
                'slug' => 'tips-berkemah-untuk-pemula',
                'excerpt' => 'Panduan lengkap untuk mereka yang baru pertama kali ingin mencoba berkemah.',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p><p>Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>',
                'image' => 'tour-packages/gandrung.jpg',
                'category' => 'Outdoor',
                'published_at' => Carbon::now()->subDays(3),
                'is_published' => true,
            ],
        ];

        $tags = Tag::all();

        foreach ($articles as $articleData) {
            $article = Article::create($articleData);

            $article->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

        $this->command->info('Articles seeded successfully!');
    }
}
