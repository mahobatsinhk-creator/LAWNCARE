<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-snow-offerings-2026';

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

$serviceDetails['snow-removal-services'] = array_merge(
    $serviceDetails['snow-removal-services'] ?? [],
    [
        'intro_heading' => 'Reliable snow removal for Spruce Grove homeowners who need safe, accessible driveways and walkways all winter long.',
        'hero_image' => 'https://framerusercontent.com/images/Ts7fX9HQbPaf76tZcEItj2hZS0.jpg',
        'detail_offerings' => [
            [
                'title' => 'Driveway Clearing',
                'body' => 'We clear snow from residential driveways after every storm so you can leave and return home safely. Our crew removes packed snow and restores full vehicle access quickly.',
                'image' => '/assets/services/snow-removal/driveway-clearing.png',
            ],
            [
                'title' => 'Walkway & Sidewalk Clearing',
                'body' => 'Front steps, sidewalks, and side entrances are cleared with care to keep daily foot traffic safe. We focus on the paths your family uses most.',
                'image' => '/assets/services/snow-removal/walkway-sidewalk-clearing.png',
            ],
            [
                'title' => 'Manual Ice Chipping',
                'body' => 'When ice builds up on steps, landings, or walkways, we manually chip and remove it to reduce slip hazards that snow clearing alone cannot fix.',
                'image' => '/assets/services/snow-removal/manual-ice-chipping.png',
            ],
            [
                'title' => 'Walkway Safety Maintenance',
                'body' => 'We monitor high-traffic areas throughout the winter and maintain safe access with follow-up clearing, ice treatment, and attention to detail after each snowfall.',
                'image' => '/assets/services/snow-removal/walkway-safety-maintenance.png',
            ],
        ],
    ]
);

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Updated snow removal detail offerings\n";
echo 'Delete update-snow-removal-offerings.php now.' . PHP_EOL;
