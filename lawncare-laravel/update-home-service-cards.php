<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-home-service-cards-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$configServices = config('site.home_services', []);
$record = SiteContent::query()->where('section', 'home')->first();
$data = $record->data ?? [];
$services = $data['home_services'] ?? $configServices;

if (! is_array($services)) {
    http_response_code(500);
    exit("home_services is not an array\n");
}

$slugs = [
    'snow-removal-services',
    'lawn-care-and-maintenance',
    'property-cleanup-and-maintenance',
    'spring-fall-clean-up',
];

$configBySlug = collect($configServices)->keyBy('slug');
$updated = [];

foreach ($services as $index => $service) {
    $slug = $service['slug'] ?? '';

    if (! in_array($slug, $slugs, true)) {
        continue;
    }

    $configService = $configBySlug->get($slug);

    if (! is_array($configService)) {
        continue;
    }

    $services[$index]['image'] = $configService['image'];
    unset($services[$index]['video']);
    $updated[] = $slug . ' => ' . $configService['image'];
}

SiteContent::saveFormData('home', ['home_services' => $services]);

$servicesRecord = SiteContent::query()->where('section', 'services')->first();
$serviceDetails = $servicesRecord->data['service_details'] ?? [];

if (! is_array($serviceDetails)) {
    $serviceDetails = [];
}

foreach ($slugs as $slug) {
    $configDetail = config("site.service_details.{$slug}");

    if (! is_array($configDetail)) {
        continue;
    }

    $serviceDetails[$slug] = array_merge(
        $serviceDetails[$slug] ?? [],
        [
            'hero_image' => $configDetail['hero_image'] ?? null,
            'video' => null,
        ]
    );
}

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Updated homepage service card images:\n";
echo implode("\n", $updated) . "\n";
echo 'Delete update-home-service-cards.php now.' . PHP_EOL;
