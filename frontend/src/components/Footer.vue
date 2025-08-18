<template>
  <footer class="bg-gray-900 dark:bg-gray-950 text-white py-12 transition-colors duration-200">
    <div class="max-w-6xl mx-auto px-6">
      <!-- Footer Content -->
      <div class="grid md:grid-cols-3 gap-8 mb-8">
        <!-- Logo & Company Info -->
        <div class="flex flex-col items-start">
          <div class="mb-4">
            <div class="flex items-center gap-3 mb-2">
              <img 
                src="/favicon-muster-transparent-blau.png" 
                alt="Mayer Elektro Logo" 
                class="w-8 h-8 object-contain"
              />
              <div class="flex flex-col">
                <span class="text-lg font-black tracking-tight leading-none">
                  <span class="bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">MAYER</span>
                  <span class="font-light text-gray-300"> ELEKTRO</span>
                </span>
                <span class="text-xs font-bold tracking-widest text-[#0097b2] leading-none mt-0.5">ELEKTROINSTALLATION</span>
              </div>
            </div>
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
            <p>Mayer Elektro GmbH</p>
            <p>Musterstraße 123</p>
            <p>12345 Hamburg</p>
            <p class="mt-3">
              <a href="tel:+4940123456789" class="hover:text-white transition">
                +49 (0) 40 123 456 789
              </a>
            </p>
            <p>
              <a href="mailto:info@mayer-elektro.de" class="hover:text-white transition">
                info@mayer-elektro.de
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

const { t } = useI18n()
</script>
