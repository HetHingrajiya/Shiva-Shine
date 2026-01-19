#!/bin/sh
set -e

# Copy .env.example to .env if missing
if [ ! -f .env ]; then
    cp .env.example .env
fi

# IMPORTANT:
# If APP_KEY is present in the environment (from Render), we must ensure it is in the .env file
# because 'php artisan serve' sometimes ignores the system environment variables unlike 'php-fpm'.
if [ ! -z "$APP_KEY" ]; then
    # Escape special characters in the key if necessary, though base64 is usually safe
    # We use sed to replace the existing APP_KEY=... or append if not found
    sed -i "s|^APP_KEY=.*|APP_KEY=$APP_KEY|g" .env
fi

# Do standard clearing
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
