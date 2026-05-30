@echo off
echo =============================================
echo Starting "Ofarin! Tu metavoni!" Project Setup
echo =============================================

:: 1. Check if global flutter exists
where flutter >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    set FLUTTER_CMD=flutter
    echo [OK] Global Flutter command detected!
    goto :setup
)

:: 2. Check if local path exists
if exist "C:\Users\alaco\flutter\bin\flutter.bat" (
    echo [INFO] Global Flutter command not in PATH.
    echo [INFO] Using local path: C:\Users\alaco\flutter\bin\flutter.bat
    set FLUTTER_CMD=C:\Users\alaco\flutter\bin\flutter.bat
    goto :setup
)

echo [ERROR] Flutter SDK not detected globally or at C:\Users\alaco\flutter.
echo Please install Flutter or check your path.
pause
exit /b 1

:setup
echo.
echo [1/3] Installing Flutter dependencies...
call "%FLUTTER_CMD%" pub get

echo.
echo [2/3] Compiling multi-language ARB localization files...
call "%FLUTTER_CMD%" gen-l10n

echo.
echo [3/3] Running build_runner for code generation...
call "%FLUTTER_CMD%" pub run build_runner build --delete-conflicting-outputs

echo.
echo =============================================
echo 🎉 Project Setup Complete!
echo.
echo 👉 Run the app on web using:
echo "%FLUTTER_CMD%" run -d chrome --web-port=8095
echo =============================================
pause
