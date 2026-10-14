<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BlogPost;
use App\Models\BlogSetting;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-blog-images-2026';

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
        'hero_image' => $page['hero_image'] ?? '/assets/site/blogs-hero-2026.jpg',
    ],
);

$updated = 0;

foreach (config('site.blog_posts', []) as $post) {
    $slug = $post['slug'] ?? null;
    $image = $post['image'] ?? null;

    if (! $slug || ! $image) {
        continue;
    }

    $count = BlogPost::query()->where('slug', $slug)->update(['image' => $image]);
    $updated += $count;
}

echo "Updated blogs hero image and {$updated} blog post images\n";
echo 'Delete update-blog-images.php now.' . PHP_EOL;
