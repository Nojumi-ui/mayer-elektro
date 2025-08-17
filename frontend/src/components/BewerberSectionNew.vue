<template>
  <section id="bewerber" class="py-20 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-6">
      <!-- Header -->
      <div ref="headerRef" class="text-center mb-16">
        <h2 :class="['text-4xl md:text-5xl font-bold text-gray-800 dark:text-gray-200 mb-6 fade-in-up', { visible: headerVisible }]">{{ t('applicants.title') }}</h2>
        <p :class="['text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto fade-in-up stagger-1', { visible: headerVisible }]">
          {{ t('applicants.subtitle') }}
        </p>
      </div>

      <!-- Ausbildung Sektion -->
      <div id="ausbildung" ref="ausbildungRef" class="mb-20">
        <h3 :class="['text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 fade-in-up', { visible: ausbildungVisible }]">
          {{ t('applicants.training.title') }}
        </h3>
        
        <div class="grid md:grid-cols-2 gap-12">
          <div :class="['fade-in-left', { visible: ausbildungVisible }]">
            <h4 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ t('applicants.training.subtitle') }}</h4>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
              {{ t('applicants.training.description') }}
            </p>
            
            <div class="space-y-4">
              <div class="flex items-start">
                <div class="w-6 h-6 bg-[#0097b2] rounded-full flex items-center justify-center mr-3 mt-1">
                  <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <h5 class="font-semibold text-gray-800 dark:text-gray-200">{{ t('applicants.training.practical_training') }}</h5>
                  <p class="text-gray-600 dark:text-gray-400">{{ t('applicants.training.practical_desc') }}</p>
                </div>
              </div>
              
              <div class="flex items-start">
                <div class="w-6 h-6 bg-[#0097b2] rounded-full flex items-center justify-center mr-3 mt-1">
                  <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <h5 class="font-semibold text-gray-800 dark:text-gray-200">{{ t('applicants.training.job_guarantee') }}</h5>
                  <p class="text-gray-600 dark:text-gray-400">{{ t('applicants.training.job_guarantee_desc') }}</p>
                </div>
              </div>
              
              <div class="flex items-start">
                <div class="w-6 h-6 bg-[#0097b2] rounded-full flex items-center justify-center mr-3 mt-1">
                  <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <h5 class="font-semibold text-gray-800 dark:text-gray-200">{{ t('applicants.training.modern_equipment') }}</h5>
                  <p class="text-gray-600 dark:text-gray-400">{{ t('applicants.training.modern_equipment_desc') }}</p>
                </div>
              </div>
            </div>
          </div>
          
          <div :class="['fade-in-right', { visible: ausbildungVisible }]">
            <img 
              src="/img/ausbildung.jpg" 
              alt="Ausbildung bei Mayer Elektro" 
              class="w-full h-80 object-cover rounded-lg shadow-lg"
            >
          </div>
        </div>
      </div>

      <!-- Qualifizierungsangebote Sektion -->
      <div id="qualifizierung" ref="qualifizierungRef" class="mb-20">
        <h3 :class="['text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 fade-in-up', { visible: qualifizierungVisible }]">
          {{ t('applicants.qualification.title') }}
        </h3>
        
        <div class="grid md:grid-cols-3 gap-8">
          <div :class="['bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg scale-in stagger-1', { visible: qualifizierungVisible }]">
            <div class="w-12 h-12 bg-[#0097b2] rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('applicants.qualification.continuing_education') }}</h4>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('applicants.qualification.continuing_education_desc') }}
            </p>
            <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
              <li>• VDE-Normen Updates</li>
              <li>• Smart Home Technologien</li>
              <li>• Photovoltaik-Anlagen</li>
              <li>• E-Mobilität</li>
            </ul>
          </div>

          <div :class="['bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg scale-in stagger-2', { visible: qualifizierungVisible }]">
            <div class="w-12 h-12 bg-[#0097b2] rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('applicants.qualification.certifications') }}</h4>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('applicants.qualification.certifications_desc') }}
            </p>
            <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
              <li>• Elektrofachkraft</li>
              <li>• SPS-Programmierung</li>
              <li>• Arbeitsschutz</li>
              <li>• Meisterprüfung</li>
            </ul>
          </div>

          <div :class="['bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg scale-in stagger-3', { visible: qualifizierungVisible }]">
            <div class="w-12 h-12 bg-[#0097b2] rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('applicants.qualification.mentoring') }}</h4>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('applicants.qualification.mentoring_desc') }}
            </p>
            <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
              <li>• Persönliche Betreuung</li>
              <li>• Karriereplanung</li>
              <li>• Fachliche Unterstützung</li>
              <li>• Netzwerk-Aufbau</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Fachkräfte Sektion -->
      <div id="fachkraefte" ref="fachkraefteRef" class="mb-20">
        <h3 :class="['text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 fade-in-up', { visible: fachkraefteVisible }]">
          {{ t('applicants.professionals.title') }}
        </h3>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div :class="['bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-1', { visible: fachkraefteVisible }]">
            <div class="h-32 overflow-hidden rounded-lg mb-4">
              <img 
                src="/img/electrician_3.jpg" 
                alt="Elektrotechnik" 
                class="w-full h-full object-cover"
              >
            </div>
            <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">{{ t('applicants.professionals.electrical.title') }}</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
              {{ t('applicants.professionals.electrical.description') }}
            </p>
          </div>

          <div :class="['bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-2', { visible: fachkraefteVisible }]">
            <div class="h-32 overflow-hidden rounded-lg mb-4">
              <img 
                src="/img/automatisierung_3.jpg" 
                alt="Automatisierungstechnik" 
                class="w-full h-full object-cover"
              >
            </div>
            <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">{{ t('applicants.professionals.automation.title') }}</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
              {{ t('applicants.professionals.automation.description') }}
            </p>
          </div>

          <div :class="['bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-3', { visible: fachkraefteVisible }]">
            <div class="h-32 overflow-hidden rounded-lg mb-4">
              <img 
                src="/img/instandhaltung.jpg" 
                alt="Instandhaltung" 
                class="w-full h-full object-cover"
              >
            </div>
            <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">{{ t('applicants.professionals.maintenance.title') }}</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
              {{ t('applicants.professionals.maintenance.description') }}
            </p>
          </div>

          <div :class="['bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-4', { visible: fachkraefteVisible }]">
            <div class="h-32 overflow-hidden rounded-lg mb-4">
              <img 
                src="/img/schaltanlagenbau.jpg" 
                alt="Schaltanlagenbau" 
                class="w-full h-full object-cover"
              >
            </div>
            <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">{{ t('applicants.professionals.switchgear.title') }}</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
              {{ t('applicants.professionals.switchgear.description') }}
            </p>
          </div>
        </div>
      </div>

      <!-- Unsere Vorteile Sektion -->
      <div id="vorteile" ref="vorteileRef" class="mb-20">
        <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-lg">
          <h3 :class="['text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center fade-in-up', { visible: vorteileVisible }]">
            {{ t('applicants.benefits.title') }}
          </h3>
          
          <div class="grid md:grid-cols-2 gap-12">
            <div :class="['fade-in-left', { visible: vorteileVisible }]">
              <h4 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">{{ t('applicants.benefits.subtitle') }}</h4>
              <ul class="space-y-4 text-gray-600 dark:text-gray-400">
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#0097b2] mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <span><b>{{ t('applicants.benefits.permanent_position') }}</b> {{ t('applicants.benefits.permanent_position_desc') }}</span>
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#0097b2] mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <span><b>{{ t('applicants.benefits.exciting_projects') }}</b>, {{ t('applicants.benefits.exciting_projects_desc') }}</span>
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#0097b2] mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <span><b>{{ t('applicants.benefits.appreciative_cooperation') }}</b> – {{ t('applicants.benefits.appreciative_cooperation_desc') }}</span>
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#0097b2] mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <span><b>{{ t('applicants.benefits.room_for_initiative') }}</b> {{ t('applicants.benefits.room_for_initiative_desc') }}</span>
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#0097b2] mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <span><b>{{ t('applicants.benefits.attractive_compensation') }}</b> {{ t('applicants.benefits.attractive_compensation_desc') }}</span>
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#0097b2] mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <span><b>{{ t('applicants.benefits.strong_team') }}</b>, {{ t('applicants.benefits.strong_team_desc') }}</span>
                </li>
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-[#0097b2] mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <span><b>{{ t('applicants.benefits.vacation_days') }}</b> {{ t('applicants.benefits.vacation_days_desc') }}</span>
                </li>
              </ul>
            </div>
            
            <div :class="['fade-in-right', { visible: vorteileVisible }]">
              <img 
                src="/img/team.jpg" 
                alt="Unser Team bei Mayer Elektro" 
                class="w-full h-64 object-cover rounded-lg shadow-md"
              >
              <div class="mt-6">
                <h4 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">{{ t('applicants.benefits.application_title') }}</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                  {{ t('applicants.benefits.application_desc') }}
                </p>
                <div class="mt-6">
                  <a 
                    href="/bewerbungsformular"
                    class="inline-block bg-[#0097b2] text-white px-8 py-3 rounded-lg font-semibold hover:bg-cyan-600 transition cursor-pointer no-underline"
                  >
                    {{ t('applicants.benefits.apply_now') }}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useScrollAnimation } from '../composables/useScrollAnimation.js'
import { useI18n } from 'vue-i18n'
import { useRouter } from 'vue-router'

const { t } = useI18n()
const router = useRouter()

const navigateToApplication = () => {
  console.log('BewerberSectionNew: Button clicked')
  window.location.href = '/bewerbungsformular'
}
// Benefits translations updated

// Multiple animation observers for different sections
const { isVisible: headerVisible, elementRef: headerRef } = useScrollAnimation()
const { isVisible: ausbildungVisible, elementRef: ausbildungRef } = useScrollAnimation()
const { isVisible: qualifizierungVisible, elementRef: qualifizierungRef } = useScrollAnimation()
const { isVisible: fachkraefteVisible, elementRef: fachkraefteRef } = useScrollAnimation()
const { isVisible: vorteileVisible, elementRef: vorteileRef } = useScrollAnimation()
</script>