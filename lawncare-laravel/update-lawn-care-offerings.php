<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-lawn-offerings-2026';

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

$serviceDetails['lawn-care-and-maintenance'] = array_merge(
    $serviceDetails['lawn-care-and-maintenance'] ?? [],
    [
        'intro_heading' => 'Professional lawn services designed to keep your property healthy, clean, and well maintained throughout the growing season.',
        'hero_image' => 'https://framerusercontent.com/images/ViXmTB1nT2P2h03owWL2ciH4WY.jpg',
        'offerings_lead' => 'Our lawn care program covers the essential services your yard needs to stay lush, green, and well groomed from spring through fall.',
        'detail_offerings' => [
            [
                'title' => 'Lawn Mowing and Trimming',
                'body' => 'Regular mowing at the proper height, with trimming around beds, fences, and obstacles for a clean, finished look every visit.',
                'image' => '/assets/services/lawn-care/lawn-mowing-trimming.png',
            ],
            [
                'title' => 'Lawn Edging',
                'body' => 'Crisp edging along sidewalks, driveways, and landscape borders gives your lawn a polished, professionally maintained appearance.',
                'image' => '/assets/services/lawn-care/lawn-edging.png',
            ],
            [
                'title' => 'Fertilizer Application',
                'body' => 'Seasonal fertilizer treatments nourish your turf and support strong, healthy growth throughout the growing season.',
                'image' => '/assets/services/lawn-care/fertilizer-application.png',
            ],
            [
                'title' => 'Aeration',
                'body' => 'Core aeration reduces soil compaction and improves water, air, and nutrient flow to grass roots for a healthier lawn.',
                'image' => '/assets/services/lawn-care/aeration.png',
            ],
            [
                'title' => 'Power Raking',
                'body' => 'Power raking removes dead thatch buildup so your lawn can breathe and green up more effectively each spring.',
                'image' => '/assets/services/lawn-care/power-raking.png',
            ],
            [
                'title' => 'Overseeding',
                'body' => 'Overseeding fills thin or bare areas with fresh grass seed to create a thicker, more resilient lawn over time.',
                'image' => '/assets/services/lawn-care/overseeding.png',
            ],
            [
                'title' => 'Lawn Patch Restoration',
                'body' => 'Targeted patch repair restores damaged or worn sections of turf back to a healthy, even surface you can enjoy.',
                'image' => '/assets/services/lawn-care/lawn-patch-restoration.png',
            ],
        ],
    ]
);

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Updated lawn care detail offerings\n";
echo 'Delete update-lawn-care-offerings.php now.' . PHP_EOL;
