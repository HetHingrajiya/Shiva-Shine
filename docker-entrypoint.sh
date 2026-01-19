#!/bin/sh
set -e

# Copy .env.example to .env if missing
if [ ! -f .env ]; then
    cp .env.example .env
fi

# -----------------------------------------------------------------------------
# HOST/PORT FIX
# Render provides config variables, but 'php artisan serve' often ignores them
# if they are not in the .env file. We must FORCE them into the file.
# -----------------------------------------------------------------------------

# Helper function to update or append env var
update_env() {
    key=$1
    value=$2
    if grep -q "^${key}=" .env; then
        # Use a different delimiter (#) for sed to avoid issues with / or |
        sed -i "s#^${key}=.*#${key}=${value}#g" .env
    else
        echo "${key}=${value}" >> .env
    fi
}

echo "Injecting Render configuration into .env..."

if [ ! -z "$APP_KEY" ]; then
    update_env "APP_KEY" "$APP_KEY"
fi

if [ ! -z "$DB_HOST" ]; then
    update_env "DB_CONNECTION" "pgsql"
    update_env "DB_HOST" "$DB_HOST"
    update_env "DB_PORT" "5432"  # Force standard PG port if not set, or use $DB_PORT
    update_env "DB_DATABASE" "$DB_DATABASE"
    update_env "DB_USERNAME" "$DB_USERNAME"
    update_env "DB_PASSWORD" "$DB_PASSWORD"
fi

# Ensure log channel is stderr for Render
update_env "LOG_CHANNEL" "stderr"

# -----------------------------------------------------------------------------

# Clear config caches
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
