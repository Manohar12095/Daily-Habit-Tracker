@echo off
cd /d "%~dp0"
title Habit Tracker Server
echo ===================================================
echo Starting your Daily Habit Tracker...
echo ===================================================
echo.
echo Please keep this console window open while using the app.
echo.
echo Attempting to open your web browser...
start http://localhost:8000/index.php
echo.
echo Starting local PHP server on port 8000...

if exist "C:\xampp\php\php.exe" (
    echo XAMPP PHP detected. Starting server...
    "C:\xampp\php\php.exe" -S localhost:8000
) else (
    php -S localhost:8000
)

if %errorlevel% neq 0 (
    echo.
    echo [ERROR] PHP server failed to start!
    echo.
    echo Why did this happen?
    echo 1. You might not have PHP installed directly on your Windows system.
    echo 2. If you use XAMPP or WAMP, you need to copy this entire "Dbms project" folder.
    echo    Move it into your "C:\xampp\htdocs" (for XAMPP) or "C:\wamp64\www" (for WAMP) folder.
    echo    Then open your browser and manually visit: http://localhost/Dbms project/index.php
    echo.
    pause
)
