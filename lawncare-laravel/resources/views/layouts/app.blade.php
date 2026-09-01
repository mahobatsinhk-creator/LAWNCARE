<!DOCTYPE html>
<html lang="en-CA">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $site['name'])</title>
    <meta name="description" content="{{ $site['description'] }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon-32x32.png" type="image/png" sizes="32x32">
    <link rel="icon" href="/favicon.png" type="image/png" sizes="192x192">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://framerusercontent.com" crossorigin>
    <link rel="preconnect" href="https://d13cw1lxlociqy.cloudfront.net" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Roboto+Serif:opsz,wght@8..144,300;8..144,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full antialiased" data-header-solid="{{ request()->is('/') ? 'false' : 'true' }}">
    @include('partials.header')
    <main>@yield('content')</main>
    @include('partials.footer')
</body>
</html>
