<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-areas-grammar-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

SiteContent::saveFormData('home', [
    'areas_badge' => 'Where We Serve',
    'areas_title' => 'Serving Spruce Grove and Surrounding Alberta Communities',
]);

echo "Updated service areas grammar.\n";
echo 'Delete update-areas-grammar.php now.' . PHP_EOL;
