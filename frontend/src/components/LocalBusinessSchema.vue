<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="localBusinessSchema" />
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  // Unternehmensdaten
  business: {
    type: Object,
    default: () => ({
      name: "Mayer Elektro- und Gebäudetechnik GmbH",
      description: "Professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen in Hamburg und Umgebung.",
      url: "https://www.mayerelektro.de",
      logo: "https://www.mayerelektro.de/logo.png",
      image: "https://www.mayerelektro.de/img/building.jpg",
      telephone: "+4940123456789",
      email: "info@mayerelektro.de",
      priceRange: "€€",
      currenciesAccepted: "EUR",
      paymentAccepted: "Bargeld, Kreditkarte, Überweisung",
      openingHours: [
        {
          dayOfWeek: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
          opens: "08:00",
          closes: "17:00"
        }
      ],
      address: {
        streetAddress: "Christoph-Probst-Weg 4",
        addressLocality: "Hamburg",
        postalCode: "20251",
        addressCountry: "DE"
      },
      geo: {
        latitude: 53.5969,
        longitude: 9.9937
      },
      sameAs: [
        "https://www.facebook.com/mayerelektro",
        "https://www.instagram.com/mayerelektro",
        "https://www.linkedin.com/company/mayerelektro"
      ]
    })
  }
});

// Strukturierte Daten für lokales Unternehmen
const localBusinessSchema = computed(() => {
  const { 
    name, 
    description, 
    url, 
    logo, 
    image, 
    telephone, 
    email, 
    priceRange, 
    currenciesAccepted, 
    paymentAccepted, 
    openingHours, 
    address, 
    geo, 
    sameAs 
  } = props.business;
  
  return {
    "@context": "https://schema.org",
    "@type": "ElectricalBusiness",
    "name": name,
    "description": description,
    "url": url,
    "logo": {
      "@type": "ImageObject",
      "url": logo
    },
    "image": image,
    "telephone": telephone,
    "email": email,
    "priceRange": priceRange,
    "currenciesAccepted": currenciesAccepted,
    "paymentAccepted": paymentAccepted,
    "openingHoursSpecification": openingHours.map(hours => ({
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": hours.dayOfWeek,
      "opens": hours.opens,
      "closes": hours.closes
    })),
    "address": {
      "@type": "PostalAddress",
      "streetAddress": address.streetAddress,
      "addressLocality": address.addressLocality,
      "postalCode": address.postalCode,
      "addressCountry": address.addressCountry
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": geo.latitude,
      "longitude": geo.longitude
    },
    "sameAs": sameAs
  };
});
</script>