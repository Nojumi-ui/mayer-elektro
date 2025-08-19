<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur strukturierte Daten für SEO -->
</template>

<script setup>
import { computed, onMounted, onBeforeUnmount, watch } from 'vue';
import { useRoute } from 'vue-router';

const props = defineProps({
  // Basis-URL der Website
  baseUrl: {
    type: String,
    default: 'https://www.mayerelektro.de'
  },
  // Breadcrumb-Items
  items: {
    type: Array,
    default: () => []
  },
  // Automatisch generieren basierend auf der Route
  autoGenerate: {
    type: Boolean,
    default: true
  },
  // Routenname zu Breadcrumb-Mapping
  routeMapping: {
    type: Object,
    default: () => ({
      'home': 'Startseite',
      'impressum': 'Impressum',
      'datenschutz': 'Datenschutz',
      'agb': 'AGB',
      'bewerbungsformular': 'Bewerbungsformular',
      'kontakt': 'Kontakt'
    })
  }
});

const route = useRoute();

// Generiert Breadcrumbs basierend auf der aktuellen Route
const generateBreadcrumbs = () => {
  const breadcrumbs = [
    {
      name: 'Startseite',
      item: props.baseUrl
    }
  ];
  
  // Wenn wir auf der Startseite sind, nur die Startseite zurückgeben
  if (route.path === '/') {
    return breadcrumbs;
  }
  
  // Route in Segmente aufteilen
  const segments = route.path.split('/').filter(segment => segment);
  
  // Pfad aufbauen und für jedes Segment einen Breadcrumb erstellen
  let currentPath = '';
  segments.forEach((segment, index) => {
    currentPath += `/${segment}`;
    
    // Name für das Segment ermitteln
    let name = props.routeMapping[segment] || segment.charAt(0).toUpperCase() + segment.slice(1);
    
    // Wenn es ein Hash in der Route gibt, diesen als letzten Breadcrumb hinzufügen
    if (index === segments.length - 1 && route.hash) {
      breadcrumbs.push({
        name: name,
        item: `${props.baseUrl}${currentPath}`
      });
      
      // Hash ohne # extrahieren
      const hashSegment = route.hash.substring(1);
      name = props.routeMapping[hashSegment] || hashSegment.charAt(0).toUpperCase() + hashSegment.slice(1);
      
      breadcrumbs.push({
        name: name,
        item: `${props.baseUrl}${currentPath}${route.hash}`
      });
    } else {
      breadcrumbs.push({
        name: name,
        item: `${props.baseUrl}${currentPath}`
      });
    }
  });
  
  return breadcrumbs;
};

// Breadcrumbs basierend auf Props oder generiert
const breadcrumbs = computed(() => {
  if (props.items.length > 0) {
    return props.items;
  }
  
  if (props.autoGenerate) {
    return generateBreadcrumbs();
  }
  
  return [];
});

// Strukturierte Daten für Breadcrumbs
const breadcrumbSchema = computed(() => {
  return {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": breadcrumbs.value.map((breadcrumb, index) => ({
      "@type": "ListItem",
      "position": index + 1,
      "name": breadcrumb.name,
      "item": breadcrumb.item
    }))
  };
});

// Erstellt die strukturierten Daten
const createBreadcrumbSchema = () => {
  // Bestehende strukturierte Daten entfernen
  const existingScript = document.getElementById('breadcrumb-schema');
  if (existingScript) {
    existingScript.remove();
  }
  
  // Neue strukturierte Daten hinzufügen
  const script = document.createElement('script');
  script.setAttribute('type', 'application/ld+json');
  script.setAttribute('id', 'breadcrumb-schema');
  script.textContent = JSON.stringify(breadcrumbSchema.value);
  document.head.appendChild(script);
};

// Aktualisiere die strukturierten Daten bei Routenänderungen
watch(() => route.path, () => {
  if (props.autoGenerate) {
    createBreadcrumbSchema();
  }
});

// Erstelle die strukturierten Daten beim Mounten
onMounted(() => {
  createBreadcrumbSchema();
});

// Entferne die strukturierten Daten beim Unmounten
onBeforeUnmount(() => {
  const existingScript = document.getElementById('breadcrumb-schema');
  if (existingScript) {
    existingScript.remove();
  }
});
</script>