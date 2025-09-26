#!/bin/bash

# Laravel Development Server Script (Cross-Platform)
# This script works on Linux, macOS, and Windows (with Git Bash or WSL)

echo "🚀 Starting Laravel development environment..."

# Function to handle cleanup
cleanup() {
    echo ""
    echo "🛑 Stopping all processes..."
    kill $(jobs -p) 2>/dev/null
    exit 0
}

# Set up trap for cleanup
trap cleanup SIGINT SIGTERM

# Start Laravel development server
echo "📦 Starting Laravel server..."
php artisan serve &
SERVER_PID=$!

# Start Vite dev server
echo "📦 Starting Vite..."
npm run dev &
VITE_PID=$!

# Optionally start queue worker if requested
if [[ "$1" == "--with-queue" || "$1" == "-q" ]]; then
    echo "📦 Starting Queue Worker..."
    php artisan queue:listen --tries=1 &
    QUEUE_PID=$!
fi

echo ""
echo "✅ Development environment started!"
echo "🌐 Laravel: http://localhost:8000"
echo "⚡ Vite: http://localhost:5173"
echo ""
echo "Press Ctrl+C to stop all processes"

# Wait for all background processes
wait