<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur die Hreflang-Links im Head -->
</template>

<script setup>
import { onMounted, onBeforeUnmount, watch } from 'vue';
import { useRoute } from 'vue-router';

const props = defineProps({
  // Basis-URL der Website
  baseUrl: {
    type: String,
    default: 'https://www.mayerelektro.de'
  },
  // Verfügbare Sprachen und ihre Pfade
  languages: {
    type: Object,
    default: () => ({
      de: {
        code: 'de',
        path: '',
        default: true
      },
      en: {
        code: 'en',
        path: '/en'
      }
    })
  },
  // Optionaler benutzerdefinierter Pfad
  path: {
    type: String,
    default: null
  }
});

const route = useRoute();

// Erstellt die Hreflang-Links
const createHreflangLinks = () => {
  // Bestehende Hreflang-Links entfernen
  const existingLinks = document.querySelectorAll('link[rel="alternate"][hreflang]');
  existingLinks.forEach(link => link.remove());
  
  // Pfad bestimmen
  const currentPath = props.path || route.path;
  
  // Für jede Sprache einen Hreflang-Link erstellen
  Object.values(props.languages).forEach(language => {
    // URL für die Sprache erstellen
    let url = props.baseUrl;
    
    // Sprachpfad hinzufügen (z.B. /en)
    if (language.path) {
      url += language.path;
    }
    
    // Wenn der aktuelle Pfad nicht die Startseite ist, füge ihn hinzu
    // Dabei berücksichtigen, dass der Pfad in der Standardsprache ohne Sprachpräfix ist
    if (currentPath !== '/' && currentPath !== '') {
      // Für die Standardsprache den Pfad direkt verwenden
      if (language.default) {
        url += currentPath;
      } else {
        // Für andere Sprachen prüfen, ob der Pfad bereits einen Sprachpräfix hat
        const pathWithoutLangPrefix = Object.values(props.languages)
          .filter(lang => !lang.default && currentPath.startsWith(lang.path))
          .reduce((path, lang) => path.replace(lang.path, ''), currentPath);
        
        url += pathWithoutLangPrefix;
      }
    }
    
    // Hreflang-Link erstellen und einfügen
    const link = document.createElement('link');
    link.setAttribute('rel', 'alternate');
    link.setAttribute('hreflang', language.code);
    link.setAttribute('href', url);
    document.head.appendChild(link);
  });
  
  // x-default Hreflang-Link für die Standardsprache hinzufügen
  const defaultLanguage = Object.values(props.languages).find(lang => lang.default);
  if (defaultLanguage) {
    const defaultUrl = props.baseUrl + (defaultLanguage.path || '');
    const link = document.createElement('link');
    link.setAttribute('rel', 'alternate');
    link.setAttribute('hreflang', 'x-default');
    link.setAttribute('href', defaultUrl);
    document.head.appendChild(link);
  }
};

// Aktualisiere die Hreflang-Links bei Routenänderungen
watch(() => route.path, () => {
  if (!props.path) {
    createHreflangLinks();
  }
});

// Erstelle die Hreflang-Links beim Mounten
onMounted(() => {
  createHreflangLinks();
});

// Entferne die Hreflang-Links beim Unmounten
onBeforeUnmount(() => {
  const existingLinks = document.querySelectorAll('link[rel="alternate"][hreflang]');
  existingLinks.forEach(link => link.remove());
});
</script>