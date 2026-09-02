<?php
$zip = __DIR__ . '/lawncare-hostinger-deploy.zip';
if (!file_exists($zip)) {
    http_response_code(404);
    exit('Deploy zip not found.');
}

$zipArchive = new ZipArchive();
if ($zipArchive->open($zip) !== true) {
    http_response_code(500);
    exit('Unable to open deploy zip.');
}

$zipArchive->extractTo(__DIR__);
$zipArchive->close();

@unlink($zip);
@unlink(__FILE__);

echo 'Deploy extracted successfully. Remove this message by reloading the homepage.';
