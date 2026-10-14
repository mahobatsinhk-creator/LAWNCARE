# Deploy Blog 2 SEO files to Hostinger
param(
    [string]$SshHost = "82.25.81.129",
    [int]$SshPort = 65002,
    [string]$SshUser = "u358963751_tEFdJBEuy",
    [string]$SshPass = $env:SSH_PASSWORD,
    [string]$RemoteRoot = "websites/tEFdJBEuy/public_html"
)

$ErrorActionPreference = "Stop"
$root = $PSScriptRoot

if (-not $SshPass) {
    throw "Set SSH_PASSWORD environment variable before running this script."
}

$askpass = Join-Path $env:TEMP "lawncare-ssh-askpass.cmd"
"@echo $SshPass" | Set-Content -Path $askpass -Encoding ASCII
$env:SSH_ASKPASS = $askpass
$env:SSH_ASKPASS_REQUIRE = "force"
$env:DISPLAY = "dummy"

function Remote([string]$Command) {
    ssh -p $SshPort -o StrictHostKeyChecking=accept-new "${SshUser}@${SshHost}" $Command
}

function Upload([string]$LocalPath, [string]$RemotePath) {
    scp -P $SshPort -o StrictHostKeyChecking=accept-new $LocalPath "${SshUser}@${SshHost}:${RemotePath}"
}

Write-Host "Detecting app root..."
$listing = Remote "ls -1 $RemoteRoot"
$AppRoot = if ($listing -match "lawncare-app") { "$RemoteRoot/lawncare-app" } else { $RemoteRoot }
Write-Host "AppRoot=$AppRoot"

$files = @(
    @{ L = "config/blog_content.php"; R = "$AppRoot/config/blog_content.php" },
    @{ L = "config/site.php"; R = "$AppRoot/config/site.php" },
    @{ L = "config/blog_seo_fall_cleanup_dos_donts.php"; R = "$AppRoot/config/blog_seo_fall_cleanup_dos_donts.php" },
    @{ L = "app/Support/SiteData.php"; R = "$AppRoot/app/Support/SiteData.php" },
    @{ L = "resources/views/blogs/show.blade.php"; R = "$AppRoot/resources/views/blogs/show.blade.php" },
    @{ L = "resources/views/layouts/app.blade.php"; R = "$AppRoot/resources/views/layouts/app.blade.php" },
    @{ L = "resources/views/partials/harmone-blog-article.blade.php"; R = "$AppRoot/resources/views/partials/harmone-blog-article.blade.php" },
    @{ L = "sync-blogs.php"; R = "$RemoteRoot/sync-blogs.php" },
    @{ L = "clear-views.php"; R = "$RemoteRoot/clear-views.php" }
)

foreach ($f in $files) {
    $remoteDir = ($f.R -replace '/[^/]+$', '')
    Remote "mkdir -p $remoteDir" | Out-Null
    Write-Host "-> $($f.L)"
    Upload (Join-Path $root $f.L) $f.R
}

$imgLocal = Join-Path $root "public/assets/services/spring-fall-clean-up"
$imgRemote = "$RemoteRoot/assets/services/spring-fall-clean-up"
Remote "mkdir -p $imgRemote" | Out-Null

@(
    "fall-cleanup-dos-donts-edmonton.jpg",
    "fall-leaf-removal-tips.jpg",
    "final-mow-before-winter-edmonton.jpg",
    "autumn-sidewalk-leaf-cleanup.jpg",
    "fall-lawn-aeration-edmonton.jpg",
    "fall-branch-and-yard-debris-removal.jpg",
    "fall-yard-waste.jpg",
    "fall-winter-prep.jpg"
) | ForEach-Object {
    Write-Host "-> image $_"
    Upload (Join-Path $imgLocal $_) "$imgRemote/$_"
}

Remote "mkdir -p $RemoteRoot/build/assets" | Out-Null
Upload (Join-Path $root "public/build/manifest.json") "$RemoteRoot/build/manifest.json"
Get-ChildItem (Join-Path $root "public/build/assets") -File | ForEach-Object {
    Write-Host "-> build $($_.Name)"
    Upload $_.FullName "$RemoteRoot/build/assets/$($_.Name)"
}

Write-Host "Clearing caches..."
Remote "cd $AppRoot && php artisan config:clear && php artisan view:clear && php artisan cache:clear" | Write-Host

Write-Host "Syncing blog DB via HTTP..."
foreach ($base in @("https://lawncareandsnowremovalexperts.com", "https://ivory-elephant-669677.hostingersite.com")) {
    try {
        $r = Invoke-WebRequest -Uri "$base/sync-blogs.php?key=lawncare-sync-blogs-2026" -UseBasicParsing -TimeoutSec 90
        Write-Host "$base sync: $($r.Content.Trim())"
        $c = Invoke-WebRequest -Uri "$base/clear-views.php?key=lawncare-clear-views-2026" -UseBasicParsing -TimeoutSec 30
        Write-Host "$base clear: $($c.Content.Trim())"
    } catch {
        Write-Host "$base failed: $($_.Exception.Message)"
    }
}

Write-Host "Deploy complete."
