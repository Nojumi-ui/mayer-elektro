<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur Meta-Tags für Social Media -->
</template>

<script setup>
import { onMounted, onBeforeUnmount, watch } from 'vue';
import { useRoute } from 'vue-router';

const props = defineProps({
  // Social-Media-Daten
  data: {
    type: Object,
    default: () => ({
      title: "Mayer Elektro - Elektroinstallation & Gebäudetechnik Hamburg",
      description: "Professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen in Hamburg und Umgebung.",
      image: "https://www.mayerelektro.de/img/social-share.jpg",
      url: "https://www.mayerelektro.de",
      siteName: "Mayer Elektro",
      twitterHandle: "@mayerelektro",
      twitterCardType: "summary_large_image",
      locale: "de_DE",
      type: "website"
    })
  }
});

const route = useRoute();

// Erstellt die Social-Media-Meta-Tags
const createSocialMediaTags = () => {
  // Bestehende Meta-Tags entfernen
  document.querySelectorAll('meta[data-social-media]').forEach(el => el.remove());
  
  // URL aktualisieren
  const url = props.data.url + route.path;
  
  // Meta-Tags erstellen
  const metaTags = {
    // Open Graph
    'og:title': props.data.title,
    'og:description': props.data.description,
    'og:image': props.data.image,
    'og:url': url,
    'og:type': props.data.type,
    'og:site_name': props.data.siteName,
    'og:locale': props.data.locale,
    
    // Twitter
    'twitter:card': props.data.twitterCardType,
    'twitter:site': props.data.twitterHandle,
    'twitter:title': props.data.title,
    'twitter:description': props.data.description,
    'twitter:image': props.data.image
  };
  
  // Meta-Tags hinzufügen
  Object.entries(metaTags).forEach(([name, content]) => {
    if (!content) return;
    
    const meta = document.createElement('meta');
    
    if (name.startsWith('og:')) {
      meta.setAttribute('property', name);
    } else {
      meta.setAttribute('name', name);
    }
    
    meta.setAttribute('content', content);
    meta.setAttribute('data-social-media', 'true');
    document.head.appendChild(meta);
  });
};

// Aktualisiere die Meta-Tags bei Routenänderungen
watch(() => route.path, () => {
  createSocialMediaTags();
});

// Erstelle die Meta-Tags beim Mounten
onMounted(() => {
  createSocialMediaTags();
});

// Entferne die Meta-Tags beim Unmounten
onBeforeUnmount(() => {
  document.querySelectorAll('meta[data-social-media]').forEach(el => el.remove());
});
</script>