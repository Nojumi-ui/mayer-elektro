<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="qaSchema" />
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  // QA-Daten
  qa: {
    type: Object,
    required: true,
    validator: (qa) => {
      return 'question' in qa && 
             'answers' in qa;
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

// Strukturierte Daten für QA
const qaSchema = computed(() => {
  const { 
    question, 
    answers, 
    dateCreated, 
    dateModified, 
    url
  } = props.qa;
  
  return {
    "@context": "https://schema.org",
    "@type": "QAPage",
    "mainEntity": {
      "@type": "Question",
      "name": question.name,
      "text": question.text || question.name,
      "answerCount": answers.length,
      "dateCreated": dateCreated || new Date().toISOString(),
      "dateModified": dateModified || dateCreated || new Date().toISOString(),
      "author": {
        "@type": "Organization",
        "name": props.author.name,
        "url": props.author.url
      },
      "url": url || "",
      "acceptedAnswer": answers.find(answer => answer.isAccepted) ? {
        "@type": "Answer",
        "text": answers.find(answer => answer.isAccepted).text,
        "dateCreated": answers.find(answer => answer.isAccepted).dateCreated || dateCreated || new Date().toISOString(),
        "upvoteCount": answers.find(answer => answer.isAccepted).upvoteCount || 0,
        "url": answers.find(answer => answer.isAccepted).url || url || "",
        "author": {
          "@type": "Organization",
          "name": answers.find(answer => answer.isAccepted).author || props.author.name,
          "url": props.author.url
        }
      } : null,
      "suggestedAnswer": answers.filter(answer => !answer.isAccepted).map(answer => ({
        "@type": "Answer",
        "text": answer.text,
        "dateCreated": answer.dateCreated || dateCreated || new Date().toISOString(),
        "upvoteCount": answer.upvoteCount || 0,
        "url": answer.url || url || "",
        "author": {
          "@type": "Organization",
          "name": answer.author || props.author.name,
          "url": props.author.url
        }
      }))
    }
  };
});
</script>