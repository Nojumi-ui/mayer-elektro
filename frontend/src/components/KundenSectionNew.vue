<template>
  <section id="kunden" class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200 mobile-container">
    <div class="max-w-7xl mx-auto px-6">
      <!-- Header -->
      <div ref="headerRef" class="text-center mb-16">
        <h2 :class="['text-4xl md:text-5xl font-bold text-gray-800 dark:text-gray-200 mb-6 fade-in-up heading-break mobile-word-break', { visible: headerVisible }]">{{ t('clients.title') }}</h2>
        <p :class="['text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto fade-in-up stagger-1', { visible: headerVisible }]">
          {{ t('clients.subtitle') }}
        </p>
      </div>

      <!-- Automatisierungstechnik Sektion -->
      <div id="automatisierung" ref="automatisierungRef" class="mb-20">
        <h3 :class="['text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 fade-in-up heading-break mobile-word-break', { visible: automatisierungVisible }]">
          {{ t('clients.automation.title') }}
        </h3>
        
        <div class="grid md:grid-cols-2 gap-12 mb-12">
          <div :class="['fade-in-left', { visible: automatisierungVisible }]">
            <h4 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ t('services.title') }}</h4>
            <p class="text-gray-600 dark:text-gray-400 mb-6 word-break-responsive">
              {{ t('clients.automation.description') }}
            </p>
            
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ t('clients.automation.switchgear_title') }}</h5>
                <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                  <li>• {{ t('clients.automation.low_voltage') }}</li>
                  <li>• {{ t('clients.automation.medium_voltage') }}</li>
                  <li>• {{ t('clients.automation.control_cabinet') }}</li>
                  <li>• {{ t('clients.automation.distribution_cabinet') }}</li>
                </ul>
              </div>
              <div>
                <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ t('clients.automation.automation_title') }}</h5>
                <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                  <li>• {{ t('clients.automation.plc_programming') }}</li>
                  <li>• {{ t('clients.automation.hmi_systems') }}</li>
                  <li>• {{ t('clients.automation.process_visualization') }}</li>
                  <li>• {{ t('clients.automation.remote_maintenance') }}</li>
                </ul>
              </div>
            </div>
          </div>
          
          <div :class="['fade-in-right', { visible: automatisierungVisible }]">
            <img 
              src="/img/automatisierung_4.jpg" 
              alt="Automatisierungstechnik" 
              class="w-full h-80 object-cover rounded-lg shadow-lg"
            >
          </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8 items-stretch">
          <div :class="['bg-gray-50 dark:bg-gray-700 p-6 rounded-lg scale-in stagger-1 transition-colors duration-200 flex flex-col h-full', { visible: automatisierungVisible }]">
            <div class="w-12 h-12 bg-[#0097b2] rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('clients.automation.planning_title') }}</h4>
            <p class="text-gray-600 dark:text-gray-400 mb-4 flex-grow">
              {{ t('clients.automation.planning_desc') }}
            </p>
            <button 
              @click="openServiceModal('planning')"
              class="bg-[#0097b2] text-white px-4 py-2 rounded-lg hover:bg-cyan-600 transition text-sm font-medium mt-auto"
            >
              {{ t('clients.automation.learn_more') }}
            </button>
          </div>

          <div :class="['bg-gray-50 dark:bg-gray-700 p-6 rounded-lg scale-in stagger-2 transition-colors duration-200 flex flex-col h-full', { visible: automatisierungVisible }]">
            <div class="w-12 h-12 bg-[#0097b2] rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('clients.automation.installation_title') }}</h4>
            <p class="text-gray-600 dark:text-gray-400 mb-4 flex-grow">
              {{ t('clients.automation.installation_desc') }}
            </p>
            <button 
              @click="openServiceModal('installation')"
              class="bg-[#0097b2] text-white px-4 py-2 rounded-lg hover:bg-cyan-600 transition text-sm font-medium mt-auto"
            >
              {{ t('clients.automation.learn_more') }}
            </button>
          </div>

          <div :class="['bg-gray-50 dark:bg-gray-700 p-6 rounded-lg scale-in stagger-3 transition-colors duration-200 flex flex-col h-full', { visible: automatisierungVisible }]">
            <div class="w-12 h-12 bg-[#0097b2] rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('clients.automation.service_title') }}</h4>
            <p class="text-gray-600 dark:text-gray-400 mb-4 flex-grow">
              {{ t('clients.automation.service_desc') }}
            </p>
            <button 
              @click="openServiceModal('service')"
              class="bg-[#0097b2] text-white px-4 py-2 rounded-lg hover:bg-cyan-600 transition text-sm font-medium mt-auto"
            >
              {{ t('clients.automation.learn_more') }}
            </button>
          </div>
        </div>
      </div>

      <!-- Instandhaltung Sektion -->
      <div id="instandhaltung" ref="instandhaltungRef" class="mb-20 bg-gray-50 dark:bg-gray-800 -mx-6 px-6 py-16 transition-colors duration-200">
        <div class="max-w-7xl mx-auto">
          <h3 :class="['text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center fade-in-up', { visible: instandhaltungVisible }]">
            {{ t('clients.maintenance.title') }}
          </h3>
          
          <div class="grid md:grid-cols-2 gap-12">
            <div :class="['fade-in-left', { visible: instandhaltungVisible }]">
              <img 
                src="/img/instandhaltung_2.jpg" 
                alt="Instandhaltung" 
                class="w-full h-80 object-cover rounded-lg shadow-lg"
              >
            </div>
            
            <div :class="['fade-in-right', { visible: instandhaltungVisible }]">
              <h4 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ t('clients.maintenance.subtitle') }}</h4>
              <p class="text-gray-600 dark:text-gray-400 mb-6">
                {{ t('clients.maintenance.description') }}
              </p>
              
              <div class="space-y-4">
                <div class="flex items-start">
                  <div class="w-8 h-8 bg-[#0097b2] rounded-full flex items-center justify-center mr-4 mt-1">
                    <span class="text-white font-bold text-sm">1</span>
                  </div>
                  <div>
                    <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">{{ t('clients.maintenance.inspection_title') }}</h5>
                    <p class="text-gray-600 dark:text-gray-400">{{ t('clients.maintenance.inspection_desc') }}</p>
                  </div>
                </div>
                
                <div class="flex items-start">
                  <div class="w-8 h-8 bg-[#0097b2] rounded-full flex items-center justify-center mr-4 mt-1">
                    <span class="text-white font-bold text-sm">2</span>
                  </div>
                  <div>
                    <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">{{ t('clients.maintenance.maintenance_title') }}</h5>
                    <p class="text-gray-600 dark:text-gray-400">{{ t('clients.maintenance.maintenance_desc') }}</p>
                  </div>
                </div>
                
                <div class="flex items-start">
                  <div class="w-8 h-8 bg-[#0097b2] rounded-full flex items-center justify-center mr-4 mt-1">
                    <span class="text-white font-bold text-sm">3</span>
                  </div>
                  <div>
                    <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">{{ t('clients.maintenance.repair_title') }}</h5>
                    <p class="text-gray-600 dark:text-gray-400">{{ t('clients.maintenance.repair_desc') }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Elektroinstallation Sektion -->
      <div id="elektroinstallation" ref="elektroinstallationRef" class="mb-20">
        <h3 :class="['text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 fade-in-up', { visible: elektroinstallationVisible }]">
          {{ t('clients.electrical.title') }}
        </h3>
        
        <div class="grid md:grid-cols-3 gap-8">
          <!-- Wohngebäude -->
          <div :class="['bg-white dark:bg-gray-700 rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-1 overflow-hidden', { visible: elektroinstallationVisible }]">
            <div class="h-48 overflow-hidden">
              <img 
                src="/img/smart-home.jpg" 
                alt="Smart Home Installation" 
                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
              >
            </div>
            <div class="p-6">
              <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('clients.electrical.residential_title') }}</h4>
              <p class="text-gray-600 dark:text-gray-400 mb-4">{{ t('clients.electrical.residential_desc') }}</p>
              <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                <li>• {{ t('clients.electrical.house_installations') }}</li>
                <li>• {{ t('clients.electrical.smart_home') }}</li>
                <li>• {{ t('clients.electrical.lighting_concepts') }}</li>
                <li>• {{ t('clients.electrical.security_tech') }}</li>
              </ul>
            </div>
          </div>

          <!-- Gewerbe & Industrie -->
          <div :class="['bg-white dark:bg-gray-700 rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-2 overflow-hidden', { visible: elektroinstallationVisible }]">
            <div class="h-48 overflow-hidden">
              <img 
                src="/img/industrial-automation.jpg" 
                alt="Industrielle Installation" 
                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
              >
            </div>
            <div class="p-6">
              <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('clients.electrical.commercial_title') }}</h4>
              <p class="text-gray-600 dark:text-gray-400 mb-4">{{ t('clients.electrical.commercial_desc') }}</p>
              <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                <li>• {{ t('clients.electrical.industrial_installations') }}</li>
                <li>• {{ t('clients.electrical.machine_connection') }}</li>
                <li>• {{ t('clients.electrical.lighting_systems') }}</li>
                <li>• {{ t('clients.electrical.emergency_power') }}</li>
              </ul>
            </div>
          </div>

          <!-- Sonderanlagen -->
          <div :class="['bg-white dark:bg-gray-700 rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-3 overflow-hidden', { visible: elektroinstallationVisible }]">
            <div class="h-48 overflow-hidden">
              <img 
                src="/img/pv-anlage.jpg" 
                alt="Photovoltaik-Anlage" 
                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
              >
            </div>
            <div class="p-6">
              <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('clients.electrical.special_title') }}</h4>
              <p class="text-gray-600 dark:text-gray-400 mb-4">{{ t('clients.electrical.special_desc') }}</p>
              <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                <li>• {{ t('clients.electrical.photovoltaic') }}</li>
                <li>• {{ t('clients.electrical.e_mobility') }}</li>
                <li>• {{ t('clients.electrical.fire_alarm') }}</li>
                <li>• {{ t('clients.electrical.lightning_protection') }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Personaldienstleistungen Sektion -->
      <div id="personaldienstleistungen" ref="personalRef" class="mb-20 bg-gradient-to-r from-cyan-600 to-[#0097b2] -mx-6 px-6 py-16 text-white mobile-container">
        <div class="max-w-7xl mx-auto">
          <h3 :class="['text-3xl font-bold mb-8 text-center fade-in-up heading-break mobile-word-break', { visible: personalVisible }]">
            {{ t('clients.personnel.title') }}
          </h3>
          
          <div class="grid md:grid-cols-2 gap-12">
            <div :class="['fade-in-left', { visible: personalVisible }]">
              <h4 class="text-2xl font-semibold mb-4">{{ t('clients.personnel.subtitle') }}</h4>
              <p class="mb-6 opacity-90 word-break-responsive">
                {{ t('clients.personnel.description') }}
              </p>
              
              <div class="grid md:grid-cols-2 gap-6">
                <div>
                  <h5 class="font-semibold mb-2">{{ t('clients.personnel.temporary_title') }}</h5>
                  <ul class="text-sm opacity-80 space-y-1">
                    <li>• {{ t('clients.personnel.short_projects') }}</li>
                    <li>• {{ t('clients.personnel.vacation_cover') }}</li>
                    <li>• {{ t('clients.personnel.peak_orders') }}</li>
                    <li>• {{ t('clients.personnel.flexible_assignments') }}</li>
                  </ul>
                </div>
                <div>
                  <h5 class="font-semibold mb-2">{{ t('clients.personnel.placement_title') }}</h5>
                  <ul class="text-sm opacity-80 space-y-1">
                    <li>• {{ t('clients.personnel.permanent_positions') }}</li>
                    <li>• {{ t('clients.personnel.recruitment') }}</li>
                    <li>• {{ t('clients.personnel.preselection') }}</li>
                    <li>• {{ t('clients.personnel.aftercare') }}</li>
                  </ul>
                </div>
              </div>
            </div>
            
            <div :class="['fade-in-right', { visible: personalVisible }]">
              <img 
                src="/img/personaldienstleistungen.jpg" 
                alt="Personaldienstleistungen" 
                class="w-full h-80 object-cover rounded-lg shadow-lg"
              >
            </div>
          </div>
        </div>
      </div>

      <!-- Referenzen -->
      <div ref="statsRef" class="text-center">
        <h3 :class="['text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 fade-in-up', { visible: statsVisible }]">{{ t('clients.references.title') }}</h3>
        <div class="grid md:grid-cols-4 gap-8">
          <div :class="['text-center scale-in stagger-1', { visible: statsVisible }]">
            <div ref="customers" class="text-4xl font-bold text-[#0097b2] mb-2">{{ customersCount }}+</div>
            <p class="text-gray-600 dark:text-gray-400">{{ t('clients.references.satisfied_customers') }}</p>
          </div>
          <div :class="['text-center scale-in stagger-2', { visible: statsVisible }]">
            <div ref="experience" class="text-4xl font-bold text-[#0097b2] mb-2">{{ experienceCount }}</div>
            <p class="text-gray-600 dark:text-gray-400">{{ t('clients.references.years_experience') }}</p>
          </div>
          <div :class="['text-center scale-in stagger-3', { visible: statsVisible }]">
            <div ref="projects" class="text-4xl font-bold text-[#0097b2] mb-2">{{ projectsCount }}+</div>
            <p class="text-gray-600 dark:text-gray-400">{{ t('clients.references.projects_completed') }}</p>
          </div>
          <div :class="['text-center scale-in stagger-4', { visible: statsVisible }]">
            <div class="text-4xl font-bold text-[#0097b2] mb-2">24/7</div>
            <p class="text-gray-600 dark:text-gray-400">{{ t('clients.references.emergency_service') }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Service Details Modal -->
    <div v-if="showServiceModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" @click="closeServiceModal">
      <div class="bg-white dark:bg-gray-800 rounded-lg max-w-5xl w-full max-h-[90vh] overflow-y-auto" @click.stop>
        <div class="sticky top-0 bg-white dark:bg-gray-800 border-b dark:border-gray-700 p-6 flex justify-between items-center">
          <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ selectedService?.title }}</h2>
          <button @click="closeServiceModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        
        <div class="p-6">
          <!-- Header mit Bild -->
          <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div>
              <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ selectedService?.subtitle }}</h3>
              <p class="text-gray-600 dark:text-gray-400 mb-6">{{ selectedService?.description }}</p>
            </div>
            <div>
              <img 
                :src="selectedService?.image" 
                :alt="selectedService?.title" 
                class="w-full h-64 object-cover rounded-lg shadow-lg"
              />
            </div>
          </div>

          <!-- Services und Technologies -->
          <div class="grid md:grid-cols-2 gap-8">
            <!-- Leistungen -->
            <div>
              <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ locale === 'de' ? 'Unsere Leistungen' : 'Our Services' }}
              </h3>
              <ul class="space-y-3">
                <li v-for="service in selectedService?.services" :key="service" class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-[#0097b2] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <span class="text-gray-600 dark:text-gray-400">{{ service }}</span>
                </li>
              </ul>
            </div>

            <!-- Technologien -->
            <div>
              <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                {{ locale === 'de' ? 'Technologien & Tools' : 'Technologies & Tools' }}
              </h3>
              <ul class="space-y-3">
                <li v-for="tech in selectedService?.technologies" :key="tech" class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-[#0097b2] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <span class="text-gray-600 dark:text-gray-400">{{ tech }}</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- CTA Button -->
          <div class="mt-8 text-center">
            <a 
              href="#contact"
              @click="closeServiceModal"
              class="inline-block bg-[#0097b2] text-white px-8 py-3 rounded-lg hover:bg-cyan-600 transition font-semibold"
            >
              {{ locale === 'de' ? 'Jetzt Beratung anfragen' : 'Request consultation now' }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useI18n } from 'vue-i18n'
import { useScrollAnimation } from '../composables/useScrollAnimation.js'
import { useCountAnimation } from '../composables/useCountAnimation.js'

const { t, locale } = useI18n()

const { isVisible: headerVisible, elementRef: headerRef } = useScrollAnimation()
const { isVisible: automatisierungVisible, elementRef: automatisierungRef } = useScrollAnimation()
const { isVisible: instandhaltungVisible, elementRef: instandhaltungRef } = useScrollAnimation()
const { isVisible: elektroinstallationVisible, elementRef: elektroinstallationRef } = useScrollAnimation()
const { isVisible: personalVisible, elementRef: personalRef } = useScrollAnimation()
const { isVisible: statsVisible, elementRef: statsRef } = useScrollAnimation()

// Service Modal
const showServiceModal = ref(false)
const selectedServiceType = ref(null)

const selectedService = computed(() => {
  if (!selectedServiceType.value) return null
  
  const isGerman = locale.value === 'de'
  
  const serviceData = {
    planning: {
      title: t('clients.automation.planning_details.title'),
      subtitle: t('clients.automation.planning_details.subtitle'),
      description: t('clients.automation.planning_details.description'),
      services: isGerman ? [
        'Anforderungsanalyse und Machbarkeitsstudien',
        'Technische Konzeptentwicklung und Systemauslegung',
        'Erstellung von Schaltplänen und Stromlaufplänen',
        '3D-Planung und Visualisierung von Schaltanlagen',
        'Normgerechte Dokumentation nach VDE und IEC',
        'Projektmanagement und Terminplanung',
        'Kostenoptimierung und Wirtschaftlichkeitsanalyse',
        'Integration in bestehende Systeme und Infrastrukturen'
      ] : [
        'Requirements analysis and feasibility studies',
        'Technical concept development and system design',
        'Creation of circuit diagrams and wiring diagrams',
        '3D planning and visualization of switchgear',
        'Standards-compliant documentation according to VDE and IEC',
        'Project management and scheduling',
        'Cost optimization and economic analysis',
        'Integration into existing systems and infrastructures'
      ],
      technologies: isGerman ? [
        'CAD-Software für Elektroplanung (EPLAN, AutoCAD Electrical)',
        '3D-Modellierung und Simulation',
        'Projektmanagement-Tools',
        'Normendatenbanken und Berechnungssoftware'
      ] : [
        'CAD software for electrical planning (EPLAN, AutoCAD Electrical)',
        '3D modeling and simulation',
        'Project management tools',
        'Standards databases and calculation software'
      ],
      image: '/img/planung-engineering.jpg'
    },
    installation: {
      title: t('clients.automation.installation_details.title'),
      subtitle: t('clients.automation.installation_details.subtitle'),
      description: t('clients.automation.installation_details.description'),
      services: isGerman ? [
        'Montage von Schaltschränken und Verteilern',
        'Installation von SPS-Systemen und Steuerungen',
        'Verlegung und Anschluss von Kabeln und Leitungen',
        'Montage von Sensoren und Aktoren',
        'Installation von HMI-Panels und Bediengeräten',
        'Aufbau von Netzwerk- und Kommunikationsinfrastruktur',
        'Integration von Sicherheitssystemen',
        'Dokumentation und Kennzeichnung aller Komponenten'
      ] : [
        'Assembly of control cabinets and distributors',
        'Installation of PLC systems and controls',
        'Laying and connection of cables and lines',
        'Assembly of sensors and actuators',
        'Installation of HMI panels and operating devices',
        'Setup of network and communication infrastructure',
        'Integration of safety systems',
        'Documentation and labeling of all components'
      ],
      technologies: isGerman ? [
        'Siemens S7-Systeme (S7-1200, S7-1500)',
        'Beckhoff TwinCAT Automatisierung',
        'Phoenix Contact PLCnext',
        'Profinet, Profibus, Ethernet/IP Kommunikation'
      ] : [
        'Siemens S7 systems (S7-1200, S7-1500)',
        'Beckhoff TwinCAT automation',
        'Phoenix Contact PLCnext',
        'Profinet, Profibus, Ethernet/IP communication'
      ],
      image: '/img/automatisierung_2.jpg'
    },
    service: {
      title: t('clients.automation.service_details.title'),
      subtitle: t('clients.automation.service_details.subtitle'),
      description: t('clients.automation.service_details.description'),
      services: isGerman ? [
        'Funktionsprüfung und Systemtest',
        'Programmierung und Parametrierung',
        'Inbetriebnahme und Optimierung',
        'Schulung Ihres Bedienungspersonals',
        'Erstellung von Betriebsanleitungen',
        'Wartungsverträge und präventive Instandhaltung',
        '24/7 Störungsdienst und Fernwartung',
        'Software-Updates und Systemerweiterungen'
      ] : [
        'Functional testing and system testing',
        'Programming and parameterization',
        'Commissioning and optimization',
        'Training of your operating personnel',
        'Creation of operating instructions',
        'Maintenance contracts and preventive maintenance',
        '24/7 emergency service and remote maintenance',
        'Software updates and system extensions'
      ],
      technologies: isGerman ? [
        'Fernwartung über VPN-Verbindungen',
        'Condition Monitoring Systeme',
        'Predictive Maintenance Lösungen',
        'Mobile Service-Apps für Techniker'
      ] : [
        'Remote maintenance via VPN connections',
        'Condition monitoring systems',
        'Predictive maintenance solutions',
        'Mobile service apps for technicians'
      ],
      image: '/img/technician-at-work_3.jpg'
    }
  }
  
  return serviceData[selectedServiceType.value]
})

const openServiceModal = (serviceType) => {
  selectedServiceType.value = serviceType
  showServiceModal.value = true
}

const closeServiceModal = () => {
  showServiceModal.value = false
  selectedServiceType.value = null
}

// Animated counters
const { currentValue: customersCount, elementRef: customers } = useCountAnimation(500, { 
  duration: 2500,
  easing: 'easeOutQuart'
})

const { currentValue: experienceCount, elementRef: experience } = useCountAnimation(15, { 
  duration: 2000,
  easing: 'easeOutQuart'
})

const { currentValue: projectsCount, elementRef: projects } = useCountAnimation(1000, { 
  duration: 3000,
  easing: 'easeOutQuart'
})
</script>