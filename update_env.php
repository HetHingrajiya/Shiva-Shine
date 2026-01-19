<?php

// List of keys we want to sync from System Env to .env file
$keysToSync = [
    'APP_KEY',
    'APP_DEBUG',
    'APP_URL',
    'LOG_CHANNEL',
    'DB_CONNECTION',
    'DB_HOST',
    'DB_PORT',
    'DB_DATABASE',
    'DB_USERNAME',
    'DB_PASSWORD',
];

$envFile = __DIR__ . '/.env';

if (!file_exists($envFile)) {
    if (file_exists(__DIR__ . '/.env.example')) {
        copy(__DIR__ . '/.env.example', $envFile);
    } else {
        touch($envFile);
    }
}

$envContent = file_get_contents($envFile);
$lines = explode("\n", $envContent);
$newLines = [];
$keysFound = [];

// Parse existing lines
foreach ($lines as $line) {
    if (trim($line) === '') {
        $newLines[] = $line;
        continue;
    }
    
    // Check if line is a key=value pair
    if (strpos($line, '=') !== false) {
        list($key, $val) = explode('=', $line, 2);
        $key = trim($key);
        
        if (in_array($key, $keysToSync)) {
            // If this key is in our sync list, check if we have a system env var for it
            $systemVal = getenv($key);
            if ($systemVal !== false) {
                // Determine if we need to quote the value (if it has spaces or special chars)
                $safeVal = $systemVal;
                // If it contains spaces or #, it's safer to quote, but .env parsers vary.
                // Simple strategy: if it has spaces, quote it. 
                // Render usually provides raw values.
                
                // Update the line
                $newLines[] = "{$key}={$safeVal}";
                $keysFound[] = $key;
                continue;
            }
        }
    }
    
    $newLines[] = $line;
}

// Append missing keys
foreach ($keysToSync as $key) {
    if (!in_array($key, $keysFound)) {
        $systemVal = getenv($key);
        if ($systemVal !== false) {
            $newLines[] = "{$key}={$systemVal}";
        }
    }
}

file_put_contents($envFile, implode("\n", $newLines));

echo "Successfully synchronized .env with system environment variables.\n";
