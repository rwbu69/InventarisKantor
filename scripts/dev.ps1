# Laravel Development Server Script for Windows PowerShell

Write-Host "🚀 Starting Laravel development environment..." -ForegroundColor Green

# Function to handle cleanup
function Stop-Processes {
    Write-Host "`n🛑 Stopping all processes..." -ForegroundColor Yellow
    Get-Job | Stop-Job
    Get-Job | Remove-Job
    exit 0
}

# Set up cleanup on Ctrl+C
$null = Register-EngineEvent PowerShell.Exiting -Action { Stop-Processes }

try {
    # Start Laravel development server
    Write-Host "📦 Starting Laravel server..." -ForegroundColor Cyan
    $serverJob = Start-Job -ScriptBlock { php artisan serve }

    # Start Vite dev server
    Write-Host "📦 Starting Vite..." -ForegroundColor Yellow
    $viteJob = Start-Job -ScriptBlock { npm run dev }

    # Optionally start queue worker if requested
    $queueJob = $null
    if ($args -contains "--with-queue" -or $args -contains "-q") {
        Write-Host "📦 Starting Queue Worker..." -ForegroundColor Magenta
        $queueJob = Start-Job -ScriptBlock { php artisan queue:listen --tries=1 }
    }

    Write-Host "`n✅ Development environment started!" -ForegroundColor Green
    Write-Host "🌐 Laravel: http://localhost:8000" -ForegroundColor Cyan
    Write-Host "⚡ Vite: http://localhost:5173" -ForegroundColor Yellow
    Write-Host "`nPress Ctrl+C to stop all processes" -ForegroundColor Gray

    # Monitor jobs and display output
    while ($true) {
        # Display server output
        if ($serverJob.HasMoreData) {
            $serverOutput = Receive-Job $serverJob -Keep
            if ($serverOutput) {
                Write-Host "[server] $serverOutput" -ForegroundColor Cyan
            }
        }

        # Display vite output
        if ($viteJob.HasMoreData) {
            $viteOutput = Receive-Job $viteJob -Keep
            if ($viteOutput) {
                Write-Host "[vite] $viteOutput" -ForegroundColor Yellow
            }
        }

        # Display queue output if running
        if ($queueJob -and $queueJob.HasMoreData) {
            $queueOutput = Receive-Job $queueJob -Keep
            if ($queueOutput) {
                Write-Host "[queue] $queueOutput" -ForegroundColor Magenta
            }
        }

        # Check if any job failed
        $failedJobs = Get-Job | Where-Object { $_.State -eq "Failed" }
        if ($failedJobs) {
            Write-Host "`n❌ One or more processes failed:" -ForegroundColor Red
            $failedJobs | ForEach-Object {
                Write-Host "  - $($_.Name): $($_.JobStateInfo.Reason)" -ForegroundColor Red
            }
            break
        }

        Start-Sleep -Milliseconds 100
    }
}
catch {
    Write-Host "`n❌ Error occurred: $($_.Exception.Message)" -ForegroundColor Red
}
finally {
    Stop-Processes
}