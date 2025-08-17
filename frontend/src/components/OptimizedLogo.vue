<template>
  <div class="optimized-logo-container">
    <img 
      :src="logoSrc"
      :alt="altText"
      :class="logoClasses"
      :style="logoStyles"
      @error="handleImageError"
      @load="handleImageLoad"
    >
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  variant: {
    type: String,
    default: 'default',
    validator: (value) => ['default', 'dark'].includes(value)
  },
  height: {
    type: [String, Number],
    default: 180 // Direkte Pixel-Angabe für maximale Kontrolle
  },
  altText: {
    type: String,
    default: 'Mayer Elektro Logo'
  }
})

const imageLoaded = ref(false)
const imageError = ref(false)

const logoSrc = computed(() => '/logo.png')

const logoClasses = computed(() => {
  const baseClasses = [
    'logo-optimized',
    'object-contain',
    'w-auto',
    'transition-opacity',
    'duration-300'
  ]
  
  if (props.variant === 'dark') {
    baseClasses.push('filter', 'brightness-0', 'invert')
  }
  
  if (!imageLoaded.value) {
    baseClasses.push('opacity-0')
  } else {
    baseClasses.push('opacity-100')
  }
  
  return baseClasses
})

const logoStyles = computed(() => {
  const height = typeof props.height === 'number' ? `${props.height}px` : props.height
  return {
    height,
    maxHeight: height,
    minHeight: height
  }
})

const handleImageLoad = () => {
  imageLoaded.value = true
  imageError.value = false
}

const handleImageError = () => {
  imageError.value = true
  console.warn('Logo konnte nicht geladen werden')
}
</script>

<style scoped>
.optimized-logo-container {
  display: inline-block;
  line-height: 0; /* Verhindert zusätzlichen Whitespace */
}

.logo-optimized {
  /* Maximale Bildqualität */
  image-rendering: -webkit-optimize-contrast;
  image-rendering: -moz-crisp-edges;
  image-rendering: crisp-edges;
  
  /* Für Retina/High-DPI Displays */
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  
  /* Verhindert Unschärfe bei Skalierung */
  image-rendering: pixelated;
  image-rendering: -webkit-crisp-edges;
  
  /* Optimale Darstellung */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  
  /* Verhindert Kompression */
  image-rendering: high-quality;
  
  /* Scharfe Kanten */
  shape-rendering: crispEdges;
  
  /* Maximale Schärfe für SVG und PNG */
  image-rendering: optimizeQuality;
}

/* Spezielle Behandlung für verschiedene Bildformate */
.logo-optimized[src$=".svg"] {
  image-rendering: auto;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
}

.logo-optimized[src$=".png"] {
  image-rendering: -webkit-optimize-contrast;
  image-rendering: crisp-edges;
}

/* Hover-Effekt */
.optimized-logo-container:hover .logo-optimized {
  opacity: 0.8;
  transition: opacity 0.2s ease-in-out;
}

/* Responsive Anpassungen */
@media (max-width: 768px) {
  .logo-optimized {
    max-height: 120px; /* Fallback für sehr kleine Bildschirme */
  }
}

@media (max-width: 480px) {
  .logo-optimized {
    max-height: 100px; /* Noch kleinere Bildschirme */
  }
}

/* High-DPI Display Optimierung */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .logo-optimized {
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
  }
}
</style>