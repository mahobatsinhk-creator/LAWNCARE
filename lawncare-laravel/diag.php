<?php
header('Content-Type: text/plain');
$logFile = __DIR__ . '/lawncare-app/storage/logs/laravel.log';
if (!file_exists($logFile)) {
    echo 'No log file';
    exit;
}
$log = file_get_contents($logFile);
if (preg_match_all('/local\.ERROR: (.+?) \{"exception"/s', $log, $matches)) {
    $last = end($matches[1]);
    echo trim($last) . PHP_EOL;
} else {
    echo substr($log, -8000);
}
