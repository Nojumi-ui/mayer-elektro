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

        <div class="grid md:grid-cols-3 gap-8">
          <div :class="['bg-gray-50 dark:bg-gray-700 p-6 rounded-lg scale-in stagger-1 transition-colors duration-200', { visible: automatisierungVisible }]">
            <div class="w-12 h-12 bg-[#0097b2] rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('clients.automation.planning_title') }}</h4>
            <p class="text-gray-600 dark:text-gray-400">
              {{ t('clients.automation.planning_desc') }}
            </p>
          </div>

          <div :class="['bg-gray-50 dark:bg-gray-700 p-6 rounded-lg scale-in stagger-2 transition-colors duration-200', { visible: automatisierungVisible }]">
            <div class="w-12 h-12 bg-[#0097b2] rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('clients.automation.installation_title') }}</h4>
            <p class="text-gray-600 dark:text-gray-400">
              {{ t('clients.automation.installation_desc') }}
            </p>
          </div>

          <div :class="['bg-gray-50 dark:bg-gray-700 p-6 rounded-lg scale-in stagger-3 transition-colors duration-200', { visible: automatisierungVisible }]">
            <div class="w-12 h-12 bg-[#0097b2] rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('clients.automation.service_title') }}</h4>
            <p class="text-gray-600 dark:text-gray-400">
              {{ t('clients.automation.service_desc') }}
            </p>
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
  </section>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
import { useScrollAnimation } from '../composables/useScrollAnimation.js'
import { useCountAnimation } from '../composables/useCountAnimation.js'

const { t } = useI18n()

const { isVisible: headerVisible, elementRef: headerRef } = useScrollAnimation()
const { isVisible: automatisierungVisible, elementRef: automatisierungRef } = useScrollAnimation()
const { isVisible: instandhaltungVisible, elementRef: instandhaltungRef } = useScrollAnimation()
const { isVisible: elektroinstallationVisible, elementRef: elektroinstallationRef } = useScrollAnimation()
const { isVisible: personalVisible, elementRef: personalRef } = useScrollAnimation()
const { isVisible: statsVisible, elementRef: statsRef } = useScrollAnimation()

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