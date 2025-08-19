<template>
  <picture>
    <!-- WebP-Format für Browser mit Unterstützung -->
    <source
      v-if="webpSrc"
      :srcset="webpSrcset || webpSrc"
      :sizes="sizes"
      type="image/webp"
    />
    
    <!-- Fallback für Browser ohne WebP-Unterstützung -->
    <source
      :srcset="srcset || src"
      :sizes="sizes"
      :type="`image/${getImageType(src)}`"
    />
    
    <!-- Das eigentliche Bild-Element -->
    <img
      :src="src"
      :alt="alt"
      :width="width"
      :height="height"
      :loading="loading"
      :decoding="decoding"
      :class="imgClass"
      :style="imgStyle"
      @load="$emit('load', $event)"
      @error="$emit('error', $event)"
    />
  </picture>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  // Bild-Quellen
  src: {
    type: String,
    required: true
  },
  webpSrc: {
    type: String,
    default: ''
  },
  srcset: {
    type: String,
    default: ''
  },
  webpSrcset: {
    type: String,
    default: ''
  },
  sizes: {
    type: String,
    default: ''
  },
  
  // Bild-Attribute
  alt: {
    type: String,
    required: true
  },
  width: {
    type: [Number, String],
    default: null
  },
  height: {
    type: [Number, String],
    default: null
  },
  loading: {
    type: String,
    default: 'lazy',
    validator: (value) => ['lazy', 'eager', 'auto'].includes(value)
  },
  decoding: {
    type: String,
    default: 'async',
    validator: (value) => ['async', 'sync', 'auto'].includes(value)
  },
  
  // Styling
  imgClass: {
    type: String,
    default: ''
  },
  imgStyle: {
    type: Object,
    default: () => ({})
  }
});

// Bestimme den Bildtyp aus der Dateiendung
const getImageType = (src) => {
  if (!src) return 'jpeg';
  
  const extension = src.split('.').pop().toLowerCase();
  
  switch (extension) {
    case 'jpg':
    case 'jpeg':
      return 'jpeg';
    case 'png':
      return 'png';
    case 'gif':
      return 'gif';
    case 'svg':
      return 'svg+xml';
    default:
      return 'jpeg';
  }
};

// Definiere Emits
defineEmits(['load', 'error']);
</script>