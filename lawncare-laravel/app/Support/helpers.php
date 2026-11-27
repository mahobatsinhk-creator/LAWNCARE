<?php

use App\Support\ImageAlt;

if (! function_exists('site_image_alt')) {
    /**
     * Resolve SEO/GEO alt text for a site image by filename (and current page when needed).
     */
    function site_image_alt(?string $src, ?string $fallback = null): string
    {
        return ImageAlt::resolve($src, $fallback);
    }
}
