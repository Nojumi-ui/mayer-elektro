# 🚀 Node.js Backend - Production Deployment Guide

## 📋 Vor dem Deployment

### 1. System-Anforderungen
- **Node.js:** >= 16.0.0 (empfohlen: 18.x LTS)
- **npm:** >= 8.0.0
- **RAM:** Mindestens 512MB (empfohlen: 1GB+)
- **Disk:** 100MB für Anwendung + Upload-Speicher

### 2. Dateien vorbereiten
```bash
# Backend-Dateien kopieren (ohne node_modules und .git)
backend-node/
├── api/
├── uploads/ (leer, wird automatisch erstellt)
├── logs/ (leer, wird automatisch erstellt)
├── server.js
├── package.json
├── package-lock.json
├── ecosystem.config.js (für PM2)
├── Dockerfile (für Docker)
└── .env (aus .env.production kopiert)
```

### 3. Environment-Datei anpassen
```bash
# .env.production nach .env kopieren und anpassen:
cp .env.production .env

# WICHTIGE ANPASSUNGEN:
NODE_ENV=production
EMAIL_USER=info@mayer-elektro.de
EMAIL_PASS=IHR_ECHTES_PASSWORT
CORS_ORIGINS=https://mayer-elektro.de,https://www.mayer-elektro.de
TRUST_PROXY=true
SECURE_COOKIES=true
```

## 🚀 Deployment-Optionen

### Option 1: Standard Node.js Deployment

#### 1. Dependencies installieren
```bash
cd backend-node
npm ci --production
```

#### 2. Server starten
```bash
# Direkt starten
npm start

# Oder mit nohup für Background
nohup npm start > logs/app.log 2>&1 &
```

#### 3. Health Check
```bash
curl http://localhost:4000/api/health
```

### Option 2: PM2 Process Manager (Empfohlen)

#### 1. PM2 installieren
```bash
npm install -g pm2
```

#### 2. Anwendung starten
```bash
# Production starten
pm2 start ecosystem.config.js --env production

# Status prüfen
pm2 status
pm2 logs mayer-elektro-backend

# Auto-Start beim Boot
pm2 startup
pm2 save
```

#### 3. PM2 Commands
```bash
# Restart
pm2 restart mayer-elektro-backend

# Stop
pm2 stop mayer-elektro-backend

# Monitoring
pm2 monit

# Logs anzeigen
pm2 logs mayer-elektro-backend --lines 100
```

### Option 3: Docker Deployment

#### 1. Image bauen
```bash
docker build -t mayer-elektro-backend .
```

#### 2. Container starten
```bash
# Einzelner Container
docker run -d \
  --name mayer-elektro-backend \
  -p 4000:4000 \
  --env-file .env.production \
  -v $(pwd)/uploads:/app/uploads \
  -v $(pwd)/logs:/app/logs \
  --restart unless-stopped \
  mayer-elektro-backend

# Mit Docker Compose
docker-compose up -d
```

#### 3. Container verwalten
```bash
# Status prüfen
docker ps
docker logs mayer-elektro-backend

# Restart
docker restart mayer-elektro-backend

# Health Check
docker exec mayer-elektro-backend npm run health
```

## 🔧 Reverse Proxy Setup

### Nginx Konfiguration
```nginx
server {
    listen 80;
    server_name mayer-elektro.de www.mayer-elektro.de;
    
    # Frontend (statische Dateien)
    location / {
        root /var/www/frontend/dist;
        try_files $uri $uri/ /index.html;
    }
    
    # Backend API
    location /api/ {
        proxy_pass http://localhost:4000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_cache_bypass $http_upgrade;
        
        # Timeouts
        proxy_connect_timeout 60s;
        proxy_send_timeout 60s;
        proxy_read_timeout 60s;
        
        # File Upload
        client_max_body_size 50M;
    }
    
    # Security Headers
    add_header X-Frame-Options DENY;
    add_header X-Content-Type-Options nosniff;
    add_header X-XSS-Protection "1; mode=block";
    add_header Referrer-Policy "strict-origin-when-cross-origin";
}
```

### Apache Konfiguration
```apache
<VirtualHost *:80>
    ServerName mayer-elektro.de
    ServerAlias www.mayer-elektro.de
    
    # Frontend
    DocumentRoot /var/www/frontend/dist
    
    # Backend API Proxy
    ProxyPreserveHost On
    ProxyPass /api/ http://localhost:4000/api/
    ProxyPassReverse /api/ http://localhost:4000/api/
    
    # Security Headers
    Header always set X-Frame-Options DENY
    Header always set X-Content-Type-Options nosniff
    Header always set X-XSS-Protection "1; mode=block"
</VirtualHost>
```

## 📊 Monitoring & Logging

### 1. Log-Dateien
```bash
# Application Logs
tail -f logs/app.log
tail -f logs/error.log

# PM2 Logs
pm2 logs mayer-elektro-backend

# Docker Logs
docker logs -f mayer-elektro-backend
```

### 2. Health Monitoring
```bash
# Health Check Script
#!/bin/bash
response=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:4000/api/health)
if [ $response != "200" ]; then
    echo "Backend is down! Status: $response"
    # Restart logic hier
fi
```

### 3. Log Rotation
```bash
# Cron Job für Log-Rotation (täglich um 2 Uhr)
0 2 * * * find /path/to/backend-node/logs -name "*.log" -mtime +30 -delete
```

## 🔒 Sicherheit

### 1. Firewall
```bash
# Nur notwendige Ports öffnen
ufw allow 22    # SSH
ufw allow 80    # HTTP
ufw allow 443   # HTTPS
ufw deny 4000   # Backend-Port nicht direkt zugänglich
```

### 2. SSL/TLS
```bash
# Let's Encrypt mit Certbot
certbot --nginx -d mayer-elektro.de -d www.mayer-elektro.de
```

### 3. Environment-Sicherheit
```bash
# .env Datei schützen
chmod 600 .env
chown root:root .env
```

## 🧪 Testing

### 1. Funktionstest
```bash
# Health Check
curl https://mayer-elektro.de/api/health

# Kontaktformular
curl -X POST https://mayer-elektro.de/api/contact \
  -H "Content-Type: application/json" \
  -d '{"name":"Test","email":"test@example.com","message":"Test"}'

# File Upload Test
curl -X POST https://mayer-elektro.de/api/submit-application \
  -F "firstName=Test" \
  -F "lastName=User" \
  -F "email=test@example.com" \
  -F "position=Testposition" \
  -F "files=@test.pdf"
```

### 2. Load Testing
```bash
# Mit Apache Bench
ab -n 1000 -c 10 https://mayer-elektro.de/api/health

# Mit curl (Rate Limiting testen)
for i in {1..10}; do
  curl -X POST https://mayer-elektro.de/api/contact \
    -H "Content-Type: application/json" \
    -d '{"name":"Test","email":"test@example.com","message":"Test"}'
done
```

## 🔄 Wartung

### 1. Updates
```bash
# Dependencies aktualisieren
npm audit
npm update

# PM2 Reload (Zero-Downtime)
pm2 reload mayer-elektro-backend
```

### 2. Backup
```bash
# Wichtige Dateien sichern
tar -czf backup-$(date +%Y%m%d).tar.gz \
  .env \
  uploads/ \
  logs/ \
  package.json \
  package-lock.json
```

### 3. Cleanup
```bash
# Alte Uploads löschen (nach 7 Tagen)
find uploads/ -type f -mtime +7 -delete

# Alte Logs löschen (nach 30 Tagen)
find logs/ -name "*.log" -mtime +30 -delete
```

## 🚨 Troubleshooting

### Häufige Probleme

#### 1. Port bereits belegt
```bash
# Port-Nutzung prüfen
netstat -tulpn | grep :4000
lsof -i :4000

# Prozess beenden
kill -9 <PID>
```

#### 2. Permission Errors
```bash
# Berechtigungen setzen
chmod 755 backend-node/
chmod 777 backend-node/uploads/
chmod 777 backend-node/logs/
```

#### 3. E-Mail funktioniert nicht
```bash
# SMTP-Verbindung testen
telnet smtp.web.de 587

# Logs prüfen
grep -i "email\|smtp" logs/app.log
```

#### 4. High Memory Usage
```bash
# Memory-Nutzung prüfen
ps aux | grep node
top -p $(pgrep node)

# PM2 Memory Restart
pm2 restart mayer-elektro-backend
```

## 📈 Performance-Optimierung

### 1. Node.js Tuning
```bash
# Environment-Variablen für Performance
export NODE_OPTIONS="--max-old-space-size=1024"
export UV_THREADPOOL_SIZE=4
```

### 2. PM2 Cluster Mode
```javascript
// ecosystem.config.js
module.exports = {
  apps: [{
    name: 'mayer-elektro-backend',
    script: 'server.js',
    instances: 'max', // Nutze alle CPU-Kerne
    exec_mode: 'cluster'
  }]
};
```

### 3. Caching
- Nginx-Caching für statische Assets
- Redis für Session-Storage (bei Bedarf)
- CDN für globale Verfügbarkeit

---

## ✅ Deployment Checklist

- [ ] Node.js und npm installiert
- [ ] .env.production angepasst und als .env kopiert
- [ ] Dependencies installiert (`npm ci --production`)
- [ ] Verzeichnisse erstellt (uploads/, logs/)
- [ ] Firewall konfiguriert
- [ ] Reverse Proxy eingerichtet
- [ ] SSL-Zertifikat installiert
- [ ] PM2 oder Docker konfiguriert
- [ ] Health Checks funktionieren
- [ ] E-Mail-Versand getestet
- [ ] File-Upload getestet
- [ ] Monitoring eingerichtet
- [ ] Backup-Strategie implementiert
- [ ] Log-Rotation konfiguriert

**Das Node.js Backend ist production-ready!** 🎉