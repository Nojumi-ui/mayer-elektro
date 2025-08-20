<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <MetaTags
      :title="t('terms.meta_title')"
      :description="t('terms.meta_description')"
      canonical="https://www.mayerelektro.de/agb"
    />
    
    <!-- Breadcrumbs -->
    <Breadcrumbs :items="[{ text: t('terms.breadcrumb') }]" class="pt-24" />
    
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-sm relative">
      <div class="max-w-4xl mx-auto px-6 py-8">
        <!-- Zurück-Button (absolut positioniert) -->
        <router-link 
          to="/" 
          class="absolute top-4 right-4 inline-flex items-center justify-center w-10 h-10 bg-[#0097b2] text-white rounded-lg hover:bg-cyan-600 transition"
          :aria-label="t('terms.back_to_home')"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
        </router-link>
        
        <div>
          <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white pr-14">{{ t('terms.title') }}</h1>
          <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mt-2">{{ t('terms.valid_from') }}</p>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-6 py-12">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-8">
          <!-- Einleitung -->
          <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
              <svg class="w-6 h-6 mr-3 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
              {{ t('terms.intro.title') }}
            </h2>
            
            <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
              <p class="mb-4">{{ t('terms.intro.text') }}</p>
            </div>
          </section>

          <!-- Allgemeine Geschäftsbedingungen -->
          <section class="mb-8 border-t border-gray-200 dark:border-gray-700 pt-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
              <svg class="w-6 h-6 mr-3 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
              {{ t('terms.sections_title') }}
            </h2>
            
            <div class="space-y-6 text-gray-700 dark:text-gray-300">
              <!-- § 1 Geltungsbereich -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ t('terms.sections.scope.title') }}</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>{{ t('terms.sections.scope.text1') }}</p>
                  <p>{{ t('terms.sections.scope.text2') }}</p>
                  <p>{{ t('terms.sections.scope.text3') }}</p>
                  <p>{{ t('terms.sections.scope.text4') }}</p>
                </div>
              </div>
              
              <!-- § 2 Vertragsschluss -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ t('terms.sections.contract.title') }}</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>{{ t('terms.sections.contract.text1') }}</p>
                  <p>{{ t('terms.sections.contract.text2') }}</p>
                  <p>{{ t('terms.sections.contract.text3') }}</p>
                </div>
              </div>
              
              <!-- § 3 Leistungen -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ t('terms.sections.services.title') }}</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>{{ t('terms.sections.services.text1') }}</p>
                  <p>{{ t('terms.sections.services.text2') }}</p>
                  <p>{{ t('terms.sections.services.text3') }}</p>
                </div>
              </div>
              
              <!-- § 4 Mitwirkungspflichten des Kunden -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ t('terms.sections.cooperation.title') }}</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>{{ t('terms.sections.cooperation.text1') }}</p>
                  <p>{{ t('terms.sections.cooperation.text2') }}</p>
                  <p>{{ t('terms.sections.cooperation.text3') }}</p>
                </div>
              </div>
              
              <!-- § 5 Preise und Zahlungsbedingungen -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ t('terms.sections.prices.title') }}</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>{{ t('terms.sections.prices.text1') }}</p>
                  <p>{{ t('terms.sections.prices.text2') }}</p>
                  <p>{{ t('terms.sections.prices.text3') }}</p>
                </div>
              </div>
              
              <!-- § 6 Eigentumsvorbehalt -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ t('terms.sections.retention.title') }}</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>{{ t('terms.sections.retention.text1') }}</p>
                  <p>{{ t('terms.sections.retention.text2') }}</p>
                </div>
              </div>
              
              <!-- § 7 Ausführungszeit, Abnahme und Gefahrenübergang -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ t('terms.sections.execution.title') }}</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>{{ t('terms.sections.execution.text1') }}</p>
                  <p>{{ t('terms.sections.execution.text2') }}</p>
                </div>
              </div>
              
              <!-- § 8 Gewährleistung -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ t('terms.sections.warranty.title') }}</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>{{ t('terms.sections.warranty.text1') }}</p>
                  <p>{{ t('terms.sections.warranty.text2') }}</p>
                  <p>{{ t('terms.sections.warranty.text3') }}</p>
                </div>
              </div>
              
              <!-- § 9 Haftung -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ t('terms.sections.liability.title') }}</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>{{ t('terms.sections.liability.text1') }}</p>
                  <p>{{ t('terms.sections.liability.text2') }}</p>
                </div>
              </div>
              
              <!-- § 10 Datenschutz -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ t('terms.sections.data_protection.title') }}</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>{{ t('terms.sections.data_protection.text1') }}</p>
                  <p>{{ t('terms.sections.data_protection.text2') }}</p>
                </div>
              </div>
              
              <!-- § 11 Schlussbestimmungen -->
              <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ t('terms.sections.final.title') }}</h3>
                <div class="prose dark:prose-invert max-w-none">
                  <p>{{ t('terms.sections.final.text1') }}</p>
                  <p>{{ t('terms.sections.final.text2') }}</p>
                  <p>{{ t('terms.sections.final.text3') }} <a :href="t('terms.sections.final.odr_link')" target="_blank" class="text-[#0097b2] hover:underline">
                    <span class="hidden sm:inline">{{ t('terms.sections.final.odr_text_full') }}</span>
                    <span class="sm:hidden">{{ t('terms.sections.final.odr_text_mobile') }}</span>
                  </a></p>
                  <p>{{ t('terms.sections.final.text4') }}</p>
                </div>
              </div>
            </div>
          </section>

          <!-- Kontakt -->
          <section class="border-t border-gray-200 dark:border-gray-700 pt-8">
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ t('terms.contact_section.title') }}</h3>
              <p class="text-gray-700 dark:text-gray-300 mb-4">{{ t('terms.contact_section.text') }}</p>
              <div class="flex flex-col sm:flex-row gap-4">
                <router-link 
                  to="/#contact"
                  class="flex-1 bg-[#0097b2] text-white py-3 px-6 rounded-lg hover:bg-cyan-600 transition text-center font-semibold"
                >
                  {{ t('terms.contact_section.button') }}
                </router-link>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Breadcrumbs from './Breadcrumbs.vue'
import MetaTags from './MetaTags.vue'
import { useTheme } from "../composables/useTheme";
import { useI18n } from 'vue-i18n';

const { isDark } = useTheme();
const { t } = useI18n();
</script>