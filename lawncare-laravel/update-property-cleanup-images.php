<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-cleanup-images-2026g';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$configCleanup = config('site.service_details.property-cleanup-and-maintenance', []);

$servicesRecord = SiteContent::query()->where('section', 'services')->first();
$serviceDetails = $servicesRecord->data['service_details'] ?? [];

if (! is_array($serviceDetails)) {
    $serviceDetails = [];
}

$serviceDetails['property-cleanup-and-maintenance'] = array_merge(
    $serviceDetails['property-cleanup-and-maintenance'] ?? [],
    $configCleanup
);

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

$homeRecord = SiteContent::query()->where('section', 'home')->first();
$homeData = $homeRecord->data ?? [];
$homeServices = $homeData['home_services'] ?? config('site.home_services', []);
$cardImage = $configCleanup['hero_image'] ?? '/assets/services/property-cleanup/property-cleanup-card.jpg?v=cleanup2026g';

if (is_array($homeServices)) {
    foreach ($homeServices as $index => $service) {
        if (($service['slug'] ?? '') !== 'property-cleanup-and-maintenance') {
            continue;
        }

        $homeServices[$index]['image'] = $cardImage;
        unset($homeServices[$index]['video']);
        break;
    }

    SiteContent::saveFormData('home', ['home_services' => $homeServices]);
}

echo "Synced property clean-up service images (cleanup2026g)\n";
echo 'Hero: '.($configCleanup['hero_image'] ?? 'missing')."\n";
echo 'Delete update-property-cleanup-images.php now.' . PHP_EOL;
