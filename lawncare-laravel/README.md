# Lawn Care — Laravel (Harmone Template)

Laravel 12 + Blade + Tailwind 4 port of the Harmone homepage with real business content from [lawncareandsnowremovalexperts.com](https://lawncareandsnowremovalexperts.com/).

## Stack

- **PHP 8.2+** / **Laravel 12**
- **Blade** templates
- **Tailwind CSS 4** via Vite
- Content in `config/site.php`

## Run locally

**Easiest — one command:**

```powershell
cd c:\Users\mahob\Dev\lawncare-laravel
.\start.ps1
```

Then open **http://127.0.0.1:8000** in your browser.

> **Important:** This is Laravel on port **8000**, not the old Next.js site on port 3001.

**Alternative:**

```powershell
cd c:\Users\mahob\Dev\lawncare-laravel
composer run serve
```

Or with live CSS reload:

```powershell
composer run dev
```

## Production build

```powershell
npm run build
php artisan serve
```

## Canva photos

Drop exports into `public/images/` and update image URLs in `config/site.php`.

## Previous Next.js builds

- `lawncare-harmone` — Next.js Harmone prototype (deprecated)
- `lawncare` — Original Next.js site with admin panel
