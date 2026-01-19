#!/bin/sh
set -e

# Copy .env.example to .env if missing
if [ ! -f .env ]; then
    cp .env.example .env
fi

# -----------------------------------------------------------------------------
# INJECT ENVIRONMENT VARIABLES INTO .env
# This is crucial because 'php artisan serve' reads .env, and the default 
# .env.example usually forces 'mysql', overriding Render's 'pgsql' setting.
# -----------------------------------------------------------------------------

# Inject APP_KEY
if [ ! -z "$APP_KEY" ]; then
    sed -i "s|^APP_KEY=.*|APP_KEY=$APP_KEY|g" .env
fi

# Inject Database Credentials
# We use | as delimiter to avoid issues if valid urls/paths are used, 
# though passwords with | might still break.
if [ ! -z "$DB_HOST" ]; then
    echo "Injecting Database config into .env..."
    sed -i "s|^DB_CONNECTION=.*|DB_CONNECTION=pgsql|g" .env
    sed -i "s|^DB_HOST=.*|DB_HOST=$DB_HOST|g" .env
    sed -i "s|^DB_PORT=.*|DB_PORT=$DB_PORT|g" .env
    sed -i "s|^DB_DATABASE=.*|DB_DATABASE=$DB_DATABASE|g" .env
    sed -i "s|^DB_USERNAME=.*|DB_USERNAME=$DB_USERNAME|g" .env
    sed -i "s|^DB_PASSWORD=.*|DB_PASSWORD=$DB_PASSWORD|g" .env
fi

# -----------------------------------------------------------------------------

# Clear config caches to ensure fresh load
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
