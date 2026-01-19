#!/bin/sh
set -e

# Create a .env file from example if it doesn't exist
if [ ! -f .env ]; then
    cp .env.example .env
fi

# IMPORTANT: Do NOT use config:cache if you call env() variables outside of config files.
# Using config:clear ensures the app reads environment variables directly, which fixes issues
# where env() returns null in Controllers/Models.
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Fix permissions again at runtime to be safe
chmod -R 777 storage bootstrap/cache

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Start the server
echo "Starting server..."
exec php artisan serve --host=0.0.0.0 --port=10000
