<template>
  <div class="image-gallery">
    <h2 v-if="title" class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">{{ title }}</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div 
        v-for="(image, index) in images" 
        :key="index"
        class="gallery-item overflow-hidden rounded-lg shadow-lg bg-white dark:bg-gray-800 cursor-pointer"
        @click="openLightbox(index)"
      >
        <div class="aspect-w-16 aspect-h-9 overflow-hidden">
          <OptimizedImage
            :src="image.src"
            :webp-src="image.webpSrc || ''"
            :alt="image.alt || 'Galeriebild'"
            :width="image.width || 640"
            :height="image.height || 360"
            img-class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
          />
        </div>
        <div v-if="image.caption" class="p-4">
          <p class="text-gray-700 dark:text-gray-300">{{ image.caption }}</p>
        </div>
      </div>
    </div>
    
    <!-- Lightbox -->
    <div 
      v-if="lightboxOpen" 
      class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center"
      @click="closeLightbox"
    >
      <div class="relative max-w-6xl w-full max-h-screen p-4">
        <!-- Schließen-Button -->
        <button 
          class="absolute top-4 right-4 text-white hover:text-gray-300 z-10"
          @click.stop="closeLightbox"
          aria-label="Galerie schließen"
        >
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
        
        <!-- Navigation -->
        <button 
          v-if="images.length > 1"
          class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-10"
          @click.stop="prevImage"
          aria-label="Vorheriges Bild"
        >
          <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>
        
        <button 
          v-if="images.length > 1"
          class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-10"
          @click.stop="nextImage"
          aria-label="Nächstes Bild"
        >
          <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
        
        <!-- Bild -->
        <div class="h-full flex flex-col items-center justify-center">
          <img 
            :src="currentImage.src" 
            :alt="currentImage.alt || 'Galeriebild'"
            class="max-h-[80vh] max-w-full object-contain"
            @click.stop
          />
          
          <div v-if="currentImage.caption" class="mt-4 text-white text-center max-w-2xl">
            <p>{{ currentImage.caption }}</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Strukturierte Daten für SEO -->
    <StructuredData :data="imageGallerySchema" />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import OptimizedImage from './OptimizedImage.vue';
import StructuredData from './StructuredData.vue';

const props = defineProps({
  title: {
    type: String,
    default: ''
  },
  images: {
    type: Array,
    required: true,
    validator: (images) => {
      return images.every(image => 'src' in image);
    }
  },
  galleryName: {
    type: String,
    default: 'Bildergalerie'
  }
});

// Lightbox-Status
const lightboxOpen = ref(false);
const currentIndex = ref(0);

// Aktuelles Bild
const currentImage = computed(() => {
  return props.images[currentIndex.value] || {};
});

// Lightbox öffnen
const openLightbox = (index) => {
  currentIndex.value = index;
  lightboxOpen.value = true;
  document.body.style.overflow = 'hidden'; // Scrolling verhindern
};

// Lightbox schließen
const closeLightbox = () => {
  lightboxOpen.value = false;
  document.body.style.overflow = ''; // Scrolling wieder erlauben
};

// Navigation
const nextImage = () => {
  currentIndex.value = (currentIndex.value + 1) % props.images.length;
};

const prevImage = () => {
  currentIndex.value = (currentIndex.value - 1 + props.images.length) % props.images.length;
};

// Strukturierte Daten für die Bildergalerie
const imageGallerySchema = computed(() => {
  return {
    "@context": "https://schema.org",
    "@type": "ImageGallery",
    "name": props.galleryName || props.title || "Bildergalerie",
    "description": `Bildergalerie von ${props.galleryName || "Mayer Elektro"}`,
    "image": props.images.map(image => ({
      "@type": "ImageObject",
      "contentUrl": image.src,
      "name": image.alt || "Galeriebild",
      "description": image.caption || ""
    }))
  };
});
</script>