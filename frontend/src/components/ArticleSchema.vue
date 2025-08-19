<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="articleSchema" />
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  // Artikel-Daten
  article: {
    type: Object,
    required: true,
    validator: (article) => {
      return 'headline' in article && 
             'datePublished' in article && 
             'author' in article;
    }
  }
});

// Strukturierte Daten für Artikel
const articleSchema = computed(() => {
  const { 
    headline, 
    datePublished, 
    dateModified, 
    author, 
    description, 
    image, 
    url,
    publisher,
    keywords,
    articleSection,
    wordCount,
    articleBody
  } = props.article;
  
  return {
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": headline,
    "datePublished": datePublished,
    "dateModified": dateModified || datePublished,
    "author": {
      "@type": "Person",
      "name": author
    },
    "publisher": publisher || {
      "@type": "Organization",
      "name": "Mayer Elektro- und Gebäudetechnik GmbH",
      "logo": {
        "@type": "ImageObject",
        "url": "https://www.mayerelektro.de/logo.png"
      }
    },
    "description": description || "",
    "image": image || "https://www.mayerelektro.de/logo.png",
    "url": url || "https://www.mayerelektro.de/news",
    "keywords": keywords || "",
    "articleSection": articleSection || "News",
    "wordCount": wordCount || "",
    "articleBody": articleBody || ""
  };
});
</script>