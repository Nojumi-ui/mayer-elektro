<template>
  <section class="py-20 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-gray-200 mb-6">{{ t('testimonials.title') }}</h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
          {{ t('testimonials.subtitle') }}
        </p>
      </div>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div 
          v-for="(testimonial, index) in testimonials" 
          :key="index"
          class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-8 relative"
        >
          <!-- Quote Icon -->
          <div class="absolute top-6 right-8 text-[#0097b2] opacity-20">
            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
              <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
            </svg>
          </div>
          
          <!-- Testimonial Content -->
          <div class="mb-6">
            <p class="text-gray-600 dark:text-gray-300 italic">{{ testimonial.content }}</p>
          </div>
          
          <!-- Author Info -->
          <div class="flex items-center">
            <div 
              v-if="testimonial.avatar" 
              class="w-12 h-12 rounded-full overflow-hidden mr-4"
            >
              <img 
                :src="testimonial.avatar" 
                :alt="`Foto von ${testimonial.name}`"
                class="w-full h-full object-cover"
                loading="lazy"
              />
            </div>
            <div v-else class="w-12 h-12 rounded-full bg-[#0097b2] flex items-center justify-center text-white mr-4">
              <span class="text-lg font-bold">{{ testimonial.name.charAt(0) }}</span>
            </div>
            
            <div>
              <h3 class="font-semibold text-gray-800 dark:text-white">{{ testimonial.name }}</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">{{ testimonial.position }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Strukturierte Daten für SEO -->
    <StructuredData :data="reviewSchema" />
    <ReviewSchema :reviews="reviewsForSchema" />
  </section>
</template>

<script setup>
import { computed } from 'vue';
import { useI18n } from 'vue-i18n';
import StructuredData from './StructuredData.vue';
import ReviewSchema from './ReviewSchema.vue';

const { t } = useI18n();

const props = defineProps({
  testimonials: {
    type: Array,
    required: false,
    default: () => []
  }
});

// Testimonials aus Übersetzungen laden
const testimonials = computed(() => {
  if (props.testimonials.length > 0) {
    return props.testimonials;
  }
  
  return [
    {
      content: t('testimonials.testimonial1.content'),
      name: t('testimonials.testimonial1.name'),
      position: t('testimonials.testimonial1.company'),
      rating: 5
    },
    {
      content: t('testimonials.testimonial2.content'),
      name: t('testimonials.testimonial2.name'),
      position: t('testimonials.testimonial2.company'),
      rating: 5
    },
    {
      content: t('testimonials.testimonial3.content'),
      name: t('testimonials.testimonial3.name'),
      position: t('testimonials.testimonial3.company'),
      rating: 5
    }
  ];
});

// Strukturierte Daten für Reviews (altes Format)
const reviewSchema = computed(() => {
  return {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Mayer Elektro- und Gebäudetechnik GmbH",
    "review": testimonials.value.map(testimonial => ({
      "@type": "Review",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": testimonial.rating || 5,
        "bestRating": 5
      },
      "author": {
        "@type": "Person",
        "name": testimonial.name
      },
      "reviewBody": testimonial.content
    }))
  };
});

// Bewertungen für das neue ReviewSchema-Format
const reviewsForSchema = computed(() => {
  return testimonials.value.map(testimonial => ({
    author: testimonial.name,
    reviewBody: testimonial.content,
    ratingValue: testimonial.rating || 5,
    datePublished: testimonial.date || new Date().toISOString().split('T')[0],
    name: `Bewertung von ${testimonial.name}`
  }));
});

// Aggregierte Bewertung
const aggregateRating = computed(() => {
  const totalRating = testimonials.value.reduce((sum, testimonial) => sum + (testimonial.rating || 5), 0);
  const avgRating = totalRating / testimonials.value.length;
  
  return {
    ratingValue: parseFloat(avgRating.toFixed(1)),
    reviewCount: testimonials.value.length,
    bestRating: 5,
    worstRating: 1
  };
});
</script>