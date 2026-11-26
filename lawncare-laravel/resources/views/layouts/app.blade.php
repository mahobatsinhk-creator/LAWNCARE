<!DOCTYPE html>
<html lang="en-CA">
<head>
    {{-- Google Analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2LNF0VLKW6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-2LNF0VLKW6');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        // @section('title', $value) HTML-escapes once; decode before {{ }} so &amp; is not double-encoded.
        $decodeMeta = static function (string $value): string {
            $value = html_entity_decode(trim($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            // Prefer plain "and" in titles/previews — never show literal &amp;
            return preg_replace('/\s*&\s*/', ' and ', $value) ?? $value;
        };
        $pageTitle = $decodeMeta($__env->yieldContent('title', $site['name'] ?? 'Lawn Care and Snow Removal Experts'));
        $pageDescription = $decodeMeta($__env->yieldContent('meta_description', $site['description'] ?? ''));
        $canonicalUrl = trim(html_entity_decode($__env->yieldContent('canonical', url()->current()), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $ogImageRaw = trim(html_entity_decode($__env->yieldContent('og_image', $site['logo'] ?? '/assets/site/logo-header.png'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $ogImage = str_starts_with($ogImageRaw, 'http') ? $ogImageRaw : url($ogImageRaw);
        $ogType = trim(html_entity_decode($__env->yieldContent('og_type', 'website'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $siteUrl = rtrim($site['url'] ?? config('app.url'), '/');
        $siteName = $decodeMeta($site['name'] ?? 'Lawn Care and Snow Removal Experts');
    @endphp
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:locale" content="en_CA">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $ogImage }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <link rel="icon" href="/favicon-32x32.png" type="image/png" sizes="32x32">
    <link rel="icon" href="/favicon.png" type="image/png" sizes="192x192">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://framerusercontent.com" crossorigin>
    <link rel="preconnect" href="https://d13cw1lxlociqy.cloudfront.net" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Roboto+Serif:opsz,wght@8..144,300;8..144,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-full antialiased" data-header-solid="{{ request()->is('/') ? 'false' : 'true' }}">
    @include('partials.header')
    <main>@yield('content')</main>
    @include('partials.footer')
</body>
</html>