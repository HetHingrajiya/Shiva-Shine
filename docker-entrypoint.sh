#!/bin/sh
set -e

# Run the PHP script to safely sync environment variables to .env
# This avoids corrupting the file with sed if passwords contain special chars
php update_env.php

# Clear caches to ensure fresh load
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
