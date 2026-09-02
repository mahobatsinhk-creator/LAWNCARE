<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-spring-fall-offerings-2026';

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

$serviceDetails['spring-fall-clean-up'] = array_merge(
    $serviceDetails['spring-fall-clean-up'] ?? [],
    [
        'intro_heading' => 'Our property clearing and debris removal services to help keep residential spaces clean and organized.',
        'hero_image' => 'https://framerusercontent.com/images/7yHE8ZVls3zmMFuteKMeGFFAjqQc19d.jpg',
        'offerings_lead' => 'From seasonal yard clean-ups to full property clear-outs, we handle the heavy work so your outdoor spaces stay tidy and usable.',
        'detail_offerings' => [
            [
                'title' => 'Yard Clean-Up',
                'body' => 'Thorough yard clean-up removes leaves, branches, clippings, and seasonal buildup from lawns, beds, and walkways.',
                'image' => '/assets/services/spring-fall-clean-up/yard-clean-up.png',
            ],
            [
                'title' => 'Property Debris Removal',
                'body' => 'We haul away accumulated yard debris and outdoor waste so your property stays clear, safe, and ready to enjoy.',
                'image' => '/assets/services/spring-fall-clean-up/property-debris-removal.png',
            ],
            [
                'title' => 'Estate and Bulk Item Removal',
                'body' => 'Large or bulky items are removed efficiently with the equipment and crew needed to handle heavier residential clean-ups.',
                'image' => '/assets/services/spring-fall-clean-up/estate-bulk-item-removal.png',
            ],
            [
                'title' => 'Property Clear-Out Services',
                'body' => 'Full property clear-outs restore order to cluttered yards, garages, and outdoor areas with complete removal and tidy results.',
                'image' => '/assets/services/spring-fall-clean-up/property-clear-out.png',
            ],
            [
                'title' => 'Site Clean-Up and Disposal',
                'body' => 'We finish every job with responsible disposal and a clean site, leaving your property organized and ready for the next season.',
                'image' => '/assets/services/spring-fall-clean-up/site-cleanup-disposal.png',
            ],
        ],
    ]
);

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Updated spring fall clean-up detail offerings\n";
echo 'Delete update-spring-fall-offerings.php now.' . PHP_EOL;
