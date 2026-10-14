<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-property-cleanup-video-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$video = '/videos/property-cleanup-2026c.mp4';

$record = SiteContent::query()->where('section', 'home')->first();
$data = $record->data ?? [];
$services = $data['home_services'] ?? config('site.home_services');

if (! is_array($services)) {
    http_response_code(500);
    exit("home_services is not an array\n");
}

$updated = false;

foreach ($services as $index => $service) {
    if (($service['slug'] ?? '') !== 'property-cleanup-and-maintenance') {
        continue;
    }

    $services[$index]['video'] = $video;
    $services[$index]['image'] = $video;
    $updated = true;
    break;
}

if (! $updated) {
    http_response_code(404);
    exit("property-cleanup-and-maintenance service not found\n");
}

SiteContent::saveFormData('home', ['home_services' => $services]);

$servicesRecord = SiteContent::query()->where('section', 'services')->first();
$serviceDetails = $servicesRecord->data['service_details'] ?? config('site.service_details');

if (! is_array($serviceDetails)) {
    $serviceDetails = [];
}

$serviceDetails['property-cleanup-and-maintenance'] = array_merge(
    $serviceDetails['property-cleanup-and-maintenance'] ?? [],
    ['video' => $video]
);

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Updated property cleanup service video to {$video}\n";
echo 'Delete update-property-cleanup-video.php now.' . PHP_EOL;
