<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-about-hero-image-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$newImage = '/assets/site/about-hero-2026.jpg';

SiteContent::saveFormData('about', ['hero_image' => $newImage]);

echo "Updated about hero image to {$newImage}\n";
echo 'Delete update-about-hero-image.php now.' . PHP_EOL;
