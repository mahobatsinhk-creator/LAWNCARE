<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;
use Illuminate\Support\Str;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-service-headings-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$serviceDetails = config('site.service_details', []);
$updatedTitles = 0;

foreach ($serviceDetails as $slug => $service) {
    foreach (['detail_offerings', 'detail_features'] as $section) {
        if (! is_array($service[$section] ?? null)) {
            continue;
        }

        foreach ($service[$section] as $index => $item) {
            if (! isset($item['title'])) {
                continue;
            }

            $serviceDetails[$slug][$section][$index]['title'] = Str::title($item['title']);
            $updatedTitles++;
        }
    }
}

SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

echo "Updated {$updatedTitles} service card titles across all service pages.\n";
echo 'Delete update-service-headings.php now.' . PHP_EOL;
