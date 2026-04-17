$dateStr = Get-Date -Format "yyyy-MM-dd_HH-mm-ss"
$projects = @("Webistan.Luxury", "Neksoz", "Yaghnob.Heritage")
$baseDir = "C:\Users\alaco\Academy_Webistan"

Write-Host "Starting automated backup protocol..."

foreach ($proj in $projects) {
    $projDir = "$baseDir\$proj"
    if (Test-Path $projDir) {
        Write-Host "Processing $proj..."
        
        # 1. Initialize isolated Git repository if not present
        Set-Location $projDir
        if (!(Test-Path "$projDir\.git")) {
            git init
        }
        git add .
        git commit -m "Automated safety checkpoint: $dateStr"
        
        # 2. Create timestamped ZIP archive (excluding node_modules to avoid path too long errors)
        $zipPath = "$baseDir\${proj}_Backup_${dateStr}.zip"
        
        # Using a safer compress method for large/locked files
        $tmpDir = "$baseDir\${proj}_tmp_backup"
        New-Item -ItemType Directory -Path $tmpDir -Force | Out-Null
        Copy-Item -Path "$projDir\*" -Destination $tmpDir -Recurse -Force -Exclude "node_modules", ".git", "neksoz-env" -ErrorAction SilentlyContinue
        
        Compress-Archive -Path "$tmpDir\*" -DestinationPath $zipPath -Force
        Remove-Item -Path $tmpDir -Recurse -Force
        
        Write-Host "Saved: $zipPath and committed to isolated Git repo."
    }
}

Write-Host "Backup protocol completed successfully."
