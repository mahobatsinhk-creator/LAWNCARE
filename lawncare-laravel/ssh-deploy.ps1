# Upload files to Hostinger via SSH/SFTP (port 65002)
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

function Initialize-SshAuth {
    $askpass = Join-Path $env:TEMP "lawncare-ssh-askpass.cmd"
    "@echo $SshPass" | Set-Content -Path $askpass -Encoding ASCII
    $env:SSH_ASKPASS = $askpass
    $env:SSH_ASKPASS_REQUIRE = "force"
    $env:DISPLAY = "dummy"
}

function Invoke-RemoteSsh {
    param([string]$Command)

    Initialize-SshAuth
    ssh -p $SshPort -o StrictHostKeyChecking=accept-new "${SshUser}@${SshHost}" $Command
}

function Upload-ScpFile {
    param(
        [string]$LocalPath,
        [string]$RemotePath
    )

    Initialize-SshAuth
    scp -P $SshPort -o StrictHostKeyChecking=accept-new $LocalPath "${SshUser}@${SshHost}:${RemotePath}"
}

Write-Host "Testing SSH connection..." -ForegroundColor Yellow
Invoke-RemoteSsh "pwd && ls -la $RemoteRoot"

Write-Host "Uploading public assets..." -ForegroundColor Yellow
$publicRoot = Join-Path $root "public"
$files = Get-ChildItem -Path $publicRoot -Recurse -File -Force
$total = $files.Count
$index = 0

foreach ($file in $files) {
    $index++
    $relative = $file.FullName.Substring($publicRoot.Length + 1).Replace("\", "/")
    $remotePath = "$RemoteRoot/$relative"
    $remoteDir = Split-Path $remotePath -Parent
    Invoke-RemoteSsh "mkdir -p $remoteDir" | Out-Null
    Write-Host "[$index/$total] $relative"
    Upload-ScpFile -LocalPath $file.FullName -RemotePath $remotePath
}

Write-Host "Upload complete." -ForegroundColor Green
