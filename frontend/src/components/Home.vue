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
    <TestimonialsSection :testimonials="testimonialItems" />
    <FaqSection :faqs="faqItems" />
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

// Testimonial-Daten
const testimonialItems = [
  {
    content: "Mayer Elektro hat unsere Büroräume komplett neu verkabelt und eine moderne Beleuchtungsanlage installiert. Die Arbeit wurde schnell, sauber und professionell erledigt. Wir sind sehr zufrieden mit dem Ergebnis und können das Unternehmen uneingeschränkt weiterempfehlen.",
    name: "Thomas Müller",
    position: "Geschäftsführer, TM Consulting GmbH",
    rating: 5
  },
  {
    content: "Die Installation unserer Photovoltaikanlage durch Mayer Elektro verlief reibungslos. Von der Beratung bis zur Inbetriebnahme wurden wir kompetent betreut. Die Anlage läuft einwandfrei und die Einsparungen sind sogar höher als ursprünglich kalkuliert.",
    name: "Sabine Weber",
    position: "Privatkundin",
    rating: 5
  },
  {
    content: "Als Industriebetrieb sind wir auf zuverlässige Elektroinstallationen angewiesen. Mayer Elektro ist seit Jahren unser Partner für Wartung und Instandhaltung. Die Reaktionszeiten sind kurz, die Mitarbeiter kompetent und die Preise fair.",
    name: "Dr. Frank Schmidt",
    position: "Technischer Leiter, Hamburg Manufacturing",
    rating: 5
  }
];

// FAQ-Daten
const faqItems = [
  {
    question: "Welche Elektroinstallationsleistungen bietet Mayer Elektro an?",
    answer: "Wir bieten ein umfassendes Spektrum an Elektroinstallationsleistungen für Privat- und Gewerbekunden in Hamburg und Umgebung. Dazu gehören Neuinstallationen, Renovierungen, Erweiterungen, Beleuchtungssysteme, Sicherheitstechnik, Smart Home-Lösungen und vieles mehr."
  },
  {
    question: "Bietet Mayer Elektro auch Notdienste an?",
    answer: "Ja, wir bieten einen 24/7-Notdienst für unsere Kunden an. Bei elektrischen Notfällen können Sie uns jederzeit kontaktieren, und wir schicken schnellstmöglich einen qualifizierten Elektriker zu Ihnen."
  },
  {
    question: "Wie kann ich mich bei Mayer Elektro bewerben?",
    answer: "Sie können sich über unser Online-Bewerbungsformular bewerben oder uns Ihre Bewerbungsunterlagen per E-Mail an karriere@mayerelektro.de senden. Wir suchen regelmäßig qualifizierte Elektrofachkräfte und bieten auch Ausbildungsplätze an."
  },
  {
    question: "Führt Mayer Elektro auch Photovoltaik-Installationen durch?",
    answer: "Ja, wir sind Experten für die Installation, Wartung und Reparatur von Photovoltaikanlagen. Wir beraten Sie gerne zu nachhaltigen Energielösungen für Ihr Zuhause oder Unternehmen."
  },
  {
    question: "In welchem Gebiet ist Mayer Elektro tätig?",
    answer: "Wir sind hauptsächlich in Hamburg und im Umkreis von ca. 50 km tätig. Bei größeren Projekten sind wir aber auch überregional für unsere Kunden im Einsatz."
  }
];

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
