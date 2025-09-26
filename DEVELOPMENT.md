# Development Setup

This project includes cross-platform development scripts that work on Windows, macOS, and Linux.

## Quick Start

### Option 1: Using Composer (Recommended)
```bash
composer run dev
```

This will start both the Laravel development server and Vite automatically.

### Option 2: Using npm scripts
```bash
# Start server + vite only
npm run dev:server

# Start server + vite + queue worker
npm run dev:full

# Start using concurrently (fallback)
npm run dev:concurrent
```

### Option 3: Platform-specific scripts

#### Linux/macOS:
```bash
# Basic setup (server + vite)
./scripts/dev.sh

# With queue worker
./scripts/dev.sh --with-queue
```

#### Windows:

**Command Prompt:**
```cmd
REM Basic setup (opens separate windows)
scripts\dev.bat

REM With queue worker  
scripts\dev.bat --with-queue
```

**PowerShell:**
```powershell
# Basic setup
.\scripts\dev.ps1

# With queue worker
.\scripts\dev.ps1 --with-queue
```

#### Cross-platform Node.js script:
```bash
# Basic setup
node scripts/dev.js

# With queue worker
node scripts/dev.js --with-queue

# With logs (if available)
node scripts/dev.js --with-logs

# All options
node scripts/dev.js --with-queue --with-logs
```

## Available Services

When you run the development environment, the following services will be available:

- **Laravel App**: http://localhost:8000
- **Vite Dev Server**: http://localhost:5173 (for hot module replacement)
- **Queue Worker**: Processes background jobs (if enabled)

## Individual Commands

If you prefer to run services individually:

```bash
# Laravel development server
php artisan serve

# Vite development server  
npm run dev

# Queue worker
php artisan queue:listen --tries=1

# Build for production
npm run build
```

## Stopping the Development Environment

- **Composer/npm scripts**: Press `Ctrl+C` once to stop all processes
- **Shell scripts**: Press `Ctrl+C` to stop all processes
- **Windows batch**: Close the command windows
- **Node.js script**: Press `Ctrl+C` to gracefully stop all processes

## Troubleshooting

### Port Already in Use
If you get a "port already in use" error:

- **Laravel (port 8000)**: Use `php artisan serve --port=8001`
- **Vite (port 5173)**: The port will automatically increment

### Queue Worker Issues
If the queue worker fails to start, make sure your `.env` file has proper queue configuration:

```env
QUEUE_CONNECTION=database
# or
QUEUE_CONNECTION=sync
```

### Windows-specific Issues
- Make sure you have Node.js installed
- Use Command Prompt or PowerShell, not Git Bash for `.bat` files
- For Git Bash, use the shell script: `./scripts/dev.sh`

## Development Workflow

1. **Start development**: `composer run dev`
2. **Make changes** to your PHP or frontend files
3. **View changes** at http://localhost:8000 (auto-reloads with Vite)
4. **Stop when done**: `Ctrl+C`