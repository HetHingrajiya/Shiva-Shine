#!/bin/sh
set -e

echo "Initializing..."
echo "Current DB_CONNECTION Env Var: $DB_CONNECTION"

# Regenerate .env with forceful single quotes
echo "Generating .env file..."

# Write lines without using variables immediately to ensure content
echo "APP_NAME='ShivaShine'" > .env
echo "APP_ENV='production'" >> .env
echo "APP_DEBUG='true'" >> .env
echo "LOG_CHANNEL='stderr'" >> .env

# Database - Critical Section
echo "DB_CONNECTION='pgsql'" >> .env
echo "DB_HOST='$DB_HOST'" >> .env
echo "DB_PORT='$DB_PORT'" >> .env
echo "DB_DATABASE='$DB_DATABASE'" >> .env
echo "DB_USERNAME='$DB_USERNAME'" >> .env
echo "DB_PASSWORD='$DB_PASSWORD'" >> .env

echo "APP_KEY='$APP_KEY'" >> .env
echo "APP_URL='$APP_URL'" >> .env

echo "Done generating .env"

# CLEAR ALL CACHES - Use force
php artisan config:clear
php artisan cache:clear

# Debug: Print the connection config before running migrate
echo "Checking Laravel Database Config..."
php -r "echo 'Configured DB Connection: ' . config('database.default') . PHP_EOL;"

# Run migrations
echo "Running migrations..."
php artisan migrate --force

echo "Starting server..."
exec php artisan serve --host=0.0.0.0 --port=10000
