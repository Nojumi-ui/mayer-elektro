<template>
  <section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">{{ t('location.title') }}</h2>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
          {{ t('location.subtitle') }}
        </p>
      </div>
      
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <!-- Map -->
        <div class="h-96 bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden shadow-lg">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2367.5792223883064!2d9.991518!3d53.596900000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b18912a599faad%3A0x295ceadf19a9d071!2sChristoph-Probst-Weg%204%2C%2020251%20Hamburg!5e0!3m2!1sde!2sde!4v1626889732177!5m2!1sde!2sde" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            title="Standort von Mayer Elektro in Hamburg"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
        
        <!-- Business Info -->
        <div class="space-y-8">
          <div>
            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ t('location.contact_info') }}</h3>
            
            <div class="space-y-4">
              <div class="flex items-start">
                <div class="text-[#0097b2] mt-1 mr-4">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                </div>
                <div>
                  <h4 class="font-medium text-gray-800 dark:text-gray-200">{{ t('location.address_label') }}</h4>
                  <address class="not-italic text-gray-600 dark:text-gray-400 mt-1">
                    Mayer Elektro- und Gebäudetechnik GmbH<br>
                    Christoph-Probst-Weg 4<br>
                    20251 Hamburg
                  </address>
                </div>
              </div>
              
              <!--div class="flex items-start">
                <div class="text-[#0097b2] mt-1 mr-4">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                </div>
                <div>
                  <h4 class="font-medium text-gray-800 dark:text-gray-200">{{ t('location.phone_label') }}</h4>
                  <p class="text-gray-600 dark:text-gray-400 mt-1">
                    <a href="tel:+4940123456789" class="hover:text-[#0097b2] transition">+49 (0) 40 123 456 789</a>
                  </p>
                </div>
              </div-->
              
              <div class="flex items-start">
                <div class="text-[#0097b2] mt-1 mr-4">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                </div>
                <div>
                  <h4 class="font-medium text-gray-800 dark:text-gray-200">{{ t('location.email_label') }}</h4>
                  <p class="text-gray-600 dark:text-gray-400 mt-1">
                    <a href="mailto:info@mayerelektro.de" class="hover:text-[#0097b2] transition">info@mayerelektro.de</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
          
          <div>
            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ t('location.opening_hours') }}</h3>
            
            <div class="space-y-2">
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">{{ t('location.monday_friday') }}</span>
                <span class="text-gray-800 dark:text-gray-200 font-medium">{{ t('location.hours_weekday') }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">{{ t('location.saturday') }}</span>
                <span class="text-gray-800 dark:text-gray-200 font-medium">{{ t('location.hours_saturday') }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">{{ t('location.sunday') }}</span>
                <span class="text-gray-800 dark:text-gray-200 font-medium">{{ t('location.hours_sunday') }}</span>
              </div>
              <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <span class="text-[#0097b2] font-medium">{{ t('location.emergency_service') }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Strukturierte Daten für SEO -->
    <StructuredData :data="localBusinessSchema" />
    <LocalBusinessSchema :business="businessData" />
  </section>
</template>

<script setup>
import { useI18n } from 'vue-i18n';
import StructuredData from './StructuredData.vue';
import LocalBusinessSchema from './LocalBusinessSchema.vue';

const { t } = useI18n();

// Strukturierte Daten für lokales Geschäft (altes Format)
const localBusinessSchema = {
  "@context": "https://schema.org",
  "@type": "ElectricalBusiness",
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
  "openingHoursSpecification": [
    {
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
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": "Saturday",
      "opens": "09:00",
      "closes": "13:00",
      "description": "Nach Vereinbarung"
    }
  ],
  "specialOpeningHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "00:00",
    "closes": "23:59",
    "description": "24/7 Notdienst"
  },
  "priceRange": "€€",
  "paymentAccepted": "Cash, Credit Card, Invoice",
  "currenciesAccepted": "EUR",
  "areaServed": {
    "@type": "GeoCircle",
    "geoMidpoint": {
      "@type": "GeoCoordinates",
      "latitude": 53.5969,
      "longitude": 9.9937
    },
    "geoRadius": "50000"
  },
  "serviceType": [
    "Elektroinstallation",
    "Gebäudetechnik",
    "Automatisierung",
    "Photovoltaik",
    "Smart Home",
    "Elektroprüfung"
  ]
};

// Erweiterte Unternehmensdaten für das neue Schema
const businessData = {
  name: "Mayer Elektro- und Gebäudetechnik GmbH",
  description: "Professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen in Hamburg und Umgebung.",
  url: "https://www.mayerelektro.de",
  logo: "https://www.mayerelektro.de/logo.png",
  image: "https://www.mayerelektro.de/img/building.jpg",
  telephone: "+4940123456789",
  email: "info@mayerelektro.de",
  priceRange: "€€",
  currenciesAccepted: "EUR",
  paymentAccepted: "Bargeld, Kreditkarte, Überweisung, PayPal",
  openingHours: [
    {
      dayOfWeek: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
      opens: "08:00",
      closes: "17:00"
    },
    {
      dayOfWeek: ["Saturday"],
      opens: "09:00",
      closes: "13:00"
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
};
</script>