<?php

/**
 * One-shot content sync from config/site.php into CMS tables.
 * Run: php apply-exact-replacement-content.php
 */

use Database\Seeders\BlogSeeder;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/vendor/autoload.php';

$app = require __DIR__.'/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

(new SiteContentSeeder)->run();
(new BlogSeeder)->run();

echo "Site content and blog titles synced from config/site.php\n";
