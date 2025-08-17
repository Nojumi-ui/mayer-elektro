<template>
  <section id="kunden" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
      <div ref="headerRef" class="text-center mb-16">
        <h2 :class="['text-4xl md:text-5xl font-bold text-gray-800 mb-6 fade-in-up', { visible: headerVisible }]">Für Kunden</h2>
        <p :class="['text-xl text-gray-600 max-w-3xl mx-auto fade-in-up stagger-1', { visible: headerVisible }]">
          Professionelle Elektroinstallationen und Automatisierungslösungen für Privat- und Geschäftskunden.
        </p>
      </div>

      <div ref="servicesRef" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <!-- Wohngebäude -->
        <div :class="['bg-white rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-1 overflow-hidden', { visible: servicesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/smart-home.jpg" 
              alt="Smart Home Installation" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Wohngebäude</h3>
            <p class="text-gray-600 mb-4">Komplette Elektroinstallation für Neubauten, Sanierungen und Modernisierungen.</p>
            <ul class="text-sm text-gray-600 space-y-2">
              <li>• Hausinstallationen</li>
              <li>• Smart Home Systeme</li>
              <li>• Beleuchtungskonzepte</li>
              <li>• Sicherheitstechnik</li>
            </ul>
          </div>
        </div>

        <!-- Gewerbe & Industrie -->
        <div :class="['bg-white rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-2 overflow-hidden', { visible: servicesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/industrial-automation.jpg" 
              alt="Industrielle Automatisierung" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Gewerbe & Industrie</h3>
            <p class="text-gray-600 mb-4">Professionelle Lösungen für Bürogebäude, Produktionsstätten und Industrieanlagen.</p>
            <ul class="text-sm text-gray-600 space-y-2">
              <li>• Industrieinstallationen</li>
              <li>• Maschinenanbindung</li>
              <li>• Schaltschrankbau</li>
              <li>• Wartung & Service</li>
            </ul>
          </div>
        </div>

        <!-- Automatisierung -->
        <div :class="['bg-white rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-3 overflow-hidden', { visible: servicesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/electrical-panel.jpg" 
              alt="Schaltschrank und Automatisierung" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Automatisierung</h3>
            <p class="text-gray-600 mb-4">Moderne Automatisierungslösungen für effiziente und intelligente Systeme.</p>
            <ul class="text-sm text-gray-600 space-y-2">
              <li>• SPS-Programmierung</li>
              <li>• Prozessautomatisierung</li>
              <li>• Visualisierung</li>
              <li>• Fernwartung</li>
            </ul>
          </div>
        </div>
      </div>

      <div ref="processRef" class="grid md:grid-cols-2 gap-12 mb-16">
        <div :class="['fade-in-left', { visible: processVisible }]">
          <h3 class="text-3xl font-bold text-gray-800 mb-6">Unser Service</h3>
          <div class="space-y-6">
            <div class="flex items-start">
              <div class="w-8 h-8 bg-[#0097b2] rounded-full flex items-center justify-center mr-4 mt-1">
                <span class="text-white font-bold text-sm">1</span>
              </div>
              <div>
                <h4 class="text-xl font-semibold text-gray-800 mb-2">Beratung & Planung</h4>
                <p class="text-gray-600">Kostenlose Erstberatung und detaillierte Projektplanung nach Ihren Wünschen.</p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="w-8 h-8 bg-[#0097b2] rounded-full flex items-center justify-center mr-4 mt-1">
                <span class="text-white font-bold text-sm">2</span>
              </div>
              <div>
                <h4 class="text-xl font-semibold text-gray-800 mb-2">Ausführung</h4>
                <p class="text-gray-600">Fachgerechte Installation durch qualifizierte Elektriker mit modernster Technik.</p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="w-8 h-8 bg-[#0097b2] rounded-full flex items-center justify-center mr-4 mt-1">
                <span class="text-white font-bold text-sm">3</span>
              </div>
              <div>
                <h4 class="text-xl font-semibold text-gray-800 mb-2">Service & Wartung</h4>
                <p class="text-gray-600">Langfristige Betreuung und regelmäßige Wartung Ihrer Elektroinstallationen.</p>
              </div>
            </div>
          </div>
        </div>
        <div :class="['fade-in-right', { visible: processVisible }]">
          <img 
            src="/img/technician-at-work.jpg" 
            alt="Techniker bei der Arbeit" 
            class="w-full h-96 object-cover rounded-lg shadow-lg"
          >
        </div>

        <div class="bg-[#0097b2] text-white p-8 rounded-lg">
          <h3 class="text-3xl font-bold mb-6">Kostenlose Beratung</h3>
          <p class="text-lg mb-6">
            Lassen Sie sich unverbindlich von unseren Experten beraten. 
            Wir erstellen Ihnen gerne ein individuelles Angebot.
          </p>
          <div class="space-y-4">
            <div class="flex items-center">
              <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
              <span>+49 (0) 123 456789</span>
            </div>
            <div class="flex items-center">
              <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
              <span>info@mayer-elektro.de</span>
            </div>
            <div class="flex items-center">
              <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <span>Mo-Fr: 7:00 - 17:00 Uhr</span>
            </div>
          </div>
          <a href="#contact" class="inline-block bg-white text-[#0097b2] px-6 py-3 rounded-full font-semibold mt-6 hover:bg-gray-100 transition">
            Jetzt Kontakt aufnehmen
          </a>
        </div>
      </div>

      <!-- Referenzen -->
      <div ref="statsRef" class="text-center">
        <h3 :class="['text-3xl font-bold text-gray-800 mb-8 fade-in-up', { visible: statsVisible }]">Unsere Referenzen</h3>
        <div class="grid md:grid-cols-4 gap-8">
          <div :class="['text-center scale-in stagger-1', { visible: statsVisible }]">
            <div ref="customers" class="text-4xl font-bold text-[#0097b2] mb-2">{{ customersCount }}+</div>
            <p class="text-gray-600">Zufriedene Kunden</p>
          </div>
          <div :class="['text-center scale-in stagger-2', { visible: statsVisible }]">
            <div ref="experience" class="text-4xl font-bold text-[#0097b2] mb-2">{{ experienceCount }}</div>
            <p class="text-gray-600">Jahre Erfahrung</p>
          </div>
          <div :class="['text-center scale-in stagger-3', { visible: statsVisible }]">
            <div ref="projects" class="text-4xl font-bold text-[#0097b2] mb-2">{{ projectsCount }}+</div>
            <p class="text-gray-600">Projekte realisiert</p>
          </div>
          <div :class="['text-center scale-in stagger-4', { visible: statsVisible }]">
            <div class="text-4xl font-bold text-[#0097b2] mb-2">24/7</div>
            <p class="text-gray-600">Notdienst</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useScrollAnimation } from '../composables/useScrollAnimation.js'
import { useCountAnimation } from '../composables/useCountAnimation.js'

const { isVisible: headerVisible, elementRef: headerRef } = useScrollAnimation()
const { isVisible: servicesVisible, elementRef: servicesRef } = useScrollAnimation()
const { isVisible: processVisible, elementRef: processRef } = useScrollAnimation()
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