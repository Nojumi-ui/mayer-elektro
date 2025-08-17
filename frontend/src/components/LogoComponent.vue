<template>
  <div class="logo-container">
    <!-- Standard Logo für helle Hintergründe -->
    <img 
      v-if="variant === 'default'"
      src="/logo.png" 
      :alt="altText"
      :class="logoClasses"
      @error="handleImageError"
    >
    
    <!-- Logo für dunkle Hintergründe (invertiert) -->
    <img 
      v-else-if="variant === 'dark'"
      src="/logo.png" 
      :alt="altText"
      :class="[logoClasses, 'filter brightness-0 invert']"
      @error="handleImageError"
    >
    
    <!-- Fallback Logo (SVG) falls Bild nicht lädt -->
    <div 
      v-else-if="variant === 'fallback'"
      :class="[fallbackClasses, 'bg-gradient-to-r from-cyan-600 to-[#0097b2] rounded-lg flex items-center justify-center']"
    >
      <svg class="text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
      </svg>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  variant: {
    type: String,
    default: 'default', // 'default', 'dark', 'fallback'
    validator: (value) => ['default', 'dark', 'fallback'].includes(value)
  },
  size: {
    type: String,
    default: 'medium', // 'small', 'medium', 'large', 'xl', 'xxl', 'xxxl'
    validator: (value) => ['small', 'medium', 'large', 'xl', 'xxl', 'xxxl'].includes(value)
  },
  altText: {
    type: String,
    default: 'Mayer Elektro Logo'
  }
})

const imageError = ref(false)

const logoClasses = computed(() => {
  const baseClasses = 'object-contain'
  const sizeClasses = {
    small: 'h-12 w-auto',      // 48px
    medium: 'h-20 w-auto',     // 80px
    large: 'h-28 w-auto',      // 112px
    xl: 'h-36 w-auto',         // 144px
    xxl: 'h-44 w-auto',        // 176px
    xxxl: 'h-52 w-auto'        // 208px
  }
  
  return [baseClasses, sizeClasses[props.size]]
})

const fallbackClasses = computed(() => {
  const sizeClasses = {
    small: 'w-12 h-12',
    medium: 'w-20 h-20', 
    large: 'w-28 h-28',
    xl: 'w-36 h-36',
    xxl: 'w-44 h-44',
    xxxl: 'w-52 h-52'
  }
  
  const iconSizes = {
    small: 'w-6 h-6',
    medium: 'w-10 h-10',
    large: 'w-14 h-14',
    xl: 'w-18 h-18',
    xxl: 'w-22 h-22',
    xxxl: 'w-26 h-26'
  }
  
  return [sizeClasses[props.size], `icon-${iconSizes[props.size]}`]
})

const handleImageError = () => {
  imageError.value = true
  // Hier könnten Sie ein Event emittieren oder eine Fallback-Logik implementieren
  console.warn('Logo konnte nicht geladen werden, verwende Fallback')
}
</script>

<style scoped>
.logo-container {
  display: inline-block;
}

/* Responsive Anpassungen */
@media (max-width: 640px) {
  .logo-container img {
    max-height: 2.5rem; /* 10 auf Mobile */
  }
}

/* Hover-Effekte */
.logo-container:hover img {
  transition: opacity 0.2s ease-in-out;
}

/* Optimierung für verschiedene Logo-Typen */
.logo-container img {
  /* Für Logos mit transparentem Hintergrund */
  background: transparent;
  
  /* Für schärfere Darstellung - wichtig für Logo-Qualität */
  image-rendering: -webkit-optimize-contrast;
  image-rendering: -moz-crisp-edges;
  image-rendering: crisp-edges;
  image-rendering: pixelated;
  
  /* Bessere Skalierung */
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  
  /* Anti-Aliasing für bessere Qualität */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  
  /* Maximale Schärfe */
  image-rendering: high-quality;
  image-rendering: -webkit-crisp-edges;
}

/* Dark Mode Unterstützung */
@media (prefers-color-scheme: dark) {
  .logo-container.auto-invert img {
    filter: brightness(0) invert(1);
  }
}
</style>