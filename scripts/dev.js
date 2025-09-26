#!/usr/bin/env node

import { spawn } from 'child_process';
import os from 'os';
import path from 'path';
import process from 'process';

const platform = os.platform();
const isWindows = platform === 'win32';

// Colors for different processes
const colors = {
    server: '\x1b[36m', // Cyan
    queue: '\x1b[35m',  // Magenta
    vite: '\x1b[33m',   // Yellow
    logs: '\x1b[32m',   // Green
    reset: '\x1b[0m'    // Reset
};

// Process configurations
const processes = [
    {
        name: 'server',
        command: 'php',
        args: ['artisan', 'serve'],
        color: colors.server
    },
    {
        name: 'vite',
        command: isWindows ? 'npm.cmd' : 'npm',
        args: ['run', 'dev'],
        color: colors.vite
    }
];

// Add queue process if requested
if (process.argv.includes('--with-queue') || process.argv.includes('-q')) {
    processes.push({
        name: 'queue',
        command: 'php',
        args: ['artisan', 'queue:listen', '--tries=1'],
        color: colors.queue
    });
}

// Add log tailing if available and requested
if (process.argv.includes('--with-logs') || process.argv.includes('-l')) {
    processes.push({
        name: 'logs',
        command: 'php',
        args: ['artisan', 'log:tail'],
        color: colors.logs
    });
}

console.log('🚀 Starting Laravel development environment...\n');

const runningProcesses = [];

// Function to spawn a process with proper output handling
function spawnProcess(config) {
    const proc = spawn(config.command, config.args, {
        stdio: ['pipe', 'pipe', 'pipe'],
        shell: isWindows,
        cwd: process.cwd()
    });

    // Handle stdout
    proc.stdout.on('data', (data) => {
        const lines = data.toString().split('\n').filter(line => line.trim());
        lines.forEach(line => {
            console.log(`${config.color}[${config.name}]${colors.reset} ${line}`);
        });
    });

    // Handle stderr
    proc.stderr.on('data', (data) => {
        const lines = data.toString().split('\n').filter(line => line.trim());
        lines.forEach(line => {
            console.log(`${config.color}[${config.name}] ERROR:${colors.reset} ${line}`);
        });
    });

    // Handle process exit
    proc.on('close', (code) => {
        console.log(`${config.color}[${config.name}]${colors.reset} Process exited with code ${code}`);
        
        // If any critical process exits, kill all others
        if (config.name === 'server' || config.name === 'vite') {
            console.log('\n🛑 Critical process exited, stopping all processes...');
            stopAllProcesses();
        }
    });

    proc.on('error', (err) => {
        console.error(`${config.color}[${config.name}] SPAWN ERROR:${colors.reset}`, err.message);
    });

    return proc;
}

// Function to stop all processes
function stopAllProcesses() {
    runningProcesses.forEach(proc => {
        if (!proc.killed) {
            if (isWindows) {
                spawn('taskkill', ['/pid', proc.pid, '/f', '/t'], { shell: true });
            } else {
                proc.kill('SIGTERM');
            }
        }
    });
    process.exit(0);
}

// Handle graceful shutdown
process.on('SIGINT', () => {
    console.log('\n\n🛑 Received SIGINT, stopping all processes...');
    stopAllProcesses();
});

process.on('SIGTERM', () => {
    console.log('\n\n🛑 Received SIGTERM, stopping all processes...');
    stopAllProcesses();
});

// Start all processes
processes.forEach(config => {
    console.log(`📦 Starting ${config.name}...`);
    const proc = spawnProcess(config);
    runningProcesses.push(proc);
});

console.log(`\n✅ Started ${processes.length} processes. Press Ctrl+C to stop all.\n`);

// Display help information
if (process.argv.includes('--help') || process.argv.includes('-h')) {
    console.log(`
Usage: node scripts/dev.js [options]

Options:
  -q, --with-queue    Include queue worker
  -l, --with-logs     Include log tailing (if available)
  -h, --help         Show this help message

Examples:
  node scripts/dev.js                    # Start server + vite
  node scripts/dev.js --with-queue       # Start server + vite + queue
  node scripts/dev.js -q -l             # Start all processes
`);
}