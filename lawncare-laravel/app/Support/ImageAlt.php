<?php

namespace App\Support;

class ImageAlt
{
    public static function resolve(?string $src, ?string $fallback = null): string
    {
        if ($src === null || $src === '') {
            return $fallback ?? '';
        }

        $path = parse_url($src, PHP_URL_PATH) ?: $src;
        $filename = basename($path);
        $map = config('image_alts', []);

        if (! array_key_exists($filename, $map)) {
            return $fallback ?? '';
        }

        $entry = $map[$filename];

        if (is_string($entry)) {
            return $entry;
        }

        if (! is_array($entry)) {
            return $fallback ?? '';
        }

        $pageKey = self::pageKey();

        if (isset($entry[$pageKey]) && is_string($entry[$pageKey])) {
            return $entry[$pageKey];
        }

        if (isset($entry['_default']) && is_string($entry['_default'])) {
            return $entry['_default'];
        }

        return $fallback ?? '';
    }

    protected static function pageKey(): string
    {
        $path = trim(request()->path(), '/');

        if ($path === '' || $path === '/') {
            return '/';
        }

        return $path;
    }
}
