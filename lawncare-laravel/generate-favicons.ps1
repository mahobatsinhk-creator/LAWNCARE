Add-Type -AssemblyName System.Drawing

function Save-RoundIcon {
    param(
        [string]$SourcePath,
        [string]$DestPath,
        [int]$Size
    )

    $source = [System.Drawing.Image]::FromFile($SourcePath)
    try {
        $bitmap = New-Object System.Drawing.Bitmap $Size, $Size, ([System.Drawing.Imaging.PixelFormat]::Format32bppArgb)
        $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
        try {
            $graphics.Clear([System.Drawing.Color]::Transparent)
            $graphics.SmoothingMode = [System.Drawing.Drawing2D.SmoothingMode]::HighQuality
            $graphics.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
            $graphics.PixelOffsetMode = [System.Drawing.Drawing2D.PixelOffsetMode]::HighQuality
            $graphics.CompositingQuality = [System.Drawing.Drawing2D.CompositingQuality]::HighQuality

            $path = New-Object System.Drawing.Drawing2D.GraphicsPath
            $path.AddEllipse(0, 0, $Size, $Size)
            $graphics.SetClip($path)

            $graphics.DrawImage($source, 0, 0, $Size, $Size)
        } finally {
            $graphics.Dispose()
        }

        $bitmap.Save($DestPath, [System.Drawing.Imaging.ImageFormat]::Png)
        $bitmap.Dispose()
    } finally {
        $source.Dispose()
    }
}

$root = Split-Path -Parent $MyInvocation.MyCommand.Path
$source = Join-Path $root 'public\favicon-source.png'

if (-not (Test-Path $source)) {
    $logoUrl = 'https://d13cw1lxlociqy.cloudfront.net/72ivb81rb4njfskjy3ztlmqedsr7'
    Invoke-WebRequest -Uri $logoUrl -OutFile $source -UseBasicParsing
}

Save-RoundIcon -SourcePath $source -DestPath (Join-Path $root 'public\favicon.png') -Size 192
Save-RoundIcon -SourcePath $source -DestPath (Join-Path $root 'public\favicon-32x32.png') -Size 32
Save-RoundIcon -SourcePath $source -DestPath (Join-Path $root 'public\apple-touch-icon.png') -Size 180

Write-Host 'Round favicons generated.'
