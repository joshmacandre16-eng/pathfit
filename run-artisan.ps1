# Run artisan using a known PHP installation (useful when PHP isn't on PATH)

# Update this path if your PHP lives elsewhere (e.g., "C:\xampp\php" or "C:\Program Files\php\").
$phpPath = "C:\xampp1\php"

if (-not (Test-Path "$phpPath\php.exe")) {
    Write-Error "php.exe not found in $phpPath. Update \$phpPath in this script to the correct location."
    exit 1
}

$env:Path = "$phpPath;$env:Path"

# Run artisan with the given arguments (or default to 'serve')
$arguments = $args
if ($arguments.Count -eq 0) {
    $arguments = @('serve')
}

& "$phpPath\php.exe" "artisan" @arguments
