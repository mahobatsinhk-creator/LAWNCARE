<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BlogPost;
use App\Models\BlogSetting;
use Carbon\Carbon;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-sync-blogs-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$page = config('site.blogs_page', []);

BlogSetting::query()->updateOrCreate(
    ['id' => 1],
    [
        'badge' => $page['badge'] ?? 'our blogs',
        'title' => $page['title'] ?? 'Lawn care and snow removal tips',
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

echo 'Synced '.count(config('site.blog_posts', [])).' blog posts.' . PHP_EOL;
echo 'Delete sync-blogs.php now.' . PHP_EOL;
