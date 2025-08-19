import { ref, onMounted, onBeforeUnmount } from 'vue';

/**
 * Composable für Barrierefreiheit
 * @returns {Object} - Barrierefreiheits-Hilfsfunktionen und -Status
 */
export function useAccessibility() {
  // Status
  const highContrast = ref(false);
  const largeText = ref(false);
  const reducedMotion = ref(false);
  
  /**
   * Aktiviert/Deaktiviert den Hochkontrastmodus
   * @param {boolean} value - Aktivieren (true) oder deaktivieren (false)
   */
  const toggleHighContrast = (value) => {
    // Wenn value nicht definiert ist, invertiere den aktuellen Wert
    const newValue = value !== undefined ? value : !highContrast.value;
    highContrast.value = newValue;
    
    if (newValue) {
      document.documentElement.classList.add('high-contrast');
    } else {
      document.documentElement.classList.remove('high-contrast');
    }
    
    // Einstellung speichern
    localStorage.setItem('accessibility-high-contrast', newValue);
  };
  
  /**
   * Aktiviert/Deaktiviert große Schrift
   * @param {boolean} value - Aktivieren (true) oder deaktivieren (false)
   */
  const toggleLargeText = (value) => {
    // Wenn value nicht definiert ist, invertiere den aktuellen Wert
    const newValue = value !== undefined ? value : !largeText.value;
    largeText.value = newValue;
    
    if (newValue) {
      document.documentElement.classList.add('large-text');
    } else {
      document.documentElement.classList.remove('large-text');
    }
    
    // Einstellung speichern
    localStorage.setItem('accessibility-large-text', newValue);
  };
  
  /**
   * Aktiviert/Deaktiviert reduzierte Bewegung
   * @param {boolean} value - Aktivieren (true) oder deaktivieren (false)
   */
  const toggleReducedMotion = (value) => {
    // Wenn value nicht definiert ist, invertiere den aktuellen Wert
    const newValue = value !== undefined ? value : !reducedMotion.value;
    reducedMotion.value = newValue;
    
    if (newValue) {
      document.documentElement.classList.add('reduced-motion');
    } else {
      document.documentElement.classList.remove('reduced-motion');
    }
    
    // Einstellung speichern
    localStorage.setItem('accessibility-reduced-motion', newValue);
  };
  
  /**
   * Verbessert die Fokussierbarkeit von Elementen
   */
  const enhanceFocus = () => {
    // Fügt Klasse hinzu, wenn mit Tastatur navigiert wird
    const handleFirstTab = (e) => {
      if (e.key === 'Tab') {
        document.body.classList.add('user-is-tabbing');
        window.removeEventListener('keydown', handleFirstTab);
      }
    };
    
    window.addEventListener('keydown', handleFirstTab);
  };
  
  /**
   * Verbessert die Barrierefreiheit von Bildern
   */
  const enhanceImageAccessibility = () => {
    // Findet Bilder ohne Alt-Text und fügt Warnungen hinzu
    const images = document.querySelectorAll('img:not([alt])');
    images.forEach(img => {
      console.warn('Bild ohne Alt-Text gefunden:', img);
      
      // Optional: Alt-Text basierend auf Dateinamen oder Kontext hinzufügen
      if (img.src) {
        const filename = img.src.split('/').pop().split('.')[0];
        img.alt = filename.replace(/[-_]/g, ' ');
      }
    });
  };
  
  /**
   * Verbessert die Barrierefreiheit von Formularen
   */
  const enhanceFormAccessibility = () => {
    // Findet Formularelemente ohne Labels und fügt Warnungen hinzu
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
      const id = input.id;
      if (id) {
        const label = document.querySelector(`label[for="${id}"]`);
        if (!label) {
          console.warn('Formularelement ohne Label gefunden:', input);
        }
      } else {
        console.warn('Formularelement ohne ID gefunden:', input);
      }
    });
  };
  
  /**
   * Initialisiert die Barrierefreiheits-Einstellungen
   */
  const initAccessibilitySettings = () => {
    // Gespeicherte Einstellungen laden
    const savedHighContrast = localStorage.getItem('accessibility-high-contrast') === 'true';
    const savedLargeText = localStorage.getItem('accessibility-large-text') === 'true';
    const savedReducedMotion = localStorage.getItem('accessibility-reduced-motion') === 'true';
    
    // Einstellungen anwenden
    toggleHighContrast(savedHighContrast);
    toggleLargeText(savedLargeText);
    toggleReducedMotion(savedReducedMotion);
    
    // Systemeinstellungen prüfen
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion && !savedReducedMotion) {
      toggleReducedMotion(true);
    }
    
    // Fokus-Verbesserungen aktivieren
    enhanceFocus();
  };
  
  /**
   * Fügt Tastaturkürzel für Barrierefreiheits-Funktionen hinzu
   */
  const setupAccessibilityShortcuts = () => {
    const handleKeyDown = (e) => {
      // Alt + C: Hochkontrastmodus umschalten
      if (e.altKey && e.key === 'c') {
        toggleHighContrast();
        e.preventDefault();
      }
      
      // Alt + L: Große Schrift umschalten
      if (e.altKey && e.key === 'l') {
        toggleLargeText();
        e.preventDefault();
      }
      
      // Alt + M: Reduzierte Bewegung umschalten
      if (e.altKey && e.key === 'm') {
        toggleReducedMotion();
        e.preventDefault();
      }
    };
    
    window.addEventListener('keydown', handleKeyDown);
    
    // Cleanup-Funktion
    return () => {
      window.removeEventListener('keydown', handleKeyDown);
    };
  };
  
  onMounted(() => {
    initAccessibilitySettings();
    const cleanup = setupAccessibilityShortcuts();
    
    // Regelmäßige Überprüfung der Barrierefreiheit
    const accessibilityCheckInterval = setInterval(() => {
      enhanceImageAccessibility();
      enhanceFormAccessibility();
    }, 5000);
    
    // Cleanup
    onBeforeUnmount(() => {
      cleanup();
      clearInterval(accessibilityCheckInterval);
    });
  });
  
  return {
    // Status
    highContrast,
    largeText,
    reducedMotion,
    
    // Methoden
    toggleHighContrast,
    toggleLargeText,
    toggleReducedMotion,
    enhanceFocus,
    enhanceImageAccessibility,
    enhanceFormAccessibility
  };
}