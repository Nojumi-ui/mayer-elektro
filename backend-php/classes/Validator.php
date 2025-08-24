<?php
/**
 * Validator Klasse
 * Implementiert alle Validierungslogik für Formulardaten
 */

class Validator {
    
    public function validateContactForm($data) {
        $errors = [];
        
        // Name Validierung
        if (empty($data['name']) || !is_string($data['name'])) {
            $errors[] = 'Name ist erforderlich';
        } else {
            $name = trim($data['name']);
            if (strlen($name) < 2) {
                $errors[] = 'Name muss mindestens 2 Zeichen lang sein';
            } elseif (strlen($name) > 100) {
                $errors[] = 'Name darf maximal 100 Zeichen lang sein';
            } elseif (!preg_match('/^[a-zA-ZäöüÄÖÜß\s\-\'\.]+$/u', $name)) {
                $errors[] = 'Name enthält ungültige Zeichen';
            }
        }
        
        // E-Mail Validierung
        if (empty($data['email']) || !is_string($data['email'])) {
            $errors[] = 'E-Mail ist erforderlich';
        } else {
            $email = trim($data['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Ungültige E-Mail-Adresse';
            } elseif (strlen($email) > 254) {
                $errors[] = 'E-Mail-Adresse ist zu lang';
            }
        }
        
        // Nachricht Validierung
        if (empty($data['message']) || !is_string($data['message'])) {
            $errors[] = 'Nachricht ist erforderlich';
        } else {
            $message = trim($data['message']);
            if (strlen($message) < 10) {
                $errors[] = 'Nachricht muss mindestens 10 Zeichen lang sein';
            } elseif (strlen($message) > 5000) {
                $errors[] = 'Nachricht darf maximal 5000 Zeichen lang sein';
            }
        }
        
        return $errors;
    }
    
    public function validateApplicationForm($data) {
        $errors = [];
        
        // Vorname Validierung
        if (empty($data['firstName']) || !is_string($data['firstName'])) {
            $errors[] = 'Vorname ist erforderlich';
        } else {
            $firstName = trim($data['firstName']);
            if (strlen($firstName) < 2) {
                $errors[] = 'Vorname muss mindestens 2 Zeichen lang sein';
            } elseif (strlen($firstName) > 50) {
                $errors[] = 'Vorname darf maximal 50 Zeichen lang sein';
            } elseif (!preg_match('/^[a-zA-ZäöüÄÖÜß\s\-\'\.]+$/u', $firstName)) {
                $errors[] = 'Vorname enthält ungültige Zeichen';
            }
        }
        
        // Nachname Validierung
        if (empty($data['lastName']) || !is_string($data['lastName'])) {
            $errors[] = 'Nachname ist erforderlich';
        } else {
            $lastName = trim($data['lastName']);
            if (strlen($lastName) < 2) {
                $errors[] = 'Nachname muss mindestens 2 Zeichen lang sein';
            } elseif (strlen($lastName) > 50) {
                $errors[] = 'Nachname darf maximal 50 Zeichen lang sein';
            } elseif (!preg_match('/^[a-zA-ZäöüÄÖÜß\s\-\'\.]+$/u', $lastName)) {
                $errors[] = 'Nachname enthält ungültige Zeichen';
            }
        }
        
        // E-Mail Validierung
        if (empty($data['email']) || !is_string($data['email'])) {
            $errors[] = 'E-Mail ist erforderlich';
        } else {
            $email = trim($data['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Ungültige E-Mail-Adresse';
            } elseif (strlen($email) > 254) {
                $errors[] = 'E-Mail-Adresse ist zu lang';
            }
        }
        
        // Position Validierung
        if (empty($data['position']) || !is_string($data['position'])) {
            $errors[] = 'Position ist erforderlich';
        } else {
            $position = trim($data['position']);
            if (strlen($position) < 2) {
                $errors[] = 'Position muss mindestens 2 Zeichen lang sein';
            } elseif (strlen($position) > 100) {
                $errors[] = 'Position darf maximal 100 Zeichen lang sein';
            }
        }
        
        // Telefon Validierung (optional)
        if (!empty($data['phone']) && is_string($data['phone'])) {
            $phone = trim($data['phone']);
            if (!empty($phone)) {
                // Deutsche Telefonnummer-Validierung
                if (!preg_match('/^(\+49|0)[1-9][0-9]{1,14}$/', preg_replace('/[\s\-\(\)]/', '', $phone))) {
                    $errors[] = 'Ungültige Telefonnummer';
                }
            }
        }
        
        // PLZ Validierung (optional)
        if (!empty($data['postalCode']) && is_string($data['postalCode'])) {
            $postalCode = trim($data['postalCode']);
            if (!empty($postalCode)) {
                if (!preg_match('/^\d{5}$/', $postalCode)) {
                    $errors[] = 'Ungültige Postleitzahl (5 Ziffern erforderlich)';
                }
            }
        }
        
        // Anschreiben Validierung (optional)
        if (!empty($data['coverLetter']) && is_string($data['coverLetter'])) {
            $coverLetter = trim($data['coverLetter']);
            if (strlen($coverLetter) > 10000) {
                $errors[] = 'Anschreiben darf maximal 10000 Zeichen lang sein';
            }
        }
        
        return $errors;
    }
    
    public function validateFile($file) {
        $errors = [];
        
        // Grundlegende Datei-Validierung
        if ($file['error'] !== UPLOAD_ERR_OK) {
            switch ($file['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $errors[] = 'Datei ist zu groß';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $errors[] = 'Datei wurde nur teilweise hochgeladen';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $errors[] = 'Keine Datei ausgewählt';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $errors[] = 'Temporäres Verzeichnis fehlt';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $errors[] = 'Datei konnte nicht geschrieben werden';
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $errors[] = 'Datei-Upload durch Erweiterung gestoppt';
                    break;
                default:
                    $errors[] = 'Unbekannter Upload-Fehler';
            }
            return $errors;
        }
        
        // MIME-Type Validierung
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($mimeType, ALLOWED_MIMES)) {
            $errors[] = "Ungültiger Dateityp: {$mimeType}. Erlaubt sind: PDF, DOC, DOCX, JPG, PNG";
        }
        
        // Dateigröße Validierung
        if ($file['size'] > MAX_FILE_SIZE) {
            $maxSizeMB = round(MAX_FILE_SIZE / 1024 / 1024, 2);
            $fileSizeMB = round($file['size'] / 1024 / 1024, 2);
            $errors[] = "Datei zu groß: {$fileSizeMB}MB. Maximum: {$maxSizeMB}MB";
        }
        
        // Dateiname Validierung
        if (strlen($file['name']) > 255) {
            $errors[] = 'Dateiname ist zu lang (maximal 255 Zeichen)';
        }
        
        // Gefährliche Dateierweiterungen prüfen
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array('.' . $extension, DANGEROUS_EXTENSIONS)) {
            $errors[] = "Gefährliche Dateierweiterung: .{$extension}";
        }
        
        // Dateiinhalt-Validierung (Magic Bytes)
        if (!$this->validateFileContent($file['tmp_name'], $mimeType)) {
            $errors[] = 'Dateiinhalt entspricht nicht dem angegebenen Dateityp';
        }
        
        return $errors;
    }
    
    private function validateFileContent($filePath, $expectedMimeType) {
        $handle = fopen($filePath, 'rb');
        if (!$handle) {
            return false;
        }
        
        $header = fread($handle, 8);
        fclose($handle);
        
        // Magic Bytes für verschiedene Dateitypen
        $magicBytes = [
            'application/pdf' => ['%PDF'],
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => ['PK'],
            'application/msword' => ["\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1"],
            'image/jpeg' => ["\xFF\xD8\xFF"],
            'image/png' => ["\x89PNG\r\n\x1A\n"]
        ];
        
        if (!isset($magicBytes[$expectedMimeType])) {
            return true; // Unbekannter MIME-Type, keine Validierung
        }
        
        foreach ($magicBytes[$expectedMimeType] as $magic) {
            if (strpos($header, $magic) === 0) {
                return true;
            }
        }
        
        return false;
    }
    
    public function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public function isValidURL($url) {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
    
    public function sanitizeString($string) {
        return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
    }
    
    public function isSpam($text) {
        $text = strtolower($text);
        
        foreach (SPAM_KEYWORDS as $keyword) {
            if (strpos($text, $keyword) !== false) {
                return true;
            }
        }
        
        return false;
    }
}