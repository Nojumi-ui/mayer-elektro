<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
  <StructuredData :data="servicesSchema" />
</template>

<script setup>
import { onMounted, onBeforeUnmount } from 'vue';
import StructuredData from './StructuredData.vue';

// Strukturierte Daten für Dienstleistungen
const services = [
  {
    "@type": "Service",
    "name": "Elektroinstallation",
    "description": "Professionelle Elektroinstallationen für Privat- und Gewerbekunden in Hamburg und Umgebung. Neuinstallationen, Renovierungen und Erweiterungen.",
    "provider": {
      "@type": "LocalBusiness",
      "name": "Mayer Elektro- und Gebäudetechnik GmbH"
    },
    "areaServed": {
      "@type": "GeoCircle",
      "geoMidpoint": {
        "@type": "GeoCoordinates",
        "latitude": 53.5969,
        "longitude": 9.9937
      },
      "geoRadius": "50000"
    },
    "serviceType": "Elektroinstallation",
    "offers": {
      "@type": "Offer",
      "price": "0",
      "priceCurrency": "EUR",
      "priceSpecification": {
        "@type": "PriceSpecification",
        "price": "0",
        "priceCurrency": "EUR",
        "description": "Preis auf Anfrage"
      }
    }
  },
  {
    "@type": "Service",
    "name": "Gebäudeautomation",
    "description": "Intelligente Gebäudeautomation für mehr Komfort, Sicherheit und Energieeffizienz. Smart Home-Lösungen für private und gewerbliche Immobilien.",
    "provider": {
      "@type": "LocalBusiness",
      "name": "Mayer Elektro- und Gebäudetechnik GmbH"
    },
    "areaServed": {
      "@type": "GeoCircle",
      "geoMidpoint": {
        "@type": "GeoCoordinates",
        "latitude": 53.5969,
        "longitude": 9.9937
      },
      "geoRadius": "50000"
    },
    "serviceType": "Gebäudeautomation",
    "offers": {
      "@type": "Offer",
      "price": "0",
      "priceCurrency": "EUR",
      "priceSpecification": {
        "@type": "PriceSpecification",
        "price": "0",
        "priceCurrency": "EUR",
        "description": "Preis auf Anfrage"
      }
    }
  },
  {
    "@type": "Service",
    "name": "Photovoltaik-Installation",
    "description": "Installation, Wartung und Reparatur von Photovoltaikanlagen. Nachhaltige Energielösungen für Ihr Zuhause oder Unternehmen.",
    "provider": {
      "@type": "LocalBusiness",
      "name": "Mayer Elektro- und Gebäudetechnik GmbH"
    },
    "areaServed": {
      "@type": "GeoCircle",
      "geoMidpoint": {
        "@type": "GeoCoordinates",
        "latitude": 53.5969,
        "longitude": 9.9937
      },
      "geoRadius": "50000"
    },
    "serviceType": "Photovoltaik",
    "offers": {
      "@type": "Offer",
      "price": "0",
      "priceCurrency": "EUR",
      "priceSpecification": {
        "@type": "PriceSpecification",
        "price": "0",
        "priceCurrency": "EUR",
        "description": "Preis auf Anfrage"
      }
    }
  },
  {
    "@type": "Service",
    "name": "Elektroprüfung",
    "description": "Gesetzlich vorgeschriebene Prüfungen elektrischer Anlagen und Geräte. E-Check, DGUV V3-Prüfungen und mehr.",
    "provider": {
      "@type": "LocalBusiness",
      "name": "Mayer Elektro- und Gebäudetechnik GmbH"
    },
    "areaServed": {
      "@type": "GeoCircle",
      "geoMidpoint": {
        "@type": "GeoCoordinates",
        "latitude": 53.5969,
        "longitude": 9.9937
      },
      "geoRadius": "50000"
    },
    "serviceType": "Elektroprüfung",
    "offers": {
      "@type": "Offer",
      "price": "0",
      "priceCurrency": "EUR",
      "priceSpecification": {
        "@type": "PriceSpecification",
        "price": "0",
        "priceCurrency": "EUR",
        "description": "Preis auf Anfrage"
      }
    }
  },
  {
    "@type": "Service",
    "name": "24/7 Notdienst",
    "description": "Rund um die Uhr Notdienst für elektrische Notfälle. Schnelle Hilfe bei Stromausfällen, defekten Anlagen und mehr.",
    "provider": {
      "@type": "LocalBusiness",
      "name": "Mayer Elektro- und Gebäudetechnik GmbH"
    },
    "areaServed": {
      "@type": "GeoCircle",
      "geoMidpoint": {
        "@type": "GeoCoordinates",
        "latitude": 53.5969,
        "longitude": 9.9937
      },
      "geoRadius": "50000"
    },
    "serviceType": "Notdienst",
    "offers": {
      "@type": "Offer",
      "price": "0",
      "priceCurrency": "EUR",
      "priceSpecification": {
        "@type": "PriceSpecification",
        "price": "0",
        "priceCurrency": "EUR",
        "description": "Preis auf Anfrage"
      }
    }
  }
];

// Schema für alle Dienstleistungen
const servicesSchema = {
  "@context": "https://schema.org",
  "@type": "ItemList",
  "itemListElement": services.map((service, index) => ({
    "@type": "ListItem",
    "position": index + 1,
    "item": service
  }))
};
</script>