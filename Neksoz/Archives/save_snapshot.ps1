# =============================================
# YAGHNOB HERITAGE - Save Site Snapshot
# Запустите этот файл чтобы сохранить текущее состояние сайта
# =============================================

$timestamp = Get-Date -Format "yyyy-MM-dd_HH-mm"
$snapshotName = Read-Host "Введите название снапшота (или нажмите Enter для '$timestamp')"
if ([string]::IsNullOrWhiteSpace($snapshotName)) { $snapshotName = $timestamp }

$themeDir = "C:\xampp\htdocs\wordpress\wp-content\themes\academy"
$backupDir = "c:\Users\alaco\Academy_Webistan\backups\$snapshotName"

New-Item -ItemType Directory -Force -Path $backupDir | Out-Null

$files = @(
    "header.php",
    "front-page.php",
    "footer.php",
    "style.css",
    "functions.php",
    "index.php",
    "single.php",
    "page.php",
    "archive.php"
)

$copied = 0
foreach ($f in $files) {
    $src = "$themeDir\$f"
    if (Test-Path $src) {
        Copy-Item -Path $src -Destination "$backupDir\$f" -Force
        $copied++
        Write-Host "  ✓ $f" -ForegroundColor Green
    }
}

Write-Host ""
Write-Host "✅ Сохранено $copied файлов в: $backupDir" -ForegroundColor Cyan
Write-Host ""
Write-Host "Для восстановления скажите мне: 'восстанови снапшот $snapshotName'" -ForegroundColor Yellow
Write-Host ""
Read-Host "Нажмите Enter для выхода"
