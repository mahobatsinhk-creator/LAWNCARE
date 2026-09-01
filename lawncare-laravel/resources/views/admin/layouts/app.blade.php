<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Lawn Care Admin</title>
    <link rel="icon" href="/favicon-32x32.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @yield('head')
    <link rel="stylesheet" href="/assets/admin/admin.css?v=7">
</head>
<body class="admin-body">
    <div class="admin-shell">
        <aside class="admin-sidebar">
            @php($logo = config('site.site.logo'))
            @php($siteName = config('site.site.name'))
            <div class="admin-brand">
                <img src="{{ $logo }}" alt="{{ $siteName }}" class="admin-brand__logo-img" width="56" height="56">
                <div>
                    <p class="admin-brand__title">Lawn Care Admin</p>
                    <p class="admin-brand__subtitle">Website Manager</p>
                </div>
            </div>

            <nav class="admin-nav">
                <p class="admin-nav__label">Main</p>
                <a href="{{ route('admin.dashboard') }}" class="admin-nav__link @if(request()->routeIs('admin.dashboard')) is-active @endif">
                    Dashboard
                </a>

                <p class="admin-nav__label">Management</p>
                <a href="{{ route('admin.services.index') }}" class="admin-nav__link @if(request()->routeIs('admin.services.*')) is-active @endif">
                    Services
                </a>
                <a href="{{ route('admin.leads.index') }}" class="admin-nav__link @if(request()->routeIs('admin.leads.*')) is-active @endif">
                    Leads
                </a>
                <a href="{{ route('admin.inquiries.index') }}" class="admin-nav__link @if(request()->routeIs('admin.inquiries.*')) is-active @endif">
                    Contact Inquiry
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="admin-nav__link @if(request()->routeIs('admin.blogs.*')) is-active @endif">
                    Blogs
                </a>

                <p class="admin-nav__label">Website</p>
                <a href="{{ route('admin.content.index') }}" class="admin-nav__link @if(request()->routeIs('admin.content.*')) is-active @endif">
                    Website Content
                </a>
            </nav>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <div>
                    <h1 class="admin-topbar__title">@yield('heading', 'Dashboard')</h1>
                    @hasSection('subheading')
                        <p class="admin-topbar__subtitle">@yield('subheading')</p>
                    @endif
                </div>
                <div class="admin-topbar__actions">
                    <a href="/" class="admin-link" target="_blank" rel="noopener">View site</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="admin-btn admin-btn--ghost">Logout</button>
                    </form>
                </div>
            </header>

            @if (session('success'))
                <div class="admin-alert admin-alert--success">{{ session('success') }}</div>
            @endif

            <main class="admin-content">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
