<template>
  <!-- Diese Komponente rendert kein sichtbares HTML -->
</template>

<script setup>
import { onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
  // JSON-LD Daten als String oder Objekt
  data: {
    type: [Object, String],
    required: true
  },
  // Eindeutige ID für das Script-Element
  id: {
    type: String,
    default: () => `structured-data-${Math.random().toString(36).substring(2, 9)}`
  }
});

// Script-Element erstellen und in den Head einfügen
onMounted(() => {
  const script = document.createElement('script');
  script.setAttribute('id', props.id);
  script.setAttribute('type', 'application/ld+json');
  
  // Daten als JSON-String setzen
  script.textContent = typeof props.data === 'string' 
    ? props.data 
    : JSON.stringify(props.data);
  
  // Script zum Head hinzufügen
  document.head.appendChild(script);
});

// Script-Element entfernen, wenn die Komponente zerstört wird
onBeforeUnmount(() => {
  const script = document.getElementById(props.id);
  if (script) {
    document.head.removeChild(script);
  }
});
</script>