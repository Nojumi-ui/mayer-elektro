<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <!-- Header - Added pt-24 to create space for the fixed navbar -->
    <div class="bg-white dark:bg-gray-800 shadow-sm pt-24">
      <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ t('imprint.title') }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">{{ t('imprint.subtitle') }}</p>
          </div>
          <router-link 
            to="/" 
            class="inline-flex items-center px-4 py-2 bg-[#0097b2] text-white rounded-lg hover:bg-cyan-600 transition"
          >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            {{ t('imprint.back_home') }}
          </router-link>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-6 py-12">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-8">
          <!-- Company Information -->
          <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
              <svg class="w-6 h-6 mr-3 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
              </svg>
              {{ t('imprint.company_info') }}
            </h2>
            
            <div class="grid md:grid-cols-2 gap-8">
              <div class="space-y-4">
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ t('imprint.company_name') }}</h3>
                  <p class="text-gray-700 dark:text-gray-300">Mayer Elektro- und Gebäudetechnik GmbH</p>
                </div>
                
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ t('imprint.address') }}</h3>
                  <p class="text-gray-700 dark:text-gray-300">
                    Christoph-Probst-Weg 4<br>
                    20251 Hamburg<br>
                    Deutschland
                  </p>
                </div>
                
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ t('imprint.commercial_register') }}</h3>
                  <p class="text-gray-700 dark:text-gray-300">HRB 193758</p>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">{{ t('imprint.register_court') }}</p>
                </div>
              </div>
              
              <div class="space-y-4">
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ t('imprint.contact') }}</h3>
                  <p class="text-gray-700 dark:text-gray-300">
                    <a href="mailto:info@mayerelektro.de" class="text-[#0097b2] hover:underline">
                      info@mayerelektro.de
                    </a>
                  </p>
                  <!--p class="text-gray-700 dark:text-gray-300">
                    <a href="tel:+4940123456789" class="text-[#0097b2] hover:underline">
                      +49 (0) 40 123 456 789
                    </a>
                  </p-->
                </div>
                
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ t('imprint.managing_director') }}</h3>
                  <p class="text-gray-700 dark:text-gray-300">Ghazal Maryam Mahyar</p>
                </div>
                
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ t('imprint.vat_id') }}</h3>
                  <p class="text-gray-700 dark:text-gray-300">DE455935115</p>
                </div>
              </div>
            </div>
          </section>

          <!-- Legal Information -->
          <section class="mb-8 border-t border-gray-200 dark:border-gray-700 pt-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
              <svg class="w-6 h-6 mr-3 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
              </svg>
              {{ t('imprint.legal_info') }}
            </h2>
            
            <div class="prose dark:prose-invert max-w-none">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ t('imprint.liability_content') }}</h3>
              <p class="text-gray-700 dark:text-gray-300 mb-4">{{ t('imprint.liability_content_text') }}</p>
              
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ t('imprint.liability_links') }}</h3>
              <p class="text-gray-700 dark:text-gray-300 mb-4">{{ t('imprint.liability_links_text') }}</p>
              
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ t('imprint.copyright') }}</h3>
              <p class="text-gray-700 dark:text-gray-300 mb-4">{{ t('imprint.copyright_text') }}</p>
            </div>
          </section>

          <!-- Professional Information -->
          <section class="mb-8 border-t border-gray-200 dark:border-gray-700 pt-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
              <svg class="w-6 h-6 mr-3 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
              </svg>
              {{ t('imprint.professional_info') }}
            </h2>
            
            <div class="grid md:grid-cols-2 gap-8">
              <div class="space-y-4">
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ t('imprint.professional_title') }}</h3>
                  <p class="text-gray-700 dark:text-gray-300">{{ t('imprint.electrical_contractor') }}</p>
                </div>
                
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ t('imprint.chamber') }}</h3>
                  <p class="text-gray-700 dark:text-gray-300">{{ t('imprint.chamber_name') }}</p>
                </div>
              </div>
              
              <div class="space-y-4">
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ t('imprint.insurance') }}</h3>
                  <p class="text-gray-700 dark:text-gray-300">{{ t('imprint.insurance_company') }}</p>
                  <p class="text-gray-600 dark:text-gray-400 text-sm">{{ t('imprint.insurance_coverage') }}</p>
                </div>
                
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white mb-2">{{ t('imprint.regulations') }}</h3>
                  <p class="text-gray-700 dark:text-gray-300">{{ t('imprint.regulations_text') }}</p>
                </div>
              </div>
            </div>
          </section>

          <!-- Dispute Resolution -->
          <section class="border-t border-gray-200 dark:border-gray-700 pt-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
              <svg class="w-6 h-6 mr-3 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
              </svg>
              {{ t('imprint.dispute_resolution') }}
            </h2>
            
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
              <p class="text-gray-700 dark:text-gray-300 mb-4">{{ t('imprint.dispute_text') }}</p>
              <p class="text-gray-700 dark:text-gray-300">
                <strong>{{ t('imprint.eu_platform') }}:</strong>
                <a href="https://ec.europa.eu/consumers/odr/" target="_blank" class="text-[#0097b2] hover:underline ml-2">
                  https://ec.europa.eu/consumers/odr/
                </a>
              </p>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
</script>