<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="jobPostingsSchema" />
</template>

<script setup>
import { onMounted, onBeforeUnmount } from 'vue';
import StructuredData from './StructuredData.vue';

// Strukturierte Daten für Stellenangebote
const jobPostings = [
  {
    "@type": "JobPosting",
    "title": "Elektroniker/in für Energie- und Gebäudetechnik (m/w/d)",
    "description": "Als Elektroniker/in für Energie- und Gebäudetechnik sind Sie verantwortlich für die Installation, Wartung und Reparatur elektrischer Anlagen in Wohn- und Geschäftsgebäuden. Sie arbeiten selbstständig und im Team an verschiedenen Projekten in Hamburg und Umgebung.",
    "datePosted": "2025-06-01",
    "validThrough": "2025-12-31",
    "employmentType": "FULL_TIME",
    "hiringOrganization": {
      "@type": "Organization",
      "name": "Mayer Elektro- und Gebäudetechnik GmbH",
      "sameAs": "https://www.mayerelektro.de"
    },
    "jobLocation": {
      "@type": "Place",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Christoph-Probst-Weg 4",
        "addressLocality": "Hamburg",
        "postalCode": "20251",
        "addressCountry": "DE"
      }
    },
    "baseSalary": {
      "@type": "MonetaryAmount",
      "currency": "EUR",
      "value": {
        "@type": "QuantitativeValue",
        "minValue": 3200,
        "maxValue": 4200,
        "unitText": "MONTH"
      }
    },
    "qualifications": "Abgeschlossene Berufsausbildung als Elektroniker/in für Energie- und Gebäudetechnik oder vergleichbare Qualifikation. Führerschein Klasse B erforderlich.",
    "skills": "Elektroinstallation, Gebäudetechnik, KNX, Schaltschrankbau, Fehlersuche und -behebung",
    "workHours": "40 Stunden/Woche",
    "experienceRequirements": "Mindestens 2 Jahre Berufserfahrung",
    "jobBenefits": "Firmenwagen, betriebliche Altersvorsorge, flexible Arbeitszeiten, Weiterbildungsmöglichkeiten"
  },
  {
    "@type": "JobPosting",
    "title": "Elektroniker/in für Automatisierungstechnik (m/w/d)",
    "description": "Als Elektroniker/in für Automatisierungstechnik sind Sie verantwortlich für die Planung, Installation und Inbetriebnahme von Automatisierungssystemen in industriellen Anlagen. Sie arbeiten an spannenden Projekten bei namhaften Kunden in der Region Hamburg.",
    "datePosted": "2025-06-15",
    "validThrough": "2025-12-31",
    "employmentType": "FULL_TIME",
    "hiringOrganization": {
      "@type": "Organization",
      "name": "Mayer Elektro- und Gebäudetechnik GmbH",
      "sameAs": "https://www.mayerelektro.de"
    },
    "jobLocation": {
      "@type": "Place",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Christoph-Probst-Weg 4",
        "addressLocality": "Hamburg",
        "postalCode": "20251",
        "addressCountry": "DE"
      }
    },
    "baseSalary": {
      "@type": "MonetaryAmount",
      "currency": "EUR",
      "value": {
        "@type": "QuantitativeValue",
        "minValue": 3500,
        "maxValue": 4500,
        "unitText": "MONTH"
      }
    },
    "qualifications": "Abgeschlossene Berufsausbildung als Elektroniker/in für Automatisierungstechnik oder vergleichbare Qualifikation. Führerschein Klasse B erforderlich.",
    "skills": "SPS-Programmierung, Siemens S7, Automatisierungstechnik, Schaltschrankbau, Fehlerdiagnose",
    "workHours": "40 Stunden/Woche",
    "experienceRequirements": "Mindestens 3 Jahre Berufserfahrung",
    "jobBenefits": "Firmenwagen, betriebliche Altersvorsorge, flexible Arbeitszeiten, Weiterbildungsmöglichkeiten"
  },
  {
    "@type": "JobPosting",
    "title": "Auszubildende/r zum/zur Elektroniker/in für Energie- und Gebäudetechnik (m/w/d)",
    "description": "Wir bieten eine fundierte Ausbildung zum/zur Elektroniker/in für Energie- und Gebäudetechnik. Während der 3,5-jährigen Ausbildung lernen Sie alle Aspekte der modernen Elektroinstallation und Gebäudetechnik kennen und arbeiten an verschiedenen Projekten mit erfahrenen Kollegen.",
    "datePosted": "2025-05-01",
    "validThrough": "2025-08-31",
    "employmentType": "FULL_TIME",
    "hiringOrganization": {
      "@type": "Organization",
      "name": "Mayer Elektro- und Gebäudetechnik GmbH",
      "sameAs": "https://www.mayerelektro.de"
    },
    "jobLocation": {
      "@type": "Place",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Christoph-Probst-Weg 4",
        "addressLocality": "Hamburg",
        "postalCode": "20251",
        "addressCountry": "DE"
      }
    },
    "qualifications": "Mittlerer Schulabschluss oder Abitur, gute Noten in Mathematik und Physik, technisches Verständnis",
    "educationRequirements": "Mittlerer Schulabschluss oder höher",
    "workHours": "40 Stunden/Woche",
    "jobBenefits": "Übernahmegarantie bei guten Leistungen, zusätzliche Ausbildungsinhalte, Azubi-Events"
  }
];

// Schema für alle Stellenangebote
const jobPostingsSchema = {
  "@context": "https://schema.org",
  "@type": "ItemList",
  "itemListElement": jobPostings.map((job, index) => ({
    "@type": "ListItem",
    "position": index + 1,
    "item": job
  }))
};
</script>