import { onMounted, onBeforeUnmount } from 'vue';

/**
 * Composable für Performance-Optimierung und Tracking von Core Web Vitals
 */
export function usePerformance() {
  let observer = null;

  /**
   * Initialisiert Intersection Observer für Lazy Loading
   * @param {string} selector - CSS-Selektor für zu beobachtende Elemente
   * @param {Function} callback - Callback-Funktion, die aufgerufen wird, wenn ein Element sichtbar wird
   */
  const setupIntersectionObserver = (selector, callback) => {
    if ('IntersectionObserver' in window) {
      const elements = document.querySelectorAll(selector);
      
      observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            callback(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, {
        rootMargin: '200px 0px',
        threshold: 0.01
      });
      
      elements.forEach(element => {
        observer.observe(element);
      });
    } else {
      // Fallback für Browser ohne IntersectionObserver
      const elements = document.querySelectorAll(selector);
      elements.forEach(element => {
        callback(element);
      });
    }
  };

  /**
   * Berichtet Core Web Vitals an Google Analytics (falls vorhanden)
   */
  const reportWebVitals = () => {
    if ('web-vitals' in window) {
      const { getCLS, getFID, getLCP, getFCP, getTTFB } = window['web-vitals'];
      
      getCLS(metric => sendToAnalytics('CLS', metric));
      getFID(metric => sendToAnalytics('FID', metric));
      getLCP(metric => sendToAnalytics('LCP', metric));
      getFCP(metric => sendToAnalytics('FCP', metric));
      getTTFB(metric => sendToAnalytics('TTFB', metric));
    }
  };

  /**
   * Sendet Metriken an Google Analytics
   * @param {string} name - Name der Metrik
   * @param {Object} metric - Metrik-Objekt
   */
  const sendToAnalytics = (name, metric) => {
    if (window.gtag) {
      window.gtag('event', name, {
        value: Math.round(name === 'CLS' ? metric.value * 1000 : metric.value),
        metric_id: metric.id,
        metric_value: metric.value,
        metric_delta: metric.delta,
      });
    }
  };

  /**
   * Optimiert Bilder für bessere Performance
   */
  const optimizeImages = () => {
    setupIntersectionObserver('img[loading="lazy"]', (img) => {
      if (img.dataset.src) {
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
      }
    });
  };

  /**
   * Optimiert Iframes für bessere Performance
   */
  const optimizeIframes = () => {
    setupIntersectionObserver('iframe[loading="lazy"]', (iframe) => {
      if (iframe.dataset.src) {
        iframe.src = iframe.dataset.src;
        iframe.removeAttribute('data-src');
      }
    });
  };

  /**
   * Optimiert Schriftarten für bessere Performance
   */
  const optimizeFonts = () => {
    // Fügt Font Display Swap für bessere Schriftart-Ladeleistung hinzu
    if (document.fonts && document.fonts.ready) {
      document.fonts.ready.then(() => {
        document.documentElement.classList.add('fonts-loaded');
      });
    } else {
      // Fallback für ältere Browser
      setTimeout(() => {
        document.documentElement.classList.add('fonts-loaded');
      }, 2000);
    }
  };

  onMounted(() => {
    // Optimierungen anwenden
    optimizeImages();
    optimizeIframes();
    optimizeFonts();
    
    // Web Vitals melden
    reportWebVitals();
  });

  onBeforeUnmount(() => {
    // Cleanup
    if (observer) {
      observer.disconnect();
    }
  });

  return {
    setupIntersectionObserver,
    reportWebVitals,
    optimizeImages,
    optimizeIframes,
    optimizeFonts
  };
}