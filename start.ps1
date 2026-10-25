# Laravel Dev Server Startup Script
# Uses C:\php\php.exe directly since that's the working PHP installation

$phpExe = "C:\php\php.exe"
$projectDir = $PSScriptRoot

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "   FPY Laravel App - Starting Up" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Start Laravel backend in a new window
Write-Host "[1/2] Starting Laravel backend on http://127.0.0.1:8088 ..." -ForegroundColor Green
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd '$projectDir'; Write-Host 'Laravel Backend Running at http://127.0.0.1:8088' -ForegroundColor Green; & '$phpExe' artisan serve --host=0.0.0.0 --port=8088"

Start-Sleep -Seconds 2

# Start Vite frontend in a new window
Write-Host "[2/2] Starting Vite frontend on http://localhost:5173 ..." -ForegroundColor Yellow
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd '$projectDir'; Write-Host 'Vite Dev Server Running' -ForegroundColor Yellow; npm run dev"

Start-Sleep -Seconds 3

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host " App is running!" -ForegroundColor Green
Write-Host " Backend : http://127.0.0.1:8088" -ForegroundColor White
Write-Host " Vite    : http://localhost:5173" -ForegroundColor White
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Opening app in browser..." -ForegroundColor Gray
Start-Process "http://127.0.0.1:8088"
