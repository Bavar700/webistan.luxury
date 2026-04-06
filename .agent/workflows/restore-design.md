---
description: Restore the High-End Academic Design (Manuscript Hero)
---

This workflow restores the theme to the "High-End Academic" design with the parchment background and manuscript hero section.

1. Copy files from backup to the active theme folder:
// turbo
run_command:
  CommandLine: |
    $backupDir = "c:\Users\alaco\Academy_Webistan\backups\High-End_Academic_Design"
    $themeDir = "C:\xampp\htdocs\wordpress\wp-content\themes\academy"
    $files = @("header.php", "front-page.php", "footer.php", "style.css", "functions.php", "index.php")
    foreach ($f in $files) {
        Copy-Item -Path "$backupDir\$f" -Destination "$themeDir\$f" -Force
    }
  Cwd: "c:\Users\alaco\Academy_Webistan"
  SafeToAutoRun: true

2. Sync workspace files:
// turbo
run_command:
  CommandLine: |
    $backupDir = "c:\Users\alaco\Academy_Webistan\backups\High-End_Academic_Design"
    $files = @("header.php", "front-page.php", "footer.php", "style.css", "functions.php", "index.php")
    foreach ($f in $files) {
        Copy-Item -Path "$backupDir\$f" -Destination "c:\Users\alaco\Academy_Webistan\$f" -Force
    }
  Cwd: "c:\Users\alaco\Academy_Webistan"
  SafeToAutoRun: true
