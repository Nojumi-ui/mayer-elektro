<template>
  <section id="jobs" class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-6">
      <!-- Header -->
      <div ref="headerRef" class="text-center mb-16">
        <h2 :class="['text-4xl md:text-5xl font-bold text-gray-800 dark:text-gray-200 mb-6 fade-in-up', { visible: headerVisible }]">
          {{ t('jobs.title') }}
        </h2>
        <p :class="['text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto fade-in-up stagger-1', { visible: headerVisible }]">
          {{ t('jobs.subtitle') }}
        </p>
      </div>

      <!-- Stellenangebote Sektion -->
      <div id="stellenangebote" ref="jobsRef" class="mb-20">
        <h3 :class="['text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 fade-in-up', { visible: jobsVisible }]">
          {{ t('nav.stellenangebote') }}
        </h3>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="(job, index) in jobs" :key="index"
               :class="['bg-gray-50 dark:bg-gray-800 rounded-lg p-6 hover:shadow-lg dark:hover:shadow-gray-700 transition scale-in', `stagger-${index + 1}`, { visible: jobsVisible }]">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 bg-[#0097b2] rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="job.icon"></path>
                </svg>
              </div>
              <span class="text-sm text-gray-500 dark:text-gray-400">{{ job.type }}</span>
            </div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">{{ job.title }}</h4>
            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ job.location }} - ab sofort</p>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ job.description }}</p>
            <a 
              href="/bewerbungsformular"
              class="block w-full bg-[#0097b2] text-white py-2 px-4 rounded-lg hover:bg-cyan-600 transition text-center cursor-pointer no-underline"
              @click="handleClick"
            >
              {{ t('jobs.apply_now') }}
            </a>
          </div>
        </div>

        <div class="text-center mt-8">
          <a href="#initiativbewerbung" @click="scrollToSection('initiativbewerbung')" 
             class="inline-block bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 px-6 py-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition">
            {{ t('jobs.view_all_jobs') }}
          </a>
        </div>
      </div>

      <!-- Initiativbewerbung Sektion -->
      <div id="initiativbewerbung" ref="initiativeRef" class="mb-20">
        <div class="bg-gradient-to-r from-cyan-600 to-[#0097b2] rounded-lg p-8 text-white">
          <div :class="['text-center fade-in-up', { visible: initiativeVisible }]">
            <h3 class="text-3xl font-bold mb-4">{{ t('jobs.initiative_title') }}</h3>
            <p class="text-xl mb-6 opacity-90">
              {{ t('jobs.initiative_subtitle') }}
            </p>
            <p class="mb-8 opacity-80">
              {{ t('jobs.initiative_description') }}
            </p>
            <a 
              href="/bewerbungsformular"
              class="inline-block bg-white text-[#0097b2] px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition cursor-pointer no-underline"
              @click="handleClick"
            >
              {{ t('jobs.initiative_button') }}
            </a>
          </div>
        </div>
      </div>

      <!-- Bewerbungsablauf Sektion -->
      <div id="bewerbungsablauf" ref="processRef" class="mb-20">
        <h3 :class="['text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center fade-in-up', { visible: processVisible }]">
          {{ t('jobs.process_title') }}
        </h3>
        
        <div class="grid md:grid-cols-4 gap-8">
          <div :class="['text-center scale-in stagger-1', { visible: processVisible }]">
            <div class="w-16 h-16 bg-[#0097b2] rounded-full flex items-center justify-center mx-auto mb-4">
              <span class="text-white font-bold text-xl">1</span>
            </div>
            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ t('jobs.process_step1_title') }}</h4>
            <p class="text-gray-600 dark:text-gray-400">
              {{ t('jobs.process_step1_desc') }}
            </p>
          </div>

          <div :class="['text-center scale-in stagger-2', { visible: processVisible }]">
            <div class="w-16 h-16 bg-[#0097b2] rounded-full flex items-center justify-center mx-auto mb-4">
              <span class="text-white font-bold text-xl">2</span>
            </div>
            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ t('jobs.process_step2_title') }}</h4>
            <p class="text-gray-600 dark:text-gray-400">
              {{ t('jobs.process_step2_desc') }}
            </p>
          </div>

          <div :class="['text-center scale-in stagger-3', { visible: processVisible }]">
            <div class="w-16 h-16 bg-[#0097b2] rounded-full flex items-center justify-center mx-auto mb-4">
              <span class="text-white font-bold text-xl">3</span>
            </div>
            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ t('jobs.process_step3_title') }}</h4>
            <p class="text-gray-600 dark:text-gray-400">
              {{ t('jobs.process_step3_desc') }}
            </p>
          </div>

          <div :class="['text-center scale-in stagger-4', { visible: processVisible }]">
            <div class="w-16 h-16 bg-[#0097b2] rounded-full flex items-center justify-center mx-auto mb-4">
              <span class="text-white font-bold text-xl">4</span>
            </div>
            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ t('jobs.process_step4_title') }}</h4>
            <p class="text-gray-600 dark:text-gray-400">
              {{ t('jobs.process_step4_desc') }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.no-underline {
  text-decoration: none !important;
}

.no-underline:hover {
  text-decoration: none !important;
}
</style>

<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'
import { useRouter } from 'vue-router'
import { useScrollAnimation } from '../composables/useScrollAnimation.js'

const { t } = useI18n()
const router = useRouter()

const handleClick = (event) => {
  console.log('Link clicked - JobsSection')
  // Lassen wir den natürlichen Link funktionieren
}

// Multiple animation observers for different sections
const { isVisible: headerVisible, elementRef: headerRef } = useScrollAnimation()
const { isVisible: jobsVisible, elementRef: jobsRef } = useScrollAnimation()
const { isVisible: initiativeVisible, elementRef: initiativeRef } = useScrollAnimation()
const { isVisible: processVisible, elementRef: processRef } = useScrollAnimation()

const jobs = computed(() => [
  {
    title: t('jobs.electrician'),
    location: 'Hamburg',
    type: t('jobs.full_time'),
    description: t('jobs.electrician_desc'),
    icon: 'M13 10V3L4 14h7v7l9-11h-7z'
  },
  {
    title: t('jobs.automation_technician'),
    location: 'Lübeck',
    type: t('jobs.full_time'),
    description: t('jobs.automation_technician_desc'),
    icon: 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
  },
  {
    title: t('jobs.service_technician'),
    location: 'Kiel',
    type: t('jobs.full_time'),
    description: t('jobs.service_technician_desc'),
    icon: 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'
  },
  {
    title: t('jobs.apprentice'),
    location: 'Hamburg',
    type: t('jobs.apprenticeship'),
    description: t('jobs.apprentice_desc'),
    icon: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'
  }
])

const scrollToSection = (sectionId) => {
  const element = document.getElementById(sectionId);
  if (element) {
    const navbarHeight = 80;
    const elementPosition = element.offsetTop - navbarHeight;
    
    window.scrollTo({
      top: elementPosition,
      behavior: 'smooth'
    });
  }
};
</script>