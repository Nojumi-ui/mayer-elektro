<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur den Canonical-Link im Head -->
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
  // Optionaler benutzerdefinierter Pfad
  path: {
    type: String,
    default: null
  }
});

const route = useRoute();

// Erstellt den Canonical-Link
const createCanonicalLink = () => {
  // Bestehenden Canonical-Link entfernen
  const existingLink = document.querySelector('link[rel="canonical"]');
  if (existingLink) {
    existingLink.remove();
  }
  
  // Pfad bestimmen
  const path = props.path || route.path;
  
  // Canonical-URL erstellen
  let canonicalUrl = props.baseUrl;
  
  // Wenn der Pfad nicht die Startseite ist, füge ihn hinzu
  if (path !== '/' && path !== '') {
    canonicalUrl += path;
  }
  
  // Canonical-Link erstellen und einfügen
  const link = document.createElement('link');
  link.setAttribute('rel', 'canonical');
  link.setAttribute('href', canonicalUrl);
  document.head.appendChild(link);
};

// Aktualisiere den Canonical-Link bei Routenänderungen
watch(() => route.path, () => {
  if (!props.path) {
    createCanonicalLink();
  }
});

// Erstelle den Canonical-Link beim Mounten
onMounted(() => {
  createCanonicalLink();
});

// Entferne den Canonical-Link beim Unmounten
onBeforeUnmount(() => {
  const existingLink = document.querySelector('link[rel="canonical"]');
  if (existingLink) {
    existingLink.remove();
  }
});
</script>