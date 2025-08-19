<template>
  <footer class="bg-gray-900 dark:bg-gray-950 text-white py-12 transition-colors duration-200">
    <!-- Site Navigation für SEO -->
    <SiteNavigation class="sr-only" />
    
    <div class="max-w-6xl mx-auto px-6">
      <!-- Footer Content -->
      <div class="grid md:grid-cols-3 gap-8 mb-8">
        <!-- Logo & Company Info -->
        <div class="flex flex-col items-start">
          <div class="mb-4">
            <img 
              :src="isDark ? '/logo_transparent_white.png' : '/logo_transparent_white.png'" 
              alt="Mayer Elektro - Elektroinstallation & Gebäudetechnik Hamburg" 
              class="h-12 w-auto object-contain"
              width="180"
              height="60"
              loading="lazy"
            />
          </div>
          <p class="text-gray-400 text-sm">
            {{ t('footer.company_description') }}
          </p>
        </div>

        <!-- Quick Links -->
        <div>
          <h3 class="text-lg font-semibold mb-4">{{ t('footer.quick_links') }}</h3>
          <ul class="space-y-2 text-sm text-gray-400">
            <li><a @click.prevent="navigateToSection('jobs')" class="hover:text-white transition cursor-pointer" aria-label="Zu den Stellenangeboten">{{ t('nav.jobs') || 'Stellenangebote' }}</a></li>
            <li><a @click.prevent="navigateToSection('bewerber')" class="hover:text-white transition cursor-pointer" aria-label="Informationen für Bewerber">{{ t('nav.bewerber') || 'Für Bewerber' }}</a></li>
            <li><a @click.prevent="navigateToSection('kunden')" class="hover:text-white transition cursor-pointer" aria-label="Informationen für Kunden">{{ t('nav.kunden') || 'Für Kunden' }}</a></li>
            <li><a @click.prevent="navigateToSection('news')" class="hover:text-white transition cursor-pointer" aria-label="Zu den Neuigkeiten">{{ t('nav.news') || 'News' }}</a></li>
            <li><a @click.prevent="navigateToSection('contact')" class="hover:text-white transition cursor-pointer" aria-label="Zum Kontaktformular">{{ t('nav.kontakt') || 'Kontakt' }}</a></li>
          </ul>
        </div>

        <!-- Contact Info -->
        <div>
          <h3 class="text-lg font-semibold mb-4">{{ t('nav.kontakt') }}</h3>
          <div class="space-y-2 text-sm text-gray-400">
            <p>Mayer Elektro- und Gebäudetechnik GmbH</p>
            <p>Christoph-Probst-Weg 4</p>
            <p>20251 Hamburg</p>
            <!--p class="mt-3">
              <a href="tel:+4940123456789" class="hover:text-white transition">
                +49 (0) 40 123 456 789
              </a>
            </p-->
            <p>
              <a href="mailto:info@mayerelektro.de" class="hover:text-white transition">
                info@mayerelektro.de
              </a>
            </p>
          </div>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="border-t border-gray-800 dark:border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
        <p class="text-gray-400 text-sm">&copy; 2025 {{ t('footer.company_name') }}. {{ t('footer.copyright') }}</p>
        <div class="flex gap-4 mt-4 md:mt-0 text-sm">
          <router-link to="/impressum" class="text-gray-400 hover:text-white transition" aria-label="Zum Impressum">{{ t('footer.imprint') || 'Impressum' }}</router-link>
          <router-link to="/datenschutz" class="text-gray-400 hover:text-white transition" aria-label="Zur Datenschutzerklärung">{{ t('footer.privacy') || 'Datenschutz' }}</router-link>
          <router-link to="/agb" class="text-gray-400 hover:text-white transition" aria-label="Zu den AGB">{{ t('footer.terms') || 'AGB' }}</router-link>
          <router-link to="/bewerbungsformular" class="text-gray-400 hover:text-white transition" aria-label="Zum Bewerbungsformular">Bewerbungsformular</router-link>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
import { useTheme } from "../composables/useTheme"
import SiteNavigation from './SiteNavigation.vue'
import { useRouter, useRoute } from 'vue-router'

const { t } = useI18n()
const { isDark } = useTheme()
const router = useRouter()
const route = useRoute()

// Funktion zum Navigieren zu Abschnitten auf der Hauptseite
const navigateToSection = (sectionId) => {
  // Wenn wir nicht auf der Hauptseite sind, navigieren wir zuerst dorthin
  if (route.path !== '/') {
    router.push({ path: '/', hash: `#${sectionId}` });
  } else {
    // Wenn wir bereits auf der Hauptseite sind, scrollen wir zum Abschnitt
    const element = document.getElementById(sectionId);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }
}
</script>
