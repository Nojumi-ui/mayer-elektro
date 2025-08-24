# Mayer Elektro - Backend

Node.js/Express Backend-Server für die Mayer Elektro Website mit E-Mail-Funktionalität und Datei-Upload für Bewerbungen.

## 🚀 Technologie-Stack

- **Node.js** - JavaScript Runtime
- **Express.js** - Web Framework
- **Nodemailer** - E-Mail-Versand
- **Multer** - Datei-Upload Middleware
- **CORS** - Cross-Origin Resource Sharing

## 📋 Voraussetzungen

- Node.js (Version 16 oder höher)
- npm
- SMTP-Server für E-Mail-Versand (z.B. Gmail)

## 🛠️ Installation

1. **In das Backend-Verzeichnis wechseln:**
   ```bash
   cd backend
   ```

2. **Abhängigkeiten installieren:**
   ```bash
   npm install
   ```

3. **Umgebungsvariablen konfigurieren:**
   Erstellen Sie eine `.env` Datei im Backend-Verzeichnis:
   ```env
   PORT=4000
   EMAIL_USER=ihr-email@gmail.com
   EMAIL_PASS=ihr-app-passwort
   ```

## 🏃‍♂️ Server starten

### Development
```bash
npm start
```

### Production
```bash
NODE_ENV=production npm start
```

Der Server läuft standardmäßig auf Port 4000: `http://localhost:4000`

## 📁 Projektstruktur

```
backend/
├── uploads/               # Hochgeladene Dateien (wird automatisch erstellt)
├── server.js             # Haupt-Server-Datei
├── package.json          # Projekt-Dependencies
└── README.md             # Diese Datei
```

## 🔌 API Endpoints

### 1. Kontaktformular
**POST** `/api/contact`

Verarbeitet Kontaktanfragen von der Website.

**Request Body:**
```json
{
  "name": "Max Mustermann",
  "email": "max@example.com",
  "message": "Ihre Nachricht hier",
  "phone": "+49 123 456789" // optional
}
```

**Response:**
```json
{
  "success": true
}
```

### 2. Bewerbungsformular (Neu)
**POST** `/api/submit-application`

Verarbeitet Bewerbungen mit Datei-Uploads.

**Content-Type:** `multipart/form-data`

**Form Fields:**
- `firstName` - Vorname
- `lastName` - Nachname
- `email` - E-Mail-Adresse
- `phone` - Telefonnummer (optional)
- `address` - Adresse (optional)
- `postalCode` - Postleitzahl (optional)
- `city` - Stadt (optional)
- `country` - Land (optional)
- `position` - Gewünschte Position
- `availability` - Verfügbarkeit (optional)
- `salaryExpectation` - Gehaltsvorstellung (optional)
- `coverLetter` - Anschreiben (optional)

**File Fields:**
- `cv` - Lebenslauf (max. 1 Datei)
- `document_0` bis `document_4` - Zusätzliche Dokumente (max. 1 Datei pro Feld)

**Erlaubte Dateiformate:**
- PDF (`.pdf`)
- Word-Dokumente (`.doc`, `.docx`)
- Bilder (`.jpg`, `.jpeg`, `.png`)

**Maximale Dateigröße:** 5 MB pro Datei

**Response:**
```json
{
  "success": true,
  "message": "Bewerbung erfolgreich gesendet"
}
```

### 3. Bewerbungsformular (Legacy)
**POST** `/api/apply`

Älterer Endpoint für Bewerbungen (für Kompatibilität).

## 📧 E-Mail-Konfiguration

### Gmail Setup
1. **2-Faktor-Authentifizierung aktivieren**
2. **App-Passwort generieren:**
   - Google-Konto → Sicherheit → App-Passwörter
   - Neues App-Passwort für "Mail" erstellen
3. **Umgebungsvariablen setzen:**
   ```env
   EMAIL_USER=ihre-gmail@gmail.com
   EMAIL_PASS=ihr-16-stelliges-app-passwort
   ```

### Andere SMTP-Server
Passen Sie die Transporter-Konfiguration in `server.js` an:

```javascript
const transporter = nodemailer.createTransporter({
  host: 'ihr-smtp-server.com',
  port: 587,
  secure: false,
  auth: {
    user: process.env.EMAIL_USER,
    pass: process.env.EMAIL_PASS
  }
});
```

## 📁 Datei-Upload

### Konfiguration
- **Upload-Verzeichnis:** `./uploads/`
- **Maximale Dateigröße:** 5 MB pro Datei
- **Erlaubte MIME-Types:**
  - `application/pdf`
  - `application/vnd.openxmlformats-officedocument.wordprocessingml.document`
  - `application/msword`
  - `image/jpeg`
  - `image/jpg`
  - `image/png`

### Datei-Naming
Hochgeladene Dateien werden automatisch umbenannt:
```
{timestamp}-{originalname}
```

## 🔒 Sicherheit

### Implementierte Sicherheitsmaßnahmen
- **CORS** aktiviert für Cross-Origin Requests
- **Datei-Typ-Validierung** für Uploads
- **Dateigröße-Limits** für Uploads
- **Input-Sanitization** für E-Mail-Inhalte

### Empfohlene zusätzliche Maßnahmen
- **Rate Limiting** für API-Endpoints
- **Input-Validierung** mit Joi oder ähnlichen Libraries
- **Helmet.js** für HTTP-Header-Sicherheit
- **HTTPS** in der Produktion

## 🚀 Deployment

### Umgebungsvariablen für Produktion
```env
NODE_ENV=production
PORT=4000
EMAIL_USER=production-email@company.com
EMAIL_PASS=secure-app-password
```

### PM2 (empfohlen für Produktion)
```bash
# PM2 installieren
npm install -g pm2

# Server starten
pm2 start server.js --name "mayer-elektro-backend"

# Auto-Start bei System-Neustart
pm2 startup
pm2 save
```

### Docker
```dockerfile
FROM node:16-alpine
WORKDIR /app
COPY package*.json ./
RUN npm ci --only=production
COPY . .
EXPOSE 4000
CMD ["npm", "start"]
```

## 📊 Logging

Der Server loggt folgende Ereignisse:
- Eingehende Kontaktanfragen
- Bewerbungseinreichungen
- E-Mail-Versand-Status
- Fehler und Exceptions

### Log-Ausgabe erweitern
Für erweiterte Logging-Funktionalität empfiehlt sich die Integration von:
- **Winston** - Strukturiertes Logging
- **Morgan** - HTTP Request Logging

## 🧪 Testing

### API-Tests mit curl

**Kontaktformular testen:**
```bash
curl -X POST http://localhost:4000/api/contact \
  -H "Content-Type: application/json" \
  -d '{"name":"Test User","email":"test@example.com","message":"Test message"}'
```

**Bewerbung testen:**
```bash
curl -X POST http://localhost:4000/api/submit-application \
  -F "firstName=Max" \
  -F "lastName=Mustermann" \
  -F "email=max@example.com" \
  -F "position=Elektriker" \
  -F "cv=@/path/to/cv.pdf"
```

## 🔧 Wartung

### Uploads-Verzeichnis bereinigen
Regelmäßige Bereinigung alter Upload-Dateien:
```bash
# Dateien älter als 30 Tage löschen
find ./uploads -type f -mtime +30 -delete
```

### Log-Rotation
Implementierung einer Log-Rotation für Produktionsumgebungen empfohlen.

## 📞 Support

Bei Fragen oder Problemen:
- Überprüfen Sie die Server-Logs
- Stellen Sie sicher, dass alle Umgebungsvariablen korrekt gesetzt sind
- Testen Sie die E-Mail-Konfiguration separat

## 📄 Lizenz

Dieses Projekt ist proprietär und gehört Mayer Elektro- und Gebäudetechnik GmbH.