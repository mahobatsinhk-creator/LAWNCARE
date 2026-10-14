<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;
use Illuminate\Support\Str;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-fix-media-urls-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$uploadDir = public_path('assets/uploads');
if (! is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$storageRoot = storage_path('app/public');
$fixed = 0;

$replaceUrls = function (&$value) use (&$replaceUrls, $uploadDir, $storageRoot, &$fixed): void {
    if (is_array($value)) {
        foreach ($value as $key => $item) {
            $replaceUrls($value[$key]);
        }

        return;
    }

    if (! is_string($value) || ! str_contains($value, '/storage/')) {
        return;
    }

    $path = parse_url($value, PHP_URL_PATH) ?: $value;
    $relative = ltrim(str_replace('/storage/', '', $path), '/');
    $source = $storageRoot.'/'.$relative;

    if (! is_file($source)) {
        return;
    }

    $extension = pathinfo($source, PATHINFO_EXTENSION) ?: 'jpg';
    $filename = Str::uuid()->toString().'.'.$extension;
    $target = $uploadDir.'/'.$filename;

    if (! copy($source, $target)) {
        return;
    }

    $value = '/assets/uploads/'.$filename;
    $fixed++;
};

foreach (SiteContent::query()->get() as $record) {
    $data = $record->data ?? [];
    $replaceUrls($data);
    $record->update(['data' => $data]);
}

echo "Fixed {$fixed} broken /storage/ media URLs.\n";
echo 'Delete fix-broken-media-urls.php now.' . PHP_EOL;
