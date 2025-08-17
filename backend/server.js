const express = require('express');
const cors = require('cors');
const multer = require('multer');
const nodemailer = require('nodemailer');
const path = require('path');
const fs = require('fs');

const app = express();
app.use(cors());
app.use(express.json());
app.use('/uploads', express.static(path.join(__dirname, 'uploads')));

const UPLOAD_DIR = path.join(__dirname, 'uploads');
if (!fs.existsSync(UPLOAD_DIR)) fs.mkdirSync(UPLOAD_DIR);

// Multer storage
const storage = multer.diskStorage({
  destination: (req, file, cb) => cb(null, UPLOAD_DIR),
  filename: (req, file, cb) => cb(null, Date.now() + '-' + file.originalname)
});

// simple mime filter
const ALLOWED_MIMES = [
  'application/pdf', 
  'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
  'application/msword',
  'image/jpeg', 
  'image/jpg',
  'image/png'
];

const upload = multer({
  storage,
  fileFilter: (req, file, cb) => {
    if (ALLOWED_MIMES.includes(file.mimetype)) cb(null, true);
    else cb(new Error('Ungültiger Dateityp'));
  },
  limits: { fileSize: 5 * 1024 * 1024 } // 5 MB per file
});

// E-Mail Transporter konfigurieren
const transporter = nodemailer.createTransport({
  host: 'smtp.gmail.com', // Oder Ihr SMTP-Server
  port: 587,
  secure: false,
  auth: {
    user: process.env.EMAIL_USER || 'your-email@gmail.com',
    pass: process.env.EMAIL_PASS || 'your-app-password'
  }
});

// contact endpoint
app.post('/api/contact', (req, res) => {
  console.log('Kontakt:', req.body);
  // TODO: E-Mail Versand (nodemailer) einbauen
  res.json({ success: true });
});

// Neuer Bewerbungsformular-Endpoint
app.post('/api/submit-application', upload.fields([
  { name: 'cv', maxCount: 1 },
  { name: 'document_0', maxCount: 1 },
  { name: 'document_1', maxCount: 1 },
  { name: 'document_2', maxCount: 1 },
  { name: 'document_3', maxCount: 1 },
  { name: 'document_4', maxCount: 1 }
]), async (req, res) => {
  try {
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
    } = req.body;

    // Alle hochgeladenen Dateien sammeln
    const attachments = [];
    
    if (req.files.cv) {
      attachments.push({
        filename: req.files.cv[0].originalname,
        path: req.files.cv[0].path
      });
    }

    // Weitere Dokumente hinzufügen
    Object.keys(req.files).forEach(key => {
      if (key.startsWith('document_')) {
        attachments.push({
          filename: req.files[key][0].originalname,
          path: req.files[key][0].path
        });
      }
    });

    // E-Mail HTML Template
    const emailHTML = `
      <h2>Neue Bewerbung von ${firstName} ${lastName}</h2>
      
      <h3>Persönliche Daten:</h3>
      <ul>
        <li><strong>Name:</strong> ${firstName} ${lastName}</li>
        <li><strong>E-Mail:</strong> ${email}</li>
        <li><strong>Telefon:</strong> ${phone || 'Nicht angegeben'}</li>
        <li><strong>Adresse:</strong> ${address || 'Nicht angegeben'}</li>
        <li><strong>PLZ/Stadt:</strong> ${postalCode || ''} ${city || ''}</li>
        <li><strong>Land:</strong> ${country || 'Nicht angegeben'}</li>
      </ul>

      <h3>Bewerbungsdetails:</h3>
      <ul>
        <li><strong>Position:</strong> ${position}</li>
        <li><strong>Verfügbar ab:</strong> ${availability || 'Nicht angegeben'}</li>
        <li><strong>Gehaltsvorstellung:</strong> ${salaryExpectation || 'Nicht angegeben'}</li>
      </ul>

      ${coverLetter ? `
        <h3>Anschreiben:</h3>
        <p style="background: #f5f5f5; padding: 15px; border-radius: 5px;">
          ${coverLetter.replace(/\n/g, '<br>')}
        </p>
      ` : ''}

      <h3>Anhänge:</h3>
      <ul>
        ${attachments.map(att => `<li>${att.filename}</li>`).join('')}
      </ul>
    `;

    // E-Mail senden
    const mailOptions = {
      from: process.env.EMAIL_USER || 'your-email@gmail.com',
      to: 'bewerbungen@mayer-elektro.de', // Ziel-E-Mail-Adresse
      subject: `Neue Bewerbung: ${position} - ${firstName} ${lastName}`,
      html: emailHTML,
      attachments: attachments
    };

    await transporter.sendMail(mailOptions);

    // Bestätigungs-E-Mail an Bewerber
    const confirmationHTML = `
      <h2>Vielen Dank für Ihre Bewerbung!</h2>
      
      <p>Liebe/r ${firstName} ${lastName},</p>
      
      <p>vielen Dank für Ihre Bewerbung als <strong>${position}</strong> bei Mayer Elektro.</p>
      
      <p>Wir haben Ihre Unterlagen erhalten und werden diese sorgfältig prüfen. 
      Sie können davon ausgehen, dass wir uns innerhalb der nächsten 2 Wochen bei Ihnen melden.</p>
      
      <p>Bei Fragen stehen wir Ihnen gerne zur Verfügung.</p>
      
      <p>Mit freundlichen Grüßen<br>
      Ihr Team von Mayer Elektro</p>
      
      <hr>
      <p style="font-size: 12px; color: #666;">
        Mayer Elektro GmbH<br>
        Musterstraße 123<br>
        12345 Hamburg<br>
        Tel: +49 (0) 40 123 456 789<br>
        E-Mail: info@mayer-elektro.de
      </p>
    `;

    const confirmationOptions = {
      from: process.env.EMAIL_USER || 'your-email@gmail.com',
      to: email,
      subject: 'Bestätigung Ihrer Bewerbung - Mayer Elektro',
      html: confirmationHTML
    };

    await transporter.sendMail(confirmationOptions);

    console.log('Bewerbung erfolgreich versendet:', { firstName, lastName, email, position });
    
    res.json({ success: true, message: 'Bewerbung erfolgreich gesendet' });

  } catch (error) {
    console.error('Fehler beim Versenden der Bewerbung:', error);
    res.status(500).json({ success: false, error: 'Fehler beim Versenden der Bewerbung' });
  }
});

// Alter apply endpoint (für Kompatibilität)
app.post('/api/apply', upload.array('files', 5), (req, res) => {
  try {
    const total = (req.files || []).reduce((s, f) => s + (f.size || 0), 0);
    if (total > 5 * 1024 * 1024) {
      // delete uploaded files
      (req.files || []).forEach(f => fs.unlinkSync(f.path));
      return res.status(400).json({ success: false, error: 'Gesamte Dateigröße überschreitet 5 MB' });
    }
    console.log('Bewerbung:', req.body);
    console.log('Dateien:', (req.files || []).map(f => f.filename));
    res.json({ success: true });
  } catch (err) {
    console.error(err);
    res.status(500).json({ success: false, error: 'Serverfehler' });
  }
});

const PORT = process.env.PORT || 4000;
app.listen(PORT, () => console.log(`Backend läuft auf Port ${PORT}`));
