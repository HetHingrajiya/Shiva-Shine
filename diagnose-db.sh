#!/bin/sh
# Database Diagnostic Script for Render Deployment

echo "=== DATABASE DIAGNOSTIC ==="
echo ""
echo "Environment Variables:"
echo "DB_CONNECTION: ${DB_CONNECTION}"
echo "DB_HOST: ${DB_HOST}"
echo "DB_PORT: ${DB_PORT}"
echo "DB_DATABASE: ${DB_DATABASE}"
echo "DB_USERNAME: ${DB_USERNAME}"
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
    PGPASSWORD="${DB_PASSWORD}" psql -h "${DB_HOST}" -p "${DB_PORT}" -U "${DB_USERNAME}" -d "${DB_DATABASE}" -c "SELECT version();" 2>&1
else
    echo "psql not available, skipping direct connection test"
fi
echo ""
echo "=== End Diagnostic ==="
