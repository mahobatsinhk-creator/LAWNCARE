<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-why-us-image-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$newImage = '/assets/site/why-us-lawn-mower.png?v=whyus2026b';

SiteContent::saveFormData('global', ['why_us_image' => $newImage]);
SiteContent::saveFormData('home', ['why_us_image' => $newImage]);

echo "Updated why us image to {$newImage}\n";
echo 'Delete update-why-us-image.php now.' . PHP_EOL;
