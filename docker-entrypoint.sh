#!/bin/sh
set -e

# Create a .env file from example if it doesn't exist
# This avoids errors with artisan commands that expect the file to exist,
# even if we are using system environment variables.
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Cache configuration (uses Render environment variables)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (force is needed for production)
php artisan migrate --force

# Start the server
exec php artisan serve --host=0.0.0.0 --port=10000
