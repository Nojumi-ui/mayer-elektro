/**
 * Composable für die Bildoptimierung
 * Bietet Funktionen zur Verbesserung der Bildleistung und SEO
 */

export function useImageOptimization() {
  /**
   * Generiert ein srcset für responsive Bilder
   * @param {string} basePath - Der Basispfad des Bildes
   * @param {string} extension - Die Dateierweiterung des Bildes
   * @param {Array} sizes - Array mit Bildgrößen
   * @returns {string} Das generierte srcset
   */
  const generateSrcSet = (basePath, extension, sizes = [320, 640, 960, 1280, 1920]) => {
    return sizes
      .map(size => `${basePath}-${size}w.${extension} ${size}w`)
      .join(', ');
  };

  /**
   * Generiert ein sizes-Attribut für responsive Bilder
   * @param {Object} options - Konfigurationsoptionen
   * @returns {string} Das generierte sizes-Attribut
   */
  const generateSizes = (options = {}) => {
    const { 
      sm = '100vw', 
      md = '50vw', 
      lg = '33vw', 
      xl = '25vw',
      default: defaultSize = '100vw'
    } = options;

    return `
      (max-width: 640px) ${sm},
      (max-width: 768px) ${md},
      (max-width: 1024px) ${lg},
      (max-width: 1280px) ${xl},
      ${defaultSize}
    `;
  };

  /**
   * Generiert ein Bild mit Lazy-Loading und optimierten Attributen
   * @param {Object} options - Konfigurationsoptionen
   * @returns {Object} Optimierte Bildattribute
   */
  const getOptimizedImageAttrs = (options = {}) => {
    const {
      src,
      alt = '',
      width,
      height,
      lazy = true,
      srcset = '',
      sizes = '',
      className = '',
      loading = lazy ? 'lazy' : 'eager',
      decoding = 'async'
    } = options;

    return {
      src,
      alt,
      width,
      height,
      srcset,
      sizes,
      class: className,
      loading,
      decoding
    };
  };

  return {
    generateSrcSet,
    generateSizes,
    getOptimizedImageAttrs
  };
}