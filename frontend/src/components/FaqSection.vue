<template>
  <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
    <div class="max-w-4xl mx-auto px-6">
      <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">{{ t('faq.title') }}</h2>
      
      <div class="space-y-6">
        <div 
          v-for="(faq, index) in faqs" 
          :key="index"
          class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden"
        >
          <button 
            @click="toggleFaq(index)"
            class="w-full px-6 py-4 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-[#0097b2] focus:ring-opacity-50"
            :aria-expanded="openIndex === index"
            :aria-controls="`faq-content-${index}`"
          >
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ faq.question }}</h3>
            <svg 
              class="w-5 h-5 text-gray-500 dark:text-gray-300 transition-transform duration-200"
              :class="{ 'transform rotate-180': openIndex === index }"
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          
          <div 
            v-show="openIndex === index"
            :id="`faq-content-${index}`"
            class="px-6 pb-4 pt-3"
          >
            <p class="text-gray-600 dark:text-gray-300">{{ faq.answer }}</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Strukturierte Daten für SEO -->
    <StructuredData :data="faqSchema" />
  </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useI18n } from 'vue-i18n';
import StructuredData from './StructuredData.vue';

const { t } = useI18n();

const props = defineProps({
  faqs: {
    type: Array,
    required: false,
    default: () => []
  }
});

// FAQs aus Übersetzungen laden
const faqs = computed(() => {
  if (props.faqs.length > 0) {
    return props.faqs;
  }
  
  return t('faq.questions');
});

// State für das aktuell geöffnete FAQ-Element
const openIndex = ref(null);

// Toggle-Funktion für FAQ-Elemente
const toggleFaq = (index) => {
  if (openIndex.value === index) {
    openIndex.value = null;
  } else {
    openIndex.value = index;
  }
};

// Strukturierte Daten für FAQPage
const faqSchema = computed(() => {
  return {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": faqs.value.map(faq => ({
      "@type": "Question",
      "name": faq.question,
      "acceptedAnswer": {
        "@type": "Answer",
        "text": faq.answer
      }
    }))
  };
});
</script>