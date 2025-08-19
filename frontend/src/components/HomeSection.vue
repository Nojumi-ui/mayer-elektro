<template>
  <section id="home" class="relative h-screen flex flex-col justify-center items-center overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
      <img 
        src="/img/electrician.jpg" 
        alt="Elektriker bei der Arbeit - Mayer Elektro Hamburg" 
        class="w-full h-full object-cover"
        width="1920"
        height="1080"
        loading="eager"
        fetchpriority="high"
        sizes="100vw"
        srcset="/img/electrician-480w.jpg 480w, 
                /img/electrician-768w.jpg 768w, 
                /img/electrician-1024w.jpg 1024w, 
                /img/electrician-1280w.jpg 1280w, 
                /img/electrician.jpg 1920w"
      >
      <div class="absolute inset-0 bg-gradient-to-r from-cyan-600/90 to-[#0097b2]/90"></div>
    </div>
    
    <!-- Content -->
    <div ref="elementRef" class="relative z-10 text-center max-w-4xl mx-auto px-4 sm:px-6 text-white">
      <h1 :class="['text-2xl xs:text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black tracking-normal sm:tracking-tight mb-4 fade-in-up leading-tight break-words', { visible: isVisible }]">
        <span class="bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">MAYER</span>
        <span class="text-white font-light"> ELEKTRO</span>
        <span class="sr-only"> - Elektroinstallation & Gebäudetechnik Hamburg</span>
      </h1>
      <h2 :class="['text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl 2xl:text-5xl font-bold text-yellow-300 mb-4 tracking-wide sm:tracking-widest fade-in-up stagger-1 leading-tight break-words', { visible: isVisible }]">{{ t('home.service_title') || 'ELEKTROINSTALLATION & GEBÄUDETECHNIK HAMBURG' }}</h2>
      <div :class="['w-24 h-1 bg-gradient-to-r from-yellow-300 to-[#0097b2] mx-auto mb-10 fade-in-up stagger-2', { visible: isVisible }]"></div>
      <p :class="['text-base sm:text-lg md:text-xl lg:text-2xl font-light leading-relaxed max-w-3xl mx-auto mb-12 fade-in-up stagger-3', { visible: isVisible }]">
        <span class="text-yellow-300 font-medium">{{ t('home.premium_partner') || 'Ihr Premium-Partner' }}</span> {{ t('home.for_innovative') || 'für innovative' }} 
        <span class="text-cyan-200">{{ t('home.electrotechnology') || 'Elektrotechnik' }}</span>, {{ t('home.intelligent') || 'intelligente' }} 
        <span class="text-cyan-200">{{ t('home.automation') || 'Automatisierung' }}</span> {{ t('home.and_modern') || 'und moderne' }} 
        <span class="text-cyan-200">{{ t('home.building_technology') || 'Gebäudetechnik' }}</span>
      </p>
      <div :class="['flex flex-col sm:flex-row gap-6 justify-center items-center fade-in-up stagger-4', { visible: isVisible }]">
        <a href="#bewerber" @click="scrollToSection('bewerber')" class="bg-white text-[#0097b2] px-10 py-4 rounded-full shadow-lg hover:bg-gray-100 transition transform hover:scale-105 font-semibold text-lg min-w-[200px] text-center">{{ t('home.for_applicants') || 'Für Bewerber' }}</a>
        <a href="#kunden" @click="scrollToSection('kunden')" class="bg-transparent border-2 border-white text-white px-10 py-4 rounded-full hover:bg-white hover:text-[#0097b2] transition transform hover:scale-105 font-semibold text-lg min-w-[200px] text-center">{{ t('home.for_customers') || 'Für Kunden' }}</a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useScrollAnimation } from '../composables/useScrollAnimation.js'
import { useI18n } from 'vue-i18n'

const { isVisible, elementRef } = useScrollAnimation({ immediate: true })
const { t } = useI18n()



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