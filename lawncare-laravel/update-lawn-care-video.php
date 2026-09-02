<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-lawn-care-video-2026';

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

$video = '/videos/lawn-care-2026.mp4';
$updated = false;

foreach ($services as $index => $service) {
    if (($service['slug'] ?? '') !== 'lawn-care-and-maintenance') {
        continue;
    }

    $services[$index]['video'] = $video;
    $services[$index]['image'] = $video;
    $updated = true;
    break;
}

if (! $updated) {
    http_response_code(404);
    exit("lawn-care-and-maintenance service not found\n");
}

SiteContent::saveFormData('home', ['home_services' => $services]);

echo "Updated lawn care service video to {$video}\n";
echo 'Delete update-lawn-care-video.php now.' . PHP_EOL;
