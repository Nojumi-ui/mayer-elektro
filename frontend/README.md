# Mayer Elektro - Frontend

Eine moderne, responsive Website für Mayer Elektro- und Gebäudetechnik GmbH, entwickelt mit Vue.js 3 und Vite.

## 🚀 Technologie-Stack

- **Vue.js 3** - Progressive JavaScript Framework
- **Vite** - Schneller Build-Tool und Dev-Server
- **Vue Router 4** - Client-side Routing
- **Vue I18n** - Internationalisierung (Deutsch/Englisch)
- **Tailwind CSS** - Utility-first CSS Framework
- **GSAP** - Animationsbibliothek
- **Axios** - HTTP Client für API-Aufrufe

## 📋 Voraussetzungen

- Node.js (Version 16 oder höher)
- npm oder yarn

## 🛠️ Installation

1. **Repository klonen und in das Frontend-Verzeichnis wechseln:**
   ```bash
   cd frontend
   ```

2. **Abhängigkeiten installieren:**
   ```bash
   npm install
   ```

## 🏃‍♂️ Entwicklung

### Development Server starten
```bash
npm run dev
```
Die Anwendung ist dann unter `http://localhost:5173` erreichbar.

### Build für Produktion
```bash
npm run build
```
Die Build-Dateien werden im `dist/` Verzeichnis erstellt.

### Preview der Production Build
```bash
npm run preview
```

## 📁 Projektstruktur

```
frontend/
├── public/                 # Statische Assets
│   ├── img/               # Bilder und Icons
│   ├── favicon.ico        # Favicon
│   ├── manifest.json      # PWA Manifest
│   └── robots.txt         # SEO Robots
├── src/
│   ├── assets/            # Build-Assets (Bilder, Styles)
│   ├── components/        # Vue Komponenten
│   │   ├── LocalBusinessInfo.vue
│   │   ├── StructuredData.vue
│   │   └── ...
│   ├── composables/       # Vue Composables
│   ├── locales/           # Übersetzungsdateien
│   │   ├── de.json        # Deutsche Übersetzungen
│   │   └── en.json        # Englische Übersetzungen
│   ├── utils/             # Utility-Funktionen
│   ├── views/             # Vue Views/Pages
│   ├── App.vue            # Haupt-App-Komponente
│   ├── main.js            # App Entry Point
│   ├── router.js          # Vue Router Konfiguration
│   └── i18n.js            # Internationalisierung Setup
├── index.html             # HTML Template
├── package.json           # Projekt-Dependencies
├── vite.config.js         # Vite Konfiguration
├── tailwind.config.js     # Tailwind CSS Konfiguration
└── postcss.config.js      # PostCSS Konfiguration
```

## 🌐 Features

### Mehrsprachigkeit
- Deutsch (Standard)
- Englisch
- Automatische Spracherkennung basierend auf Browser-Einstellungen

### SEO-Optimierung
- Strukturierte Daten (Schema.org)
- Meta-Tags für Social Media
- Sitemap und Robots.txt
- Optimierte Ladezeiten

### Responsive Design
- Mobile-first Ansatz
- Optimiert für alle Bildschirmgrößen
- Touch-freundliche Navigation

### Performance
- Lazy Loading für Bilder
- Code-Splitting
- Service Worker für Offline-Funktionalität
- Optimierte Bundle-Größe

## 🎨 Styling

Das Projekt verwendet **Tailwind CSS** für das Styling:

- Utility-first CSS Framework
- Dark Mode Support
- Responsive Design System
- Benutzerdefinierte Farbpalette für Mayer Elektro

### Hauptfarben
- Primary: `#0097b2` (Mayer Elektro Blau)
- Dark Mode Support mit automatischer Umschaltung

## 📱 PWA Features

- Installierbar als App
- Offline-Funktionalität
- Service Worker für Caching
- Web App Manifest

## 🔧 Konfiguration

### Umgebungsvariablen
Erstellen Sie eine `.env` Datei im Frontend-Verzeichnis:

```env
VITE_API_URL=http://localhost:4000
VITE_SITE_URL=https://www.mayerelektro.de
```

### Vite Konfiguration
Die Vite-Konfiguration befindet sich in `vite.config.js` und kann für verschiedene Umgebungen angepasst werden.

## 🚀 Deployment

### Netlify (empfohlen)
Das Projekt ist für Netlify optimiert:

1. Build-Command: `npm run build`
2. Publish Directory: `dist`
3. Die `netlify.toml` Datei enthält alle notwendigen Konfigurationen

### Andere Hosting-Anbieter
1. Build erstellen: `npm run build`
2. Inhalt des `dist/` Verzeichnisses auf den Server hochladen
3. Server für SPA konfigurieren (alle Routen zu `index.html` weiterleiten)

## 🧪 Entwicklung

### Code-Style
- ESLint für Code-Qualität
- Prettier für Code-Formatierung
- Vue 3 Composition API

### Komponenten-Struktur
- Wiederverwendbare Komponenten in `components/`
- Seitenspezifische Views in `views/`
- Composables für geteilte Logik

## 📞 Support

Bei Fragen oder Problemen:
- Erstellen Sie ein Issue im Repository
- Kontaktieren Sie das Entwicklungsteam

## 📄 Lizenz

Dieses Projekt ist proprietär und gehört Mayer Elektro- und Gebäudetechnik GmbH.