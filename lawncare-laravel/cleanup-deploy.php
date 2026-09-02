<?php
$root = __DIR__;
$keep = ['cleanup-deploy.php', 'lawncare-hostinger-deploy.zip', 'extract-deploy.php', 'setup-once.php', 'deploy.php'];

foreach (scandir($root) as $item) {
    if ($item === '.' || $item === '..') {
        continue;
    }
    if (in_array($item, $keep, true)) {
        continue;
    }
    $path = $root . DIRECTORY_SEPARATOR . $item;
    if (is_dir($path)) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($iterator as $file) {
            if ($file->isDir()) {
                @rmdir($file->getPathname());
            } else {
                @unlink($file->getPathname());
            }
        }
        @rmdir($path);
    } else {
        @unlink($path);
    }
}

echo 'Cleanup complete.';
