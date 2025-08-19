<template>
  <!-- Diese Komponente rendert kein sichtbares HTML -->
</template>

<script setup>
import { onMounted, onBeforeUnmount, watch } from 'vue';

const props = defineProps({
  // Seitentitel
  title: {
    type: String,
    default: ''
  },
  // Meta-Beschreibung
  description: {
    type: String,
    default: ''
  },
  // Meta-Keywords
  keywords: {
    type: String,
    default: ''
  },
  // Canonical URL
  canonical: {
    type: String,
    default: ''
  },
  // Open Graph Daten
  og: {
    type: Object,
    default: () => ({})
  },
  // Twitter Card Daten
  twitter: {
    type: Object,
    default: () => ({})
  },
  // Zusätzliche Meta-Tags
  additionalTags: {
    type: Array,
    default: () => []
  }
});

// Array für alle erstellten Meta-Tags
const createdTags = [];

// Funktion zum Erstellen und Hinzufügen von Meta-Tags
const updateMetaTags = () => {
  // Vorherige Tags entfernen
  removeMetaTags();
  
  // Titel aktualisieren, wenn vorhanden
  if (props.title) {
    document.title = props.title;
  }
  
  // Meta-Tags erstellen und hinzufügen
  const tags = [];
  
  // Beschreibung
  if (props.description) {
    tags.push({ name: 'description', content: props.description });
  }
  
  // Keywords
  if (props.keywords) {
    tags.push({ name: 'keywords', content: props.keywords });
  }
  
  // Open Graph Tags
  if (props.og) {
    const { title, description, image, url, type } = props.og;
    if (title) tags.push({ property: 'og:title', content: title });
    if (description) tags.push({ property: 'og:description', content: description });
    if (image) tags.push({ property: 'og:image', content: image });
    if (url) tags.push({ property: 'og:url', content: url });
    if (type) tags.push({ property: 'og:type', content: type });
  }
  
  // Twitter Card Tags
  if (props.twitter) {
    const { card, title, description, image } = props.twitter;
    if (card) tags.push({ name: 'twitter:card', content: card });
    if (title) tags.push({ name: 'twitter:title', content: title });
    if (description) tags.push({ name: 'twitter:description', content: description });
    if (image) tags.push({ name: 'twitter:image', content: image });
  }
  
  // Zusätzliche Tags
  if (props.additionalTags.length) {
    tags.push(...props.additionalTags);
  }
  
  // Canonical URL
  if (props.canonical) {
    const link = document.createElement('link');
    link.rel = 'canonical';
    link.href = props.canonical;
    document.head.appendChild(link);
    createdTags.push(link);
  }
  
  // Alle Meta-Tags erstellen und zum Head hinzufügen
  tags.forEach(tagInfo => {
    const meta = document.createElement('meta');
    Object.entries(tagInfo).forEach(([key, value]) => {
      meta.setAttribute(key, value);
    });
    document.head.appendChild(meta);
    createdTags.push(meta);
  });
};

// Funktion zum Entfernen aller erstellten Meta-Tags
const removeMetaTags = () => {
  createdTags.forEach(tag => {
    if (tag.parentNode) {
      tag.parentNode.removeChild(tag);
    }
  });
  createdTags.length = 0;
};

// Meta-Tags aktualisieren, wenn sich Props ändern
watch(() => props, updateMetaTags, { deep: true });

// Meta-Tags beim Mounten erstellen
onMounted(updateMetaTags);

// Meta-Tags beim Unmounten entfernen
onBeforeUnmount(removeMetaTags);
</script>