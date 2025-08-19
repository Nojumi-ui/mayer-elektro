<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
</template>

<script setup>
import { onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
  // Organisations-Daten
  organization: {
    type: Object,
    default: () => ({
      name: "Mayer Elektro- und Gebäudetechnik GmbH",
      alternateName: "Mayer Elektro",
      url: "https://www.mayerelektro.de",
      logo: "https://www.mayerelektro.de/logo.png",
      description: "Professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen in Hamburg und Umgebung.",
      foundingDate: "2010-01-01",
      founders: [
        {
          name: "Max Mayer",
          jobTitle: "Geschäftsführer"
        }
      ],
      address: {
        streetAddress: "Christoph-Probst-Weg 4",
        addressLocality: "Hamburg",
        postalCode: "20251",
        addressCountry: "DE"
      },
      contactPoint: {
        telephone: "+4940123456789",
        email: "info@mayerelektro.de",
        contactType: "customer service"
      },
      sameAs: [
        "https://www.facebook.com/mayerelektro",
        "https://www.instagram.com/mayerelektro",
        "https://www.linkedin.com/company/mayerelektro"
      ]
    })
  }
});

// Strukturierte Daten für Organisation
const organizationSchema = {
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": props.organization.name,
  "alternateName": props.organization.alternateName,
  "url": props.organization.url,
  "logo": props.organization.logo,
  "description": props.organization.description,
  "foundingDate": props.organization.foundingDate,
  "founders": props.organization.founders.map(founder => ({
    "@type": "Person",
    "name": founder.name,
    "jobTitle": founder.jobTitle
  })),
  "address": {
    "@type": "PostalAddress",
    "streetAddress": props.organization.address.streetAddress,
    "addressLocality": props.organization.address.addressLocality,
    "postalCode": props.organization.address.postalCode,
    "addressCountry": props.organization.address.addressCountry
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": props.organization.contactPoint.telephone,
    "email": props.organization.contactPoint.email,
    "contactType": props.organization.contactPoint.contactType
  },
  "sameAs": props.organization.sameAs
};

// Erstellt die strukturierten Daten
const createOrganizationSchema = () => {
  // Bestehende strukturierte Daten entfernen
  const existingScript = document.getElementById('organization-schema');
  if (existingScript) {
    existingScript.remove();
  }
  
  // Neue strukturierte Daten hinzufügen
  const script = document.createElement('script');
  script.setAttribute('type', 'application/ld+json');
  script.setAttribute('id', 'organization-schema');
  script.textContent = JSON.stringify(organizationSchema);
  document.head.appendChild(script);
};

// Erstelle die strukturierten Daten beim Mounten
onMounted(() => {
  createOrganizationSchema();
});

// Entferne die strukturierten Daten beim Unmounten
onBeforeUnmount(() => {
  const existingScript = document.getElementById('organization-schema');
  if (existingScript) {
    existingScript.remove();
  }
});
</script>