<?php
// Simple diagnostic file to check paths and errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Laravel Hostinger Diagnostics</h1>";

// Check PHP version
echo "<p>PHP Version: " . phpversion() . "</p>";

// Check public path
$publicPath = __DIR__ . '/public';
echo "<p>Public Directory Exists: " . (is_dir($publicPath) ? 'Yes' : 'No') . "</p>";

// Check index.php
$indexPath = $publicPath . '/index.php';
echo "<p>public/index.php Exists: " . (file_exists($indexPath) ? 'Yes' : 'No') . "</p>";

// Storage permissions
$storagePath = __DIR__ . '/storage';
if (is_dir($storagePath)) {
    echo "<p>Storage Directory Writable: " . (is_writable($storagePath) ? 'Yes' : 'No') . "</p>";
}
else {
    echo "<p>Storage Directory: Not Found</p>";
}

// Check vendor
$vendorPath = __DIR__ . '/vendor';
echo "<p>Vendor Directory (Dependencies) Exists: " . (is_dir($vendorPath) ? 'Yes' : 'No') . " - <small>If No, you forgot to upload vendor or run composer install.</small></p>";

// Check .env
$envPath = __DIR__ . '/.env';
echo "<p>.env File Exists: " . (file_exists($envPath) ? 'Yes' : 'No') . "</p>";

echo "<hr><pre>";
echo "Current Directory: " . __DIR__ . "\n";
echo "</pre>";

if (file_exists(__DIR__ . '/storage/logs/laravel.log')) {
    echo "<h2>Last 10 lines of Laravel Log:</h2><pre>";
    $lines = file(__DIR__ . '/storage/logs/laravel.log');
    $last_lines = array_slice($lines, -10);
    echo htmlspecialchars(implode("", $last_lines));
    echo "</pre>";
}
?>
