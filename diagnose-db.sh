#!/bin/sh
# Database Diagnostic Script for Render Deployment

echo "=== DATABASE DIAGNOSTIC ==="
echo ""
echo "Environment Variables:"
echo "DB_CONNECTION: ${DB_CONNECTION:-pgsql}"
echo "DB_HOST: ${DB_HOST:-dpg-d5ohbhf5c7fs73d4ah70-a.oregon-postgres.render.com}"
echo "DB_PORT: ${DB_PORT:-5432}"
echo "DB_DATABASE: ${DB_DATABASE:-shivashinedb}"
echo "DB_USERNAME: ${DB_USERNAME:-shivashinedb_user}"
echo "DB_PASSWORD: ${DB_PASSWORD:+[SET]}"
echo ""
echo "=== Laravel Config (after bootstrap) ==="
php -r "
require 'vendor/autoload.php';
\$app = require_once 'bootstrap/app.php';
\$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
echo 'Default Connection: ' . config('database.default') . PHP_EOL;
echo 'Host: ' . config('database.connections.' . config('database.default') . '.host') . PHP_EOL;
echo 'Port: ' . config('database.connections.' . config('database.default') . '.port') . PHP_EOL;
echo 'Database: ' . config('database.connections.' . config('database.default') . '.database') . PHP_EOL;
"
echo ""
echo "=== Testing PostgreSQL Connection ==="
if command -v psql > /dev/null 2>&1; then
    PGPASSWORD="${DB_PASSWORD:-Xdo2CHpb2G3kzb5yYXdn7Gscey9VVF18}" psql -h "${DB_HOST:-dpg-d5ohbhf5c7fs73d4ah70-a.oregon-postgres.render.com}" -p "${DB_PORT:-5432}" -U "${DB_USERNAME:-shivashinedb_user}" -d "${DB_DATABASE:-shivashinedb}" -c "SELECT version();" 2>&1
else
    echo "psql not available, skipping direct connection test"
fi
echo ""
echo "=== End Diagnostic ==="
