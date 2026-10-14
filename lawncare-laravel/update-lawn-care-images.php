<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-lawn-images-2026f';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$configLawn = config('site.service_details.lawn-care-and-maintenance', []);

$servicesRecord = SiteContent::query()->where('section', 'services')->first();
$serviceDetails = $servicesRecord->data['service_details'] ?? [];

if (! is_array($serviceDetails)) {
    $serviceDetails = [];
}

$serviceDetails['lawn-care-and-maintenance'] = array_merge(
    $serviceDetails['lawn-care-and-maintenance'] ?? [],
    $configLawn
);

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

$homeRecord = SiteContent::query()->where('section', 'home')->first();
$homeData = $homeRecord->data ?? [];
$homeServices = $homeData['home_services'] ?? config('site.home_services', []);
$cardImage = $configLawn['hero_image'] ?? '/assets/services/lawn-care/lawn-care-card.jpg?v=lawn2026e';

if (is_array($homeServices)) {
    foreach ($homeServices as $index => $service) {
        if (($service['slug'] ?? '') !== 'lawn-care-and-maintenance') {
            continue;
        }

        $homeServices[$index]['image'] = $cardImage;
        unset($homeServices[$index]['video']);
        break;
    }

    SiteContent::saveFormData('home', ['home_services' => $homeServices]);
}

echo "Synced lawn care service images (lawn2026f)\n";
echo 'Hero: '.($configLawn['hero_image'] ?? 'missing')."\n";
echo 'Delete update-lawn-care-images.php now.' . PHP_EOL;
