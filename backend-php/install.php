<?php
/**
 * Installations-Script für das PHP Backend
 * Prüft Systemanforderungen und richtet das Backend ein
 */

echo "<!DOCTYPE html>
<html lang='de'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Mayer Elektro Backend - Installation</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .success { color: #28a745; }
        .warning { color: #ffc107; }
        .error { color: #dc3545; }
        .info { color: #17a2b8; }
        .box { padding: 15px; margin: 10px 0; border-radius: 5px; }
        .success-box { background: #d4edda; border: 1px solid #c3e6cb; }
        .warning-box { background: #fff3cd; border: 1px solid #ffeaa7; }
        .error-box { background: #f8d7da; border: 1px solid #f5c6cb; }
        .info-box { background: #d1ecf1; border: 1px solid #bee5eb; }
        pre { background: #f8f9fa; padding: 10px; border-radius: 5px; overflow-x: auto; }
        .check-item { margin: 10px 0; padding: 10px; border-left: 4px solid #ddd; }
        .check-ok { border-left-color: #28a745; }
        .check-warning { border-left-color: #ffc107; }
        .check-error { border-left-color: #dc3545; }
    </style>
</head>
<body>";

echo "<h1>🚀 Mayer Elektro Backend - Installation</h1>";

$checks = [];
$errors = [];
$warnings = [];

// PHP Version prüfen
$phpVersion = PHP_VERSION;
$minPhpVersion = '7.4.0';
if (version_compare($phpVersion, $minPhpVersion, '>=')) {
    $checks[] = ['status' => 'ok', 'message' => "PHP Version: $phpVersion ✅"];
} else {
    $errors[] = "PHP Version zu alt: $phpVersion (mindestens $minPhpVersion erforderlich)";
    $checks[] = ['status' => 'error', 'message' => "PHP Version: $phpVersion ❌"];
}

// Erforderliche PHP-Erweiterungen prüfen
$requiredExtensions = ['json', 'fileinfo', 'mbstring', 'session'];
foreach ($requiredExtensions as $ext) {
    if (extension_loaded($ext)) {
        $checks[] = ['status' => 'ok', 'message' => "PHP Extension '$ext': Verfügbar ✅"];
    } else {
        $errors[] = "PHP Extension '$ext' nicht verfügbar";
        $checks[] = ['status' => 'error', 'message' => "PHP Extension '$ext': Nicht verfügbar ❌"];
    }
}

// Mail-Funktion prüfen
if (function_exists('mail')) {
    $checks[] = ['status' => 'ok', 'message' => "PHP mail() Funktion: Verfügbar ✅"];
} else {
    $warnings[] = "PHP mail() Funktion nicht verfügbar - E-Mail-Versand funktioniert nicht";
    $checks[] = ['status' => 'warning', 'message' => "PHP mail() Funktion: Nicht verfügbar ⚠️"];
}

// Verzeichnisse prüfen und erstellen
$directories = [
    __DIR__ . '/uploads' => 'Upload-Verzeichnis',
    __DIR__ . '/storage' => 'Storage-Verzeichnis'
];

foreach ($directories as $dir => $name) {
    if (!is_dir($dir)) {
        if (mkdir($dir, 0755, true)) {
            $checks[] = ['status' => 'ok', 'message' => "$name: Erstellt ✅"];
        } else {
            $errors[] = "$name konnte nicht erstellt werden: $dir";
            $checks[] = ['status' => 'error', 'message' => "$name: Erstellung fehlgeschlagen ❌"];
        }
    } else {
        $checks[] = ['status' => 'ok', 'message' => "$name: Existiert bereits ✅"];
    }
    
    // Schreibrechte prüfen
    if (is_writable($dir)) {
        $checks[] = ['status' => 'ok', 'message' => "$name: Schreibbar ✅"];
    } else {
        $errors[] = "$name ist nicht schreibbar: $dir";
        $checks[] = ['status' => 'error', 'message' => "$name: Nicht schreibbar ❌"];
    }
}

// .env Datei prüfen
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $checks[] = ['status' => 'ok', 'message' => ".env Datei: Gefunden ✅"];
    
    // .env laden und wichtige Variablen prüfen
    $envContent = file_get_contents($envFile);
    $requiredEnvVars = ['EMAIL_USER', 'EMAIL_PASS', 'SMTP_HOST'];
    
    foreach ($requiredEnvVars as $var) {
        if (strpos($envContent, $var . '=') !== false) {
            $checks[] = ['status' => 'ok', 'message' => "Umgebungsvariable '$var': Gesetzt ✅"];
        } else {
            $warnings[] = "Umgebungsvariable '$var' nicht in .env gefunden";
            $checks[] = ['status' => 'warning', 'message' => "Umgebungsvariable '$var': Nicht gesetzt ⚠️"];
        }
    }
} else {
    $errors[] = ".env Datei nicht gefunden";
    $checks[] = ['status' => 'error', 'message' => ".env Datei: Nicht gefunden ❌"];
}

// PHP-Konfiguration prüfen
$phpConfig = [
    'upload_max_filesize' => '10M',
    'post_max_size' => '50M',
    'max_file_uploads' => '6',
    'memory_limit' => '256M'
];

foreach ($phpConfig as $setting => $recommended) {
    $current = ini_get($setting);
    $checks[] = ['status' => 'info', 'message' => "PHP $setting: $current (empfohlen: $recommended) ℹ️"];
}

// Ergebnisse anzeigen
echo "<h2>📋 System-Checks</h2>";

foreach ($checks as $check) {
    $class = 'check-' . $check['status'];
    echo "<div class='check-item $class'>{$check['message']}</div>";
}

// Zusammenfassung
echo "<h2>📊 Zusammenfassung</h2>";

if (empty($errors)) {
    echo "<div class='box success-box'>";
    echo "<h3 class='success'>✅ Installation erfolgreich!</h3>";
    echo "<p>Das Backend ist bereit für den Einsatz.</p>";
    echo "</div>";
} else {
    echo "<div class='box error-box'>";
    echo "<h3 class='error'>❌ Installation fehlgeschlagen</h3>";
    echo "<p>Folgende Fehler müssen behoben werden:</p>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li class='error'>$error</li>";
    }
    echo "</ul>";
    echo "</div>";
}

if (!empty($warnings)) {
    echo "<div class='box warning-box'>";
    echo "<h3 class='warning'>⚠️ Warnungen</h3>";
    echo "<ul>";
    foreach ($warnings as $warning) {
        echo "<li class='warning'>$warning</li>";
    }
    echo "</ul>";
    echo "</div>";
}

// Nächste Schritte
echo "<h2>🔧 Nächste Schritte</h2>";

if (empty($errors)) {
    echo "<div class='box info-box'>";
    echo "<ol>";
    echo "<li><strong>Backend testen:</strong> <a href='api/health' target='_blank'>Health Check aufrufen</a></li>";
    echo "<li><strong>Frontend konfigurieren:</strong> API-URLs auf PHP Backend umstellen</li>";
    echo "<li><strong>E-Mail testen:</strong> Kontaktformular verwenden</li>";
    echo "<li><strong>Datei-Upload testen:</strong> Bewerbungsformular verwenden</li>";
    echo "<li><strong>Logs überwachen:</strong> PHP error_log prüfen</li>";
    echo "</ol>";
    echo "</div>";
} else {
    echo "<div class='box error-box'>";
    echo "<ol>";
    echo "<li><strong>Fehler beheben:</strong> Siehe Fehlerliste oben</li>";
    echo "<li><strong>Installation wiederholen:</strong> Diese Seite neu laden</li>";
    echo "</ol>";
    echo "</div>";
}

// Konfigurationsbeispiele
echo "<h2>⚙️ Konfiguration</h2>";

echo "<h3>.env Beispiel:</h3>";
echo "<pre>";
echo "# E-Mail Konfiguration
EMAIL_USER=your-email@domain.com
EMAIL_PASS=your-password

# SMTP Konfiguration
SMTP_HOST=smtp.domain.com
SMTP_PORT=587
SMTP_SECURE=false

# Server Konfiguration
PORT=4000

# CORS Origins
CORS_ORIGINS=http://localhost:5173,http://127.0.0.1:5173

# Upload Konfiguration
MAX_FILE_SIZE=5242880
UPLOAD_DIR=uploads

# Firmeninformationen
COMPANY_NAME=Mayer Elektro GmbH
COMPANY_EMAIL=info@mayer-elektro.de";
echo "</pre>";

echo "<h3>Apache .htaccess (bereits konfiguriert):</h3>";
echo "<pre>";
echo "RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]

# Security Headers
Header always set X-Content-Type-Options \"nosniff\"
Header always set X-Frame-Options \"DENY\"
Header always set X-XSS-Protection \"1; mode=block\"

# Upload-Limits
php_value upload_max_filesize 10M
php_value post_max_size 50M
php_value max_file_uploads 6";
echo "</pre>";

// System-Informationen
echo "<h2>🖥️ System-Informationen</h2>";
echo "<div class='box info-box'>";
echo "<ul>";
echo "<li><strong>PHP Version:</strong> " . PHP_VERSION . "</li>";
echo "<li><strong>Server Software:</strong> " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unbekannt') . "</li>";
echo "<li><strong>Betriebssystem:</strong> " . PHP_OS . "</li>";
echo "<li><strong>Aktuelles Verzeichnis:</strong> " . __DIR__ . "</li>";
echo "<li><strong>Zeitzone:</strong> " . date_default_timezone_get() . "</li>";
echo "<li><strong>Memory Limit:</strong> " . ini_get('memory_limit') . "</li>";
echo "<li><strong>Max Execution Time:</strong> " . ini_get('max_execution_time') . "s</li>";
echo "</ul>";
echo "</div>";

echo "<hr>";
echo "<p><small>Installation durchgeführt am: " . date('Y-m-d H:i:s') . "</small></p>";

echo "</body></html>";
?>