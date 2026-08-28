# Start the Laravel site locally
Set-Location $PSScriptRoot

Write-Host ""
Write-Host "  Lawn Care Laravel — local dev" -ForegroundColor Green
Write-Host ""

if (-not (Test-Path "public\build\manifest.json")) {
    Write-Host "  Building CSS/JS (first run)..." -ForegroundColor Yellow
    npm run build
}

Write-Host "  Open in your browser:" -ForegroundColor Cyan
Write-Host "  http://127.0.0.1:8000" -ForegroundColor White
Write-Host ""
Write-Host "  (Not localhost:3001 — that was the old Next.js project)" -ForegroundColor DarkGray
Write-Host "  Press Ctrl+C to stop" -ForegroundColor DarkGray
Write-Host ""

php artisan serve --host=127.0.0.1 --port=8000
