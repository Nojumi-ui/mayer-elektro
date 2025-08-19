<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="imageSchema" />
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  // Bild-Daten
  image: {
    type: Object,
    required: true,
    validator: (image) => {
      return 'contentUrl' in image;
    }
  },
  // Publisher-Daten
  publisher: {
    type: Object,
    default: () => ({
      name: "Mayer Elektro- und Gebäudetechnik GmbH",
      url: "https://www.mayerelektro.de"
    })
  }
});

// Strukturierte Daten für Bild
const imageSchema = computed(() => {
  const { 
    contentUrl, 
    name, 
    description, 
    caption, 
    uploadDate,
    width,
    height,
    author,
    license,
    acquireLicensePage,
    creditText,
    copyrightNotice,
    exifData
  } = props.image;
  
  return {
    "@context": "https://schema.org",
    "@type": "ImageObject",
    "contentUrl": contentUrl,
    "name": name || "",
    "description": description || "",
    "caption": caption || "",
    "uploadDate": uploadDate || new Date().toISOString().split('T')[0],
    "width": width || "",
    "height": height || "",
    "author": author ? {
      "@type": "Person",
      "name": author
    } : {
      "@type": "Organization",
      "name": props.publisher.name
    },
    "publisher": {
      "@type": "Organization",
      "name": props.publisher.name,
      "url": props.publisher.url
    },
    "license": license || "",
    "acquireLicensePage": acquireLicensePage || "",
    "creditText": creditText || "",
    "copyrightNotice": copyrightNotice || `© ${new Date().getFullYear()} ${props.publisher.name}`,
    "exifData": exifData || null
  };
});
</script>