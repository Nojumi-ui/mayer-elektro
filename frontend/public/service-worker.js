// Service Worker für Mayer Elektro Website
const CACHE_NAME = 'mayer-elektro-cache-v1';

// Assets, die beim Installieren des Service Workers gecacht werden sollen
const PRECACHE_ASSETS = [
  '/',
  '/index.html',
  '/manifest.json',
  '/favicon.ico',
  '/logo_transparent_dark.png',
  '/logo_transparent_white.png',
  '/css/main.css',
  '/js/main.js',
  '/offline.html'
];

// Installation des Service Workers
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        console.log('Cache geöffnet');
        return cache.addAll(PRECACHE_ASSETS);
      })
      .then(() => self.skipWaiting())
  );
});

// Aktivierung des Service Workers
self.addEventListener('activate', (event) => {
  const cacheWhitelist = [CACHE_NAME];
  
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            // Alte Caches löschen
            return caches.delete(cacheName);
          }
        })
      );
    }).then(() => self.clients.claim())
  );
});

// Fetch-Event-Handler
self.addEventListener('fetch', (event) => {
  // Skip cross-origin requests
  if (!event.request.url.startsWith(self.location.origin)) {
    return;
  }
  
  // Strategie: Network first, fallback to cache
  event.respondWith(
    fetch(event.request)
      .then((response) => {
        // Erfolgreiche Antwort im Cache speichern
        if (response.status === 200) {
          const responseClone = response.clone();
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(event.request, responseClone);
          });
        }
        return response;
      })
      .catch(() => {
        // Bei Netzwerkfehler aus dem Cache bedienen
        return caches.match(event.request)
          .then((response) => {
            if (response) {
              return response;
            }
            
            // Wenn die Anfrage eine HTML-Seite ist, offline.html zurückgeben
            if (event.request.headers.get('Accept').includes('text/html')) {
              return caches.match('/offline.html');
            }
          });
      })
  );
});

// Push-Benachrichtigungen
self.addEventListener('push', (event) => {
  if (event.data) {
    const data = event.data.json();
    
    const options = {
      body: data.body || 'Neue Nachricht von Mayer Elektro',
      icon: '/favicon-192x192.png',
      badge: '/favicon-32x32.png',
      data: {
        url: data.url || '/'
      }
    };
    
    event.waitUntil(
      self.registration.showNotification(data.title || 'Mayer Elektro', options)
    );
  }
});

// Klick auf Benachrichtigung
self.addEventListener('notificationclick', (event) => {
  event.notification.close();
  
  event.waitUntil(
    clients.openWindow(event.notification.data.url || '/')
  );
});

// Hintergrund-Synchronisation
self.addEventListener('sync', (event) => {
  if (event.tag === 'contact-form-sync') {
    event.waitUntil(syncContactForm());
  }
});

// Funktion zum Synchronisieren des Kontaktformulars
function syncContactForm() {
  return fetch('/api/sync-contact-forms')
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        return Promise.resolve();
      }
      return Promise.reject(new Error('Synchronisation fehlgeschlagen'));
    });
}