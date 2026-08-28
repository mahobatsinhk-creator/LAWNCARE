# Package lawncare-laravel for upload to PHP hosting (cPanel, VPS, etc.)
Set-Location $PSScriptRoot
$ErrorActionPreference = "Stop"

Write-Host ""
Write-Host "  Building production assets..." -ForegroundColor Yellow
npm run build

Write-Host "  Creating deploy zip..." -ForegroundColor Yellow
$zipPath = Join-Path $PSScriptRoot "lawncare-laravel-deploy.zip"
if (Test-Path $zipPath) { Remove-Item $zipPath -Force }

$exclude = @(
    "node_modules\*",
    ".git\*",
    "storage\logs\*",
    "storage\framework\cache\data\*",
    "storage\framework\sessions\*",
    "storage\framework\views\*",
    "tests\*",
    ".env",
    "lawncare-laravel-deploy.zip"
)

$items = Get-ChildItem -Path $PSScriptRoot -Force | Where-Object {
    $_.Name -notin @("node_modules", ".git", "lawncare-laravel-deploy.zip")
}

Compress-Archive -Path $items.FullName -DestinationPath $zipPath -Force

Write-Host ""
Write-Host "  Done: $zipPath" -ForegroundColor Green
Write-Host ""
Write-Host "  Upload steps (cPanel / shared hosting):" -ForegroundColor Cyan
Write-Host "  1. Upload and extract the zip to your server"
Write-Host "  2. Point the domain document root to the public/ folder"
Write-Host "  3. Copy .env.example to .env and set:"
Write-Host "       APP_ENV=production"
Write-Host "       APP_DEBUG=false"
Write-Host "       APP_URL=https://lawncareandsnowremovalexperts.com"
Write-Host "  4. Run on server: composer install --no-dev --optimize-autoloader"
Write-Host "  5. Run on server: php artisan key:generate"
Write-Host "  6. Run on server: php artisan migrate --force"
Write-Host "  7. Run on server: php artisan config:cache && php artisan route:cache && php artisan view:cache"
Write-Host ""
