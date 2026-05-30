# "Офарин! Ту метавонӣ!" - Setup Helper Script
# This script automates the initial setup, localization generation, and build runners.

Write-Host "=============================================" -ForegroundColor Cyan
Write-Host "🚀 Starting 'Ofarin! Ту метавонӣ!' Project Setup" -ForegroundColor Cyan
Write-Host "=============================================" -ForegroundColor Cyan

# Check Flutter SDK globally, then check the detected C:\Users\alaco\flutter installation
Write-Host "🔍 Checking Flutter environment..." -ForegroundColor Yellow

$flutterCmd = "flutter"
if (-not (Get-Command "flutter" -ErrorAction SilentlyContinue)) {
    if (Test-Path "C:\Users\alaco\flutter\bin\flutter.bat") {
        Write-Host "ℹ️ Global 'flutter' command not in PATH. Using local path: C:\Users\alaco\flutter\bin\flutter.bat" -ForegroundColor Yellow
        $flutterCmd = "C:\Users\alaco\flutter\bin\flutter.bat"
    } else {
        $flutterCmd = $null
    }
}

if ($flutterCmd) {
    Write-Host "✅ Flutter SDK detected!" -ForegroundColor Green
    
    # 2. Install dependencies
    Write-Host "📦 Installing Flutter dependencies..." -ForegroundColor Yellow
    & $flutterCmd pub get
    
    # 3. Generate Localization files
    Write-Host "🌐 Compiling multi-language ARB localization files..." -ForegroundColor Yellow
    & $flutterCmd gen-l10n
    
    # 4. Run build runner code generation
    Write-Host "⚙️ Running build_runner for code generation (Riverpod annotations)..." -ForegroundColor Yellow
    & $flutterCmd pub run build_runner build --delete-conflicting-outputs

    Write-Host ""
    Write-Host "=============================================" -ForegroundColor Green
    Write-Host "🎉 Project Setup Complete!" -ForegroundColor Green
    Write-Host "👉 Run the app on web using: & '$flutterCmd' run -d chrome --web-port=8095" -ForegroundColor Green
    Write-Host "=============================================" -ForegroundColor Green
} else {
    Write-Host "❌ Flutter command-line tool not detected." -ForegroundColor Red
    Write-Host "👉 Please install Flutter and ensure it is placed in C:\Users\alaco\flutter" -ForegroundColor Red
}
