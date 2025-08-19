<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="eventSchema" />
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  // Event-Daten
  events: {
    type: Array,
    required: true,
    validator: (events) => {
      return events.every(event => 
        'name' in event && 
        'startDate' in event && 
        'location' in event
      );
    }
  }
});

// Strukturierte Daten für Events
const eventSchema = computed(() => {
  return {
    "@context": "https://schema.org",
    "@type": "ItemList",
    "itemListElement": props.events.map((event, index) => ({
      "@type": "ListItem",
      "position": index + 1,
      "item": {
        "@type": "Event",
        "name": event.name,
        "startDate": event.startDate,
        "endDate": event.endDate || event.startDate,
        "location": {
          "@type": "Place",
          "name": event.location.name,
          "address": {
            "@type": "PostalAddress",
            "streetAddress": event.location.streetAddress,
            "addressLocality": event.location.addressLocality,
            "postalCode": event.location.postalCode,
            "addressCountry": event.location.addressCountry || "DE"
          }
        },
        "description": event.description || "",
        "image": event.image || "https://www.mayerelektro.de/logo.png",
        "url": event.url || "https://www.mayerelektro.de/events",
        "organizer": {
          "@type": "Organization",
          "name": event.organizer || "Mayer Elektro- und Gebäudetechnik GmbH",
          "url": event.organizerUrl || "https://www.mayerelektro.de"
        },
        "offers": event.offers ? {
          "@type": "Offer",
          "price": event.offers.price || "0",
          "priceCurrency": event.offers.priceCurrency || "EUR",
          "availability": event.offers.availability || "https://schema.org/InStock",
          "url": event.offers.url || "https://www.mayerelektro.de/events"
        } : undefined,
        "performer": event.performer ? {
          "@type": "Person",
          "name": event.performer
        } : undefined
      }
    }))
  };
});
</script>