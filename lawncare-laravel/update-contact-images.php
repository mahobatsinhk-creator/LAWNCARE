<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-contact-images-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$contact = config('site.contact', []);

SiteContent::saveFormData('contact', [
    'hero_image' => $contact['hero_image'] ?? '/assets/harmone/images/HjFE0k09aumATbaplUA1vVO2ZYa09e.png',
    'form_image' => $contact['form_image'] ?? null,
]);

echo "Updated contact hero and form images\n";
echo 'Delete update-contact-images.php now.' . PHP_EOL;
