<template>
  <div class="lazy-image-container" :style="containerStyle">
    <!-- Placeholder während des Ladens -->
    <div 
      v-if="!loaded && showPlaceholder" 
      class="lazy-image-placeholder"
      :style="{ 
        backgroundColor: placeholderColor,
        aspectRatio: aspectRatio ? aspectRatio : 'auto'
      }"
    ></div>
    
    <!-- Das eigentliche Bild -->
    <img
      :src="src"
      :alt="alt"
      :width="width"
      :height="height"
      :srcset="srcset"
      :sizes="sizes"
      :class="[imageClass, { 'lazy-image-loaded': loaded }]"
      :style="imageStyle"
      loading="lazy"
      decoding="async"
      @load="onImageLoaded"
      @error="onImageError"
    />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
  // Bild-Attribute
  src: {
    type: String,
    required: true
  },
  alt: {
    type: String,
    default: ''
  },
  width: {
    type: [Number, String],
    default: null
  },
  height: {
    type: [Number, String],
    default: null
  },
  srcset: {
    type: String,
    default: ''
  },
  sizes: {
    type: String,
    default: ''
  },
  
  // Styling
  imageClass: {
    type: String,
    default: ''
  },
  imageStyle: {
    type: Object,
    default: () => ({})
  },
  containerStyle: {
    type: Object,
    default: () => ({})
  },
  
  // Placeholder-Optionen
  showPlaceholder: {
    type: Boolean,
    default: true
  },
  placeholderColor: {
    type: String,
    default: '#f3f4f6' // Hellgrau
  },
  aspectRatio: {
    type: String,
    default: null
  },
  
  // Verhalten
  eager: {
    type: Boolean,
    default: false
  }
});

const loaded = ref(false);
const error = ref(false);

// Bild laden, wenn die Komponente gemountet wird
onMounted(() => {
  if (props.eager) {
    const img = new Image();
    img.src = props.src;
    img.onload = onImageLoaded;
    img.onerror = onImageError;
  }
});

// Event-Handler
const onImageLoaded = () => {
  loaded.value = true;
};

const onImageError = () => {
  error.value = true;
  loaded.value = true; // Auch bei Fehler als "geladen" markieren, um Placeholder zu entfernen
};
</script>

<style scoped>
.lazy-image-container {
  position: relative;
  overflow: hidden;
  width: 100%;
}

.lazy-image-placeholder {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  transition: opacity 0.3s ease;
}

img {
  position: relative;
  z-index: 2;
  opacity: 0;
  transition: opacity 0.3s ease;
  width: 100%;
  height: auto;
}

.lazy-image-loaded {
  opacity: 1;
}
</style>