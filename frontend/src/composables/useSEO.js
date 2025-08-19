import { onMounted, onBeforeUnmount, watch } from 'vue';
import { useRoute } from 'vue-router';

/**
 * Composable für SEO-Optimierungen
 * @param {Object} options - Konfigurationsoptionen
 * @returns {Object} - SEO-Hilfsfunktionen
 */
export function useSEO(options = {}) {
  const route = useRoute();
  
  // Standard-Optionen
  const defaultOptions = {
    siteName: 'Mayer Elektro - Elektroinstallation & Gebäudetechnik Hamburg',
    titleTemplate: '%s | Mayer Elektro',
    defaultTitle: 'Mayer Elektro - Elektroinstallation & Gebäudetechnik Hamburg',
    defaultDescription: 'Mayer Elektro in Hamburg bietet professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen. Zuverlässig und regional seit über 15 Jahren.',
    defaultKeywords: 'Elektroinstallation Hamburg, Gebäudetechnik, Automatisierung, Elektrofachkräfte, Elektrotechnik, Instandhaltung, Elektroinstallateur',
    defaultImage: 'https://www.mayerelektro.de/logo.png',
    defaultLocale: 'de_DE',
    defaultType: 'website',
    twitterHandle: '@mayerelektro',
    twitterCardType: 'summary_large_image'
  };
  
  // Optionen zusammenführen
  const seoOptions = { ...defaultOptions, ...options };
  
  /**
   * Setzt den Seitentitel
   * @param {string} title - Der Seitentitel
   */
  const setTitle = (title) => {
    const formattedTitle = title 
      ? seoOptions.titleTemplate.replace('%s', title)
      : seoOptions.defaultTitle;
    
    document.title = formattedTitle;
  };
  
  /**
   * Setzt Meta-Tags
   * @param {Object} tags - Die zu setzenden Meta-Tags
   */
  const setMetaTags = (tags = {}) => {
    // Standard-Tags
    const metaTags = {
      description: tags.description || seoOptions.defaultDescription,
      keywords: tags.keywords || seoOptions.defaultKeywords,
      
      // Open Graph
      'og:title': tags.title 
        ? seoOptions.titleTemplate.replace('%s', tags.title)
        : seoOptions.defaultTitle,
      'og:description': tags.description || seoOptions.defaultDescription,
      'og:image': tags.image || seoOptions.defaultImage,
      'og:url': tags.url || window.location.href,
      'og:type': tags.type || seoOptions.defaultType,
      'og:site_name': seoOptions.siteName,
      'og:locale': tags.locale || seoOptions.defaultLocale,
      
      // Twitter
      'twitter:card': tags.twitterCardType || seoOptions.twitterCardType,
      'twitter:site': seoOptions.twitterHandle,
      'twitter:title': tags.title 
        ? seoOptions.titleTemplate.replace('%s', tags.title)
        : seoOptions.defaultTitle,
      'twitter:description': tags.description || seoOptions.defaultDescription,
      'twitter:image': tags.image || seoOptions.defaultImage,
      
      // Canonical URL
      canonical: tags.canonical || window.location.href
    };
    
    // Bestehende Meta-Tags entfernen
    document.querySelectorAll('meta[data-vue-seo]').forEach(el => el.remove());
    
    // Neue Meta-Tags hinzufügen
    Object.entries(metaTags).forEach(([name, content]) => {
      if (!content) return;
      
      let meta;
      
      if (name === 'canonical') {
        // Canonical Link-Tag
        let link = document.querySelector('link[rel="canonical"]');
        
        if (!link) {
          link = document.createElement('link');
          link.setAttribute('rel', 'canonical');
          link.setAttribute('data-vue-seo', 'true');
          document.head.appendChild(link);
        }
        
        link.setAttribute('href', content);
      } else if (name.startsWith('og:')) {
        // Open Graph Meta-Tag
        meta = document.createElement('meta');
        meta.setAttribute('property', name);
        meta.setAttribute('content', content);
        meta.setAttribute('data-vue-seo', 'true');
        document.head.appendChild(meta);
      } else if (name.startsWith('twitter:')) {
        // Twitter Meta-Tag
        meta = document.createElement('meta');
        meta.setAttribute('name', name);
        meta.setAttribute('content', content);
        meta.setAttribute('data-vue-seo', 'true');
        document.head.appendChild(meta);
      } else {
        // Standard Meta-Tag
        meta = document.createElement('meta');
        meta.setAttribute('name', name);
        meta.setAttribute('content', content);
        meta.setAttribute('data-vue-seo', 'true');
        document.head.appendChild(meta);
      }
    });
  };
  
  /**
   * Setzt strukturierte Daten (JSON-LD)
   * @param {Object} data - Die strukturierten Daten
   * @param {string} id - ID für das Script-Tag
   */
  const setStructuredData = (data, id = 'structured-data') => {
    // Bestehende strukturierte Daten entfernen
    const existingScript = document.getElementById(id);
    if (existingScript) {
      existingScript.remove();
    }
    
    // Neue strukturierte Daten hinzufügen
    if (data) {
      const script = document.createElement('script');
      script.setAttribute('type', 'application/ld+json');
      script.setAttribute('id', id);
      script.textContent = JSON.stringify(data);
      document.head.appendChild(script);
    }
  };
  
  /**
   * Aktualisiert alle SEO-Informationen
   * @param {Object} seoData - Die SEO-Daten
   */
  const updateSEO = (seoData = {}) => {
    setTitle(seoData.title);
    setMetaTags(seoData);
    
    if (seoData.structuredData) {
      setStructuredData(seoData.structuredData);
    }
  };
  
  // Routenänderungen überwachen
  watch(() => route.path, () => {
    // Hier könnten Sie routenspezifische SEO-Daten laden
    // Beispiel: updateSEO(getSEODataForRoute(route.path));
  });
  
  onMounted(() => {
    // Initialisierung
    if (options.initialData) {
      updateSEO(options.initialData);
    }
  });
  
  onBeforeUnmount(() => {
    // Aufräumen
    document.querySelectorAll('meta[data-vue-seo]').forEach(el => el.remove());
    document.querySelectorAll('script[id^="structured-data"]').forEach(el => el.remove());
  });
  
  return {
    setTitle,
    setMetaTags,
    setStructuredData,
    updateSEO
  };
}