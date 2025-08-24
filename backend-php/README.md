# Mayer Elektro Backend - PHP Version

Vollständige PHP-Portierung des Node.js Backends mit allen Funktionen und Sicherheitsfeatures.

## 🚀 Features

- **Kontaktformular-API** (`/api/contact`)
- **Bewerbungsformular-API** (`/api/submit-application`)
- **Legacy-Kompatibilität** (`/api/apply`)
- **Datei-Upload** mit sicherer Validierung
- **Rate Limiting** (IP-basiert)
- **E-Mail-Versand** mit HTML-Templates
- **Spam-Schutz**
- **Umfassende Validierung**
- **Security Headers**
- **CORS-Unterstützung**

## 📋 Anforderungen

- **PHP 7.4+** (empfohlen: PHP 8.0+)
- **Apache/Nginx** Webserver
- **Mail-Funktion** aktiviert
- **Schreibrechte** für Upload-Verzeichnis

## 🛠️ Installation

### 1. Dateien kopieren
Alle PHP-Dateien in das Backend-Verzeichnis kopieren.

### 2. Verzeichnisse erstellen
```bash
mkdir uploads
mkdir storage
chmod 755 uploads storage
```

### 3. .env Konfiguration
Die bestehende `.env` Datei wird automatisch geladen.

### 4. Apache-Konfiguration
Die `.htaccess` Datei ist bereits konfiguriert für:
- URL-Rewriting
- Security Headers
- Upload-Limits
- CORS Headers

### 5. PHP-Konfiguration prüfen
```ini
upload_max_filesize = 10M
post_max_size = 50M
max_file_uploads = 6
memory_limit = 256M
max_execution_time = 300
```

## 🔧 Konfiguration

### Umgebungsvariablen (.env)
```env
# E-Mail Konfiguration
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
COMPANY_EMAIL=info@mayer-elektro.de
# ... weitere Firmeninfos
```

## 📁 Dateistruktur

```
backend/
├── index.php              # Haupt-Router
├── config.php             # Konfiguration
├── .htaccess              # Apache-Konfiguration
├── .env                   # Umgebungsvariablen
├── classes/
│   ├── RateLimiter.php    # Rate Limiting
│   ├── Validator.php      # Validierung
│   ├── FileHandler.php    # Datei-Verarbeitung
│   ├── EmailService.php   # E-Mail-Versand
│   └── SecurityHelper.php # Sicherheitsfunktionen
├── uploads/               # Upload-Verzeichnis
├── storage/               # Rate Limiting Daten
└── README.md          # Diese Datei
```

## 🔒 Sicherheitsfeatures

### Rate Limiting
- **Allgemein**: 100 Requests / 15 Minuten
- **Kontakt**: 5 Requests / Stunde
- **Bewerbungen**: 3 Requests / Tag

### Input-Validierung
- XSS-Schutz durch HTML-Escaping
- Umfassende Formular-Validierung
- Datei-Upload-Validierung
- MIME-Type-Prüfung
- Magic Bytes Validierung

### Spam-Schutz
- Keyword-basierte Spam-Erkennung
- Link-Anzahl-Prüfung
- Großbuchstaben-Analyse
- Zeichen-Wiederholungs-Erkennung

### Datei-Sicherheit
- Erlaubte MIME-Types
- Gefährliche Erweiterungen blockiert
- Sichere Dateinamen-Generierung
- Dateigröße-Limits
- Gesamtgröße-Limits

## 🌐 API-Endpoints

### POST /api/contact
Kontaktformular-Verarbeitung

**Request Body:**
```json
{
  "name": "Max Mustermann",
  "email": "max@example.com",
  "message": "Ihre Nachricht hier..."
}
```

**Response:**
```json
{
  "success": true,
  "message": "Nachricht erfolgreich gesendet",
  "request_id": "abc123def456",
  "email_sent": true
}
```

### POST /api/submit-application
Bewerbungsformular-Verarbeitung

**Form Data:**
- `firstName`, `lastName`, `email`, `position` (erforderlich)
- `phone`, `address`, `postalCode`, `city`, `country` (optional)
- `availability`, `salaryExpectation`, `coverLetter` (optional)
- `cv` (Datei, erforderlich)
- `document_0` bis `document_4` (Dateien, optional)

**Response:**
```json
{
  "success": true,
  "message": "Bewerbung erfolgreich gesendet",
  "request_id": "abc123def456",
  "email_sent": true,
  "confirmation_sent": true
}
```

### GET /api/health
Health Check

**Response:**
```json
{
  "success": true,
  "message": "Backend is running",
  "timestamp": "2024-01-01T12:00:00+01:00",
  "request_id": "abc123def456",
  "version": "1.0.0-php"
}
```

## 🚨 Fehlerbehandlung

### HTTP Status Codes
- **200**: Erfolg
- **400**: Validierungsfehler
- **429**: Rate Limit erreicht
- **500**: Server-Fehler

### Fehler-Response Format
```json
{
  "success": false,
  "message": "Fehlerbeschreibung",
  "errors": ["Detaillierte Fehler..."],
  "request_id": "abc123def456"
}
```

## 📊 Logging

Alle wichtigen Events werden geloggt:
- Request-Verarbeitung
- Validierungsfehler
- E-Mail-Versand
- Sicherheitsereignisse
- Rate Limiting

Logs werden in PHP's error_log geschrieben.

## 🔄 Migration von Node.js

Das PHP Backend ist vollständig kompatibel mit dem Node.js Backend:

1. **Gleiche API-Endpoints**
2. **Identische Request/Response-Formate**
3. **Gleiche Validierungsregeln**
4. **Identische E-Mail-Templates**
5. **Gleiche Sicherheitsfeatures**

### Unterschiede
- **Rate Limiting**: Datei-basiert statt Memory-basiert
- **E-Mail**: PHP's mail() statt nodemailer
- **Sessions**: PHP-Sessions für Rate Limiting

## 🧪 Testing

### Manueller Test
```bash
# Kontakt-Test
curl -X POST http://localhost/backend/api/contact \
  -H "Content-Type: application/json" \
  -d '{"name":"Test","email":"test@example.com","message":"Test message"}'

# Health Check
curl http://localhost/backend/api/health
```

### Bewerbungs-Test
```bash
curl -X POST http://localhost/backend/api/submit-application \
  -F "firstName=Max" \
  -F "lastName=Mustermann" \
  -F "email=max@example.com" \
  -F "position=Elektriker" \
  -F "cv=@/path/to/cv.pdf"
```

## 🐛 Troubleshooting

### Häufige Probleme

1. **E-Mails werden nicht versendet**
   - PHP mail() Konfiguration prüfen
   - SMTP-Einstellungen in .env prüfen

2. **Datei-Upload funktioniert nicht**
   - PHP Upload-Limits prüfen
   - Verzeichnis-Berechtigungen prüfen

3. **Rate Limiting funktioniert nicht**
   - Storage-Verzeichnis Schreibrechte prüfen
   - PHP Sessions aktiviert?

4. **CORS-Fehler**
   - .htaccess CORS-Headers prüfen
   - CORS_ORIGINS in .env prüfen

### Debug-Modus
Für Debugging in `config.php` aktivieren:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## 📈 Performance

### Optimierungen
- Datei-basiertes Rate Limiting
- Effiziente Validierung
- Minimale Memory-Usage
- Schnelle Request-Verarbeitung

### Monitoring
- Request-IDs für Tracking
- Umfassendes Logging
- Error-Handling
- Performance-Metriken

## 🔮 Zukunft

Mögliche Erweiterungen:
- **Database-Integration** für Rate Limiting
- **Redis-Support** für bessere Performance
- **JWT-Authentication** für Admin-Bereich
- **API-Dokumentation** mit Swagger
- **Unit Tests** mit PHPUnit

## 📞 Support

Bei Fragen oder Problemen:
1. Logs prüfen (PHP error_log)
2. Konfiguration validieren
3. Berechtigungen prüfen
4. Debug-Modus aktivieren