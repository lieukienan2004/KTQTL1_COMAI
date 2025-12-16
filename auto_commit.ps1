# Auto commit script - Chay moi ngay de giu GitHub xanh
$repoPath = "C:\xampp\htdocs\14_KTL1_110122028_LIEUKIENAN\kiemtraquatrinh_DA22TTD_2"
$logFile = "$repoPath\commit_log.txt"

Set-Location $repoPath

# Tao hoac cap nhat file log
$date = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
Add-Content -Path $logFile -Value "Auto commit: $date"

# Git commands
git add .
git commit -m "Auto commit: $date"
git push origin main
