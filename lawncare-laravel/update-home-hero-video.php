<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-home-hero-video-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$video = 'https://framerusercontent.com/assets/BbBrpYmkGRxDlha1JE84gb3ri0.mp4';

SiteContent::saveFormData('global', ['hero_video' => $video]);
SiteContent::saveFormData('home', ['hero_video' => $video]);

echo "Updated homepage hero video to {$video}\n";
echo 'Delete update-home-hero-video.php now.' . PHP_EOL;
