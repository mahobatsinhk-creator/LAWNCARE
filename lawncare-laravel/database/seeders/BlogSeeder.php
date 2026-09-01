<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\BlogSetting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $page = config('site.blogs_page', []);

        BlogSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'badge' => $page['badge'] ?? 'our blogs',
                'title' => $page['title'] ?? 'Tips for better garden spaces',
                'hero_image' => $page['hero_image'] ?? '/assets/harmone/images/LM0vRNvdYtrVYp26InVBjG2Om38c9a7.png',
            ],
        );

        foreach (config('site.blog_posts', []) as $index => $post) {
            $content = config('blog_content.'.$post['slug'], []);

            BlogPost::query()->updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'author' => $post['author'],
                    'published_at' => Carbon::parse($post['date']),
                    'image' => $post['image'],
                    'reading_time' => $content['reading_time'] ?? null,
                    'author_avatar' => $content['author_avatar'] ?? null,
                    'quote' => $content['quote'] ?? null,
                    'sections' => $content['sections'] ?? [],
                    'author_bio' => $content['author_bio'] ?? null,
                    'is_published' => true,
                    'sort_order' => $index,
                ],
            );
        }
    }
}
