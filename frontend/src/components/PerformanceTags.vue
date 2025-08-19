<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur Meta-Tags für Leistungsoptimierung -->
</template>

<script setup>
import { onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
  // Leistungsoptimierungs-Daten
  data: {
    type: Object,
    default: () => ({
      dnsPrefetch: [
        'https://fonts.googleapis.com',
        'https://fonts.gstatic.com',
        'https://www.google-analytics.com'
      ],
      preconnect: [
        'https://fonts.googleapis.com',
        'https://fonts.gstatic.com'
      ],
      preload: [
        {
          href: '/fonts/custom-font.woff2',
          as: 'font',
          type: 'font/woff2',
          crossorigin: true
        },
        {
          href: '/img/hero-image.jpg',
          as: 'image'
        }
      ]
    })
  }
});

// Erstellt die Leistungsoptimierungs-Tags
const createPerformanceTags = () => {
  // Bestehende Tags entfernen
  document.querySelectorAll('link[data-performance]').forEach(el => el.remove());
  
  // DNS-Prefetch-Tags erstellen
  props.data.dnsPrefetch.forEach(href => {
    const link = document.createElement('link');
    link.setAttribute('rel', 'dns-prefetch');
    link.setAttribute('href', href);
    link.setAttribute('data-performance', 'true');
    document.head.appendChild(link);
  });
  
  // Preconnect-Tags erstellen
  props.data.preconnect.forEach(href => {
    const link = document.createElement('link');
    link.setAttribute('rel', 'preconnect');
    link.setAttribute('href', href);
    link.setAttribute('crossorigin', 'anonymous');
    link.setAttribute('data-performance', 'true');
    document.head.appendChild(link);
  });
  
  // Preload-Tags erstellen
  props.data.preload.forEach(item => {
    const link = document.createElement('link');
    link.setAttribute('rel', 'preload');
    link.setAttribute('href', item.href);
    link.setAttribute('as', item.as);
    
    if (item.type) {
      link.setAttribute('type', item.type);
    }
    
    if (item.crossorigin) {
      link.setAttribute('crossorigin', 'anonymous');
    }
    
    link.setAttribute('data-performance', 'true');
    document.head.appendChild(link);
  });
};

// Erstelle die Tags beim Mounten
onMounted(() => {
  createPerformanceTags();
});

// Entferne die Tags beim Unmounten
onBeforeUnmount(() => {
  document.querySelectorAll('link[data-performance]').forEach(el => el.remove());
});
</script>