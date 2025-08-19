<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur Meta-Tags für Suchmaschinen -->
</template>

<script setup>
import { onMounted, onBeforeUnmount, watch } from 'vue';
import { useRoute } from 'vue-router';

const props = defineProps({
  // Suchmaschinen-Daten
  data: {
    type: Object,
    default: () => ({
      robots: "index, follow",
      googlebot: "index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1",
      bingbot: "index, follow",
      keywords: "Elektroinstallation Hamburg, Gebäudetechnik, Automatisierung, Elektrofachkräfte, Elektrotechnik, Instandhaltung, Elektroinstallateur",
      author: "Mayer Elektro- und Gebäudetechnik GmbH",
      revisitAfter: "7 days",
      rating: "general",
      referrer: "no-referrer-when-downgrade",
      themeColor: "#0097b2"
    })
  },
  // Seiten, die nicht indexiert werden sollen
  noIndexPaths: {
    type: Array,
    default: () => [
      '/datenschutz',
      '/impressum',
      '/agb',
      '/404'
    ]
  }
});

const route = useRoute();

// Prüft, ob die aktuelle Seite indexiert werden soll
const shouldIndex = () => {
  return !props.noIndexPaths.includes(route.path);
};

// Erstellt die Suchmaschinen-Meta-Tags
const createSearchEngineTags = () => {
  // Bestehende Meta-Tags entfernen
  document.querySelectorAll('meta[data-search-engine]').forEach(el => el.remove());
  
  // Robots-Wert basierend auf der aktuellen Seite
  const robotsValue = shouldIndex() ? props.data.robots : 'noindex, nofollow';
  const googlebotValue = shouldIndex() ? props.data.googlebot : 'noindex, nofollow';
  const bingbotValue = shouldIndex() ? props.data.bingbot : 'noindex, nofollow';
  
  // Meta-Tags erstellen
  const metaTags = {
    'robots': robotsValue,
    'googlebot': googlebotValue,
    'bingbot': bingbotValue,
    'keywords': props.data.keywords,
    'author': props.data.author,
    'revisit-after': props.data.revisitAfter,
    'rating': props.data.rating,
    'referrer': props.data.referrer,
    'theme-color': props.data.themeColor
  };
  
  // Meta-Tags hinzufügen
  Object.entries(metaTags).forEach(([name, content]) => {
    if (!content) return;
    
    const meta = document.createElement('meta');
    meta.setAttribute('name', name);
    meta.setAttribute('content', content);
    meta.setAttribute('data-search-engine', 'true');
    document.head.appendChild(meta);
  });
};

// Aktualisiere die Meta-Tags bei Routenänderungen
watch(() => route.path, () => {
  createSearchEngineTags();
});

// Erstelle die Meta-Tags beim Mounten
onMounted(() => {
  createSearchEngineTags();
});

// Entferne die Meta-Tags beim Unmounten
onBeforeUnmount(() => {
  document.querySelectorAll('meta[data-search-engine]').forEach(el => el.remove());
});
</script>