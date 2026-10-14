<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-about-hero-title-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$title = config('site.about_page.hero_title');

SiteContent::saveFormData('about', ['hero_title' => $title]);

echo "Updated about hero title to: {$title}\n";
echo 'Delete update-about-hero-title.php now.' . PHP_EOL;
