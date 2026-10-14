<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BlogPost;
use App\Models\BlogSetting;
use Illuminate\Support\Str;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-blog-titles-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

function titleCaseSections(array $sections): array
{
    foreach ($sections as $index => $section) {
        if (($section['type'] ?? '') === 'heading' && isset($section['text'])) {
            $sections[$index]['text'] = Str::title($section['text']);
        }

        if (($section['type'] ?? '') === 'list' && isset($section['title'])) {
            $sections[$index]['title'] = Str::title($section['title']);
        }

        if (! is_array($section['items'] ?? null)) {
            continue;
        }

        foreach ($section['items'] as $itemIndex => $item) {
            if (isset($item['title'])) {
                $sections[$index]['items'][$itemIndex]['title'] = Str::title($item['title']);
            }
        }
    }

    return $sections;
}

$blogsPage = config('site.blogs_page', []);
$blogSetting = BlogSetting::query()->find(1);

BlogSetting::query()->updateOrCreate(
    ['id' => 1],
    [
        'badge' => Str::title($blogsPage['badge'] ?? 'Our Blogs'),
        'title' => Str::title($blogsPage['title'] ?? 'Lawn Care and Snow Removal Tips'),
        'hero_image' => $blogSetting->hero_image ?? ($blogsPage['hero_image'] ?? '/assets/site/blogs-hero-2026.jpg'),
    ],
);

$updatedPosts = 0;

foreach (BlogPost::query()->get() as $post) {
    $configPost = collect(config('site.blog_posts', []))->firstWhere('slug', $post->slug);
    $title = Str::title($configPost['title'] ?? $post->title);
    $sections = titleCaseSections(is_array($post->sections) ? $post->sections : []);

    $post->update([
        'title' => $title,
        'sections' => $sections,
    ]);

    $updatedPosts++;
}

echo "Updated blog page heading and {$updatedPosts} blog post titles/headings.\n";
echo 'Delete update-blog-titles.php now.' . PHP_EOL;
