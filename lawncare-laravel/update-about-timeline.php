<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-about-timeline-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$timeline = [
    ['year' => '2012', 'icon' => 'founding', 'title' => 'Where it all began', 'text' => 'Our team was founded with a vision to provide reliable, all-season property care for Alberta homeowners.'],
    ['year' => '2017', 'icon' => 'growth', 'title' => 'Growing together', 'text' => 'Expanded our services and team to deliver exceptional lawn care and snow removal across the region.'],
    ['year' => '2024', 'icon' => 'future', 'title' => 'Shaping the future', 'text' => 'Continuing to serve Spruce Grove and surrounding communities with one dedicated crew for every season.'],
];

SiteContent::saveFormData('about', ['about_timeline' => $timeline]);

echo "Updated about timeline icons.\n";
echo 'Delete update-about-timeline.php now.' . PHP_EOL;
