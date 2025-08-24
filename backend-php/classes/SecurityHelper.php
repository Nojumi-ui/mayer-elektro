<?php
/**
 * SecurityHelper Klasse
 * Implementiert Sicherheitsfunktionen wie Input-Sanitization und IP-Ermittlung
 */

class SecurityHelper {
    
    public function sanitizeInput($input) {
        if (!is_string($input)) {
            return $input;
        }
        
        // HTML-Tags entfernen und Eingabe trimmen
        $sanitized = trim($input);
        $sanitized = strip_tags($sanitized);
        $sanitized = htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');
        
        return $sanitized;
    }
    
    public function sanitizeObject($obj) {
        if (!is_array($obj)) {
            return $obj;
        }
        
        $sanitized = [];
        foreach ($obj as $key => $value) {
            if (is_string($value)) {
                $sanitized[$key] = $this->sanitizeInput($value);
            } elseif (is_array($value)) {
                $sanitized[$key] = $this->sanitizeObject($value);
            } else {
                $sanitized[$key] = $value;
            }
        }
        
        return $sanitized;
    }
    
    public function getClientIP() {
        // Verschiedene Möglichkeiten der IP-Ermittlung prüfen
        $ipKeys = [
            'HTTP_CF_CONNECTING_IP',     // Cloudflare
            'HTTP_CLIENT_IP',            // Proxy
            'HTTP_X_FORWARDED_FOR',      // Load Balancer/Proxy
            'HTTP_X_FORWARDED',          // Proxy
            'HTTP_X_CLUSTER_CLIENT_IP',  // Cluster
            'HTTP_FORWARDED_FOR',        // Proxy
            'HTTP_FORWARDED',            // Proxy
            'REMOTE_ADDR'                // Standard
        ];
        
        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) && !empty($_SERVER[$key])) {
                $ips = explode(',', $_SERVER[$key]);
                $ip = trim($ips[0]);
                
                if ($this->isValidIP($ip)) {
                    return $ip;
                }
            }
        }
        
        return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }
    
    private function isValidIP($ip) {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false;
    }
    
    public function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    public function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    public function isSpamContent($content) {
        $content = strtolower($content);
        
        foreach (SPAM_KEYWORDS as $keyword) {
            if (strpos($content, $keyword) !== false) {
                return true;
            }
        }
        
        // Zusätzliche Spam-Checks
        
        // Zu viele Links
        $linkCount = preg_match_all('/https?:\/\//', $content);
        if ($linkCount > 3) {
            return true;
        }
        
        // Zu viele Großbuchstaben
        $upperCount = preg_match_all('/[A-Z]/', $content);
        $totalChars = strlen(preg_replace('/[^a-zA-Z]/', '', $content));
        if ($totalChars > 0 && ($upperCount / $totalChars) > 0.5) {
            return true;
        }
        
        // Verdächtige Zeichen-Wiederholungen
        if (preg_match('/(.)\1{10,}/', $content)) {
            return true;
        }
        
        return false;
    }
    
    public function logSecurityEvent($type, $details = []) {
        $logData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'type' => $type,
            'ip' => $this->getClientIP(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'details' => $details
        ];
        
        error_log("SECURITY EVENT: " . json_encode($logData, JSON_UNESCAPED_UNICODE));
    }
    
    public function validateFileUpload($file) {
        $errors = [];
        
        // Datei-Upload-Fehler prüfen
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = $this->getUploadErrorMessage($file['error']);
            return $errors;
        }
        
        // Dateigröße prüfen
        if ($file['size'] > MAX_FILE_SIZE) {
            $errors[] = 'Datei ist zu groß';
        }
        
        // MIME-Type prüfen
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($mimeType, ALLOWED_MIMES)) {
            $errors[] = 'Ungültiger Dateityp';
        }
        
        // Dateiname prüfen
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array('.' . $extension, DANGEROUS_EXTENSIONS)) {
            $errors[] = 'Gefährliche Dateierweiterung';
            $this->logSecurityEvent('DANGEROUS_FILE_UPLOAD', [
                'filename' => $file['name'],
                'extension' => $extension
            ]);
        }
        
        return $errors;
    }
    
    private function getUploadErrorMessage($errorCode) {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return 'Datei ist zu groß';
            case UPLOAD_ERR_PARTIAL:
                return 'Datei wurde nur teilweise hochgeladen';
            case UPLOAD_ERR_NO_FILE:
                return 'Keine Datei ausgewählt';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Temporäres Verzeichnis fehlt';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Datei konnte nicht geschrieben werden';
            case UPLOAD_ERR_EXTENSION:
                return 'Datei-Upload durch Erweiterung gestoppt';
            default:
                return 'Unbekannter Upload-Fehler';
        }
    }
    
    public function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    
    public function generateSecureToken($length = 32) {
        return bin2hex(random_bytes($length));
    }
    
    public function isValidUserAgent($userAgent) {
        // Sehr einfache Bot-Erkennung
        $botPatterns = [
            '/bot/i',
            '/crawler/i',
            '/spider/i',
            '/scraper/i'
        ];
        
        foreach ($botPatterns as $pattern) {
            if (preg_match($pattern, $userAgent)) {
                return false;
            }
        }
        
        return true;
    }
    
    public function checkRequestIntegrity() {
        $issues = [];
        
        // User-Agent prüfen
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        if (empty($userAgent)) {
            $issues[] = 'Missing User-Agent';
        } elseif (!$this->isValidUserAgent($userAgent)) {
            $issues[] = 'Bot detected';
        }
        
        // Referer prüfen (optional)
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        if (!empty($referer)) {
            $allowedDomains = explode(',', $_ENV['CORS_ORIGINS'] ?? '');
            $refererDomain = parse_url($referer, PHP_URL_HOST);
            
            $validReferer = false;
            foreach ($allowedDomains as $domain) {
                if (strpos($domain, $refererDomain) !== false) {
                    $validReferer = true;
                    break;
                }
            }
            
            if (!$validReferer) {
                $issues[] = 'Invalid referer';
            }
        }
        
        // Request-Methode prüfen
        $method = $_SERVER['REQUEST_METHOD'] ?? '';
        if (!in_array($method, ['GET', 'POST', 'OPTIONS'])) {
            $issues[] = 'Invalid request method';
        }
        
        if (!empty($issues)) {
            $this->logSecurityEvent('REQUEST_INTEGRITY_CHECK', $issues);
        }
        
        return empty($issues);
    }
    
    public function escapeOutput($output) {
        return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
    }
    
    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public function validateURL($url) {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}