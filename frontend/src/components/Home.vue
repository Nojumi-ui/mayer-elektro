<template>
  <div>
    <MetaTags
      title="Mayer Elektro - Elektroinstallation & Gebäudetechnik Hamburg"
      description="Mayer Elektro in Hamburg bietet professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen. Zuverlässig und regional seit über 15 Jahren."
      keywords="Elektroinstallation Hamburg, Gebäudetechnik, Automatisierung, Elektrofachkräfte, Elektrotechnik, Instandhaltung, Elektroinstallateur"
      canonical="https://www.mayerelektro.de/"
      :og="{
        title: 'Mayer Elektro - Elektroinstallation & Gebäudetechnik Hamburg',
        description: 'Professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen in Hamburg und Umgebung.',
        image: 'https://www.mayerelektro.de/logo.png',
        url: 'https://www.mayerelektro.de/',
        type: 'website'
      }"
      :twitter="{
        card: 'summary_large_image',
        title: 'Mayer Elektro - Elektroinstallation & Gebäudetechnik Hamburg',
        description: 'Professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen in Hamburg und Umgebung.',
        image: 'https://www.mayerelektro.de/logo.png'
      }"
    />
    
    <StructuredData :data="structuredData" />
    <ServiceSchema />
    <JobSchema />
    <EventSchema :events="events" />
    
    <HomeSection />
    <JobsSection />
    <BewerberSectionNew />
    <KundenSectionNew />
    <NewsSection />
    <TestimonialsSection />
    <FaqSection />
    <LocalBusinessInfo />
    <ContactSection />
  </div>
</template>

<script setup>
import { onMounted, nextTick, ref } from 'vue'
import { useRoute } from 'vue-router'
import HomeSection from "./HomeSection.vue";
import JobsSection from "./JobsSection.vue";
import BewerberSectionNew from "./BewerberSectionNew.vue";
import KundenSectionNew from "./KundenSectionNew.vue";
import NewsSection from "./NewsSection.vue";
import TestimonialsSection from "./TestimonialsSection.vue";
import FaqSection from "./FaqSection.vue";
import LocalBusinessInfo from "./LocalBusinessInfo.vue";
import ContactSection from "./ContactSection.vue";
import MetaTags from "./MetaTags.vue";
import StructuredData from "./StructuredData.vue";
import ServiceSchema from "./ServiceSchema.vue";
import JobSchema from "./JobSchema.vue";
import EventSchema from "./EventSchema.vue";

const route = useRoute()

// Testimonial-Daten werden jetzt direkt in der TestimonialsSection-Komponente verwaltet

// FAQ-Daten werden jetzt direkt in der FaqSection-Komponente verwaltet

// Strukturierte Daten für SEO
const structuredData = {
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Mayer Elektro- und Gebäudetechnik GmbH",
  "image": "https://www.mayerelektro.de/logo.png",
  "url": "https://www.mayerelektro.de",
  "telephone": "+4940123456789",
  "email": "info@mayerelektro.de",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Christoph-Probst-Weg 4",
    "addressLocality": "Hamburg",
    "postalCode": "20251",
    "addressCountry": "DE"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 53.5969,
    "longitude": 9.9937
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday"
    ],
    "opens": "08:00",
    "closes": "17:00"
  },
  "priceRange": "€€",
  "description": "Professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen in Hamburg und Umgebung.",
  "keywords": "Elektroinstallation, Gebäudetechnik, Automatisierung, Elektrofachkräfte, Hamburg",
  "serviceType": ["Elektroinstallation", "Automatisierung", "Instandhaltung", "Personaldienstleistungen"]
};

// Veranstaltungsdaten für EventSchema
const events = [
  {
    name: "Tag der offenen Tür bei Mayer Elektro",
    startDate: "2025-09-15T10:00:00+02:00",
    endDate: "2025-09-15T16:00:00+02:00",
    description: "Lernen Sie unser Unternehmen kennen und erfahren Sie mehr über unsere Dienstleistungen und Karrieremöglichkeiten.",
    location: {
      name: "Mayer Elektro Hauptsitz",
      streetAddress: "Christoph-Probst-Weg 4",
      addressLocality: "Hamburg",
      postalCode: "20251",
      addressCountry: "DE"
    },
    image: "https://www.mayerelektro.de/img/event-open-day.jpg",
    offers: {
      price: "0",
      priceCurrency: "EUR",
      availability: "https://schema.org/InStock"
    }
  },
  {
    name: "Informationsveranstaltung: Karriere in der Elektrotechnik",
    startDate: "2025-10-20T18:00:00+02:00",
    endDate: "2025-10-20T20:00:00+02:00",
    description: "Informationsabend für Schüler, Studenten und Quereinsteiger über Karrieremöglichkeiten in der Elektrotechnik.",
    location: {
      name: "Berufsschule Hamburg-Mitte",
      streetAddress: "Museumstraße 19",
      addressLocality: "Hamburg",
      postalCode: "22765",
      addressCountry: "DE"
    },
    image: "https://www.mayerelektro.de/img/event-career-info.jpg",
    offers: {
      price: "0",
      priceCurrency: "EUR",
      availability: "https://schema.org/InStock"
    }
  }
];

// Scrolle zur Sektion wenn ein Anker in der URL ist
onMounted(async () => {
  await nextTick()
  
  // Prüfe auf Hash in der URL
  if (route.hash) {
    const sectionId = route.hash.substring(1) // Entferne das #
    const element = document.getElementById(sectionId)
    
    if (element) {
      // Kurze Verzögerung, damit alle Komponenten geladen sind
      setTimeout(() => {
        element.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        })
      }, 100)
    }
  }
})
</script>
