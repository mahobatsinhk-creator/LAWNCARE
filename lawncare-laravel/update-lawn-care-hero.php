<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-lawn-hero-2026';

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

$lawn = $serviceDetails['lawn-care-and-maintenance'] ?? [];
unset($lawn['hero_image']);

$serviceDetails['lawn-care-and-maintenance'] = $lawn;

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Removed lawn care hero poster image\n";
echo 'Delete update-lawn-care-hero.php now.' . PHP_EOL;
