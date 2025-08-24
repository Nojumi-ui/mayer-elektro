# 🚀 Production Deployment Guide

## Vor dem Deployment

### 1. Dateien vorbereiten
```bash
# Backend-Dateien kopieren (ohne node_modules und .git)
- backend-php/
  - api/
  - classes/
  - vendor/
  - uploads/ (leer, wird automatisch erstellt)
  - logs/ (leer, wird automatisch erstellt)
  - .htaccess
  - config.php
  - index.php
  - composer.json
  - composer.lock
```

### 2. .env Datei anpassen
```bash
# .env.production nach .env kopieren und anpassen:
cp .env.production .env

# WICHTIGE ANPASSUNGEN:
- EMAIL_USER=info@mayer-elektro.de (echte E-Mail)
- EMAIL_PASS=IHR_ECHTES_PASSWORT
- CORS_ORIGINS=https://mayer-elektro.de,https://www.mayer-elektro.de
- COMPANY_* Variablen mit echten Daten
```

### 3. Frontend bauen
```bash
# Im Frontend-Verzeichnis:
npm run build

# Dann dist/ Ordner auf Server kopieren
```

## Server-Setup

### 1. PHP-Anforderungen
- PHP 7.4+ (empfohlen: PHP 8.1+)
- Extensions: curl, openssl, mbstring, fileinfo
- Composer installiert

### 2. Abhängigkeiten installieren
```bash
cd backend-php
composer install --no-dev --optimize-autoloader
```

### 3. Berechtigungen setzen
```bash
chmod 755 backend-php/
chmod 777 backend-php/uploads/
chmod 777 backend-php/logs/
chmod 600 backend-php/.env
```

### 4. Web-Server Konfiguration

#### Apache
- .htaccess ist bereits konfiguriert
- mod_rewrite aktivieren
- mod_headers aktivieren

#### Nginx
```nginx
server {
    listen 80;
    server_name mayer-elektro.de www.mayer-elektro.de;
    
    # Frontend (statische Dateien)
    location / {
        root /path/to/frontend/dist;
        try_files $uri $uri/ /index.html;
    }
    
    # Backend API
    location /api/ {
        root /path/to/backend-php;
        try_files $uri $uri/ /index.php?$query_string;
        
        location ~ \.php$ {
            fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }
    }
    
    # Uploads schützen
    location /uploads/ {
        deny all;
    }
    
    # Sensible Dateien schützen
    location ~ /\.(env|git|htaccess) {
        deny all;
    }
}
```

## Nach dem Deployment

### 1. Funktionstest
```bash
# API-Endpunkt testen
curl https://mayer-elektro.de/api/health

# Kontaktformular testen
curl -X POST https://mayer-elektro.de/api/contact \
  -H "Content-Type: application/json" \
  -d '{"name":"Test","email":"test@example.com","message":"Test"}'
```

### 2. E-Mail-Test
- Testbewerbung über das Frontend senden
- E-Mail-Empfang prüfen
- Anhänge testen

### 3. Monitoring einrichten
- PHP Error Logs überwachen: `backend-php/logs/php_errors.log`
- Upload-Verzeichnis Größe überwachen
- Rate-Limiting Logs prüfen

## Sicherheits-Checkliste

- [ ] .env Datei ist nicht öffentlich zugänglich
- [ ] uploads/ Verzeichnis erlaubt keine PHP-Ausführung
- [ ] HTTPS ist aktiviert
- [ ] Security Headers sind gesetzt
- [ ] Regelmäßige Backups eingerichtet
- [ ] PHP und Abhängigkeiten sind aktuell

## Wartung

### Log-Rotation
```bash
# Cron-Job für Log-Rotation (täglich)
0 2 * * * find /path/to/backend-php/logs -name "*.log" -mtime +30 -delete
```

### Upload-Cleanup
```bash
# Alte Upload-Dateien löschen (nach 7 Tagen)
0 3 * * * find /path/to/backend-php/uploads -type f -mtime +7 -delete
```

## Troubleshooting

### E-Mail funktioniert nicht
1. SMTP-Zugangsdaten prüfen
2. Firewall-Regeln für Port 587 prüfen
3. PHP Error Log prüfen
4. PHPMailer Debug aktivieren

### Uploads funktionieren nicht
1. Verzeichnis-Berechtigungen prüfen
2. PHP upload_max_filesize prüfen
3. Web-Server upload limits prüfen

### CORS-Fehler
1. CORS_ORIGINS in .env prüfen
2. Web-Server CORS-Konfiguration prüfen