<template>
  <section id="bewerber" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
      <div ref="headerRef" class="text-center mb-16">
        <h2 :class="['text-4xl md:text-5xl font-bold text-gray-800 mb-6 fade-in-up', { visible: headerVisible }]">Für Bewerber</h2>
        <p :class="['text-xl text-gray-600 max-w-3xl mx-auto fade-in-up stagger-1', { visible: headerVisible }]">
          Starten Sie Ihre Karriere bei Mayer Elektro! Wir bieten spannende Möglichkeiten für Fachkräfte und Quereinsteiger.
        </p>
      </div>

      <div ref="cardsRef" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <!-- Elektroinstallateur -->
        <div :class="['bg-white rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-1 overflow-hidden', { visible: cardsVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/electrician_2.jpg" 
              alt="Elektroinstallateur bei der Arbeit" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Elektroinstallateur</h3>
            <p class="text-gray-600 mb-4">Vollzeit-Position für erfahrene Elektroinstallateure mit Gesellenbrief oder vergleichbarer Qualifikation.</p>
            <ul class="text-sm text-gray-600 space-y-2 mb-4">
              <li>• Attraktive Vergütung</li>
              <li>• Firmenwagen</li>
              <li>• Weiterbildungsmöglichkeiten</li>
            </ul>
            <a 
              href="/bewerbungsformular"
              class="block w-full bg-[#0097b2] text-white py-2 px-4 rounded-lg hover:bg-cyan-600 transition text-center cursor-pointer no-underline"
            >
              Jetzt bewerben
            </a>
          </div>
        </div>

        <!-- Automatisierungstechniker -->
        <div :class="['bg-white rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-2 overflow-hidden', { visible: cardsVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/automatisierung.jpg" 
              alt="Automatisierungstechniker" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Automatisierungstechniker</h3>
            <p class="text-gray-600 mb-4">Spezialist für SPS-Programmierung und Automatisierungslösungen in der Industrie.</p>
            <ul class="text-sm text-gray-600 space-y-2 mb-4">
              <li>• Moderne Technologien</li>
              <li>• Projektverantwortung</li>
              <li>• Flexible Arbeitszeiten</li>
            </ul>
            <a 
              href="/bewerbungsformular"
              class="block w-full bg-[#0097b2] text-white py-2 px-4 rounded-lg hover:bg-cyan-600 transition text-center cursor-pointer no-underline"
            >
              Jetzt bewerben
            </a>
          </div>
        </div>

        <!-- Ausbildung -->
        <div :class="['bg-white rounded-lg shadow-lg hover:shadow-xl transition scale-in stagger-3 overflow-hidden', { visible: cardsVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/ausbildung.jpg" 
              alt="Ausbildung Elektroniker" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Ausbildung</h3>
            <p class="text-gray-600 mb-4">Ausbildungsplätze zum Elektroniker für Energie- und Gebäudetechnik.</p>
            <ul class="text-sm text-gray-600 space-y-2 mb-4">
              <li>• Praxisnahe Ausbildung</li>
              <li>• Übernahmegarantie</li>
              <li>• Moderne Ausstattung</li>
            </ul>
            <a 
              href="/bewerbungsformular"
              class="block w-full bg-[#0097b2] text-white py-2 px-4 rounded-lg hover:bg-cyan-600 transition text-center cursor-pointer no-underline"
            >
              Jetzt bewerben
            </a>
          </div>
        </div>
      </div>

      <div ref="benefitsRef" class="bg-white p-8 rounded-lg shadow-lg">
        <h3 :class="['text-3xl font-bold text-gray-800 mb-6 text-center fade-in-up', { visible: benefitsVisible }]">Warum Mayer Elektro?</h3>
        <div class="grid md:grid-cols-2 gap-8">
          <div :class="['fade-in-left', { visible: benefitsVisible }]">
            <h4 class="text-xl font-semibold text-gray-800 mb-4">Unsere Vorteile</h4>
            <ul class="space-y-3 text-gray-600">
              <li class="flex items-center">
                <svg class="w-5 h-5 text-[#0097b2] mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Tarifliche Bezahlung nach IG Metall
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-[#0097b2] mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                30 Tage Urlaub + Sonderurlaub
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-[#0097b2] mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Betriebliche Altersvorsorge
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-[#0097b2] mr-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Regelmäßige Weiterbildungen
              </li>
            </ul>
          </div>
          <div :class="['fade-in-right', { visible: benefitsVisible }]">
            <img 
              src="/img/team.jpg" 
              alt="Unser Team bei Mayer Elektro" 
              class="w-full h-64 object-cover rounded-lg shadow-md"
            >
          </div>
            <h4 class="text-xl font-semibold text-gray-800 mb-4">Bewerbung</h4>
            <p class="text-gray-600 mb-6">
              Nutzen Sie unser Online-Bewerbungsformular für eine schnelle und einfache Bewerbung. 
              Laden Sie Ihre Unterlagen direkt hoch und senden Sie uns Ihre Bewerbung mit nur einem Klick!
            </p>
            <a 
              href="/bewerbungsformular"
              class="inline-block bg-[#0097b2] text-white px-6 py-3 rounded-lg font-semibold hover:bg-cyan-600 transition cursor-pointer no-underline"
            >
              Jetzt bewerben
            </a>
          </div>
        </div>
      </div>
  </section>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { useScrollAnimation } from '../composables/useScrollAnimation.js'

const router = useRouter()

const navigateToApplication = () => {
  console.log('BewerberSection: Button clicked')
  // Direkte Navigation mit window.location
  window.location.href = '/bewerbungsformular'
}

// Multiple animation observers for different sections
const { isVisible: headerVisible, elementRef: headerRef } = useScrollAnimation()
const { isVisible: cardsVisible, elementRef: cardsRef } = useScrollAnimation()
const { isVisible: benefitsVisible, elementRef: benefitsRef } = useScrollAnimation()
</script>