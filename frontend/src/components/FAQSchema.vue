<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="faqSchema" />
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  // FAQ-Einträge
  faqs: {
    type: Array,
    required: true,
    validator: (faqs) => {
      return faqs.every(faq => 'question' in faq && 'answer' in faq);
    }
  },
  // Optionale Eigenschaften
  mainEntity: {
    type: String,
    default: 'https://www.mayerelektro.de/faq'
  },
  name: {
    type: String,
    default: 'Häufig gestellte Fragen zu Mayer Elektro'
  }
});

// Strukturierte Daten für FAQ
const faqSchema = computed(() => {
  return {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": props.faqs.map(faq => ({
      "@type": "Question",
      "name": faq.question,
      "acceptedAnswer": {
        "@type": "Answer",
        "text": faq.answer
      }
    }))
  };
});
</script>