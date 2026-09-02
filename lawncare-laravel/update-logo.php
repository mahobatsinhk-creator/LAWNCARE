<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-logo-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$newLogo = '/assets/site/logo-header.png';

SiteContent::saveFormData('global', ['logo' => $newLogo]);

echo "Updated global logo to {$newLogo}\n";
echo 'Delete update-logo.php now.' . PHP_EOL;
