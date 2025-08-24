const express = require('express');
const cors = require('cors');
const multer = require('multer');
const nodemailer = require('nodemailer');
const path = require('path');
const fs = require('fs');
const rateLimit = require('express-rate-limit');
const helmet = require('helmet');
const validator = require('validator');
const xss = require('xss');
const crypto = require('crypto');
require('dotenv').config();

const app = express();

// Production-spezifische Konfiguration
const isProduction = process.env.NODE_ENV === 'production';
const isDevelopment = process.env.NODE_ENV === 'development';

// Logging-Setup
const logLevel = process.env.LOG_LEVEL || (isProduction ? 'info' : 'debug');

// Verzeichnisse erstellen
const uploadsDir = path.join(__dirname, process.env.UPLOAD_DIR || 'uploads');
const logsDir = path.join(__dirname, 'logs');

if (!fs.existsSync(uploadsDir)) {
  fs.mkdirSync(uploadsDir, { recursive: true });
}

if (!fs.existsSync(logsDir)) {
  fs.mkdirSync(logsDir, { recursive: true });
}

// Trust proxy in Production (für Load Balancer/Reverse Proxy)
if (isProduction && process.env.TRUST_PROXY === 'true') {
  app.set('trust proxy', 1);
}

// Sicherheits-Middleware
app.use(helmet({
  contentSecurityPolicy: {
    directives: {
      defaultSrc: ["'self'"],
      styleSrc: ["'self'", "'unsafe-inline'"],
      scriptSrc: ["'self'"],
      imgSrc: ["'self'", "data:", "https:"],
    },
  },
}));

// Rate Limiting (umgebungsabhängig)
const generalLimiter = rateLimit({
  windowMs: parseInt(process.env.RATE_LIMIT_WINDOW_MS) || 15 * 60 * 1000, // 15 Minuten
  max: parseInt(process.env.RATE_LIMIT_MAX_REQUESTS) || 100,
  message: {
    success: false,
    message: 'Zu viele Anfragen. Bitte versuchen Sie es später erneut.'
  },
  standardHeaders: true,
  legacyHeaders: false,
  skip: (req) => {
    // In Development weniger strikt
    return isDevelopment && req.ip === '127.0.0.1';
  }
});

const contactLimiter = rateLimit({
  windowMs: 60 * 60 * 1000, // 1 Stunde
  max: parseInt(process.env.CONTACT_RATE_LIMIT_MAX) || 5,
  message: {
    success: false,
    message: 'Zu viele Kontaktanfragen. Bitte warten Sie eine Stunde bevor Sie erneut eine Nachricht senden.'
  },
  standardHeaders: true,
  legacyHeaders: false,
});

const applicationLimiter = rateLimit({
  windowMs: 24 * 60 * 60 * 1000, // 24 Stunden
  max: 3, // Maximal 3 Bewerbungen pro Tag pro IP
  message: {
    success: false,
    message: 'Zu viele Bewerbungen. Sie können maximal 3 Bewerbungen pro Tag einreichen.'
  },
  standardHeaders: true,
  legacyHeaders: false,
});

app.use(generalLimiter);

// CORS-Konfiguration
const corsOrigins = process.env.CORS_ORIGINS ? process.env.CORS_ORIGINS.split(',') : ['http://localhost:5173', 'http://127.0.0.1:5173'];
app.use(cors({
  origin: corsOrigins,
  methods: ['GET', 'POST'],
  allowedHeaders: ['Content-Type', 'Authorization'],
  credentials: true
}));

app.use(express.json({ limit: '10mb' }));
app.use(express.urlencoded({ extended: true, limit: '10mb' }));
app.use('/uploads', express.static(path.join(__dirname, 'uploads')));

const UPLOAD_DIR = path.join(__dirname, process.env.UPLOAD_DIR || 'uploads');
if (!fs.existsSync(UPLOAD_DIR)) fs.mkdirSync(UPLOAD_DIR);

// Validierungsfunktionen
const validateContactForm = (data) => {
  const errors = [];
  
  // Name Validierung
  if (!data.name || typeof data.name !== 'string') {
    errors.push('Name ist erforderlich');
  } else if (data.name.trim().length < 2) {
    errors.push('Name muss mindestens 2 Zeichen lang sein');
  } else if (data.name.trim().length > 100) {
    errors.push('Name darf maximal 100 Zeichen lang sein');
  } else if (!/^[a-zA-ZäöüÄÖÜß\s\-'\.]+$/.test(data.name.trim())) {
    errors.push('Name enthält ungültige Zeichen');
  }
  
  // E-Mail Validierung
  if (!data.email || typeof data.email !== 'string') {
    errors.push('E-Mail ist erforderlich');
  } else if (!validator.isEmail(data.email.trim())) {
    errors.push('Ungültige E-Mail-Adresse');
  } else if (data.email.trim().length > 254) {
    errors.push('E-Mail-Adresse ist zu lang');
  }
  
  // Nachricht Validierung
  if (!data.message || typeof data.message !== 'string') {
    errors.push('Nachricht ist erforderlich');
  } else if (data.message.trim().length < 10) {
    errors.push('Nachricht muss mindestens 10 Zeichen lang sein');
  } else if (data.message.trim().length > 5000) {
    errors.push('Nachricht darf maximal 5000 Zeichen lang sein');
  }
  
  return errors;
};

const validateApplicationForm = (data) => {
  const errors = [];
  
  // Vorname Validierung
  if (!data.firstName || typeof data.firstName !== 'string') {
    errors.push('Vorname ist erforderlich');
  } else if (data.firstName.trim().length < 2) {
    errors.push('Vorname muss mindestens 2 Zeichen lang sein');
  } else if (data.firstName.trim().length > 50) {
    errors.push('Vorname darf maximal 50 Zeichen lang sein');
  } else if (!/^[a-zA-ZäöüÄÖÜß\s\-'\.]+$/.test(data.firstName.trim())) {
    errors.push('Vorname enthält ungültige Zeichen');
  }
  
  // Nachname Validierung
  if (!data.lastName || typeof data.lastName !== 'string') {
    errors.push('Nachname ist erforderlich');
  } else if (data.lastName.trim().length < 2) {
    errors.push('Nachname muss mindestens 2 Zeichen lang sein');
  } else if (data.lastName.trim().length > 50) {
    errors.push('Nachname darf maximal 50 Zeichen lang sein');
  } else if (!/^[a-zA-ZäöüÄÖÜß\s\-'\.]+$/.test(data.lastName.trim())) {
    errors.push('Nachname enthält ungültige Zeichen');
  }
  
  // E-Mail Validierung
  if (!data.email || typeof data.email !== 'string') {
    errors.push('E-Mail ist erforderlich');
  } else if (!validator.isEmail(data.email.trim())) {
    errors.push('Ungültige E-Mail-Adresse');
  } else if (data.email.trim().length > 254) {
    errors.push('E-Mail-Adresse ist zu lang');
  }
  
  // Position Validierung
  if (!data.position || typeof data.position !== 'string') {
    errors.push('Position ist erforderlich');
  } else if (data.position.trim().length < 2) {
    errors.push('Position muss mindestens 2 Zeichen lang sein');
  } else if (data.position.trim().length > 100) {
    errors.push('Position darf maximal 100 Zeichen lang sein');
  }
  
  // Telefon Validierung (optional)
  if (data.phone && typeof data.phone === 'string' && data.phone.trim()) {
    if (!validator.isMobilePhone(data.phone.trim(), 'de-DE') && 
        !validator.isMobilePhone(data.phone.trim(), 'any')) {
      errors.push('Ungültige Telefonnummer');
    }
  }
  
  // PLZ Validierung (optional)
  if (data.postalCode && typeof data.postalCode === 'string' && data.postalCode.trim()) {
    if (!/^\d{5}$/.test(data.postalCode.trim())) {
      errors.push('Ungültige Postleitzahl (5 Ziffern erforderlich)');
    }
  }
  
  // Anschreiben Validierung (optional)
  if (data.coverLetter && typeof data.coverLetter === 'string') {
    if (data.coverLetter.trim().length > 10000) {
      errors.push('Anschreiben darf maximal 10000 Zeichen lang sein');
    }
  }
  
  return errors;
};

const sanitizeInput = (input) => {
  if (typeof input !== 'string') return input;
  return xss(input.trim(), {
    whiteList: {}, // Keine HTML-Tags erlaubt
    stripIgnoreTag: true,
    stripIgnoreTagBody: ['script']
  });
};

const sanitizeObject = (obj) => {
  const sanitized = {};
  for (const [key, value] of Object.entries(obj)) {
    if (typeof value === 'string') {
      sanitized[key] = sanitizeInput(value);
    } else {
      sanitized[key] = value;
    }
  }
  return sanitized;
};

// Verbesserte Datei-Validierung
const validateFile = (file) => {
  const errors = [];
  
  // MIME-Type Validierung
  if (!ALLOWED_MIMES.includes(file.mimetype)) {
    errors.push(`Ungültiger Dateityp: ${file.mimetype}. Erlaubt sind: PDF, DOC, DOCX, JPG, PNG`);
  }
  
  // Dateigröße Validierung
  const maxSize = parseInt(process.env.MAX_FILE_SIZE) || 5 * 1024 * 1024;
  if (file.size > maxSize) {
    errors.push(`Datei zu groß: ${(file.size / 1024 / 1024).toFixed(2)}MB. Maximum: ${(maxSize / 1024 / 1024).toFixed(2)}MB`);
  }
  
  // Dateiname Validierung
  if (file.originalname.length > 255) {
    errors.push('Dateiname ist zu lang (maximal 255 Zeichen)');
  }
  
  // Gefährliche Dateierweiterungen prüfen
  const dangerousExtensions = ['.exe', '.bat', '.cmd', '.com', '.pif', '.scr', '.vbs', '.js', '.jar', '.php', '.asp', '.jsp'];
  const fileExtension = path.extname(file.originalname).toLowerCase();
  if (dangerousExtensions.includes(fileExtension)) {
    errors.push(`Gefährliche Dateierweiterung: ${fileExtension}`);
  }
  
  return errors;
};

// Erlaubte MIME-Types
const ALLOWED_MIMES = [
  'application/pdf', 
  'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
  'application/msword',
  'image/jpeg', 
  'image/jpg',
  'image/png'
];

// Sichere Dateiname-Generierung
const generateSecureFilename = (originalname) => {
  const timestamp = Date.now();
  const randomString = crypto.randomBytes(8).toString('hex');
  const extension = path.extname(originalname).toLowerCase();
  const baseName = path.basename(originalname, extension)
    .replace(/[^a-zA-Z0-9\-_]/g, '_')
    .substring(0, 50);
  
  return `${timestamp}-${randomString}-${baseName}${extension}`;
};

// Multer storage mit verbesserter Sicherheit
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    // Sicherstellen, dass das Upload-Verzeichnis existiert
    if (!fs.existsSync(UPLOAD_DIR)) {
      fs.mkdirSync(UPLOAD_DIR, { recursive: true });
    }
    cb(null, UPLOAD_DIR);
  },
  filename: (req, file, cb) => {
    const secureFilename = generateSecureFilename(file.originalname);
    cb(null, secureFilename);
  }
});

// Verbesserte Datei-Filter-Funktion
const fileFilter = (req, file, cb) => {
  const errors = validateFile(file);
  
  if (errors.length > 0) {
    return cb(new Error(errors.join('; ')), false);
  }
  
  cb(null, true);
};

const upload = multer({
  storage,
  fileFilter,
  limits: { 
    fileSize: parseInt(process.env.MAX_FILE_SIZE) || 5 * 1024 * 1024, // Default: 5 MB per file
    files: 6, // Maximal 6 Dateien (1 CV + 5 Dokumente)
    fieldSize: 1024 * 1024, // 1MB für Textfelder
    fieldNameSize: 100, // Maximale Länge für Feldnamen
    fields: 20 // Maximale Anzahl von Feldern
  }
});

// E-Mail Transporter konfigurieren
const transporter = nodemailer.createTransport({
  host: process.env.SMTP_HOST || 'smtp.web.de',
  port: parseInt(process.env.SMTP_PORT) || 587,
  secure: process.env.SMTP_SECURE === 'true', // true für 465, false für andere Ports
  auth: {
    user: process.env.EMAIL_USER,
    pass: process.env.EMAIL_PASS
  },
  tls: {
    rejectUnauthorized: false,
    ciphers: "SSLv3"
  },
  debug: true, // Debug-Modus aktivieren
  logger: true // Logging aktivieren
});

// Contact endpoint mit verbesserter Sicherheit
app.post('/api/contact', contactLimiter, async (req, res) => {
  const requestId = crypto.randomBytes(8).toString('hex');
  console.log(`=== KONTAKT REQUEST [${requestId}] ===`);
  console.log('IP:', req.ip);
  console.log('User-Agent:', req.get('User-Agent'));
  
  try {
    // Input-Sanitization
    const sanitizedData = sanitizeObject(req.body);
    const { name, email, message } = sanitizedData;
    
    // Umfassende Validierung
    const validationErrors = validateContactForm({ name, email, message });
    if (validationErrors.length > 0) {
      console.log(`Validierungsfehler [${requestId}]:`, validationErrors);
      return res.status(400).json({ 
        success: false, 
        message: 'Validierungsfehler',
        errors: validationErrors
      });
    }

    // Spam-Schutz: Prüfung auf verdächtige Inhalte
    const spamKeywords = ['viagra', 'casino', 'lottery', 'winner', 'congratulations', 'click here', 'free money'];
    const messageText = message.toLowerCase();
    const hasSpam = spamKeywords.some(keyword => messageText.includes(keyword));
    
    if (hasSpam) {
      console.log(`Spam erkannt [${requestId}]:`, { name, email });
      return res.status(400).json({ 
        success: false, 
        message: 'Nachricht wurde als Spam erkannt' 
      });
    }

    console.log(`Kontaktanfrage verarbeitet [${requestId}]:`, { 
      name: name.substring(0, 20) + '...', 
      email: email.substring(0, 20) + '...', 
      messageLength: message.length 
    });

    // Sichere E-Mail HTML Template (XSS-geschützt)
    const emailHTML = `
      <h2>Neue Kontaktanfrage von der Website</h2>
      
      <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
        <h3>📋 Request Details:</h3>
        <ul style="list-style: none; padding: 0;">
          <li><strong>Request ID:</strong> ${requestId}</li>
          <li><strong>Zeitstempel:</strong> ${new Date().toLocaleString('de-DE')}</li>
          <li><strong>IP-Adresse:</strong> ${req.ip}</li>
          <li><strong>User-Agent:</strong> ${req.get('User-Agent') || 'Unbekannt'}</li>
        </ul>
      </div>
      
      <h3>👤 Kontaktdaten:</h3>
      <ul>
        <li><strong>Name:</strong> ${validator.escape(name)}</li>
        <li><strong>E-Mail:</strong> ${validator.escape(email)}</li>
      </ul>

      <h3>💬 Nachricht:</h3>
      <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #007bff;">
        ${validator.escape(message).replace(/\n/g, '<br>')}
      </div>

      <hr>
      <p style="font-size: 12px; color: #666;">
        Diese Nachricht wurde über das Kontaktformular der Website gesendet.<br>
        Automatisch generiert am ${new Date().toLocaleString('de-DE')}
      </p>
    `;

    // E-Mail-Optionen mit verbesserter Sicherheit
    const mailOptions = {
      from: process.env.EMAIL_USER,
      to: process.env.EMAIL_USER,
      subject: `[KONTAKT] ${validator.escape(name)} - ${new Date().toLocaleDateString('de-DE')}`,
      html: emailHTML,
      replyTo: email,
      headers: {
        'X-Request-ID': requestId,
        'X-Mailer': 'Mayer-Elektro-Website'
      }
    };

    // E-Mail-Versand mit verbesserter Fehlerbehandlung
    let emailSent = false;
    try {
      console.log(`Versuche E-Mail zu senden [${requestId}]...`);
      
      const info = await transporter.sendMail(mailOptions);
      emailSent = true;
      
      console.log(`✅ Kontakt-E-Mail erfolgreich versendet [${requestId}]!`);
      console.log('Message ID:', info.messageId);
      
    } catch (emailError) {
      console.error(`❌ E-Mail-Versand fehlgeschlagen [${requestId}]:`, {
        code: emailError.code,
        message: emailError.message,
        response: emailError.response
      });
      
      // Bei kritischen E-Mail-Fehlern den Request als fehlgeschlagen markieren
      if (emailError.code === 'EAUTH' || emailError.code === 'ECONNECTION') {
        return res.status(500).json({ 
          success: false, 
          message: 'E-Mail-Service temporär nicht verfügbar. Bitte versuchen Sie es später erneut.' 
        });
      }
    }
    
    res.json({ 
      success: true, 
      message: 'Nachricht erfolgreich gesendet',
      requestId: requestId,
      emailSent: emailSent
    });

  } catch (error) {
    console.error(`Fehler beim Verarbeiten der Kontaktanfrage [${requestId || 'unknown'}]:`, error);
    res.status(500).json({ 
      success: false, 
      message: 'Ein unerwarteter Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.' 
    });
  }
});

// Bewerbungsformular-Endpoint mit verbesserter Sicherheit
app.post('/api/submit-application', applicationLimiter, upload.fields([
  { name: 'cv', maxCount: 1 },
  { name: 'document_0', maxCount: 1 },
  { name: 'document_1', maxCount: 1 },
  { name: 'document_2', maxCount: 1 },
  { name: 'document_3', maxCount: 1 },
  { name: 'document_4', maxCount: 1 }
]), async (req, res) => {
  const requestId = crypto.randomBytes(8).toString('hex');
  console.log(`=== BEWERBUNG REQUEST [${requestId}] ===`);
  console.log('IP:', req.ip);
  console.log('User-Agent:', req.get('User-Agent'));
  
  // Cleanup-Funktion für hochgeladene Dateien bei Fehlern
  const cleanupFiles = () => {
    if (req.files) {
      Object.values(req.files).flat().forEach(file => {
        try {
          if (fs.existsSync(file.path)) {
            fs.unlinkSync(file.path);
            console.log(`Datei gelöscht: ${file.path}`);
          }
        } catch (err) {
          console.error(`Fehler beim Löschen der Datei ${file.path}:`, err);
        }
      });
    }
  };

  try {
    // Input-Sanitization
    const sanitizedData = sanitizeObject(req.body);
    const {
      firstName,
      lastName,
      email,
      phone,
      address,
      postalCode,
      city,
      country,
      position,
      availability,
      salaryExpectation,
      coverLetter
    } = sanitizedData;

    // Umfassende Validierung der Formulardaten
    const validationErrors = validateApplicationForm(sanitizedData);
    if (validationErrors.length > 0) {
      console.log(`Bewerbung Validierungsfehler [${requestId}]:`, validationErrors);
      cleanupFiles();
      return res.status(400).json({ 
        success: false, 
        message: 'Validierungsfehler',
        errors: validationErrors
      });
    }

    // Prüfung ob mindestens ein CV hochgeladen wurde
    if (!req.files || !req.files.cv || req.files.cv.length === 0) {
      console.log(`Kein CV hochgeladen [${requestId}]`);
      cleanupFiles();
      return res.status(400).json({ 
        success: false, 
        message: 'Ein Lebenslauf (CV) ist erforderlich' 
      });
    }

    // Validierung aller hochgeladenen Dateien
    const fileValidationErrors = [];
    const allFiles = Object.values(req.files).flat();
    
    allFiles.forEach((file, index) => {
      const errors = validateFile(file);
      if (errors.length > 0) {
        fileValidationErrors.push(`Datei ${index + 1} (${file.originalname}): ${errors.join(', ')}`);
      }
    });

    if (fileValidationErrors.length > 0) {
      console.log(`Datei-Validierungsfehler [${requestId}]:`, fileValidationErrors);
      cleanupFiles();
      return res.status(400).json({ 
        success: false, 
        message: 'Datei-Validierungsfehler',
        errors: fileValidationErrors
      });
    }

    // Gesamtdateigröße prüfen
    const totalSize = allFiles.reduce((sum, file) => sum + file.size, 0);
    const maxTotalSize = 25 * 1024 * 1024; // 25 MB Gesamtlimit
    
    if (totalSize > maxTotalSize) {
      console.log(`Gesamtdateigröße überschritten [${requestId}]: ${(totalSize / 1024 / 1024).toFixed(2)}MB`);
      cleanupFiles();
      return res.status(400).json({ 
        success: false, 
        message: `Gesamtdateigröße überschreitet das Limit von ${(maxTotalSize / 1024 / 1024).toFixed(2)}MB` 
      });
    }

    console.log(`Bewerbung verarbeitet [${requestId}]:`, { 
      name: `${firstName} ${lastName}`, 
      email: email.substring(0, 20) + '...', 
      position,
      filesCount: allFiles.length,
      totalSizeMB: (totalSize / 1024 / 1024).toFixed(2)
    });

    // Alle hochgeladenen Dateien für E-Mail-Anhänge sammeln
    const attachments = [];
    
    if (req.files.cv) {
      attachments.push({
        filename: req.files.cv[0].originalname,
        path: req.files.cv[0].path,
        contentType: req.files.cv[0].mimetype
      });
    }

    // Weitere Dokumente hinzufügen
    Object.keys(req.files).forEach(key => {
      if (key.startsWith('document_')) {
        attachments.push({
          filename: req.files[key][0].originalname,
          path: req.files[key][0].path,
          contentType: req.files[key][0].mimetype
        });
      }
    });

    // Sichere E-Mail HTML Template für Bewerbungen (XSS-geschützt)
    const emailHTML = `
      <h2>🎯 Neue Bewerbung eingegangen</h2>
      
      <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
        <h3>📋 Request Details:</h3>
        <ul style="list-style: none; padding: 0;">
          <li><strong>Request ID:</strong> ${requestId}</li>
          <li><strong>Zeitstempel:</strong> ${new Date().toLocaleString('de-DE')}</li>
          <li><strong>IP-Adresse:</strong> ${req.ip}</li>
          <li><strong>User-Agent:</strong> ${req.get('User-Agent') || 'Unbekannt'}</li>
          <li><strong>Dateien:</strong> ${attachments.length} (${(totalSize / 1024 / 1024).toFixed(2)} MB)</li>
        </ul>
      </div>
      
      <h3>👤 Persönliche Daten:</h3>
      <div style="background: #fff; padding: 15px; border-radius: 5px; border-left: 4px solid #28a745;">
        <ul>
          <li><strong>Name:</strong> ${validator.escape(firstName)} ${validator.escape(lastName)}</li>
          <li><strong>E-Mail:</strong> ${validator.escape(email)}</li>
          <li><strong>Telefon:</strong> ${phone ? validator.escape(phone) : 'Nicht angegeben'}</li>
          <li><strong>Adresse:</strong> ${address ? validator.escape(address) : 'Nicht angegeben'}</li>
          <li><strong>PLZ/Stadt:</strong> ${postalCode ? validator.escape(postalCode) : ''} ${city ? validator.escape(city) : ''}</li>
          <li><strong>Land:</strong> ${country ? validator.escape(country) : 'Nicht angegeben'}</li>
        </ul>
      </div>

      <h3>💼 Bewerbungsdetails:</h3>
      <div style="background: #fff; padding: 15px; border-radius: 5px; border-left: 4px solid #007bff;">
        <ul>
          <li><strong>Position:</strong> ${validator.escape(position)}</li>
          <li><strong>Verfügbar ab:</strong> ${availability ? validator.escape(availability) : 'Nicht angegeben'}</li>
          <li><strong>Gehaltsvorstellung:</strong> ${salaryExpectation ? validator.escape(salaryExpectation) : 'Nicht angegeben'}</li>
        </ul>
      </div>

      ${coverLetter ? `
        <h3>📝 Anschreiben:</h3>
        <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; border-left: 4px solid #ffc107;">
          ${validator.escape(coverLetter).replace(/\n/g, '<br>')}
        </div>
      ` : ''}

      <h3>📎 Anhänge (${attachments.length}):</h3>
      <div style="background: #fff; padding: 15px; border-radius: 5px; border-left: 4px solid #6c757d;">
        <ul>
          ${attachments.map(att => `
            <li>
              <strong>${validator.escape(att.filename)}</strong>
              <br><small style="color: #666;">Typ: ${att.contentType}</small>
            </li>
          `).join('')}
        </ul>
      </div>

      <hr>
      <p style="font-size: 12px; color: #666;">
        Diese Bewerbung wurde über das Bewerbungsformular der Website eingereicht.<br>
        Automatisch generiert am ${new Date().toLocaleString('de-DE')}
      </p>
    `;

    // E-Mail-Optionen mit verbesserter Sicherheit
    const mailOptions = {
      from: process.env.EMAIL_USER,
      to: process.env.EMAIL_USER,
      subject: `[BEWERBUNG] ${validator.escape(position)} - ${validator.escape(firstName)} ${validator.escape(lastName)}`,
      html: emailHTML,
      attachments: attachments,
      headers: {
        'X-Request-ID': requestId,
        'X-Mailer': 'Mayer-Elektro-Website',
        'X-Application-Type': 'Job-Application'
      }
    };

    // E-Mail-Versand mit Fehlerbehandlung
    let emailSent = false;
    try {
      console.log(`Versuche Bewerbungs-E-Mail zu senden [${requestId}]...`);
      
      const info = await transporter.sendMail(mailOptions);
      emailSent = true;
      
      console.log(`✅ Bewerbungs-E-Mail erfolgreich versendet [${requestId}]!`);
      console.log('Message ID:', info.messageId);
      
    } catch (emailError) {
      console.error(`❌ Bewerbungs-E-Mail-Versand fehlgeschlagen [${requestId}]:`, {
        code: emailError.code,
        message: emailError.message,
        response: emailError.response
      });
      
      // Bei kritischen E-Mail-Fehlern Cleanup und Fehler zurückgeben
      if (emailError.code === 'EAUTH' || emailError.code === 'ECONNECTION') {
        cleanupFiles();
        return res.status(500).json({ 
          success: false, 
          message: 'E-Mail-Service temporär nicht verfügbar. Bitte versuchen Sie es später erneut.' 
        });
      }
    }

    // Bestätigungs-E-Mail an Bewerber
    const confirmationHTML = `
      <!DOCTYPE html>
      <html lang="de">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bewerbungsbestätigung</title>
      </head>
      <body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f8f9fa;">
        
        <!-- Header mit Logo -->
        <div style="text-align: center; margin-bottom: 30px; padding: 20px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border-radius: 10px;">
          ${process.env.COMPANY_LOGO_URL ? `
            <img src="${process.env.COMPANY_LOGO_URL}" alt="${process.env.COMPANY_NAME || 'Mayer Elektro'} Logo" 
                 style="max-height: 80px; max-width: 200px; margin-bottom: 15px;" />
          ` : ''}
          <h1 style="color: white; margin: 0; font-size: 24px; font-weight: 300;">
            ${process.env.COMPANY_NAME || 'Mayer Elektro'}
          </h1>
        </div>

        <!-- Hauptinhalt -->
        <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
          
          <div style="text-align: center; margin-bottom: 25px;">
            <h2 style="color: #1e3a8a; margin: 0; font-size: 28px; font-weight: 600;">
              ✅ Vielen Dank für Ihre Bewerbung!
            </h2>
          </div>
          
          <div style="background: #f0f9ff; padding: 20px; border-radius: 8px; border-left: 4px solid #3b82f6; margin-bottom: 25px;">
            <p style="margin: 0; font-size: 16px;">
              <strong>Liebe/r ${validator.escape(firstName)} ${validator.escape(lastName)},</strong>
            </p>
          </div>
          
          <p style="font-size: 16px; margin-bottom: 20px;">
            vielen Dank für Ihre Bewerbung als <strong style="color: #1e3a8a;">${validator.escape(position)}</strong> bei ${process.env.COMPANY_NAME || 'Mayer Elektro'}.
          </p>
          
          <div style="background: #f8fafc; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0; font-size: 16px;">
              <strong>📋 Nächste Schritte:</strong><br>
              Wir haben Ihre Unterlagen erhalten und werden diese sorgfältig prüfen. 
              Sie können davon ausgehen, dass wir uns innerhalb der <strong>nächsten 2 Wochen</strong> bei Ihnen melden.
            </p>
          </div>
          
          <p style="font-size: 16px; margin-bottom: 25px;">
            Bei Fragen stehen wir Ihnen gerne zur Verfügung.
          </p>
          
          <div style="text-align: center; margin: 30px 0;">
            <div style="display: inline-block; padding: 15px 25px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 25px;">
              <p style="color: white; margin: 0; font-weight: 600;">
                Mit freundlichen Grüßen<br>
                <span style="font-size: 18px;">Ihr Team von ${process.env.COMPANY_NAME || 'Mayer Elektro'}</span>
              </p>
            </div>
          </div>
        </div>
        
        <!-- Footer -->
        <div style="margin-top: 30px; padding: 20px; background: #374151; color: white; border-radius: 10px; text-align: center;">
          <div style="margin-bottom: 15px;">
            <h3 style="margin: 0 0 10px 0; color: #f3f4f6; font-size: 18px;">
              ${process.env.COMPANY_NAME || 'Mayer Elektro GmbH'}
            </h3>
          </div>
          
          <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 20px; font-size: 14px;">
            <div style="min-width: 200px;">
              <strong style="color: #f3f4f6;">📍 Adresse:</strong><br>
              ${process.env.COMPANY_ADDRESS || 'Musterstraße 123'}<br>
              ${process.env.COMPANY_POSTAL_CODE || '12345'} ${process.env.COMPANY_CITY || 'Hamburg'}
            </div>
            
            <div style="min-width: 200px;">
              <strong style="color: #f3f4f6;">📞 Kontakt:</strong><br>
              Tel: ${process.env.COMPANY_PHONE || '+49 (0) 40 123 456 789'}<br>
              E-Mail: ${process.env.COMPANY_EMAIL || 'info@mayer-elektro.de'}
            </div>
          </div>
          
          ${process.env.COMPANY_WEBSITE ? `
            <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #4b5563;">
              <a href="${process.env.COMPANY_WEBSITE}" style="color: #60a5fa; text-decoration: none; font-weight: 600;">
                🌐 ${process.env.COMPANY_WEBSITE}
              </a>
            </div>
          ` : ''}
          
          <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #4b5563; font-size: 12px; color: #9ca3af;">
            Diese E-Mail wurde automatisch generiert. Bitte antworten Sie nicht direkt auf diese E-Mail.
          </div>
        </div>
        
      </body>
      </html>
    `;

    // Bestätigungs-E-Mail senden
    const confirmationOptions = {
      from: process.env.EMAIL_USER,
      to: email,
      subject: `Bestätigung Ihrer Bewerbung - ${process.env.COMPANY_NAME || 'Mayer Elektro'}`,
      html: confirmationHTML,
      headers: {
        'X-Request-ID': requestId,
        'X-Mailer': 'Mayer-Elektro-Website',
        'X-Email-Type': 'Application-Confirmation'
      }
    };

    let confirmationSent = false;
    try {
      console.log(`Versuche Bestätigungs-E-Mail zu senden [${requestId}]...`);
      
      const confirmationInfo = await transporter.sendMail(confirmationOptions);
      confirmationSent = true;
      
      console.log(`✅ Bestätigungs-E-Mail erfolgreich versendet [${requestId}]!`);
      console.log('Confirmation Message ID:', confirmationInfo.messageId);
      
    } catch (confirmationError) {
      console.error(`❌ Bestätigungs-E-Mail-Versand fehlgeschlagen [${requestId}]:`, {
        code: confirmationError.code,
        message: confirmationError.message
      });
      // Bestätigungs-E-Mail-Fehler sind nicht kritisch, Bewerbung gilt trotzdem als erfolgreich
    }

    console.log(`✅ Bewerbung erfolgreich verarbeitet [${requestId}]:`, { 
      firstName, 
      lastName, 
      email: email.substring(0, 20) + '...', 
      position,
      emailSent,
      confirmationSent
    });
    
    res.json({ 
      success: true, 
      message: 'Bewerbung erfolgreich gesendet',
      requestId: requestId,
      emailSent: emailSent,
      confirmationSent: confirmationSent
    });

  } catch (error) {
    console.error(`Fehler beim Verarbeiten der Bewerbung [${requestId || 'unknown'}]:`, error);
    
    // Cleanup bei unerwarteten Fehlern
    cleanupFiles();
    
    res.status(500).json({ 
      success: false, 
      message: 'Ein unerwarteter Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.',
      requestId: requestId || 'unknown'
    });
  }
});

// Multer Error Handler
app.use((error, req, res, next) => {
  if (error instanceof multer.MulterError) {
    console.error('Multer Error:', error);
    
    // Cleanup hochgeladene Dateien bei Fehlern
    if (req.files) {
      Object.values(req.files).flat().forEach(file => {
        try {
          if (fs.existsSync(file.path)) {
            fs.unlinkSync(file.path);
          }
        } catch (cleanupError) {
          console.error('Cleanup Error:', cleanupError);
        }
      });
    }
    
    let message = 'Datei-Upload-Fehler';
    switch (error.code) {
      case 'LIMIT_FILE_SIZE':
        message = 'Datei ist zu groß';
        break;
      case 'LIMIT_FILE_COUNT':
        message = 'Zu viele Dateien';
        break;
      case 'LIMIT_FIELD_KEY':
        message = 'Feldname zu lang';
        break;
      case 'LIMIT_FIELD_VALUE':
        message = 'Feldwert zu groß';
        break;
      case 'LIMIT_FIELD_COUNT':
        message = 'Zu viele Felder';
        break;
      case 'LIMIT_UNEXPECTED_FILE':
        message = 'Unerwartete Datei';
        break;
    }
    
    return res.status(400).json({
      success: false,
      message: message,
      error: error.code
    });
  }
  
  if (error.message && error.message.includes('Ungültiger Dateityp')) {
    return res.status(400).json({
      success: false,
      message: error.message
    });
  }
  
  next(error);
});

// Alter apply endpoint (für Kompatibilität) - DEPRECATED
app.post('/api/apply', applicationLimiter, upload.array('files', 5), (req, res) => {
  const requestId = crypto.randomBytes(8).toString('hex');
  console.log(`=== LEGACY APPLY REQUEST [${requestId}] ===`);
  console.log('⚠️  WARNUNG: Veralteter Endpoint verwendet. Bitte auf /api/submit-application wechseln.');
  
  try {
    const total = (req.files || []).reduce((s, f) => s + (f.size || 0), 0);
    if (total > 5 * 1024 * 1024) {
      // delete uploaded files
      (req.files || []).forEach(f => {
        try {
          fs.unlinkSync(f.path);
        } catch (err) {
          console.error('Cleanup error:', err);
        }
      });
      return res.status(400).json({ 
        success: false, 
        error: 'Gesamte Dateigröße überschreitet 5 MB' 
      });
    }
    
    console.log(`Legacy Bewerbung [${requestId}]:`, req.body);
    console.log('Dateien:', (req.files || []).map(f => f.filename));
    
    res.json({ 
      success: true,
      message: 'Bewerbung erhalten (Legacy-Endpoint)',
      requestId: requestId,
      warning: 'Dieser Endpoint ist veraltet. Bitte verwenden Sie /api/submit-application'
    });
  } catch (err) {
    console.error(`Legacy Apply Error [${requestId}]:`, err);
    res.status(500).json({ 
      success: false, 
      error: 'Serverfehler',
      requestId: requestId
    });
  }
});

// Server starten
const PORT = process.env.PORT || 4000;
const HOST = process.env.HOST || '0.0.0.0';

const server = app.listen(PORT, HOST, () => {
  console.log(`🚀 Backend läuft auf ${HOST}:${PORT}`);
  console.log(`📊 Environment: ${process.env.NODE_ENV || 'development'}`);
  console.log(`🔒 Security: ${isProduction ? 'Production' : 'Development'} Mode`);
  
  if (isProduction) {
    console.log('✅ Production-Modus aktiviert');
    console.log('🛡️  Rate Limiting aktiviert');
    console.log('🔐 Security Headers aktiviert');
  }
});

// Graceful Shutdown
process.on('SIGTERM', () => {
  console.log('🛑 SIGTERM empfangen. Graceful Shutdown...');
  server.close(() => {
    console.log('✅ Server erfolgreich beendet');
    process.exit(0);
  });
});

process.on('SIGINT', () => {
  console.log('🛑 SIGINT empfangen. Graceful Shutdown...');
  server.close(() => {
    console.log('✅ Server erfolgreich beendet');
    process.exit(0);
  });
});

// Unhandled Promise Rejections
process.on('unhandledRejection', (reason, promise) => {
  console.error('❌ Unhandled Rejection at:', promise, 'reason:', reason);
  if (isProduction) {
    // In Production: Log und weiter
    console.error('🔄 Server läuft weiter...');
  } else {
    // In Development: Crash
    process.exit(1);
  }
});

// Uncaught Exceptions
process.on('uncaughtException', (error) => {
  console.error('❌ Uncaught Exception:', error);
  console.error('🛑 Server wird beendet...');
  process.exit(1);
});
