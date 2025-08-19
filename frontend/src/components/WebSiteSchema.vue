<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
</template>

<script setup>
import { onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
  // Website-Daten
  website: {
    type: Object,
    default: () => ({
      name: "Mayer Elektro - Elektroinstallation & Gebäudetechnik Hamburg",
      alternateName: "Mayer Elektro",
      url: "https://www.mayerelektro.de",
      description: "Professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen in Hamburg und Umgebung.",
      inLanguage: "de-DE",
      publisher: {
        name: "Mayer Elektro- und Gebäudetechnik GmbH",
        logo: "https://www.mayerelektro.de/logo.png"
      },
      potentialAction: [
        {
          type: "SearchAction",
          target: "https://www.mayerelektro.de/suche?q={search_term_string}",
          queryInput: "required name=search_term_string"
        }
      ],
      sameAs: [
        "https://www.facebook.com/mayerelektro",
        "https://www.instagram.com/mayerelektro",
        "https://www.linkedin.com/company/mayerelektro"
      ]
    })
  }
});

// Strukturierte Daten für Website
const websiteSchema = {
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": props.website.name,
  "alternateName": props.website.alternateName,
  "url": props.website.url,
  "description": props.website.description,
  "inLanguage": props.website.inLanguage,
  "publisher": {
    "@type": "Organization",
    "name": props.website.publisher.name,
    "logo": {
      "@type": "ImageObject",
      "url": props.website.publisher.logo
    }
  },
  "potentialAction": props.website.potentialAction.map(action => ({
    "@type": action.type,
    "target": action.target,
    "query-input": action.queryInput
  })),
  "sameAs": props.website.sameAs
};

// Erstellt die strukturierten Daten
const createWebSiteSchema = () => {
  // Bestehende strukturierte Daten entfernen
  const existingScript = document.getElementById('website-schema');
  if (existingScript) {
    existingScript.remove();
  }
  
  // Neue strukturierte Daten hinzufügen
  const script = document.createElement('script');
  script.setAttribute('type', 'application/ld+json');
  script.setAttribute('id', 'website-schema');
  script.textContent = JSON.stringify(websiteSchema);
  document.head.appendChild(script);
};

// Erstelle die strukturierten Daten beim Mounten
onMounted(() => {
  createWebSiteSchema();
});

// Entferne die strukturierten Daten beim Unmounten
onBeforeUnmount(() => {
  const existingScript = document.getElementById('website-schema');
  if (existingScript) {
    existingScript.remove();
  }
});
</script>