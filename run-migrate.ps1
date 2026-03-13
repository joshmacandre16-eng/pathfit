# Run Laravel migrations with --force, ignore errors (PowerShell equivalent of || true)
# Uses same PHP path as run-artisan.ps1 for XAMPP.

$phpPath = "C:\xampp1\php"

if (-not (Test-Path "$phpPath\php.exe")) {
    Write-Error "php.exe not found in $phpPath. Update \$phpPath or add to PATH."
    exit 1
}

$env:Path = "$phpPath;$env:Path"

Write-Host "Running: php artisan migrate --force"
& "$phpPath\php.exe" "artisan" "migrate" "--force"

if ($LASTEXITCODE -ne 0) {
    Write-Warning "Migrations exited with code $LASTEXITCODE, but continuing (like || true)."
} else {
    Write-Host "Migrations completed successfully."
}
