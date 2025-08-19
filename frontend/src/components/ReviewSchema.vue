<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="reviewSchema" />
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  // Bewertungs-Daten
  reviews: {
    type: Array,
    required: true,
    validator: (reviews) => {
      return reviews.every(review => 
        'author' in review && 
        'reviewBody' in review && 
        'ratingValue' in review
      );
    }
  },
  // Aggregierte Bewertung
  aggregateRating: {
    type: Object,
    default: () => ({
      ratingValue: 0,
      reviewCount: 0,
      bestRating: 5,
      worstRating: 1
    })
  },
  // Bewertetes Item
  itemReviewed: {
    type: Object,
    default: () => ({
      name: "Mayer Elektro- und Gebäudetechnik GmbH",
      description: "Elektroinstallation und Gebäudetechnik in Hamburg",
      image: "https://www.mayerelektro.de/logo.png",
      url: "https://www.mayerelektro.de"
    })
  }
});

// Berechne die aggregierte Bewertung, falls nicht angegeben
const calculatedAggregateRating = computed(() => {
  if (props.aggregateRating.ratingValue > 0) {
    return props.aggregateRating;
  }
  
  // Berechne Durchschnittsbewertung
  const sum = props.reviews.reduce((acc, review) => acc + review.ratingValue, 0);
  const avg = sum / props.reviews.length;
  
  return {
    ratingValue: parseFloat(avg.toFixed(1)),
    reviewCount: props.reviews.length,
    bestRating: 5,
    worstRating: 1
  };
});

// Strukturierte Daten für Bewertungen
const reviewSchema = computed(() => {
  return {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": props.itemReviewed.name,
    "description": props.itemReviewed.description,
    "image": props.itemReviewed.image,
    "url": props.itemReviewed.url,
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": calculatedAggregateRating.value.ratingValue,
      "reviewCount": calculatedAggregateRating.value.reviewCount,
      "bestRating": calculatedAggregateRating.value.bestRating,
      "worstRating": calculatedAggregateRating.value.worstRating
    },
    "review": props.reviews.map(review => ({
      "@type": "Review",
      "author": {
        "@type": "Person",
        "name": review.author
      },
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": review.ratingValue,
        "bestRating": 5,
        "worstRating": 1
      },
      "datePublished": review.datePublished || new Date().toISOString().split('T')[0],
      "reviewBody": review.reviewBody,
      "name": review.name || `Bewertung von ${review.author}`
    }))
  };
});
</script>