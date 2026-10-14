<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-snow-images-2026f';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$configSnow = config('site.service_details.snow-removal-services', []);

$servicesRecord = SiteContent::query()->where('section', 'services')->first();
$serviceDetails = $servicesRecord->data['service_details'] ?? [];

if (! is_array($serviceDetails)) {
    $serviceDetails = [];
}

$serviceDetails['snow-removal-services'] = array_merge(
    $serviceDetails['snow-removal-services'] ?? [],
    $configSnow
);

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

$homeRecord = SiteContent::query()->where('section', 'home')->first();
$homeData = $homeRecord->data ?? [];
$homeServices = $homeData['home_services'] ?? config('site.home_services', []);
$cardImage = $configSnow['hero_image'] ?? '/assets/services/snow-removal/snow-removal-card.jpg?v=snow2026d';

if (is_array($homeServices)) {
    foreach ($homeServices as $index => $service) {
        if (($service['slug'] ?? '') !== 'snow-removal-services') {
            continue;
        }

        $homeServices[$index]['image'] = $cardImage;
        unset($homeServices[$index]['video']);
        break;
    }

    SiteContent::saveFormData('home', ['home_services' => $homeServices]);
}

$contactRecord = SiteContent::query()->where('section', 'contact')->first();
$contactData = $contactRecord->data ?? [];
$formImage = config('site.contact.form_image');

if (is_array($contactData)) {
    $contactData['form_image'] = $formImage;
    SiteContent::saveFormData('contact', $contactData);
}

echo "Synced snow removal service images (snow2026f)\n";
echo 'Hero: '.($configSnow['hero_image'] ?? 'missing')."\n";
echo 'Delete update-snow-removal-images.php now.' . PHP_EOL;
