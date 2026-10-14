<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-spring-fall-page-2026';

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

$serviceDetails['spring-fall-clean-up'] = config('site.service_details.spring-fall-clean-up');

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Updated spring & fall clean-up page offerings and removed duplicate features\n";
echo 'Delete update-spring-fall-page.php now.' . PHP_EOL;
