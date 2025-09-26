@echo off
REM Laravel Development Server Script for Windows

echo 🚀 Starting Laravel development environment...

REM Start Laravel development server in new window
echo 📦 Starting Laravel server...
start "Laravel Server" cmd /c "php artisan serve & pause"

REM Wait a moment for server to start
timeout /t 2 /nobreak >nul

REM Start Vite dev server in new window  
echo 📦 Starting Vite...
start "Vite Dev Server" cmd /c "npm run dev & pause"

REM Optionally start queue worker if requested
if "%1"=="--with-queue" (
    echo 📦 Starting Queue Worker...
    start "Queue Worker" cmd /c "php artisan queue:listen --tries=1 & pause"
) else if "%1"=="-q" (
    echo 📦 Starting Queue Worker...
    start "Queue Worker" cmd /c "php artisan queue:listen --tries=1 & pause"
)

echo.
echo ✅ Development environment started!
echo 🌐 Laravel: http://localhost:8000
echo ⚡ Vite: http://localhost:5173
echo.
echo Each process is running in its own window.
echo Close the windows to stop the processes.

pause