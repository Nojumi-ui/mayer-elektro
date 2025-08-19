<template>
  <nav aria-label="Breadcrumb" class="py-3 px-6 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
    <ol class="flex flex-wrap items-center text-sm text-gray-600 dark:text-gray-400">
      <li class="flex items-center">
        <router-link to="/" class="flex items-center hover:text-[#0097b2] transition" aria-label="Zur Startseite">
          <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          <span>Startseite</span>
        </router-link>
      </li>
      
      <li v-for="(item, index) in items" :key="index" class="flex items-center">
        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        
        <template v-if="index === items.length - 1">
          <span class="font-medium text-gray-800 dark:text-gray-200" aria-current="page">{{ item.text }}</span>
        </template>
        <template v-else>
          <router-link :to="item.to" class="hover:text-[#0097b2] transition">
            {{ item.text }}
          </router-link>
        </template>
      </li>
    </ol>
    
    <!-- Strukturierte Daten für SEO -->
    <StructuredData :data="breadcrumbSchema" />
  </nav>
</template>

<script setup>
import { computed } from 'vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  items: {
    type: Array,
    required: true,
    validator: (items) => {
      return items.every(item => 'text' in item && ('to' in item || items.indexOf(item) === items.length - 1));
    }
  }
});

// Strukturierte Daten für Breadcrumbs
const breadcrumbSchema = computed(() => {
  return {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "name": "Startseite",
        "item": "https://www.mayerelektro.de/"
      },
      ...props.items.map((item, index) => ({
        "@type": "ListItem",
        "position": index + 2,
        "name": item.text,
        "item": item.to ? `https://www.mayerelektro.de${item.to}` : undefined
      }))
    ]
  };
});
</script>