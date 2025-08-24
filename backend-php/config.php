<?php
/**
 * Konfigurationsdatei für das PHP Backend
 */

// .env Datei laden
function loadEnv($path) {
    if (!file_exists($path)) {
        throw new Exception('.env Datei nicht gefunden: ' . $path);
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Kommentar überspringen
        }
        
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// .env laden
loadEnv(__DIR__ . '/.env');

// PHP Konfiguration
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '50M');
ini_set('max_file_uploads', 6);
ini_set('memory_limit', '256M');
ini_set('max_execution_time', 300);

// Production-spezifische Einstellungen
if (!isset($_ENV['DEVELOPMENT']) || $_ENV['DEVELOPMENT'] !== 'true') {
    // Fehler-Reporting für Production
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    
    // Log-Datei für Fehler
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/logs/php_errors.log');
}

// Upload-Verzeichnis erstellen
$uploadDir = __DIR__ . '/' . ($_ENV['UPLOAD_DIR'] ?? 'uploads');
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Konstanten definieren
define('UPLOAD_DIR', $uploadDir);
define('MAX_FILE_SIZE', (int)($_ENV['MAX_FILE_SIZE'] ?? 5242880)); // 5MB default
define('MAX_TOTAL_SIZE', 25 * 1024 * 1024); // 25MB
define('MAX_FILES', 6);

// Erlaubte MIME-Types
define('ALLOWED_MIMES', [
    'application/pdf',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/msword',
    'image/jpeg',
    'image/jpg',
    'image/png'
]);

// Gefährliche Dateierweiterungen
define('DANGEROUS_EXTENSIONS', [
    '.exe', '.bat', '.cmd', '.com', '.pif', '.scr', '.vbs', 
    '.js', '.jar', '.php', '.asp', '.jsp', '.sh', '.py'
]);

// Spam-Keywords
define('SPAM_KEYWORDS', [
    'viagra', 'casino', 'lottery', 'winner', 'congratulations', 
    'click here', 'free money', 'make money fast', 'get rich quick'
]);

// E-Mail Konfiguration
define('SMTP_CONFIG', [
    'host' => $_ENV['SMTP_HOST'] ?? 'smtp.web.de',
    'port' => (int)($_ENV['SMTP_PORT'] ?? 587),
    'secure' => ($_ENV['SMTP_SECURE'] ?? 'false') === 'true',
    'username' => $_ENV['EMAIL_USER'] ?? '',
    'password' => $_ENV['EMAIL_PASS'] ?? ''
]);

// Firmeninformationen
define('COMPANY_INFO', [
    'name' => $_ENV['COMPANY_NAME'] ?? 'Mayer Elektro GmbH',
    'address' => $_ENV['COMPANY_ADDRESS'] ?? 'Musterstraße 123',
    'postal_code' => $_ENV['COMPANY_POSTAL_CODE'] ?? '12345',
    'city' => $_ENV['COMPANY_CITY'] ?? 'Hamburg',
    'phone' => $_ENV['COMPANY_PHONE'] ?? '+49 (0) 40 123 456 789',
    'email' => $_ENV['COMPANY_EMAIL'] ?? 'info@mayer-elektro.de',
    'website' => $_ENV['COMPANY_WEBSITE'] ?? 'https://mayer-elektro.de',
    'logo_url' => $_ENV['COMPANY_LOGO_URL'] ?? 'https://mayer-elektro.de/logo-navbar-transparent.png'
]);

// Rate Limiting Konfiguration
define('RATE_LIMITS', [
    'general' => ['max' => 100, 'window' => 900], // 100 requests per 15 minutes
    'contact' => ['max' => 5, 'window' => 3600],  // 5 requests per hour
    'application' => ['max' => 3, 'window' => 86400] // 3 requests per day
]);

// Timezone setzen
date_default_timezone_set('Europe/Berlin');

// Session-Konfiguration für Rate Limiting (vor session_start())
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
    ini_set('session.use_strict_mode', 1);
}