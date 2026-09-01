# Upload lawncare-laravel to Hostinger via FTP
param(
    [string]$FtpHost = "82.180.164.210",
    [string]$FtpUser = "u583052730.azure-alligator-874193.hostingersite.com",
    [string]$FtpPass = $env:FTP_PASSWORD,
    [int]$FtpPort = 21
)

$ErrorActionPreference = "Stop"
$root = $PSScriptRoot

if (-not $FtpPass) {
    throw "Set FTP_PASSWORD environment variable before running this script."
}

function Invoke-Ftp {
    param(
        [string]$Path,
        [string]$Method,
        [byte[]]$Content = $null
    )

    $uri = "ftp://${FtpHost}:${FtpPort}/$Path"
    $request = [System.Net.FtpWebRequest]::Create($uri)
    $request.Method = $Method
    $request.Credentials = New-Object System.Net.NetworkCredential($FtpUser, $FtpPass)
    $request.UseBinary = $true
    $request.UsePassive = $true
    $request.KeepAlive = $false

    if ($Content) {
        $request.ContentLength = $Content.Length
        $stream = $request.GetRequestStream()
        $stream.Write($Content, 0, $Content.Length)
        $stream.Close()
    }

    try {
        $response = $request.GetResponse()
        if ($Method -eq [System.Net.WebRequestMethods+Ftp]::ListDirectoryDetails) {
            $reader = New-Object System.IO.StreamReader($response.GetResponseStream())
            $text = $reader.ReadToEnd()
            $reader.Close()
            $response.Close()
            return $text
        }
        $response.Close()
    } catch {
        if ($_.Exception.Message -notmatch "550") { throw }
        return $null
    }
}

function Ensure-FtpDirectory {
    param([string]$Path)
    $parts = $Path.Trim("/").Split("/")
    $current = ""
    foreach ($part in $parts) {
        if (-not $part) { continue }
        $current = if ($current) { "$current/$part" } else { $part }
        try {
            Invoke-Ftp -Path $current -Method ([System.Net.WebRequestMethods+Ftp]::MakeDirectory) | Out-Null
        } catch {
            # Directory may already exist.
        }
    }
}

function Upload-FtpFile {
    param(
        [string]$LocalPath,
        [string]$RemotePath
    )

    $remoteDir = Split-Path $RemotePath -Parent
    if ($remoteDir) {
        Ensure-FtpDirectory -Path ($remoteDir -replace "\\", "/")
    }

    $bytes = [System.IO.File]::ReadAllBytes($LocalPath)
    Invoke-Ftp -Path $RemotePath -Method ([System.Net.WebRequestMethods+Ftp]::UploadFile) -Content $bytes | Out-Null
}

Write-Host "Listing FTP root..." -ForegroundColor Yellow
Write-Host (Invoke-Ftp -Path "" -Method ([System.Net.WebRequestMethods+Ftp]::ListDirectoryDetails))

$remoteAppRoot = "lawncare-app"
$remotePublicRoot = "public_html"

Write-Host "Uploading Laravel app to /$remoteAppRoot ..." -ForegroundColor Yellow
Ensure-FtpDirectory -Path $remoteAppRoot

$excludePattern = '(\\node_modules\\|\\\.git\\|\\tests\\|\\storage\\logs\\|\\storage\\framework\\cache\\data\\|\\storage\\framework\\sessions\\|\\storage\\framework\\views\\|\\\.env\.example$|\\deploy\.ps1$|\\ftp-deploy\.ps1$|\\start\.ps1$|\\package\.json$|\\package-lock\.json$|\\vite\.config\.js$|\\README\.md$)'

$files = Get-ChildItem -Path $root -Recurse -File -Force |
    Where-Object { $_.FullName -notmatch $excludePattern }

$total = $files.Count
$index = 0
foreach ($file in $files) {
    $index++
    $relative = $file.FullName.Substring($root.Length + 1).Replace("\", "/")
    $remotePath = "$remoteAppRoot/$relative"
    Write-Host "[$index/$total] $remotePath"
    Upload-FtpFile -LocalPath $file.FullName -RemotePath $remotePath
}

Write-Host "Uploading public web root to /$remotePublicRoot ..." -ForegroundColor Yellow
Ensure-FtpDirectory -Path $remotePublicRoot

$publicFiles = Get-ChildItem -Path (Join-Path $root "public") -Recurse -File -Force
$publicTotal = $publicFiles.Count
$publicIndex = 0
foreach ($file in $publicFiles) {
    $publicIndex++
    $relative = $file.FullName.Substring((Join-Path $root "public").Length + 1).Replace("\", "/")
    $remotePath = "$remotePublicRoot/$relative"
    Write-Host "[$publicIndex/$publicTotal] $remotePath"
    Upload-FtpFile -LocalPath $file.FullName -RemotePath $remotePath
}

$indexPhp = Join-Path $root "public\index.php"
$indexContent = Get-Content $indexPhp -Raw
$indexContent = $indexContent.Replace("__DIR__.'/../", "__DIR__.'/../$remoteAppRoot/")
$tempIndex = Join-Path $env:TEMP "lawncare-index.php"
Set-Content -Path $tempIndex -Value $indexContent -NoNewline
Upload-FtpFile -LocalPath $tempIndex -RemotePath "$remotePublicRoot/index.php"
Remove-Item $tempIndex -Force

Write-Host "Upload complete." -ForegroundColor Green
