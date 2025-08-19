<template>
  <nav class="site-navigation py-8 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Seitennavigation</h2>
      
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Hauptseiten -->
        <div>
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Hauptseiten</h3>
          <ul class="space-y-2">
            <li v-for="(link, index) in mainLinks" :key="`main-${index}`">
              <router-link 
                :to="link.to" 
                class="text-gray-600 dark:text-gray-400 hover:text-[#0097b2] dark:hover:text-[#0097b2] transition"
              >
                {{ link.text }}
              </router-link>
            </li>
          </ul>
        </div>
        
        <!-- Dienstleistungen -->
        <div>
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Unsere Dienstleistungen</h3>
          <ul class="space-y-2">
            <li v-for="(link, index) in serviceLinks" :key="`service-${index}`">
              <a 
                :href="link.to" 
                class="text-gray-600 dark:text-gray-400 hover:text-[#0097b2] dark:hover:text-[#0097b2] transition"
              >
                {{ link.text }}
              </a>
            </li>
          </ul>
        </div>
        
        <!-- Rechtliches -->
        <div>
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Rechtliches</h3>
          <ul class="space-y-2">
            <li v-for="(link, index) in legalLinks" :key="`legal-${index}`">
              <router-link 
                :to="link.to" 
                class="text-gray-600 dark:text-gray-400 hover:text-[#0097b2] dark:hover:text-[#0097b2] transition"
              >
                {{ link.text }}
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
    
    <!-- Strukturierte Daten für SEO -->
    <StructuredData :data="siteNavigationSchema" />
  </nav>
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

// Hauptseiten-Links
const mainLinks = [
  { text: 'Startseite', to: '/' },
  { text: 'Für Bewerber', to: '/#bewerber' },
  { text: 'Für Kunden', to: '/#kunden' },
  { text: 'News', to: '/#news' },
  { text: 'Kontakt', to: '/#contact' }
];

// Dienstleistungs-Links
const serviceLinks = [
  { text: 'Elektroinstallation', to: '/#elektroinstallation' },
  { text: 'Gebäudeautomation', to: '/#automation' },
  { text: 'Photovoltaik', to: '/#photovoltaik' },
  { text: 'Instandhaltung', to: '/#instandhaltung' },
  { text: 'Personaldienstleistungen', to: '/#personaldienstleistungen' }
];

// Rechtliche Links
const legalLinks = [
  { text: 'Impressum', to: '/impressum' },
  { text: 'Datenschutz', to: '/datenschutz' },
  { text: 'AGB', to: '/agb' }
];

// Strukturierte Daten für die Seitennavigation
const siteNavigationSchema = computed(() => {
  return {
    "@context": "https://schema.org",
    "@type": "SiteNavigationElement",
    "name": "Hauptnavigation",
    "hasPart": [
      ...mainLinks.map(link => ({
        "@type": "SiteNavigationElement",
        "name": link.text,
        "url": `https://www.mayerelektro.de${link.to}`
      })),
      ...serviceLinks.map(link => ({
        "@type": "SiteNavigationElement",
        "name": link.text,
        "url": `https://www.mayerelektro.de${link.to}`
      })),
      ...legalLinks.map(link => ({
        "@type": "SiteNavigationElement",
        "name": link.text,
        "url": `https://www.mayerelektro.de${link.to}`
      }))
    ]
  };
});
</script>