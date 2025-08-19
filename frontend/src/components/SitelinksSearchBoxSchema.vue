<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
</template>

<script setup>
import { onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
  // Sitelinks-Suchbox-Daten
  searchBox: {
    type: Object,
    default: () => ({
      url: "https://www.mayerelektro.de",
      potentialAction: {
        target: "https://www.mayerelektro.de/suche?q={search_term_string}",
        queryInput: "required name=search_term_string"
      }
    })
  }
});

// Strukturierte Daten für Sitelinks-Suchbox
const searchBoxSchema = {
  "@context": "https://schema.org",
  "@type": "WebSite",
  "url": props.searchBox.url,
  "potentialAction": {
    "@type": "SearchAction",
    "target": props.searchBox.potentialAction.target,
    "query-input": props.searchBox.potentialAction.queryInput
  }
};

// Erstellt die strukturierten Daten
const createSearchBoxSchema = () => {
  // Bestehende strukturierte Daten entfernen
  const existingScript = document.getElementById('searchbox-schema');
  if (existingScript) {
    existingScript.remove();
  }
  
  // Neue strukturierte Daten hinzufügen
  const script = document.createElement('script');
  script.setAttribute('type', 'application/ld+json');
  script.setAttribute('id', 'searchbox-schema');
  script.textContent = JSON.stringify(searchBoxSchema);
  document.head.appendChild(script);
};

// Erstelle die strukturierten Daten beim Mounten
onMounted(() => {
  createSearchBoxSchema();
});

// Entferne die strukturierten Daten beim Unmounten
onBeforeUnmount(() => {
  const existingScript = document.getElementById('searchbox-schema');
  if (existingScript) {
    existingScript.remove();
  }
});
</script>