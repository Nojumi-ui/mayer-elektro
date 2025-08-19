<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="howToSchema" />
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  // HowTo-Daten
  howTo: {
    type: Object,
    required: true,
    validator: (howTo) => {
      return 'name' in howTo && 
             'steps' in howTo;
    }
  },
  // Autor-Daten
  author: {
    type: Object,
    default: () => ({
      name: "Mayer Elektro- und Gebäudetechnik GmbH",
      url: "https://www.mayerelektro.de"
    })
  }
});

// Strukturierte Daten für HowTo
const howToSchema = computed(() => {
  const { 
    name, 
    description, 
    image, 
    totalTime, 
    estimatedCost,
    supply,
    tool,
    steps,
    yield: howToYield,
    video,
    prepTime,
    performTime,
    prerequisites,
    difficulty
  } = props.howTo;
  
  return {
    "@context": "https://schema.org",
    "@type": "HowTo",
    "name": name,
    "description": description || "",
    "image": image || "",
    "totalTime": totalTime || "",
    "estimatedCost": estimatedCost ? {
      "@type": "MonetaryAmount",
      "currency": estimatedCost.currency || "EUR",
      "value": estimatedCost.value || ""
    } : null,
    "supply": supply ? supply.map(item => ({
      "@type": "HowToSupply",
      "name": item
    })) : [],
    "tool": tool ? tool.map(item => ({
      "@type": "HowToTool",
      "name": item
    })) : [],
    "step": steps.map((step, index) => ({
      "@type": "HowToStep",
      "position": index + 1,
      "name": step.name || `Schritt ${index + 1}`,
      "text": step.text,
      "image": step.image || "",
      "url": step.url || ""
    })),
    "yield": howToYield || "",
    "video": video ? {
      "@type": "VideoObject",
      "name": video.name || name,
      "description": video.description || description || "",
      "thumbnailUrl": video.thumbnailUrl || "",
      "contentUrl": video.contentUrl || "",
      "embedUrl": video.embedUrl || "",
      "uploadDate": video.uploadDate || new Date().toISOString()
    } : null,
    "prepTime": prepTime || "",
    "performTime": performTime || "",
    "prerequisites": prerequisites ? prerequisites.map(item => ({
      "@type": "HowToTip",
      "text": item
    })) : [],
    "difficulty": difficulty || "",
    "author": {
      "@type": "Organization",
      "name": props.author.name,
      "url": props.author.url
    }
  };
});
</script>