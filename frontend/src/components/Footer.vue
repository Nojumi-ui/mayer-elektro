<template>
  <footer class="bg-gray-900 dark:bg-gray-950 text-white py-12 transition-colors duration-200">
    <div class="max-w-6xl mx-auto px-6">
      <!-- Footer Content -->
      <div class="grid md:grid-cols-3 gap-8 mb-8">
        <!-- Logo & Company Info -->
        <div class="flex flex-col items-start">
          <div class="mb-4">
            <img 
              :src="isDark ? '/logo_transparent_white.png' : '/logo_transparent_white.png'" 
              alt="Mayer Elektro Logo" 
              class="h-12 w-auto object-contain"
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
            <li><a href="#jobs" class="hover:text-white transition">{{ t('nav.jobs') }}</a></li>
            <li><a href="#bewerber" class="hover:text-white transition">{{ t('nav.bewerber') }}</a></li>
            <li><a href="#kunden" class="hover:text-white transition">{{ t('nav.kunden') }}</a></li>
            <li><a href="#news" class="hover:text-white transition">{{ t('nav.news') }}</a></li>
            <li><a href="#contact" class="hover:text-white transition">{{ t('nav.kontakt') }}</a></li>
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
          <a href="/impressum" class="text-gray-400 hover:text-white transition">{{ t('footer.imprint') }}</a>
          <a href="/datenschutz" class="text-gray-400 hover:text-white transition">{{ t('footer.privacy') }}</a>
          <a href="/agb" class="text-gray-400 hover:text-white transition">{{ t('footer.terms') }}</a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
import { useTheme } from "../composables/useTheme"

const { t } = useI18n()
const { isDark } = useTheme()
</script>
