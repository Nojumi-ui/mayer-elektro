<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="productSchema" />
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  // Produkt-Daten
  product: {
    type: Object,
    required: true,
    validator: (product) => {
      return 'name' in product && 
             'description' in product;
    }
  }
});

// Strukturierte Daten für Produkt
const productSchema = computed(() => {
  const { 
    name, 
    description, 
    image, 
    url,
    brand,
    offers,
    category,
    sku,
    mpn,
    gtin,
    aggregateRating,
    review
  } = props.product;
  
  return {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": name,
    "description": description,
    "image": image || "https://www.mayerelektro.de/logo.png",
    "url": url || "https://www.mayerelektro.de/produkte",
    "brand": brand ? {
      "@type": "Brand",
      "name": brand
    } : undefined,
    "offers": offers ? {
      "@type": "Offer",
      "price": offers.price,
      "priceCurrency": offers.priceCurrency || "EUR",
      "availability": offers.availability || "https://schema.org/InStock",
      "url": offers.url || url || "https://www.mayerelektro.de/produkte",
      "priceValidUntil": offers.priceValidUntil
    } : undefined,
    "category": category || "",
    "sku": sku || "",
    "mpn": mpn || "",
    "gtin": gtin || "",
    "aggregateRating": aggregateRating ? {
      "@type": "AggregateRating",
      "ratingValue": aggregateRating.ratingValue,
      "reviewCount": aggregateRating.reviewCount,
      "bestRating": aggregateRating.bestRating || 5,
      "worstRating": aggregateRating.worstRating || 1
    } : undefined,
    "review": review ? {
      "@type": "Review",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": review.rating,
        "bestRating": review.bestRating || 5,
        "worstRating": review.worstRating || 1
      },
      "author": {
        "@type": "Person",
        "name": review.author
      },
      "reviewBody": review.text
    } : undefined
  };
});
</script>