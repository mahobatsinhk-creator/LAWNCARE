<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-snow-removal-image-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$image = '/assets/services/snow-removal/snow-removal-card.jpg?v=snowcard2026';

$record = SiteContent::query()->where('section', 'home')->first();
$data = $record->data ?? [];
$services = $data['home_services'] ?? config('site.home_services');

if (! is_array($services)) {
    http_response_code(500);
    exit("home_services is not an array\n");
}

$updated = false;

foreach ($services as $index => $service) {
    if (($service['slug'] ?? '') !== 'snow-removal-services') {
        continue;
    }

    $services[$index]['image'] = $image;
    unset($services[$index]['video']);
    $updated = true;
    break;
}

if (! $updated) {
    http_response_code(404);
    exit("snow-removal-services service not found\n");
}

SiteContent::saveFormData('home', ['home_services' => $services]);

$servicesRecord = SiteContent::query()->where('section', 'services')->first();
$serviceDetails = $servicesRecord->data['service_details'] ?? config('site.service_details');

if (! is_array($serviceDetails)) {
    $serviceDetails = [];
}

$serviceDetails['snow-removal-services'] = array_merge(
    $serviceDetails['snow-removal-services'] ?? [],
    [
        'hero_image' => $image,
        'video' => null,
    ]
);

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Updated snow removal service image to {$image}\n";
echo 'Delete update-snow-removal-image.php now.' . PHP_EOL;
