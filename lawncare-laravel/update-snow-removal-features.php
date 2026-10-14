<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-snow-features-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$record = SiteContent::query()->where('section', 'services')->first();
$data = $record->data ?? [];
$serviceDetails = $data['service_details'] ?? config('site.service_details');

if (! is_array($serviceDetails)) {
    $serviceDetails = config('site.service_details', []);
}

$snow = $serviceDetails['snow-removal-services'] ?? [];
unset($snow['hero_image'], $snow['mid_image']);

$snow['detail_features'] = [
    [
        'title' => 'Ice melt application',
        'body' => 'Targeted ice melt helps reduce slippery surfaces on steps, walkways, and high-traffic areas around your home.',
        'image' => '/assets/services/snow-removal/ice-melt-application.png?v=features2026',
    ],
    [
        'title' => 'Prompt storm response',
        'body' => 'Our crew responds after snowfall events to restore access quickly and keep your property functional.',
        'image' => '/assets/services/snow-removal/prompt-storm-response.png?v=features2026',
    ],
    [
        'title' => 'Residential snow service',
        'body' => 'We focus on residential properties across Spruce Grove, Edmonton, Stony Plain, and nearby communities.',
        'image' => '/assets/services/snow-removal/residential-snow-service.png?v=features2026',
    ],
    [
        'title' => 'One crew, every season',
        'body' => 'The same dependable team handles your property year-round—from summer lawn care to winter snow removal.',
        'image' => '/assets/services/snow-removal/one-crew-every-season.png?v=features2026',
    ],
];

$serviceDetails['snow-removal-services'] = $snow;

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Updated snow removal detail features\n";
echo 'Delete update-snow-removal-features.php now.' . PHP_EOL;
