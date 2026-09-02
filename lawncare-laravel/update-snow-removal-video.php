<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-snow-removal-video-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$record = SiteContent::query()->where('section', 'home')->first();
$data = $record->data ?? [];
$services = $data['home_services'] ?? config('site.home_services');

if (! is_array($services)) {
    http_response_code(500);
    exit("home_services is not an array\n");
}

$video = '/videos/snow-removal-2026.mp4';
$updated = false;

foreach ($services as $index => $service) {
    if (($service['slug'] ?? '') !== 'snow-removal-services') {
        continue;
    }

    $services[$index]['video'] = $video;
    $services[$index]['image'] = $video;
    $updated = true;
    break;
}

if (! $updated) {
    http_response_code(404);
    exit("snow-removal-services service not found\n");
}

SiteContent::saveFormData('home', ['home_services' => $services]);

echo "Updated snow removal service video to {$video}\n";
echo 'Delete update-snow-removal-video.php now.' . PHP_EOL;
