while ($true) {
    $timestamp = Get-Date -Format "yyyy-MM-dd_HH-mm-ss"
    $backupDir = "C:\Users\alaco\Academy_Webistan\_autosaves\autosave_$timestamp"
    
    New-Item -ItemType Directory -Force -Path $backupDir | Out-Null
    
    # Копируем основные папки
    Copy-Item -Path "C:\Users\alaco\Academy_Webistan\neksoz-variant-3pm\*" -Destination $backupDir -Recurse -Force
    # Если нужно бэкапить и основную тему, уберите '#' в строке ниже:
    # Copy-Item -Path "C:\Users\alaco\Academy_Webistan\neksoz-theme\*" -Destination "$backupDir\neksoz-theme" -Recurse -Force
    
    Write-Host "Авто-сохранение выполнено: $timestamp" -ForegroundColor Green
    
    # Ждем 5 минут (300 секунд)
    Start-Sleep -Seconds 300
}
