<template>
  <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
    <div class="max-w-4xl mx-auto px-6">
      <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">{{ t('faq.title') }}</h2>
      
      <div class="space-y-6">
        <div 
          v-for="(faq, index) in faqQuestions" 
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

const { t, locale } = useI18n();

const props = defineProps({
  faqs: {
    type: Array,
    required: false,
    default: () => []
  }
});

// Hardcoded FAQs für beide Sprachen als Fallback
const hardcodedFaqs = {
  de: [
    {
      question: "Welche Leistungen bietet Mayer Elektro an?",
      answer: "Wir bieten ein umfassendes Spektrum an Elektrodienstleistungen: Elektroinstallationen für Wohn- und Gewerbegebäude, Automatisierungstechnik, Instandhaltung, Smart Home Systeme, Photovoltaik-Anlagen und Personaldienstleistungen."
    },
    {
      question: "Bieten Sie auch einen Notdienst an?",
      answer: "Ja, wir bieten einen 24/7 Notdienst für elektrische Störungen und Ausfälle. Rufen Sie uns jederzeit unter +49 (0) 40 123 456 789 an."
    },
    {
      question: "In welchen Gebieten sind Sie tätig?",
      answer: "Wir sind hauptsächlich in Hamburg und Umgebung tätig. Für größere Projekte arbeiten wir auch in ganz Norddeutschland."
    },
    {
      question: "Wie kann ich einen Kostenvoranschlag erhalten?",
      answer: "Kontaktieren Sie uns telefonisch, per E-Mail oder über unser Kontaktformular. Wir erstellen Ihnen gerne einen kostenlosen und unverbindlichen Kostenvoranschlag."
    },
    {
      question: "Sind Sie für Photovoltaik-Anlagen zertifiziert?",
      answer: "Ja, unser Team ist für die Installation und Wartung von Photovoltaik-Anlagen zertifiziert. Wir beraten Sie gerne zu nachhaltigen Energielösungen."
    }
  ],
  en: [
    {
      question: "What services does Mayer Elektro offer?",
      answer: "We offer a comprehensive range of electrical services: electrical installations for residential and commercial buildings, automation technology, maintenance, smart home systems, photovoltaic systems, and personnel services."
    },
    {
      question: "Do you also offer emergency services?",
      answer: "Yes, we offer 24/7 emergency service for electrical faults and outages. Call us anytime at +49 (0) 40 123 456 789."
    },
    {
      question: "In which areas do you operate?",
      answer: "We mainly operate in Hamburg and surrounding areas. For larger projects, we also work throughout Northern Germany."
    },
    {
      question: "How can I get a cost estimate?",
      answer: "Contact us by phone, email, or through our contact form. We'll be happy to provide you with a free and non-binding cost estimate."
    },
    {
      question: "Are you certified for photovoltaic systems?",
      answer: "Yes, our team is certified for the installation and maintenance of photovoltaic systems. We're happy to advise you on sustainable energy solutions."
    }
  ]
};

// FAQ-Fragen basierend auf aktueller Sprache
const faqQuestions = computed(() => {
  console.log('=== FAQ DEBUG ===');
  console.log('Current locale:', locale.value);
  console.log('Props faqs length:', props.faqs.length);
  
  if (props.faqs.length > 0) {
    console.log('Using props faqs:', props.faqs);
    return props.faqs;
  }
  
  // Verwende hardcoded FAQs basierend auf aktueller Sprache
  const currentLocale = locale.value;
  const selectedFaqs = hardcodedFaqs[currentLocale] || hardcodedFaqs.de;
  console.log('Using hardcoded faqs for locale:', currentLocale);
  console.log('Selected faqs:', selectedFaqs);
  
  return selectedFaqs;
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
    "mainEntity": faqQuestions.value.map(faq => ({
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