<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Support\MediaStorage;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-fix-blog-uploads-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$copied = MediaStorage::syncExistingUploads();

echo "Copied {$copied} upload file(s) to web-accessible assets/uploads.\n";
echo 'Delete fix-blog-uploads.php now.' . PHP_EOL;
