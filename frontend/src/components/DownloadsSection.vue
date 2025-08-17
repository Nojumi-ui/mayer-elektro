<template>
  <section id="downloads" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
      <div ref="headerRef" class="text-center mb-16">
        <h2 :class="['text-4xl md:text-5xl font-bold text-gray-800 mb-6 fade-in-up', { visible: headerVisible }]">Downloads</h2>
        <p :class="['text-xl text-gray-600 max-w-3xl mx-auto fade-in-up stagger-1', { visible: headerVisible }]">
          Hier finden Sie wichtige Dokumente, Formulare und Informationen zum Download.
        </p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Für Kunden -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
          <div class="w-16 h-16 bg-[#0097b2] rounded-full flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-800 mb-6">Für Kunden</h3>
          <div class="space-y-4">
            <a href="/downloads/leistungsuebersicht.pdf" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition" download>
              <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <div>
                <div class="font-semibold text-gray-800">Leistungsübersicht</div>
                <div class="text-sm text-gray-600">PDF • 2.1 MB</div>
              </div>
            </a>
            
            <a href="/downloads/preisliste.pdf" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition" download>
              <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <div>
                <div class="font-semibold text-gray-800">Preisliste 2024</div>
                <div class="text-sm text-gray-600">PDF • 1.8 MB</div>
              </div>
            </a>

            <a href="/downloads/agb.pdf" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition" download>
              <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <div>
                <div class="font-semibold text-gray-800">AGB</div>
                <div class="text-sm text-gray-600">PDF • 0.5 MB</div>
              </div>
            </a>
          </div>
        </div>

        <!-- Für Bewerber -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
          <div class="w-16 h-16 bg-[#0097b2] rounded-full flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-800 mb-6">Für Bewerber</h3>
          <div class="space-y-4">
            <a href="/downloads/stellenausschreibungen.pdf" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition" download>
              <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <div>
                <div class="font-semibold text-gray-800">Aktuelle Stellenausschreibungen</div>
                <div class="text-sm text-gray-600">PDF • 1.2 MB</div>
              </div>
            </a>
            
            <a 
              href="/bewerbungsformular"
              class="flex items-center p-4 bg-[#0097b2] text-white rounded-lg hover:bg-cyan-600 transition cursor-pointer no-underline"
            >
              <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <div>
                <div class="font-semibold">Online-Bewerbungsformular</div>
                <div class="text-sm opacity-90">Direkt online bewerben</div>
              </div>
            </a>

            <a href="/downloads/ausbildungsinfo.pdf" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition" download>
              <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <div>
                <div class="font-semibold text-gray-800">Ausbildungsinformationen</div>
                <div class="text-sm text-gray-600">PDF • 1.5 MB</div>
              </div>
            </a>
          </div>
        </div>

        <!-- Technische Dokumente -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
          <div class="w-16 h-16 bg-[#0097b2] rounded-full flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-800 mb-6">Technische Dokumente</h3>
          <div class="space-y-4">
            <a href="/downloads/normen-richtlinien.pdf" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition" download>
              <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <div>
                <div class="font-semibold text-gray-800">Normen & Richtlinien</div>
                <div class="text-sm text-gray-600">PDF • 3.2 MB</div>
              </div>
            </a>
            
            <a href="/downloads/wartungshandbuch.pdf" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition" download>
              <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <div>
                <div class="font-semibold text-gray-800">Wartungshandbuch</div>
                <div class="text-sm text-gray-600">PDF • 2.8 MB</div>
              </div>
            </a>

            <a href="/downloads/sicherheitsdatenblatt.pdf" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition" download>
              <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <div>
                <div class="font-semibold text-gray-800">Sicherheitsdatenblätter</div>
                <div class="text-sm text-gray-600">PDF • 1.9 MB</div>
              </div>
            </a>
          </div>
        </div>
      </div>

      <!-- Zusätzliche Informationen -->
      <div class="mt-16 bg-white p-8 rounded-lg shadow-lg">
        <div class="text-center mb-8">
          <h3 class="text-3xl font-bold text-gray-800 mb-4">Weitere Informationen</h3>
          <p class="text-gray-600 max-w-2xl mx-auto">
            Benötigen Sie weitere Dokumente oder haben Sie Fragen zu unseren Downloads? 
            Kontaktieren Sie uns gerne!
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 text-center">
          <div>
            <div class="w-16 h-16 bg-[#0097b2] rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-semibold text-gray-800 mb-2">Telefonisch</h4>
            <p class="text-gray-600">+49 (0) 123 456789</p>
            <p class="text-sm text-gray-500">Mo-Fr: 7:00 - 17:00 Uhr</p>
          </div>

          <div>
            <div class="w-16 h-16 bg-[#0097b2] rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-semibold text-gray-800 mb-2">Per E-Mail</h4>
            <p class="text-gray-600">info@mayer-elektro.de</p>
            <p class="text-sm text-gray-500">Antwort innerhalb von 24h</p>
          </div>

          <div>
            <div class="w-16 h-16 bg-[#0097b2] rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
            </div>
            <h4 class="text-xl font-semibold text-gray-800 mb-2">Vor Ort</h4>
            <p class="text-gray-600">Musterstraße 123</p>
            <p class="text-sm text-gray-500">12345 Musterstadt</p>
          </div>
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
  console.log('DownloadsSection: Button clicked')
  window.location.href = '/bewerbungsformular'
}

const { isVisible: headerVisible, elementRef: headerRef } = useScrollAnimation()
</script>