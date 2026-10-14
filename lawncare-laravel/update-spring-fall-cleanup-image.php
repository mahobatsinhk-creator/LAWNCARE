<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-spring-fall-cleanup-image-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$image = '/assets/services/spring-fall-clean-up/spring-fall-cleanup-card.jpg?v=seasonalcard2026';

$record = SiteContent::query()->where('section', 'home')->first();
$data = $record->data ?? [];
$services = $data['home_services'] ?? config('site.home_services');

if (! is_array($services)) {
    http_response_code(500);
    exit("home_services is not an array\n");
}

$updated = false;

foreach ($services as $index => $service) {
    if (($service['slug'] ?? '') !== 'spring-fall-clean-up') {
        continue;
    }

    $services[$index]['image'] = $image;
    unset($services[$index]['video']);
    $updated = true;
    break;
}

if (! $updated) {
    http_response_code(404);
    exit("spring-fall-clean-up service not found\n");
}

SiteContent::saveFormData('home', ['home_services' => $services]);

$servicesRecord = SiteContent::query()->where('section', 'services')->first();
$serviceDetails = $servicesRecord->data['service_details'] ?? config('site.service_details');

if (! is_array($serviceDetails)) {
    $serviceDetails = [];
}

$serviceDetails['spring-fall-clean-up'] = array_merge(
    $serviceDetails['spring-fall-clean-up'] ?? [],
    [
        'hero_image' => $image,
        'video' => null,
    ]
);

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Updated spring fall cleanup service image to {$image}\n";
echo 'Delete update-spring-fall-cleanup-image.php now.' . PHP_EOL;
