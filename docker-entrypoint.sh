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
# Default to pgsql if on Render, or mysql if local, if not provided
if [ -z "$DB_CONNECTION" ]; then
    export DB_CONNECTION='pgsql'
fi

# Ensure SQLite file exists just in case Laravel defaults to it
mkdir -p database
touch database/database.sqlite

# Only write if variables are present, otherwise Laravel will use defaults from config/database.php
echo "DB_CONNECTION=$DB_CONNECTION" >> .env
if [ -n "$DB_HOST" ]; then
    echo "DB_HOST=$DB_HOST" >> .env
fi
if [ -n "$DB_PORT" ]; then
    echo "DB_PORT=$DB_PORT" >> .env
fi
if [ -n "$DB_DATABASE" ]; then
    echo "DB_DATABASE=$DB_DATABASE" >> .env
fi
if [ -n "$DB_USERNAME" ]; then
    echo "DB_USERNAME=$DB_USERNAME" >> .env
fi
if [ -n "$DB_PASSWORD" ]; then
    echo "DB_PASSWORD=$DB_PASSWORD" >> .env
fi

if [ -n "$APP_KEY" ]; then
    echo "APP_KEY=$APP_KEY" >> .env
fi
if [ -n "$APP_URL" ]; then
    echo "APP_URL=$APP_URL" >> .env
fi

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
