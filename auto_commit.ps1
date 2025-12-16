# Auto commit script - Chay moi ngay de giu GitHub xanh dam
$repoPath = "C:\xampp\htdocs\14_KTL1_110122028_LIEUKIENAN\kiemtraquatrinh_DA22TTD_2"
$logFile = "$repoPath\commit_log.txt"

Set-Location $repoPath

# Spam 10 commits moi ngay de xanh dam
for ($i = 1; $i -le 10; $i++) {
    $date = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
    Add-Content -Path $logFile -Value "Daily commit #$i - $date"
    git add .
    git commit -m "Daily update #$i - $date"
}

git push origin main
