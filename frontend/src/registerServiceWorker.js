// Service Worker-Registrierung für PWA-Funktionalität

/**
 * Registriert den Service Worker für die Anwendung
 */
export function register() {
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      const swUrl = '/service-worker.js';
      
      registerValidSW(swUrl);
      
      // Überprüfen, ob der Service Worker aktualisiert werden kann
      checkForUpdates(swUrl);
    });
  }
}

/**
 * Registriert einen gültigen Service Worker
 * @param {string} swUrl - URL des Service Workers
 */
function registerValidSW(swUrl) {
  navigator.serviceWorker
    .register(swUrl)
    .then(registration => {
      // Erfolgreiche Registrierung
      registration.onupdatefound = () => {
        const installingWorker = registration.installing;
        if (installingWorker == null) {
          return;
        }
        
        installingWorker.onstatechange = () => {
          if (installingWorker.state === 'installed') {
            if (navigator.serviceWorker.controller) {
              // Neuer Service Worker verfügbar
              console.log('Neue Inhalte sind verfügbar. Bitte aktualisieren Sie die Seite.');
              
              // Optional: Benachrichtigung für den Benutzer anzeigen
              showUpdateNotification();
            } else {
              // Service Worker zum ersten Mal installiert
              console.log('Inhalte werden für die Offline-Nutzung zwischengespeichert.');
            }
          }
        };
      };
    })
    .catch(error => {
      console.error('Fehler bei der Registrierung des Service Workers:', error);
    });
}

/**
 * Überprüft, ob Updates für den Service Worker verfügbar sind
 * @param {string} swUrl - URL des Service Workers
 */
function checkForUpdates(swUrl) {
  // Regelmäßig nach Updates suchen (alle 6 Stunden)
  setInterval(() => {
    fetch(swUrl)
      .then(response => {
        // Überprüfen, ob der Service Worker im Cache mit dem auf dem Server übereinstimmt
        if (
          response.status === 200 &&
          response.headers.get('content-type').indexOf('javascript') !== -1
        ) {
          // Neuen Service Worker abrufen
          return navigator.serviceWorker.getRegistration();
        }
        throw new Error('Service Worker nicht verfügbar');
      })
      .then(registration => {
        if (registration) {
          registration.update();
        }
      })
      .catch(error => {
        console.error('Fehler beim Überprüfen auf Service Worker-Updates:', error);
      });
  }, 1000 * 60 * 60 * 6); // Alle 6 Stunden
}

/**
 * Zeigt eine Benachrichtigung an, wenn ein Update verfügbar ist
 */
function showUpdateNotification() {
  // Implementierung einer benutzerdefinierten Benachrichtigung
  // Dies könnte eine Toast-Nachricht, ein Banner oder ein Modal sein
  
  // Beispiel für eine einfache Benachrichtigung
  if (document.getElementById('update-notification')) {
    return; // Benachrichtigung bereits angezeigt
  }
  
  const notification = document.createElement('div');
  notification.id = 'update-notification';
  notification.style.position = 'fixed';
  notification.style.bottom = '20px';
  notification.style.right = '20px';
  notification.style.backgroundColor = '#0097b2';
  notification.style.color = 'white';
  notification.style.padding = '12px 20px';
  notification.style.borderRadius = '4px';
  notification.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.2)';
  notification.style.zIndex = '9999';
  notification.style.display = 'flex';
  notification.style.alignItems = 'center';
  notification.style.justifyContent = 'space-between';
  
  notification.innerHTML = `
    <span>Neue Version verfügbar! Aktualisieren Sie die Seite, um die neuesten Funktionen zu erhalten.</span>
    <button style="background: white; color: #0097b2; border: none; padding: 6px 12px; margin-left: 16px; border-radius: 4px; cursor: pointer;">Aktualisieren</button>
    <button style="background: transparent; color: white; border: none; margin-left: 8px; cursor: pointer; font-size: 18px;">&times;</button>
  `;
  
  document.body.appendChild(notification);
  
  // Event-Listener für Buttons
  const updateButton = notification.querySelector('button:first-of-type');
  const closeButton = notification.querySelector('button:last-of-type');
  
  updateButton.addEventListener('click', () => {
    window.location.reload();
  });
  
  closeButton.addEventListener('click', () => {
    document.body.removeChild(notification);
  });
}

/**
 * Deregistriert den Service Worker
 */
export function unregister() {
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.ready
      .then(registration => {
        registration.unregister();
      })
      .catch(error => {
        console.error(error.message);
      });
  }
}