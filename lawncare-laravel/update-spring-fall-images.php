<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-seasonal-images-2026f';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$configSeasonal = config('site.service_details.spring-fall-clean-up', []);

$servicesRecord = SiteContent::query()->where('section', 'services')->first();
$serviceDetails = $servicesRecord->data['service_details'] ?? [];

if (! is_array($serviceDetails)) {
    $serviceDetails = [];
}

$serviceDetails['spring-fall-clean-up'] = array_merge(
    $serviceDetails['spring-fall-clean-up'] ?? [],
    $configSeasonal
);

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

$homeRecord = SiteContent::query()->where('section', 'home')->first();
$homeData = $homeRecord->data ?? [];
$homeServices = $homeData['home_services'] ?? config('site.home_services', []);
$cardImage = $configSeasonal['hero_image'] ?? '/assets/services/spring-fall-clean-up/spring-fall-cleanup-card.jpg?v=seasonal2026f';

if (is_array($homeServices)) {
    foreach ($homeServices as $index => $service) {
        if (($service['slug'] ?? '') !== 'spring-fall-clean-up') {
            continue;
        }

        $homeServices[$index]['image'] = $cardImage;
        unset($homeServices[$index]['video']);
        break;
    }

    SiteContent::saveFormData('home', ['home_services' => $homeServices]);
}

echo "Synced spring & fall clean-up service images (seasonal2026f)\n";
echo 'Hero: '.($configSeasonal['hero_image'] ?? 'missing')."\n";
echo 'Delete update-spring-fall-images.php now.' . PHP_EOL;
