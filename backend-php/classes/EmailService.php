<?php
/**
 * EmailService Klasse
 * Verwaltet E-Mail-Versand für Kontakt- und Bewerbungsformulare
 */

// PHPMailer für bessere MIME-Unterstützung
require_once __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    private $config;
    
    public function __construct() {
        $this->config = SMTP_CONFIG;
    }
    
    public function sendContactEmail($name, $email, $message, $requestId, $clientIP) {
        $subject = "[KONTAKT] " . htmlspecialchars($name) . " - " . date('d.m.Y');
        
        $emailHTML = $this->buildContactEmailHTML($name, $email, $message, $requestId, $clientIP);
        
        $headers = [
            'From' => $this->config['username'],
            'Reply-To' => $email,
            'X-Request-ID' => $requestId,
            'X-Mailer' => 'Mayer-Elektro-Website-PHP',
            'Content-Type' => 'text/html; charset=UTF-8'
        ];
        
        return $this->sendEmail($this->config['username'], $subject, $emailHTML, $headers);
    }
    
    public function sendApplicationEmail($formData, $files, $requestId, $clientIP) {
        $firstName = $formData['firstName'] ?? '';
        $lastName = $formData['lastName'] ?? '';
        $position = $formData['position'] ?? '';
        
        $subject = "[BEWERBUNG] " . htmlspecialchars($position) . " - " . htmlspecialchars($firstName . ' ' . $lastName);
        
        $emailHTML = $this->buildApplicationEmailHTML($formData, $files, $requestId, $clientIP);
        
        $headers = [
            'From' => $this->config['username'],
            'Reply-To' => $formData['email'] ?? '',
            'X-Request-ID' => $requestId,
            'X-Mailer' => 'Mayer-Elektro-Website-PHP',
            'X-Application-Type' => 'Job-Application',
            'Content-Type' => 'text/html; charset=UTF-8'
        ];
        
        // E-Mail mit Anhängen senden
        $result = $this->sendEmailWithAttachments($this->config['username'], $subject, $emailHTML, $headers, $files);
        
        return [
            'success' => $result,
            'critical' => !$result // Bei Bewerbungen ist E-Mail-Versand kritisch
        ];
    }
    
    public function sendConfirmationEmail($formData, $requestId) {
        $firstName = $formData['firstName'] ?? '';
        $lastName = $formData['lastName'] ?? '';
        $email = $formData['email'] ?? '';
        $position = $formData['position'] ?? '';
        
        if (empty($email)) {
            return false;
        }
        
        $subject = "Bewerbungsbestätigung - " . htmlspecialchars($position);
        
        $emailHTML = $this->buildConfirmationEmailHTML($firstName, $lastName, $position);
        
        $headers = [
            'From' => $this->config['username'],
            'X-Request-ID' => $requestId,
            'X-Mailer' => 'Mayer-Elektro-Website-PHP',
            'Content-Type' => 'text/html; charset=UTF-8'
        ];
        
        return $this->sendEmail($email, $subject, $emailHTML, $headers);
    }
    
    private function sendEmail($to, $subject, $body, $headers = []) {
        try {
            // Für lokale Entwicklung: E-Mail-Versand simulieren
            if ($this->isLocalDevelopment()) {
                error_log("📧 [DEVELOPMENT MODE] E-Mail würde gesendet werden:");
                error_log("   An: $to");
                error_log("   Betreff: $subject");
                error_log("   Body-Länge: " . strlen($body) . " Zeichen");
                return true; // Simuliere erfolgreichen Versand
            }
            
            // Produktionsumgebung: Versuche SMTP oder fallback zu mail()
            if ($this->canUseSMTP()) {
                return $this->sendViaSMTP($to, $subject, $body, $headers);
            } else {
                return $this->sendViaBuiltinMail($to, $subject, $body, $headers);
            }
            
        } catch (Exception $e) {
            error_log("❌ E-Mail-Fehler: " . $e->getMessage());
            return false;
        }
    }
    
    private function isLocalDevelopment() {
        // Prüfe Umgebungsvariable für E-Mail-Modus
        $sendRealEmails = ($_ENV['SEND_REAL_EMAILS'] ?? 'false') === 'true';
        
        if ($sendRealEmails) {
            return false; // Echte E-Mails senden, auch in lokaler Umgebung
        }
        
        // Fallback: Prüfe ob wir in lokaler Entwicklungsumgebung sind
        $isLocalhost = in_array($_SERVER['HTTP_HOST'] ?? '', ['localhost', '127.0.0.1', 'localhost:4000']);
        $isDevServer = strpos($_SERVER['SERVER_SOFTWARE'] ?? '', 'Development Server') !== false;
        $isDevelopment = ($_ENV['DEVELOPMENT'] ?? 'false') === 'true';
        
        return $isLocalhost || $isDevServer || $isDevelopment;
    }
    
    private function canUseSMTP() {
        // Prüfe ob SMTP-Konfiguration vollständig ist
        return !empty($this->config['host']) && 
               !empty($this->config['username']) && 
               !empty($this->config['password']);
    }
    
    private function sendViaSMTP($to, $subject, $body, $headers = []) {
        // SMTP-Implementierung für web.de optimiert
        try {
            error_log("🔄 Verbinde zu SMTP-Server: {$this->config['host']}:{$this->config['port']}");
            
            $smtp = fsockopen($this->config['host'], $this->config['port'], $errno, $errstr, 30);
            if (!$smtp) {
                error_log("❌ SMTP-Verbindung fehlgeschlagen: $errstr ($errno)");
                return false;
            }
            
            // SMTP-Kommunikation
            $this->smtpCommand($smtp, null, "220"); // Server greeting
            $this->smtpCommand($smtp, "EHLO " . ($_SERVER['SERVER_NAME'] ?? 'localhost'), "250");
            
            // STARTTLS für Port 587 (web.de erfordert dies)
            if ($this->config['port'] == 587 || $this->config['secure']) {
                error_log("🔐 Starte TLS-Verschlüsselung...");
                $this->smtpCommand($smtp, "STARTTLS", "220");
                
                if (!stream_socket_enable_crypto($smtp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                    throw new Exception("TLS-Verschlüsselung fehlgeschlagen");
                }
                
                $this->smtpCommand($smtp, "EHLO " . ($_SERVER['SERVER_NAME'] ?? 'localhost'), "250");
            }
            
            // Authentifizierung
            error_log("🔑 Authentifiziere mit Benutzername: {$this->config['username']}");
            $this->smtpCommand($smtp, "AUTH LOGIN", "334");
            $this->smtpCommand($smtp, base64_encode($this->config['username']), "334");
            $this->smtpCommand($smtp, base64_encode($this->config['password']), "235");
            
            // E-Mail senden
            error_log("📧 Sende E-Mail von {$this->config['username']} an $to");
            $this->smtpCommand($smtp, "MAIL FROM: <{$this->config['username']}>", "250");
            $this->smtpCommand($smtp, "RCPT TO: <$to>", "250");
            $this->smtpCommand($smtp, "DATA", "354");
            
            // E-Mail-Headers und Body
            $emailData = "From: {$this->config['username']}\r\n";
            $emailData .= "To: $to\r\n";
            $emailData .= "Subject: =?UTF-8?B?" . base64_encode($subject) . "?=\r\n";
            $emailData .= "MIME-Version: 1.0\r\n";
            $emailData .= "Content-Type: text/html; charset=UTF-8\r\n";
            $emailData .= "Content-Transfer-Encoding: 8bit\r\n";
            
            foreach ($headers as $key => $value) {
                if (!in_array($key, ['From', 'To', 'Subject', 'MIME-Version', 'Content-Type', 'Content-Transfer-Encoding'])) {
                    $emailData .= "$key: $value\r\n";
                }
            }
            
            $emailData .= "\r\n$body\r\n.\r\n";
            
            fwrite($smtp, $emailData);
            $this->smtpCommand($smtp, null, "250");
            $this->smtpCommand($smtp, "QUIT", "221");
            
            fclose($smtp);
            error_log("✅ E-Mail erfolgreich via SMTP versendet an: $to");
            return true;
            
        } catch (Exception $e) {
            error_log("❌ SMTP-Fehler: " . $e->getMessage());
            return false;
        }
    }
    
    private function smtpCommand($smtp, $command, $expectedCode) {
        if ($command !== null) {
            fwrite($smtp, "$command\r\n");
        }
        
        // Lese alle Zeilen der Antwort (mehrzeilige Antworten)
        $fullResponse = '';
        $lastLine = '';
        
        do {
            $line = fgets($smtp, 512);
            $fullResponse .= $line;
            $lastLine = $line;
            
            // Prüfe ob dies die letzte Zeile ist (Zeichen 4 ist ein Leerzeichen)
        } while (strlen($line) >= 4 && $line[3] == '-');
        
        $code = substr($lastLine, 0, 3);
        
        if ($code != $expectedCode) {
            throw new Exception("SMTP-Fehler: Erwartet $expectedCode, erhalten $code - Vollständige Antwort: $fullResponse");
        }
        
        return $fullResponse;
    }
    
    private function sendViaSMTPWithAttachments($to, $subject, $body, $headers = []) {
        // SMTP-Implementierung für E-Mails mit Anhängen
        try {
            error_log("🔄 Verbinde zu SMTP-Server für E-Mail mit Anhängen: {$this->config['host']}:{$this->config['port']}");
            
            $smtp = fsockopen($this->config['host'], $this->config['port'], $errno, $errstr, 30);
            if (!$smtp) {
                error_log("❌ SMTP-Verbindung fehlgeschlagen: $errstr ($errno)");
                return false;
            }
            
            // SMTP-Kommunikation
            $this->smtpCommand($smtp, null, "220"); // Server greeting
            $this->smtpCommand($smtp, "EHLO " . ($_SERVER['SERVER_NAME'] ?? 'localhost'), "250");
            
            // STARTTLS für Port 587 (web.de erfordert dies)
            if ($this->config['port'] == 587 || $this->config['secure']) {
                error_log("🔐 Starte TLS-Verschlüsselung für Anhänge...");
                $this->smtpCommand($smtp, "STARTTLS", "220");
                
                if (!stream_socket_enable_crypto($smtp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                    throw new Exception("TLS-Verschlüsselung fehlgeschlagen");
                }
                
                $this->smtpCommand($smtp, "EHLO " . ($_SERVER['SERVER_NAME'] ?? 'localhost'), "250");
            }
            
            // Authentifizierung
            error_log("🔑 Authentifiziere für E-Mail mit Anhängen: {$this->config['username']}");
            $this->smtpCommand($smtp, "AUTH LOGIN", "334");
            $this->smtpCommand($smtp, base64_encode($this->config['username']), "334");
            $this->smtpCommand($smtp, base64_encode($this->config['password']), "235");
            
            // E-Mail senden
            error_log("📧 Sende E-Mail mit Anhängen von {$this->config['username']} an $to");
            $this->smtpCommand($smtp, "MAIL FROM: <{$this->config['username']}>", "250");
            $this->smtpCommand($smtp, "RCPT TO: <$to>", "250");
            $this->smtpCommand($smtp, "DATA", "354");
            
            // E-Mail-Headers für Multipart
            $emailData = "From: {$this->config['username']}\r\n";
            $emailData .= "To: $to\r\n";
            $emailData .= "Subject: =?UTF-8?B?" . base64_encode($subject) . "?=\r\n";
            $emailData .= "MIME-Version: 1.0\r\n";
            
            // Alle Headers hinzufügen (besonders wichtig für Content-Type mit boundary)
            foreach ($headers as $key => $value) {
                if (!in_array($key, ['From', 'To', 'Subject', 'MIME-Version'])) {
                    $emailData .= "$key: $value\r\n";
                }
            }
            
            // Body mit korrekter Formatierung
            $emailData .= "\r\n";
            
            // Headers senden
            fwrite($smtp, $emailData);
            
            // Body Zeile für Zeile senden (wichtig für korrekte MIME-Formatierung)
            $bodyLines = explode("\n", $body);
            foreach ($bodyLines as $line) {
                // Escape führende Punkte (SMTP-Protokoll)
                if (strlen($line) > 0 && $line[0] === '.') {
                    $line = '.' . $line;
                }
                fwrite($smtp, $line . "\r\n");
            }
            
            // SMTP DATA Ende-Marker senden
            fwrite($smtp, ".\r\n");
            $this->smtpCommand($smtp, null, "250");
            $this->smtpCommand($smtp, "QUIT", "221");
            
            fclose($smtp);
            error_log("✅ E-Mail mit Anhängen erfolgreich via SMTP versendet an: $to");
            return true;
            
        } catch (Exception $e) {
            error_log("❌ SMTP-Fehler mit Anhängen: " . $e->getMessage());
            return false;
        }
    }
    
    private function sendViaBuiltinMail($to, $subject, $body, $headers = []) {
        // Fallback zur Standard mail() Funktion
        $defaultHeaders = [
            'MIME-Version' => '1.0',
            'Content-Type' => 'text/html; charset=UTF-8',
            'From' => $this->config['username']
        ];
        
        $allHeaders = array_merge($defaultHeaders, $headers);
        $headerString = '';
        
        foreach ($allHeaders as $key => $value) {
            $headerString .= "$key: $value\r\n";
        }
        
        $result = mail($to, $subject, $body, $headerString);
        
        if ($result) {
            error_log("✅ E-Mail erfolgreich via mail() versendet an: $to");
        } else {
            error_log("❌ E-Mail-Versand via mail() fehlgeschlagen an: $to");
        }
        
        return $result;
    }
    
    private function sendEmailWithAttachments($to, $subject, $body, $headers = [], $files = []) {
        try {
            // Für lokale Entwicklung: E-Mail-Versand mit Anhängen simulieren
            if ($this->isLocalDevelopment()) {
                error_log("📧 [DEVELOPMENT MODE] E-Mail mit Anhängen würde gesendet werden:");
                error_log("   An: $to");
                error_log("   Betreff: $subject");
                error_log("   Body-Länge: " . strlen($body) . " Zeichen");
                error_log("   Anhänge: " . count($files));
                foreach ($files as $file) {
                    error_log("     - " . ($file['original_name'] ?? 'Unbekannt') . " (" . round(($file['size'] ?? 0) / 1024, 2) . " KB)");
                }
                return true; // Simuliere erfolgreichen Versand
            }
            
            // Produktionsumgebung: Verwende normale E-Mail-Funktion
            // Für Anhänge verwenden wir erstmal die Standard-Implementierung
            $boundary = md5(time());
            
            // Headers für Multipart-E-Mail
            $defaultHeaders = [
                'MIME-Version' => '1.0',
                'Content-Type' => "multipart/mixed; boundary=\"$boundary\"",
                'From' => $this->config['username']
            ];
            
            $allHeaders = array_merge($defaultHeaders, $headers);
            $headerString = '';
            
            foreach ($allHeaders as $key => $value) {
                if ($key !== 'Content-Type') { // Content-Type wird separat behandelt
                    $headerString .= "$key: $value\r\n";
                }
            }
            
            $headerString .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
            
            // E-Mail-Body mit Anhängen erstellen (Unix-Zeilenwechsel für bessere Kompatibilität)
            $emailBody = "--$boundary\n";
            $emailBody .= "Content-Type: text/html; charset=UTF-8\n";
            $emailBody .= "Content-Transfer-Encoding: 8bit\n\n";
            $emailBody .= $body . "\n";
            
            // Anhänge hinzufügen
            foreach ($files as $file) {
                if (file_exists($file['path'])) {
                    $fileContent = file_get_contents($file['path']);
                    // Base64 kodieren und in 76-Zeichen-Blöcke aufteilen (mit \n)
                    $encodedContent = chunk_split(base64_encode($fileContent), 76, "\n");
                    // Entferne das letzte \n das chunk_split hinzufügt
                    $encodedContent = rtrim($encodedContent, "\n");
                    
                    $emailBody .= "\n--$boundary\n";
                    $emailBody .= "Content-Type: {$file['mime_type']}; name=\"{$file['original_name']}\"\n";
                    $emailBody .= "Content-Transfer-Encoding: base64\n";
                    $emailBody .= "Content-Disposition: attachment; filename=\"{$file['original_name']}\"\n\n";
                    $emailBody .= $encodedContent . "\n";
                }
            }
            
            $emailBody .= "--$boundary--\n";
            
            // E-Mail senden (verwende PHPMailer für bessere MIME-Unterstützung)
            $result = $this->sendViaPHPMailer($to, $subject, $body, $files, $headers);
            
            if ($result) {
                error_log("✅ E-Mail mit Anhängen erfolgreich versendet an: $to");
            } else {
                error_log("❌ E-Mail-Versand mit Anhängen fehlgeschlagen an: $to");
            }
            
            return $result;
            
        } catch (Exception $e) {
            error_log("❌ E-Mail-Fehler mit Anhängen: " . $e->getMessage());
            return false;
        }
    }
    
    private function buildContactEmailHTML($name, $email, $message, $requestId, $clientIP) {
        $companyInfo = COMPANY_INFO;
        $timestamp = date('d.m.Y H:i:s');
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unbekannt';
        
        return "
        <!DOCTYPE html>
        <html lang='de'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Neue Kontaktanfrage</title>
        </head>
        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;'>
            
            <h2 style='color: #1e3a8a; border-bottom: 2px solid #3b82f6; padding-bottom: 10px;'>
                Neue Kontaktanfrage von der Website
            </h2>
            
            <div style='background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                <h3 style='margin-top: 0; color: #495057;'>📋 Request Details:</h3>
                <ul style='list-style: none; padding: 0;'>
                    <li><strong>Request ID:</strong> {$requestId}</li>
                    <li><strong>Zeitstempel:</strong> {$timestamp}</li>
                    <li><strong>IP-Adresse:</strong> {$clientIP}</li>
                    <li><strong>User-Agent:</strong> {$userAgent}</li>
                </ul>
            </div>
            
            <h3 style='color: #28a745;'>👤 Kontaktdaten:</h3>
            <ul style='background: #fff; padding: 15px; border-radius: 5px; border-left: 4px solid #28a745;'>
                <li><strong>Name:</strong> " . htmlspecialchars($name) . "</li>
                <li><strong>E-Mail:</strong> " . htmlspecialchars($email) . "</li>
            </ul>

            <h3 style='color: #007bff;'>💬 Nachricht:</h3>
            <div style='background: #f5f5f5; padding: 15px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #007bff;'>
                " . nl2br(htmlspecialchars($message)) . "
            </div>

            <hr style='margin: 30px 0; border: none; border-top: 1px solid #dee2e6;'>
            <p style='font-size: 12px; color: #666; text-align: center;'>
                Diese Nachricht wurde über das Kontaktformular der Website gesendet.<br>
                Automatisch generiert am {$timestamp}
            </p>
            
        </body>
        </html>";
    }
    
    private function buildApplicationEmailHTML($formData, $files, $requestId, $clientIP) {
        $companyInfo = COMPANY_INFO;
        $timestamp = date('d.m.Y H:i:s');
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unbekannt';
        
        $firstName = htmlspecialchars($formData['firstName'] ?? '');
        $lastName = htmlspecialchars($formData['lastName'] ?? '');
        $email = htmlspecialchars($formData['email'] ?? '');
        $phone = htmlspecialchars($formData['phone'] ?? 'Nicht angegeben');
        $address = htmlspecialchars($formData['address'] ?? 'Nicht angegeben');
        $postalCode = htmlspecialchars($formData['postalCode'] ?? '');
        $city = htmlspecialchars($formData['city'] ?? '');
        $country = htmlspecialchars($formData['country'] ?? 'Nicht angegeben');
        $position = htmlspecialchars($formData['position'] ?? '');
        $availability = htmlspecialchars($formData['availability'] ?? 'Nicht angegeben');
        $salaryExpectation = htmlspecialchars($formData['salaryExpectation'] ?? 'Nicht angegeben');
        $coverLetter = htmlspecialchars($formData['coverLetter'] ?? '');
        
        $totalSize = array_sum(array_column($files, 'size'));
        $totalSizeMB = round($totalSize / 1024 / 1024, 2);
        
        $attachmentsList = '';
        foreach ($files as $file) {
            $attachmentsList .= "
                <li>
                    <strong>" . htmlspecialchars($file['original_name']) . "</strong>
                    <br><small style='color: #666;'>Typ: {$file['mime_type']}, Größe: " . round($file['size'] / 1024, 2) . " KB</small>
                </li>";
        }
        
        $coverLetterSection = '';
        if (!empty($coverLetter)) {
            $coverLetterSection = "
                <h3 style='color: #ffc107;'>📝 Anschreiben:</h3>
                <div style='background: #f5f5f5; padding: 15px; border-radius: 5px; border-left: 4px solid #ffc107;'>
                    " . nl2br($coverLetter) . "
                </div>";
        }
        
        return "
        <!DOCTYPE html>
        <html lang='de'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Neue Bewerbung</title>
        </head>
        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;'>
            
            <h2 style='color: #1e3a8a; border-bottom: 2px solid #3b82f6; padding-bottom: 10px;'>
                🎯 Neue Bewerbung eingegangen
            </h2>
            
            <div style='background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                <h3 style='margin-top: 0; color: #495057;'>📋 Request Details:</h3>
                <ul style='list-style: none; padding: 0;'>
                    <li><strong>Request ID:</strong> {$requestId}</li>
                    <li><strong>Zeitstempel:</strong> {$timestamp}</li>
                    <li><strong>IP-Adresse:</strong> {$clientIP}</li>
                    <li><strong>User-Agent:</strong> {$userAgent}</li>
                    <li><strong>Dateien:</strong> " . count($files) . " ({$totalSizeMB} MB)</li>
                </ul>
            </div>
            
            <h3 style='color: #28a745;'>👤 Persönliche Daten:</h3>
            <div style='background: #fff; padding: 15px; border-radius: 5px; border-left: 4px solid #28a745;'>
                <ul style='margin: 0; padding-left: 20px;'>
                    <li><strong>Name:</strong> {$firstName} {$lastName}</li>
                    <li><strong>E-Mail:</strong> {$email}</li>
                    <li><strong>Telefon:</strong> {$phone}</li>
                    <li><strong>Adresse:</strong> {$address}</li>
                    <li><strong>PLZ/Stadt:</strong> {$postalCode} {$city}</li>
                    <li><strong>Land:</strong> {$country}</li>
                </ul>
            </div>

            <h3 style='color: #007bff;'>💼 Bewerbungsdetails:</h3>
            <div style='background: #fff; padding: 15px; border-radius: 5px; border-left: 4px solid #007bff;'>
                <ul style='margin: 0; padding-left: 20px;'>
                    <li><strong>Position:</strong> {$position}</li>
                    <li><strong>Verfügbar ab:</strong> {$availability}</li>
                    <li><strong>Gehaltsvorstellung:</strong> {$salaryExpectation}</li>
                </ul>
            </div>

            {$coverLetterSection}

            <h3 style='color: #6c757d;'>📎 Anhänge (" . count($files) . "):</h3>
            <div style='background: #fff; padding: 15px; border-radius: 5px; border-left: 4px solid #6c757d;'>
                <ul style='margin: 0; padding-left: 20px;'>
                    {$attachmentsList}
                </ul>
            </div>

            <hr style='margin: 30px 0; border: none; border-top: 1px solid #dee2e6;'>
            <p style='font-size: 12px; color: #666; text-align: center;'>
                Diese Bewerbung wurde über das Bewerbungsformular der Website eingereicht.<br>
                Automatisch generiert am {$timestamp}
            </p>
            
        </body>
        </html>";
    }
    
    private function buildConfirmationEmailHTML($firstName, $lastName, $position) {
        $companyInfo = COMPANY_INFO;
        $timestamp = date('d.m.Y H:i:s');
        
        return "
        <!DOCTYPE html>
        <html lang='de'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Bewerbungsbestätigung</title>
        </head>
        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f8f9fa;'>
            
            <!-- Header mit Logo -->
            <div style='text-align: center; margin-bottom: 30px; padding: 20px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border-radius: 10px;'>
                <h1 style='color: white; margin: 0; font-size: 24px; font-weight: 300;'>
                    {$companyInfo['name']}
                </h1>
            </div>

            <!-- Hauptinhalt -->
            <div style='background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>
                
                <div style='text-align: center; margin-bottom: 25px;'>
                    <h2 style='color: #1e3a8a; margin: 0; font-size: 28px; font-weight: 600;'>
                        ✅ Vielen Dank für Ihre Bewerbung!
                    </h2>
                </div>
                
                <div style='background: #f0f9ff; padding: 20px; border-radius: 8px; border-left: 4px solid #3b82f6; margin-bottom: 25px;'>
                    <p style='margin: 0; font-size: 16px;'>
                        <strong>Liebe/r {$firstName} {$lastName},</strong>
                    </p>
                </div>
                
                <p style='font-size: 16px; margin-bottom: 20px;'>
                    vielen Dank für Ihre Bewerbung als <strong style='color: #1e3a8a;'>{$position}</strong> bei {$companyInfo['name']}.
                </p>
                
                <div style='background: #f8fafc; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                    <p style='margin: 0; font-size: 16px;'>
                        <strong>📋 Nächste Schritte:</strong><br>
                        Wir haben Ihre Unterlagen erhalten und werden diese sorgfältig prüfen. 
                        Sie können davon ausgehen, dass wir uns innerhalb der <strong>nächsten 2 Wochen</strong> bei Ihnen melden.
                    </p>
                </div>
                
                <p style='font-size: 16px; margin-bottom: 25px;'>
                    Bei Fragen stehen wir Ihnen gerne zur Verfügung.
                </p>
                
                <div style='text-align: center; margin: 30px 0;'>
                    <div style='display: inline-block; padding: 15px 25px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 25px;'>
                        <p style='color: white; margin: 0; font-weight: 600;'>
                            Mit freundlichen Grüßen<br>
                            <span style='font-size: 18px;'>Ihr Team von {$companyInfo['name']}</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div style='margin-top: 30px; padding: 20px; background: #374151; color: white; border-radius: 10px; text-align: center;'>
                <div style='margin-bottom: 15px;'>
                    <h3 style='margin: 0 0 10px 0; color: #f3f4f6; font-size: 18px;'>Kontakt</h3>
                    <p style='margin: 5px 0; font-size: 14px;'>{$companyInfo['address']}</p>
                    <p style='margin: 5px 0; font-size: 14px;'>{$companyInfo['postal_code']} {$companyInfo['city']}</p>
                    <p style='margin: 5px 0; font-size: 14px;'>Tel: {$companyInfo['phone']}</p>
                    <p style='margin: 5px 0; font-size: 14px;'>E-Mail: {$companyInfo['email']}</p>
                </div>
                
                <hr style='border: none; border-top: 1px solid #4b5563; margin: 15px 0;'>
                
                <p style='margin: 0; font-size: 12px; color: #9ca3af;'>
                    Diese E-Mail wurde automatisch generiert. Bitte antworten Sie nicht direkt auf diese E-Mail.<br>
                    Generiert am {$timestamp}
                </p>
            </div>
            
        </body>
        </html>";
    }
    
    private function sendViaPHPMailer($to, $subject, $body, $files = [], $headers = []) {
        try {
            $mail = new PHPMailer(true);
            
            // SMTP-Konfiguration
            $mail->isSMTP();
            $mail->Host = $this->config['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $this->config['username'];
            $mail->Password = $this->config['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $this->config['port'];
            $mail->CharSet = 'UTF-8';
            
            // E-Mail-Details
            $mail->setFrom($this->config['username'], 'Mayer Elektro');
            $mail->addAddress($to);
            
            // Zusätzliche Headers
            foreach ($headers as $key => $value) {
                if (!in_array($key, ['From', 'To', 'Subject', 'MIME-Version', 'Content-Type'])) {
                    $mail->addCustomHeader($key, $value);
                }
            }
            
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            
            // Anhänge hinzufügen
            foreach ($files as $file) {
                if (file_exists($file['path'])) {
                    $mail->addAttachment($file['path'], $file['original_name']);
                    error_log("📎 PHPMailer Anhang hinzugefügt: {$file['original_name']} (" . round($file['size'] / 1024, 2) . " KB)");
                }
            }
            
            // E-Mail senden
            $mail->send();
            error_log("✅ E-Mail erfolgreich via PHPMailer versendet an: $to");
            return true;
            
        } catch (Exception $e) {
            error_log("❌ PHPMailer Fehler: {$mail->ErrorInfo}");
            error_log("❌ Exception: " . $e->getMessage());
            return false;
        }
    }
}