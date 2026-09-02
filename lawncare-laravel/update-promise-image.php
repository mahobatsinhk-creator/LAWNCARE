<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-promise-image-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$newImage = 'https://d13cw1lxlociqy.cloudfront.net/ayylkpoa4i1f13zj8lduror8y6aw';

SiteContent::saveFormData('global', ['promise_image' => $newImage]);
SiteContent::saveFormData('home', ['promise_image' => $newImage]);

echo "Updated promise/areas image to {$newImage}\n";
echo 'Delete update-promise-image.php now.' . PHP_EOL;
