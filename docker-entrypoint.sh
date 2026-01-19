#!/bin/sh
set -e

echo "Initializing Docker Entrypoint..."

# Ensure .env exists
if [ ! -f .env ]; then
    echo "Creating .env from example..."
    cp .env.example .env
fi

# STRATEGY CHANGE:
# Instead of trying to overwrite values, we DELETE the conflicting keys from .env.
# This forces Laravel to use the actual Environment Variables provided by Render.
# This is much safer than 'sed' replacements that might miss or be malformed.

echo "Removing conflicting local config to force Render Environment Variables..."
sed -i '/^DB_/d' .env       # Remove all DB_ lines (DB_CONNECTION, DB_HOST, etc)
sed -i '/^APP_KEY=/d' .env  # Remove APP_KEY so it uses the one from Render
sed -i '/^APP_DEBUG=/d' .env
sed -i '/^APP_URL=/d' .env

echo "Environment file prepared."

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Fix permissions
chmod -R 777 storage bootstrap/cache

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Start the server
echo "Starting server..."
exec php artisan serve --host=0.0.0.0 --port=10000
