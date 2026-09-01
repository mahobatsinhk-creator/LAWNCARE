# Package Laravel app for Hostinger with Unix-safe zip paths
Set-Location $PSScriptRoot
$ErrorActionPreference = "Stop"
Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

Write-Host "Building production assets..." -ForegroundColor Yellow
npm run build | Out-Null

$staging = Join-Path $env:TEMP "lawncare-hostinger-staging"
if (Test-Path $staging) { Remove-Item $staging -Recurse -Force }
New-Item -ItemType Directory -Path $staging | Out-Null

$appDest = Join-Path $staging "lawncare-app"
New-Item -ItemType Directory -Path $appDest | Out-Null

$exclude = @("node_modules", ".git", "tests", "public", "lawncare-hostinger-deploy.zip", "deploy.ps1", "ftp-deploy.ps1", "hostinger-pack.ps1", "start.ps1", "extract-deploy.php", "cleanup-deploy.php")
Get-ChildItem -Path $PSScriptRoot -Force | Where-Object { $_.Name -notin $exclude } | ForEach-Object {
    Copy-Item -Path $_.FullName -Destination $appDest -Recurse -Force
}

Copy-Item -Path (Join-Path $PSScriptRoot "public\*") -Destination $staging -Recurse -Force

foreach ($helper in @('cleanup-deploy.php', 'extract-deploy.php', 'setup-once.php', 'setup-content.php', 'setup-blogs.php', 'deploy.php')) {
    Copy-Item -Path (Join-Path $PSScriptRoot $helper) -Destination (Join-Path $staging $helper) -Force
}

$appPublicDest = Join-Path $appDest "public"
if (Test-Path $appPublicDest) { Remove-Item $appPublicDest -Recurse -Force }
New-Item -ItemType Directory -Path $appPublicDest | Out-Null
# Laravel only needs the Vite build manifest inside lawncare-app/public (web assets live at web root).
Copy-Item -Path (Join-Path $PSScriptRoot "public\build") -Destination (Join-Path $appPublicDest "build") -Recurse -Force

$indexPath = Join-Path $staging "index.php"
$indexContent = Get-Content $indexPath -Raw
$indexContent = $indexContent.Replace("__DIR__.'/../", "__DIR__.'/lawncare-app/")
Set-Content -Path $indexPath -Value $indexContent -NoNewline

@"
<IfModule mod_authz_core.c>
    Require all denied
</IfModule>
"@ | Set-Content -Path (Join-Path $appDest ".htaccess") -NoNewline

function Add-DirectoryToZip {
    param(
        [System.IO.Compression.ZipArchive]$Archive,
        [string]$DirectoryPath,
        [string]$EntryPrefix = ""
    )

    Get-ChildItem -Path $DirectoryPath -Force | ForEach-Object {
        $entryName = if ($EntryPrefix) { "$EntryPrefix/$($_.Name)" } else { $_.Name }
        if ($_.PSIsContainer) {
            $null = $Archive.CreateEntry("$entryName/")
            Add-DirectoryToZip -Archive $Archive -DirectoryPath $_.FullName -EntryPrefix $entryName
        } else {
            $entry = $Archive.CreateEntry($entryName, [System.IO.Compression.CompressionLevel]::Optimal)
            $entryStream = $entry.Open()
            $fileStream = [System.IO.File]::OpenRead($_.FullName)
            $fileStream.CopyTo($entryStream)
            $fileStream.Close()
            $entryStream.Close()
        }
    }
}

$zipPath = Join-Path $PSScriptRoot "lawncare-hostinger-deploy.zip"
if (Test-Path $zipPath) { Remove-Item $zipPath -Force }
$zip = [System.IO.Compression.ZipFile]::Open($zipPath, [System.IO.Compression.ZipArchiveMode]::Create)
try {
    Add-DirectoryToZip -Archive $zip -DirectoryPath $staging
} finally {
    $zip.Dispose()
}

Remove-Item $staging -Recurse -Force
Write-Host "Created: $zipPath" -ForegroundColor Green
