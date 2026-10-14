<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-snow-removal-sync-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$record = SiteContent::query()->where('section', 'services')->first();
$data = $record->data ?? [];
$serviceDetails = $data['service_details'] ?? [];

if (! is_array($serviceDetails)) {
    $serviceDetails = [];
}

$configSnow = config('site.service_details.snow-removal-services', []);

$serviceDetails['snow-removal-services'] = array_merge(
    $serviceDetails['snow-removal-services'] ?? [],
    $configSnow
);

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

$features = count($serviceDetails['snow-removal-services']['detail_features'] ?? []);

echo "Synced snow removal service from config ({$features} features)\n";
echo 'Delete update-snow-removal-sync.php now.' . PHP_EOL;
