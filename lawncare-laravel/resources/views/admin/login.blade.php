<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — Lawn Care Admin</title>
    <link rel="icon" href="/favicon-32x32.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/admin/admin.css?v=7">
</head>
<body class="admin-login-body">
    <div class="admin-login-card">
        @php($logo = config('site.site.logo'))
        @php($siteName = config('site.site.name'))
        <div class="admin-brand admin-brand--center">
            <img src="{{ $logo }}" alt="{{ $siteName }}" class="admin-brand__logo-img" width="72" height="72">
            <div>
                <p class="admin-brand__title">Lawn Care Admin</p>
                <p class="admin-brand__subtitle">Sign in to manage your website</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="admin-alert admin-alert--error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="admin-login-form">
            @csrf
            <label class="admin-field">
                <span>Email</span>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </label>
            <label class="admin-field">
                <span>Password</span>
                <input type="password" name="password" required>
            </label>
            <label class="admin-check">
                <input type="checkbox" name="remember" value="1">
                <span>Remember me</span>
            </label>
            <button type="submit" class="admin-btn admin-btn--primary admin-btn--full">Sign in</button>
        </form>
    </div>
</body>
</html>
