<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-clear-views-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$viewsPath = __DIR__ . '/lawncare-app/storage/framework/views';
$count = 0;

foreach (glob($viewsPath . '/*.php') ?: [] as $file) {
    if (is_file($file) && unlink($file)) {
        $count++;
    }
}

echo "Cleared {$count} compiled views.\n";
echo 'Delete clear-views.php now.' . PHP_EOL;
