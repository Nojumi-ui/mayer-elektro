<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="videoSchema" />
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  // Video-Daten
  video: {
    type: Object,
    required: true,
    validator: (video) => {
      return 'name' in video && 
             'contentUrl' in video;
    }
  },
  // Publisher-Daten
  publisher: {
    type: Object,
    default: () => ({
      name: "Mayer Elektro- und Gebäudetechnik GmbH",
      url: "https://www.mayerelektro.de",
      logo: "https://www.mayerelektro.de/logo.png"
    })
  }
});

// Strukturierte Daten für Video
const videoSchema = computed(() => {
  const { 
    name, 
    description, 
    thumbnailUrl, 
    uploadDate, 
    contentUrl,
    embedUrl,
    duration,
    interactionCount,
    expires,
    hasPart,
    watchCount,
    publication,
    regionsAllowed
  } = props.video;
  
  return {
    "@context": "https://schema.org",
    "@type": "VideoObject",
    "name": name,
    "description": description || "",
    "thumbnailUrl": thumbnailUrl || "",
    "uploadDate": uploadDate || new Date().toISOString(),
    "contentUrl": contentUrl,
    "embedUrl": embedUrl || "",
    "duration": duration || "",
    "interactionCount": interactionCount || "",
    "expires": expires || "",
    "hasPart": hasPart || null,
    "watchCount": watchCount || "",
    "publication": publication || null,
    "regionsAllowed": regionsAllowed || "",
    "publisher": {
      "@type": "Organization",
      "name": props.publisher.name,
      "url": props.publisher.url,
      "logo": {
        "@type": "ImageObject",
        "url": props.publisher.logo
      }
    }
  };
});
</script>