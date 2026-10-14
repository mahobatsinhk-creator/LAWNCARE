<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-service-images-nologo-2026';

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

foreach (config('site.service_details', []) as $slug => $configService) {
    $serviceDetails[$slug] = array_merge($serviceDetails[$slug] ?? [], $configService);
}

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Synced all service detail images from config (nologo2026)\n";
echo 'Delete update-service-images-nologo.php now.' . PHP_EOL;
