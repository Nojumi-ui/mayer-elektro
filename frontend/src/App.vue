<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <!-- Skip-Link für Barrierefreiheit -->
    <a href="#main-content" class="skip-link" aria-label="Zum Hauptinhalt springen">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
      </svg>
    </a>
    
    <Navbar />
    <main id="main-content">
      <router-view />
    </main>
    <Footer />
    
    <!-- Barrierefreiheits-Menü -->
    <AccessibilityMenu />
    
    <!-- Canonical Link für SEO -->
    <CanonicalLink />
    
    <!-- Hreflang Links für mehrsprachige SEO -->
    <HreflangLinks />
    
    <!-- Breadcrumbs Schema für SEO -->
    <BreadcrumbsSchema />
    
    <!-- Website Schema für SEO -->
    <WebSiteSchema />
    
    <!-- Organization Schema für SEO -->
    <OrganizationSchema />
    
    <!-- Sitelinks-Suchbox Schema für SEO -->
    <SitelinksSearchBoxSchema />
    
    <!-- Social Media Meta-Tags -->
    <SocialMediaTags />
    
    <!-- Suchmaschinen Meta-Tags -->
    <SearchEngineTags />
    
    <!-- Leistungsoptimierungs-Tags -->
    <PerformanceTags />
    
    <!-- Sicherheits-Tags -->
    <SecurityTags />
  </div>
</template>

<script setup>
import Navbar from "./components/Navbar.vue";
import Footer from "./components/Footer.vue";
import AccessibilityMenu from "./components/AccessibilityMenu.vue";
import CanonicalLink from "./components/CanonicalLink.vue";
import HreflangLinks from "./components/HreflangLinks.vue";
import BreadcrumbsSchema from "./components/BreadcrumbsSchema.vue";
import WebSiteSchema from "./components/WebSiteSchema.vue";
import OrganizationSchema from "./components/OrganizationSchema.vue";
import SitelinksSearchBoxSchema from "./components/SitelinksSearchBoxSchema.vue";
import SocialMediaTags from "./components/SocialMediaTags.vue";
import SearchEngineTags from "./components/SearchEngineTags.vue";
import PerformanceTags from "./components/PerformanceTags.vue";
import SecurityTags from "./components/SecurityTags.vue";
import { useTheme } from "./composables/useTheme";
import { usePerformance } from "./composables/usePerformance";
import { useAccessibility } from "./composables/useAccessibility";
import { useSEO } from "./composables/useSEO";

// Initialize theme
useTheme();

// Initialize performance optimizations
usePerformance();

// Initialize accessibility features
useAccessibility();

// Initialize SEO
useSEO({
  initialData: {
    title: 'Elektroinstallation & Gebäudetechnik Hamburg',
    description: 'Mayer Elektro in Hamburg bietet professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen. Zuverlässig und regional seit über 15 Jahren.',
    keywords: 'Elektroinstallation Hamburg, Gebäudetechnik, Automatisierung, Elektrofachkräfte, Elektrotechnik, Instandhaltung, Elektroinstallateur'
  }
});
</script>
