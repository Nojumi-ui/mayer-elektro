<?php
/**
 * Mayer Elektro Backend - PHP Version
 * Vollständige Portierung des Node.js Backends nach PHP
 */

// Error Reporting für Development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session starten für Rate Limiting
session_start();

// Autoload für Composer (falls verwendet)
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Konfiguration laden
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/classes/RateLimiter.php';
require_once __DIR__ . '/classes/Validator.php';
require_once __DIR__ . '/classes/FileHandler.php';
require_once __DIR__ . '/classes/EmailService.php';
require_once __DIR__ . '/classes/SecurityHelper.php';

// CORS Headers setzen
$corsOrigins = explode(',', $_ENV['CORS_ORIGINS'] ?? 'http://localhost:5173,http://127.0.0.1:5173');
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if (in_array($origin, $corsOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
}

header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset=utf-8');

// Preflight OPTIONS Request behandeln
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Security Headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// CSP Header
$csp = "default-src 'self'; style-src 'self' 'unsafe-inline'; script-src 'self'; img-src 'self' data: https:;";
header("Content-Security-Policy: $csp");

// Rate Limiter initialisieren
$rateLimiter = new RateLimiter();
$validator = new Validator();
$fileHandler = new FileHandler();
$emailService = new EmailService();
$security = new SecurityHelper();

// Request ID für Logging generieren
$requestId = bin2hex(random_bytes(8));

// IP-Adresse ermitteln
$clientIP = $security->getClientIP();

// Logging-Funktion
function logRequest($requestId, $type, $data = []) {
    $timestamp = date('Y-m-d H:i:s');
    $logData = [
        'timestamp' => $timestamp,
        'request_id' => $requestId,
        'type' => $type,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        'data' => $data
    ];
    
    error_log("[$requestId] $type: " . json_encode($logData, JSON_UNESCAPED_UNICODE));
}

// Router-Funktion
function route($method, $path, $callback) {
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    if ($requestMethod === $method && $requestPath === $path) {
        return $callback();
    }
    return false;
}

// JSON Response Helper
function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit();
}

// Error Handler
function handleError($message, $statusCode = 500, $requestId = null) {
    if ($requestId) {
        logRequest($requestId, 'ERROR', ['message' => $message]);
    }
    
    jsonResponse([
        'success' => false,
        'message' => $message,
        'request_id' => $requestId
    ], $statusCode);
}

// Main Router
try {
    // Kontakt-Endpoint
    if (route('POST', '/api/contact', function() use ($rateLimiter, $validator, $emailService, $security, $requestId, $clientIP) {
        logRequest($requestId, 'CONTACT_REQUEST', [
            'ip' => $clientIP,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]);
        
        // Rate Limiting für Kontaktanfragen (5 pro Stunde)
        if (!$rateLimiter->checkLimit($clientIP, 'contact', 5, 3600)) {
            handleError('Zu viele Kontaktanfragen. Bitte warten Sie eine Stunde bevor Sie erneut eine Nachricht senden.', 429, $requestId);
        }
        
        // Input lesen und sanitizen
        $rawInput = file_get_contents('php://input');
        logRequest($requestId, 'RAW_INPUT', ['raw' => substr($rawInput, 0, 200)]);
        
        $input = json_decode($rawInput, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            logRequest($requestId, 'JSON_ERROR', [
                'error' => json_last_error_msg(),
                'raw_input' => substr($rawInput, 0, 200)
            ]);
            handleError('Ungültige JSON-Daten: ' . json_last_error_msg(), 400, $requestId);
        }
        
        if (!$input || !is_array($input)) {
            handleError('Leere oder ungültige JSON-Daten', 400, $requestId);
        }
        
        $sanitizedData = $security->sanitizeObject($input);
        $name = $sanitizedData['name'] ?? '';
        $email = $sanitizedData['email'] ?? '';
        $message = $sanitizedData['message'] ?? '';
        
        // Validierung
        $validationErrors = $validator->validateContactForm([
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);
        
        if (!empty($validationErrors)) {
            logRequest($requestId, 'VALIDATION_ERROR', $validationErrors);
            jsonResponse([
                'success' => false,
                'message' => 'Validierungsfehler',
                'errors' => $validationErrors
            ], 400);
        }
        
        // Spam-Schutz
        $spamKeywords = ['viagra', 'casino', 'lottery', 'winner', 'congratulations', 'click here', 'free money'];
        $messageText = strtolower($message);
        
        foreach ($spamKeywords as $keyword) {
            if (strpos($messageText, $keyword) !== false) {
                logRequest($requestId, 'SPAM_DETECTED', ['name' => $name, 'email' => $email]);
                handleError('Nachricht wurde als Spam erkannt', 400, $requestId);
            }
        }
        
        logRequest($requestId, 'CONTACT_PROCESSING', [
            'name' => substr($name, 0, 20) . '...',
            'email' => substr($email, 0, 20) . '...',
            'message_length' => strlen($message)
        ]);
        
        // E-Mail senden
        $emailSent = $emailService->sendContactEmail($name, $email, $message, $requestId, $clientIP);
        
        // Rate Limit erhöhen
        $rateLimiter->incrementLimit($clientIP, 'contact');
        
        jsonResponse([
            'success' => true,
            'message' => 'Nachricht erfolgreich gesendet',
            'request_id' => $requestId,
            'email_sent' => $emailSent
        ]);
    })) return;
    
    // Bewerbungs-Endpoint
    if (route('POST', '/api/submit-application', function() use ($rateLimiter, $validator, $fileHandler, $emailService, $security, $requestId, $clientIP) {
        logRequest($requestId, 'APPLICATION_REQUEST', [
            'ip' => $clientIP,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]);
        
        // Rate Limiting für Bewerbungen (3 pro Tag)
        if (!$rateLimiter->checkLimit($clientIP, 'application', 3, 86400)) {
            handleError('Zu viele Bewerbungen. Sie können maximal 3 Bewerbungen pro Tag einreichen.', 429, $requestId);
        }
        
        // Multipart/form-data verarbeiten
        $formData = $_POST;
        $files = $_FILES;
        
        // Input sanitizen
        $sanitizedData = $security->sanitizeObject($formData);
        
        // Validierung der Formulardaten
        $validationErrors = $validator->validateApplicationForm($sanitizedData);
        
        if (!empty($validationErrors)) {
            logRequest($requestId, 'APPLICATION_VALIDATION_ERROR', $validationErrors);
            $fileHandler->cleanupFiles($files);
            jsonResponse([
                'success' => false,
                'message' => 'Validierungsfehler',
                'errors' => $validationErrors
            ], 400);
        }
        
        // CV-Pflicht prüfen
        if (!isset($files['cv']) || $files['cv']['error'] !== UPLOAD_ERR_OK) {
            $fileHandler->cleanupFiles($files);
            handleError('Ein Lebenslauf (CV) ist erforderlich', 400, $requestId);
        }
        
        // Datei-Validierung
        $fileValidationResult = $fileHandler->validateFiles($files);
        if (!$fileValidationResult['success']) {
            $fileHandler->cleanupFiles($files);
            jsonResponse([
                'success' => false,
                'message' => 'Datei-Validierungsfehler',
                'errors' => $fileValidationResult['errors']
            ], 400);
        }
        
        // Dateien verarbeiten und sicher speichern
        $processedFiles = $fileHandler->processFiles($files, $requestId);
        if (!$processedFiles['success']) {
            $fileHandler->cleanupFiles($files);
            handleError($processedFiles['message'], 400, $requestId);
        }
        
        logRequest($requestId, 'APPLICATION_PROCESSING', [
            'name' => ($sanitizedData['firstName'] ?? '') . ' ' . ($sanitizedData['lastName'] ?? ''),
            'email' => substr($sanitizedData['email'] ?? '', 0, 20) . '...',
            'position' => $sanitizedData['position'] ?? '',
            'files_count' => count($processedFiles['files']),
            'total_size_mb' => round($processedFiles['total_size'] / 1024 / 1024, 2)
        ]);
        
        // E-Mails senden
        $emailResult = $emailService->sendApplicationEmail($sanitizedData, $processedFiles['files'], $requestId, $clientIP);
        
        if (!$emailResult['success'] && $emailResult['critical']) {
            $fileHandler->cleanupProcessedFiles($processedFiles['files']);
            handleError('E-Mail-Service temporär nicht verfügbar. Bitte versuchen Sie es später erneut.', 500, $requestId);
        }
        
        // Bestätigungs-E-Mail an Bewerber
        $confirmationSent = $emailService->sendConfirmationEmail($sanitizedData, $requestId);
        
        // Rate Limit erhöhen
        $rateLimiter->incrementLimit($clientIP, 'application');
        
        logRequest($requestId, 'APPLICATION_SUCCESS', [
            'firstName' => $sanitizedData['firstName'] ?? '',
            'lastName' => $sanitizedData['lastName'] ?? '',
            'email' => substr($sanitizedData['email'] ?? '', 0, 20) . '...',
            'position' => $sanitizedData['position'] ?? '',
            'email_sent' => $emailResult['success'],
            'confirmation_sent' => $confirmationSent
        ]);
        
        jsonResponse([
            'success' => true,
            'message' => 'Bewerbung erfolgreich gesendet',
            'request_id' => $requestId,
            'email_sent' => $emailResult['success'],
            'confirmation_sent' => $confirmationSent
        ]);
    })) return;
    
    // Legacy Apply Endpoint (für Kompatibilität)
    if (route('POST', '/api/apply', function() use ($rateLimiter, $requestId, $clientIP) {
        logRequest($requestId, 'LEGACY_APPLY_REQUEST', [
            'warning' => 'Veralteter Endpoint verwendet'
        ]);
        
        // Rate Limiting
        if (!$rateLimiter->checkLimit($clientIP, 'application', 3, 86400)) {
            handleError('Zu viele Bewerbungen. Sie können maximal 3 Bewerbungen pro Tag einreichen.', 429, $requestId);
        }
        
        // Einfache Verarbeitung für Legacy-Kompatibilität
        $totalSize = 0;
        if (isset($_FILES['files'])) {
            foreach ($_FILES['files']['size'] as $size) {
                $totalSize += $size;
            }
        }
        
        if ($totalSize > 5 * 1024 * 1024) {
            // Cleanup
            if (isset($_FILES['files'])) {
                foreach ($_FILES['files']['tmp_name'] as $tmpName) {
                    if (file_exists($tmpName)) {
                        unlink($tmpName);
                    }
                }
            }
            handleError('Gesamte Dateigröße überschreitet 5 MB', 400, $requestId);
        }
        
        logRequest($requestId, 'LEGACY_APPLY_PROCESSING', $_POST);
        
        jsonResponse([
            'success' => true,
            'message' => 'Bewerbung erhalten (Legacy-Endpoint)',
            'request_id' => $requestId,
            'warning' => 'Dieser Endpoint ist veraltet. Bitte verwenden Sie /api/submit-application'
        ]);
    })) return;
    
    // Uploads-Verzeichnis statisch bereitstellen
    if (route('GET', '/uploads', function() {
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $filePath = __DIR__ . $requestPath;
        
        if (file_exists($filePath) && is_file($filePath)) {
            $mimeType = mime_content_type($filePath);
            header("Content-Type: $mimeType");
            readfile($filePath);
            exit();
        }
        
        http_response_code(404);
        echo 'File not found';
        exit();
    })) return;
    
    // Health Check Endpoint
    if (route('GET', '/api/health', function() use ($requestId) {
        jsonResponse([
            'success' => true,
            'message' => 'Backend is running',
            'timestamp' => date('c'),
            'request_id' => $requestId,
            'version' => '1.0.0-php'
        ]);
    })) return;
    
    // Debug Endpoint für SMTP-Konfiguration
    if (route('GET', '/api/debug/smtp', function() use ($requestId) {
        $config = SMTP_CONFIG;
        jsonResponse([
            'success' => true,
            'smtp_config' => [
                'host' => $config['host'],
                'port' => $config['port'],
                'secure' => $config['secure'],
                'username' => $config['username'],
                'password_set' => !empty($config['password'])
            ],
            'env_vars' => [
                'SEND_REAL_EMAILS' => $_ENV['SEND_REAL_EMAILS'] ?? 'not set',
                'SMTP_HOST' => $_ENV['SMTP_HOST'] ?? 'not set',
                'SMTP_PORT' => $_ENV['SMTP_PORT'] ?? 'not set',
                'SMTP_SECURE' => $_ENV['SMTP_SECURE'] ?? 'not set',
                'EMAIL_USER' => $_ENV['EMAIL_USER'] ?? 'not set'
            ],
            'request_id' => $requestId
        ]);
    })) return;
    
    // SMTP Test Endpoint
    if (route('POST', '/api/debug/test-email', function() use ($emailService, $requestId) {
        $input = json_decode(file_get_contents('php://input'), true);
        $testEmail = $input['email'] ?? 'test@example.com';
        
        $result = $emailService->sendContactEmail(
            'Test Benutzer',
            $testEmail,
            'Dies ist eine Test-E-Mail zur Überprüfung der SMTP-Funktionalität.',
            $requestId,
            '127.0.0.1'
        );
        
        jsonResponse([
            'success' => $result,
            'message' => $result ? 'Test-E-Mail erfolgreich gesendet' : 'Test-E-Mail fehlgeschlagen',
            'request_id' => $requestId
        ]);
    })) return;
    
    // Test Endpoint für Bewerbungs-E-Mails mit Anhängen
    if (route('POST', '/api/debug/test-application', function() use ($emailService, $requestId) {
        // Erstelle Test-Dateien
        $testFiles = [];
        $uploadDir = __DIR__ . '/uploads';
        
        // Test-PDF erstellen
        $testPdfContent = "%PDF-1.4\n1 0 obj\n<<\n/Type /Catalog\n/Pages 2 0 R\n>>\nendobj\n2 0 obj\n<<\n/Type /Pages\n/Kids [3 0 R]\n/Count 1\n>>\nendobj\n3 0 obj\n<<\n/Type /Page\n/Parent 2 0 R\n/MediaBox [0 0 612 792]\n>>\nendobj\nxref\n0 4\n0000000000 65535 f \n0000000009 00000 n \n0000000074 00000 n \n0000000120 00000 n \ntrailer\n<<\n/Size 4\n/Root 1 0 R\n>>\nstartxref\n179\n%%EOF";
        $testPdfPath = $uploadDir . '/test-bewerbung.pdf';
        file_put_contents($testPdfPath, $testPdfContent);
        
        $testFiles[] = [
            'path' => $testPdfPath,
            'original_name' => 'test-bewerbung.pdf',
            'mime_type' => 'application/pdf',
            'size' => strlen($testPdfContent)
        ];
        
        $formData = [
            'firstName' => 'Max',
            'lastName' => 'Mustermann',
            'email' => 'max.mustermann@example.com',
            'position' => 'Elektriker',
            'phone' => '+49 123 456789',
            'message' => 'Dies ist eine Test-Bewerbung mit Anhängen.'
        ];
        
        $result = $emailService->sendApplicationEmail($formData, $testFiles, $requestId, '127.0.0.1');
        
        // Test-Datei löschen
        if (file_exists($testPdfPath)) {
            unlink($testPdfPath);
        }
        
        jsonResponse([
            'success' => $result['success'] ?? false,
            'message' => $result['success'] ? 'Test-Bewerbung erfolgreich gesendet' : 'Test-Bewerbung fehlgeschlagen',
            'critical' => $result['critical'] ?? false,
            'request_id' => $requestId
        ]);
    })) return;
    
    // 404 für alle anderen Routen
    http_response_code(404);
    jsonResponse([
        'success' => false,
        'message' => 'Endpoint nicht gefunden',
        'request_id' => $requestId
    ], 404);
    
} catch (Exception $e) {
    error_log("Unhandled Exception [$requestId]: " . $e->getMessage());
    handleError('Ein unerwarteter Fehler ist aufgetreten', 500, $requestId);
}