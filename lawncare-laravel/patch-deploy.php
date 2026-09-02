<?php

declare(strict_types=1);

/**
 * One-time HTTPS patch deploy helper.
 * Open /patch-deploy.php?key=lawncare-patch-2026 after uploading this file to public_html.
 */

header('Content-Type: text/plain; charset=utf-8');
set_time_limit(120);

const PATCH_KEY = 'lawncare-patch-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$root = __DIR__;
$zipUrl = $_GET['zip'] ?? '';

if ($zipUrl === '') {
    exit("Missing zip query parameter.\n");
}

if (! filter_var($zipUrl, FILTER_VALIDATE_URL)) {
    http_response_code(400);
    exit("Invalid zip URL.\n");
}

$zipPath = $root . '/patch-deploy-temp.zip';
$zipData = @file_get_contents($zipUrl);

if ($zipData === false) {
    http_response_code(500);
    exit("Could not download zip.\n");
}

file_put_contents($zipPath, $zipData);

if (! class_exists('ZipArchive')) {
    http_response_code(500);
    exit("ZipArchive not available.\n");
}

$archive = new ZipArchive();
$opened = $archive->open($zipPath);

if ($opened !== true) {
    http_response_code(500);
    exit('Could not open zip (code ' . $opened . ").\n";
}

$archive->extractTo($root);
$archive->close();
@unlink($zipPath);

echo "Patch deployed successfully.\n";
echo "Delete patch-deploy.php and patch zip from public_html now.\n";
