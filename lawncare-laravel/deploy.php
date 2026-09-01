<?php

declare(strict_types=1);

/**
 * Hostinger deploy helper with batch zip extraction.
 * Upload deploy.php + lawncare-hostinger-deploy.zip to public_html, then open /deploy.php
 */

header('Content-Type: text/html; charset=utf-8');
set_time_limit(120);
ini_set('memory_limit', '256M');

use Illuminate\Support\Facades\Artisan;

$root = __DIR__;
$zip = $root . '/lawncare-hostinger-deploy.zip';
$action = $_GET['action'] ?? 'extract';
$batchSize = 25;

function deploy_page_start(string $title): void
{
    echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>' . htmlspecialchars($title) . '</title>';
    echo '<style>body{font-family:system-ui,sans-serif;max-width:720px;margin:40px auto;padding:0 16px;line-height:1.5}pre{background:#f3f4f6;padding:12px;border-radius:8px;overflow:auto}.ok{color:#047857}.warn{color:#b45309}</style>';
    echo '</head><body>';
}

function deploy_page_end(): void
{
    echo '</body></html>';
}

function deploy_redirect(string $url, int $seconds = 1): void
{
    echo '<p>Continuing automatically in ' . $seconds . ' second(s)…</p>';
    echo '<p><a href="' . htmlspecialchars($url) . '">Click here if nothing happens</a></p>';
    echo '<script>setTimeout(function(){ window.location.href=' . json_encode($url) . '; }, ' . ($seconds * 1000) . ');</script>';
}

function deploy_log(string $message): void
{
    echo htmlspecialchars($message) . "<br>\n";
    if (function_exists('ob_flush')) {
        @ob_flush();
    }
    flush();
}

if ($action === 'extract') {
    deploy_page_start('Extracting site');

    if (! file_exists($zip)) {
        if (is_dir($root . '/lawncare-app')) {
            deploy_log('Zip already extracted. Starting setup…');
            deploy_redirect('deploy.php?action=setup');
            deploy_page_end();
            exit;
        }

        http_response_code(404);
        deploy_log('ERROR: lawncare-hostinger-deploy.zip not found in public_html.');
        deploy_log('Upload the zip file first, then reload this page.');
        deploy_page_end();
        exit;
    }

    if (! class_exists('ZipArchive')) {
        http_response_code(500);
        deploy_log('ERROR: ZipArchive is not enabled on this server.');
        deploy_page_end();
        exit;
    }

    $offset = max(0, (int) ($_GET['offset'] ?? 0));
    $archive = new ZipArchive();
    $opened = $archive->open($zip);

    if ($opened !== true) {
        http_response_code(500);
        deploy_log('ERROR: Could not open zip (code ' . $opened . ').');
        deploy_page_end();
        exit;
    }

    $total = $archive->numFiles;
    $end = min($offset + $batchSize, $total);
    $sizeMb = round(filesize($zip) / 1024 / 1024, 1);
    $percent = $total > 0 ? round(($end / $total) * 100) : 100;

    echo '<h1>Extracting files</h1>';
    echo '<p>Zip size: <strong>' . $sizeMb . ' MB</strong></p>';
    echo '<p>Progress: <strong>' . $end . ' / ' . $total . '</strong> (' . $percent . '%)</p>';
    echo '<pre>';

    $entries = [];
    for ($index = $offset; $index < $end; $index++) {
        $name = $archive->getNameIndex($index);
        if ($name === false) {
            continue;
        }

        $entries[] = $name;
        echo $name . "\n";

        if (str_ends_with($name, '/')) {
            $dir = $root . '/' . rtrim($name, '/');
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }
    }

    if ($entries !== []) {
        $extracted = $archive->extractTo($root, $entries);
        if (! $extracted) {
            $archive->close();
            echo "</pre>\n";
            deploy_log('ERROR: Batch extract failed at file ' . $offset . '.');
            deploy_log('Try again from: deploy.php?action=extract&offset=' . $offset);
            deploy_page_end();
            exit;
        }
    }

    $archive->close();
    echo "</pre>\n";

    if ($end < $total) {
        $next = 'deploy.php?action=extract&offset=' . $end;
        deploy_redirect($next);
    } else {
        @unlink($zip);
        deploy_log('<span class="ok">Extract complete.</span>');
        deploy_redirect('deploy.php?action=setup', 2);
    }

    deploy_page_end();
    exit;
}

if ($action === 'setup') {
    header('Content-Type: text/plain; charset=utf-8');
    set_time_limit(120);

    $appPath = $root . '/lawncare-app';
    $autoload = $appPath . '/vendor/autoload.php';

    if (! file_exists($autoload)) {
        http_response_code(500);
        exit("ERROR: lawncare-app not found.\nOpen deploy.php?action=extract first.\n");
    }

    require $autoload;
    $app = require $appPath . '/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    try {
        deploy_log('Running database migrations...');
        Artisan::call('migrate', ['--force' => true]);
        echo Artisan::output() . PHP_EOL;

        deploy_log('Creating admin user...');
        Artisan::call('db:seed', ['--force' => true]);
        echo Artisan::output() . PHP_EOL;

        echo PHP_EOL . 'SUCCESS — site is deployed.' . PHP_EOL;
        echo 'Homepage: /' . PHP_EOL;
        echo 'Admin login: /admin/login' . PHP_EOL;
        echo 'Email: admin@lawncareandsnowremovalexperts.com' . PHP_EOL;
        echo 'Password: Admin@12345' . PHP_EOL;
        echo PHP_EOL . 'Delete deploy.php and cleanup-deploy.php from public_html now.' . PHP_EOL;
    } catch (Throwable $exception) {
        http_response_code(500);
        exit('Setup failed: ' . $exception->getMessage() . PHP_EOL);
    }

    exit;
}

http_response_code(400);
exit("Unknown action. Use deploy.php?action=extract\n");
