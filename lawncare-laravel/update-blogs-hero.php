<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BlogSetting;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-blogs-hero-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$heroImage = '/assets/site/blogs-hero-custom.jpg?v=bloghero2026c';

BlogSetting::query()->updateOrCreate(
    ['id' => 1],
    [
        'badge' => config('site.blogs_page.badge', 'our blogs'),
        'title' => config('site.blogs_page.title', 'Lawn care and snow removal tips'),
        'hero_image' => $heroImage,
    ],
);

echo "Updated blogs hero image to {$heroImage}\n";
echo 'Delete update-blogs-hero.php now.' . PHP_EOL;
