#!/bin/sh
set -e

echo "Recreating .env file from Render Environment Variables..."

# We truncate the file and manually write the critical vars.
# We wrap values in single quotes to handle special characters safely.
# This bypasses any issues with missing source files or sed/php parsing.

echo "APP_NAME='ShivaShine'" > .env
echo "APP_ENV='production'" >> .env
echo "APP_KEY='$APP_KEY'" >> .env
echo "APP_DEBUG='true'" >> .env
echo "APP_URL='$APP_URL'" >> .env
echo "LOG_CHANNEL='stderr'" >> .env

echo "DB_CONNECTION='pgsql'" >> .env
echo "DB_HOST='$DB_HOST'" >> .env
echo "DB_PORT='$DB_PORT'" >> .env
echo "DB_DATABASE='$DB_DATABASE'" >> .env
echo "DB_USERNAME='$DB_USERNAME'" >> .env
echo "DB_PASSWORD='$DB_PASSWORD'" >> .env

echo "MAIL_MAILER='log'" >> .env
echo "SESSION_DRIVER='cookie'" >> .env

echo "Environment file (.env) generated successfully."

# Clear cached config to force reload from the new .env file
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Fix storage permissions
chmod -R 777 storage bootstrap/cache

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Start the server
echo "Starting server..."
exec php artisan serve --host=0.0.0.0 --port=10000
