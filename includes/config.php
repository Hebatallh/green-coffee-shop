<?php
// ========================================
// Green Coffee Shop - Configuration File
// ========================================

// Database Settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'green_coffee_shop');

// OpenAI API Key
define('OPENAI_API_KEY', 'YOUR_OPENAI_API_KEY_HERE');

// Auto-detect base URL (works with any folder name)
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
$script   = $_SERVER['SCRIPT_NAME'] ?? '';
$parts    = explode('/', trim($script, '/'));
$folder   = $parts[0] ?? '';
define('BASE_URL', $protocol . '://' . $host . '/' . $folder);
define('SITE_NAME', 'Green Coffee Shop');
?>
