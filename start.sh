#!/bin/bash
# Local development startup script

# Check if port is provided as environment variable, default to 8000
PORT=${PORT:-8000}

# Start PHP development server
echo "Starting PHP development server on port $PORT"
php -S localhost:$PORT -t public