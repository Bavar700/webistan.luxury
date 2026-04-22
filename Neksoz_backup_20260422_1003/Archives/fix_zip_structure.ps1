
$sourcePath = "c:\Users\alaco\Academy_Webistan\yaghnob-heritage-v3"
$zipPath = "c:\Users\alaco\Academy_Webistan\yaghnob-heritage-v3-clean.zip"

if (Test-Path $zipPath) { Remove-Item $zipPath }

# Создаем временную папку для подготовки структуры
$tempDir = New-Item -ItemType Directory -Path "$env:TEMP\wp_theme_$(Get-Random)"

# Копируем всё ИСКЛЮЧАЯ .git, .github и wp-content
# (wp-content обычно не должен быть внутри папки темы в ZIP)
Get-ChildItem -Path $sourcePath | Where-Object { 
    $_.Name -notmatch "^\.(git|github)" -and 
    $_.Name -ne "wp-content" 
} | ForEach-Object {
    Copy-Item -Path $_.FullName -Destination $tempDir -Recurse
}

# Также проверим, нет ли внутри папки wp-content чего-то нужного (обычно нет в теме)
# Но в вашем случае там пустая папка, так что пропускаем.

Compress-Archive -Path "$tempDir\*" -DestinationPath $zipPath

Remove-Item -Path $tempDir -Recurse -Force

Write-Host "Created clean theme zip: $zipPath"
