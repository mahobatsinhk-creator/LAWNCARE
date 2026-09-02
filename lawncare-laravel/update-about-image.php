<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-about-image-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$newImage = '/assets/site/snow-feature.png?v=snow2026';

SiteContent::saveFormData('home', ['about_feature_image' => $newImage]);

echo "Updated about feature image to {$newImage}\n";
echo 'Delete update-about-image.php now.' . PHP_EOL;
