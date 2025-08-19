<template>
  <!-- Diese Komponente rendert kein sichtbares HTML, sondern nur Meta-Tags für Sicherheitsoptimierung -->
</template>

<script setup>
import { onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
  // Sicherheitsoptimierungs-Daten
  data: {
    type: Object,
    default: () => ({
      contentSecurityPolicy: "default-src 'self'; script-src 'self' 'unsafe-eval' https://www.google-analytics.com https://maps.googleapis.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https://www.google-analytics.com https://*.googleapis.com https://*.gstatic.com; connect-src 'self' https://www.google-analytics.com; frame-src 'self' https://www.google.com https://maps.google.com;",
      xContentTypeOptions: "nosniff",
      xFrameOptions: "SAMEORIGIN",
      xXssProtection: "1; mode=block",
      referrerPolicy: "no-referrer-when-downgrade",
      strictTransportSecurity: "max-age=31536000; includeSubDomains",
      featurePolicy: "camera 'none'; microphone 'none'; geolocation 'self'",
      permissionsPolicy: "camera=(), microphone=(), geolocation=(self)"
    })
  }
});

// Erstellt die Sicherheitsoptimierungs-Tags
const createSecurityTags = () => {
  // Bestehende Meta-Tags entfernen
  document.querySelectorAll('meta[data-security]').forEach(el => el.remove());
  
  // Meta-Tags erstellen - X-Frame-Options ausgeschlossen, da es nur über HTTP-Header gesetzt werden kann
  const metaTags = {
    'Content-Security-Policy': props.data.contentSecurityPolicy,
    'X-Content-Type-Options': props.data.xContentTypeOptions,
    // 'X-Frame-Options' entfernt - kann nur über HTTP-Header gesetzt werden
    'X-XSS-Protection': props.data.xXssProtection,
    'Referrer-Policy': props.data.referrerPolicy,
    // 'Strict-Transport-Security' entfernt - sollte nur über HTTP-Header gesetzt werden
    'Feature-Policy': props.data.featurePolicy,
    'Permissions-Policy': props.data.permissionsPolicy
  };
  
  // Meta-Tags hinzufügen
  Object.entries(metaTags).forEach(([name, content]) => {
    if (!content) return;
    
    const meta = document.createElement('meta');
    meta.setAttribute('http-equiv', name);
    meta.setAttribute('content', content);
    meta.setAttribute('data-security', 'true');
    document.head.appendChild(meta);
  });
};

// Erstelle die Meta-Tags beim Mounten
onMounted(() => {
  createSecurityTags();
});

// Entferne die Meta-Tags beim Unmounten
onBeforeUnmount(() => {
  document.querySelectorAll('meta[data-security]').forEach(el => el.remove());
});
</script>