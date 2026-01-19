#!/bin/sh
set -e

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (force is needed for production)
php artisan migrate --force

# Start the server
exec php artisan serve --host=0.0.0.0 --port=10000
