#!/bin/sh
set -e

echo "========================================"
echo "   SHIVA SHINE - DEPLOYMENT STARTUP    "
echo "========================================"
echo ""

# Display database configuration (for debugging)
echo "Database Configuration:"
echo "  Connection: ${DB_CONNECTION:-pgsql}"
echo "  Host: ${DB_HOST:-[NOT SET]}"
echo "  Port: ${DB_PORT:-5432}"
echo "  Database: ${DB_DATABASE:-[NOT SET]}"
echo "  Username: ${DB_USERNAME:-[NOT SET]}"
echo "  Password: ${DB_PASSWORD:+[SET - Hidden]}"
echo ""

# Ensure storage directories exist with proper permissions
echo "Setting up storage directories..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p bootstrap/cache
chmod -R 775 storage bootstrap/cache
echo "✓ Storage directories configured"
echo ""

# Generate .env file from environment variables
echo "Generating .env configuration..."
cat > .env << EOF
# Application
APP_NAME=${APP_NAME:-ShivaShine}
APP_ENV=${APP_ENV:-production}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

# Logging
LOG_CHANNEL=${LOG_CHANNEL:-stderr}
LOG_LEVEL=${LOG_LEVEL:-debug}

# Database (PostgreSQL)
DB_CONNECTION=${DB_CONNECTION:-pgsql}
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT:-5432}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}

# Session & Cache
SESSION_DRIVER=${SESSION_DRIVER:-file}
SESSION_LIFETIME=120
CACHE_STORE=${CACHE_STORE:-file}
QUEUE_CONNECTION=${QUEUE_CONNECTION:-database}

# Mail Configuration
MAIL_MAILER=${MAIL_MAILER:-smtp}
MAIL_HOST=${MAIL_HOST:-smtp.gmail.com}
MAIL_PORT=${MAIL_PORT:-587}
MAIL_USERNAME=${MAIL_USERNAME}
MAIL_PASSWORD=${MAIL_PASSWORD}
MAIL_ENCRYPTION=${MAIL_ENCRYPTION:-tls}
MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS}
MAIL_FROM_NAME="${MAIL_FROM_NAME:-ShivaShine}"

# Google OAuth
GOOGLE_CLIENT_ID=${GOOGLE_CLIENT_ID}
GOOGLE_CLIENT_SECRET=${GOOGLE_CLIENT_SECRET}
GOOGLE_REDIRECT=${GOOGLE_REDIRECT}

# Razorpay (if configured)
RAZORPAY_KEY=${RAZORPAY_KEY}
RAZORPAY_SECRET=${RAZORPAY_SECRET}

# Other
BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
EOF

# Generate APP_KEY if not provided
if [ -z "$APP_KEY" ]; then
    echo "Generating new APP_KEY..."
    APP_KEY=$(php artisan key:generate --show)
    echo "APP_KEY=$APP_KEY" >> .env
else
    echo "APP_KEY=$APP_KEY" >> .env
fi

echo "✓ .env file generated"
echo ""

# Verify database configuration
echo "Verifying database connection..."
MISSING_VARS=""

if [ -z "$DB_HOST" ]; then
    MISSING_VARS="${MISSING_VARS}  - DB_HOST\n"
fi
if [ -z "$DB_DATABASE" ]; then
    MISSING_VARS="${MISSING_VARS}  - DB_DATABASE\n"
fi
if [ -z "$DB_USERNAME" ]; then
    MISSING_VARS="${MISSING_VARS}  - DB_USERNAME\n"
fi
if [ -z "$DB_PASSWORD" ]; then
    MISSING_VARS="${MISSING_VARS}  - DB_PASSWORD\n"
fi

if [ -n "$MISSING_VARS" ]; then
    echo "❌ ERROR: Database credentials are incomplete!"
    echo "   Missing environment variables:"
    echo -e "$MISSING_VARS"
    echo ""
    echo "   Current values:"
    echo "   DB_HOST=${DB_HOST:-[NOT SET]}"
    echo "   DB_DATABASE=${DB_DATABASE:-[NOT SET]}"
    echo "   DB_USERNAME=${DB_USERNAME:-[NOT SET]}"
    echo "   DB_PASSWORD=${DB_PASSWORD:+[SET]}"
    echo ""
    echo "   Please set these in Render Dashboard → Environment"
    exit 1
fi
echo "✓ Database credentials verified"
echo ""

# Clear all caches to ensure fresh configuration
echo "Clearing Laravel caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/services.php
rm -f bootstrap/cache/packages.php
echo "✓ Caches cleared"
echo ""

# Test database connection
echo "Testing database connection..."
echo "  Attempting to connect to: ${DB_HOST}:${DB_PORT}"
echo "  Database: ${DB_DATABASE}"
echo "  Username: ${DB_USERNAME}"
echo ""

MAX_RETRIES=10
RETRY_COUNT=0

while [ $RETRY_COUNT -lt $MAX_RETRIES ]; do
    echo "Attempt $((RETRY_COUNT + 1))/$MAX_RETRIES..."
    
    # Try to connect using Laravel's database connection
    if php -r "
        require 'vendor/autoload.php';
        \$app = require_once 'bootstrap/app.php';
        \$kernel = \$app->make(Illuminate\Contracts\Console\Kernel::class);
        \$kernel->bootstrap();
        try {
            DB::connection()->getPdo();
            echo 'Connected successfully';
            exit(0);
        } catch (Exception \$e) {
            echo 'Connection failed: ' . \$e->getMessage();
            exit(1);
        }
    " 2>&1; then
        echo "✓ Database connection successful"
        break
    else
        RETRY_COUNT=$((RETRY_COUNT + 1))
        if [ $RETRY_COUNT -lt $MAX_RETRIES ]; then
            echo "⚠ Database connection failed. Retrying in 10 seconds..."
            sleep 10
        else
            echo ""
            echo "❌ ERROR: Could not connect to database after $MAX_RETRIES attempts"
            echo ""
            echo "Troubleshooting Information:"
            echo "  1. Verify PostgreSQL database is running on Render"
            echo "  2. Check if database credentials are correct"
            echo "  3. Ensure database allows connections from this service"
            echo "  4. Try using internal hostname if available"
            echo ""
            echo "Current Configuration:"
            echo "  DB_HOST: ${DB_HOST}"
            echo "  DB_PORT: ${DB_PORT}"
            echo "  DB_DATABASE: ${DB_DATABASE}"
            echo "  DB_USERNAME: ${DB_USERNAME}"
            echo ""
            exit 1
        fi
    fi
done
echo ""

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force || {
    echo "❌ ERROR: Migration failed!"
    echo "   Please check your database credentials and network connectivity."
    exit 1
}
echo "✓ Migrations completed successfully"
echo ""

# Seed database with admin account
echo "Seeding database with admin account..."
php artisan db:seed --class=AdminSeeder --force || echo "⚠ Warning: Seeding failed or admin already exists"
echo "✓ Database seeding completed"
echo ""
echo "   Admin Login Credentials:"
echo "   Email: admin@shivashine.com"
echo "   Password: shivashine@108"
echo ""

# Cache configuration for production performance
echo "Caching configuration for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "✓ Configuration cached"
echo ""

echo "========================================"
echo "   Starting Laravel Application Server "
echo "========================================"
echo "Listening on: 0.0.0.0:10000"
echo ""

# Start the Laravel development server
exec php artisan serve --host=0.0.0.0 --port=10000
