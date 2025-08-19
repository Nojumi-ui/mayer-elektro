<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="personSchema" />
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  // Person-Daten
  person: {
    type: Object,
    required: true,
    validator: (person) => {
      return 'name' in person;
    }
  },
  // Organisations-Daten
  organization: {
    type: Object,
    default: () => ({
      name: "Mayer Elektro- und Gebäudetechnik GmbH",
      url: "https://www.mayerelektro.de",
      logo: "https://www.mayerelektro.de/logo.png"
    })
  }
});

// Strukturierte Daten für Person
const personSchema = computed(() => {
  const { 
    name, 
    jobTitle, 
    image, 
    description, 
    email,
    telephone,
    url,
    sameAs,
    address,
    birthDate,
    nationality,
    alumniOf,
    award,
    knowsLanguage,
    workLocation,
    worksFor
  } = props.person;
  
  return {
    "@context": "https://schema.org",
    "@type": "Person",
    "name": name,
    "jobTitle": jobTitle || "",
    "image": image || "",
    "description": description || "",
    "email": email || "",
    "telephone": telephone || "",
    "url": url || "",
    "sameAs": sameAs || [],
    "address": address ? {
      "@type": "PostalAddress",
      "streetAddress": address.streetAddress || "",
      "addressLocality": address.addressLocality || "",
      "postalCode": address.postalCode || "",
      "addressCountry": address.addressCountry || "DE"
    } : null,
    "birthDate": birthDate || "",
    "nationality": nationality ? {
      "@type": "Country",
      "name": nationality
    } : null,
    "alumniOf": alumniOf ? {
      "@type": "EducationalOrganization",
      "name": alumniOf
    } : null,
    "award": award || "",
    "knowsLanguage": knowsLanguage || [],
    "workLocation": workLocation ? {
      "@type": "Place",
      "name": workLocation
    } : null,
    "worksFor": worksFor ? {
      "@type": "Organization",
      "name": worksFor.name || props.organization.name,
      "url": worksFor.url || props.organization.url,
      "logo": worksFor.logo || props.organization.logo
    } : {
      "@type": "Organization",
      "name": props.organization.name,
      "url": props.organization.url,
      "logo": props.organization.logo
    }
  };
});
</script>