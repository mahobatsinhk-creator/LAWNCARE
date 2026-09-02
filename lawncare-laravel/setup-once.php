<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Artisan;

header('Content-Type: text/plain');

try {
    Artisan::call('migrate', ['--force' => true]);
    echo Artisan::output() . PHP_EOL;
    Artisan::call('db:seed', ['--force' => true]);
    echo Artisan::output() . PHP_EOL;
    echo 'Admin setup complete. Delete this file now.' . PHP_EOL;
} catch (Throwable $exception) {
    http_response_code(500);
    echo 'Setup failed: ' . $exception->getMessage();
}
