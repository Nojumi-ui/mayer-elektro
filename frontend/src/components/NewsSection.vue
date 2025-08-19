<template>
  <section id="news" class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-6">
      <div ref="headerRef" class="text-center mb-16">
        <h2 :class="['text-4xl md:text-5xl font-bold text-gray-800 dark:text-gray-200 mb-6 fade-in-up', { visible: headerVisible }]">{{ t('news.title') }}</h2>
        <p :class="['text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto fade-in-up stagger-1', { visible: headerVisible }]">
          {{ t('news.subtitle') }}
        </p>
      </div>

      <div ref="articlesRef" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <!-- News Artikel 1 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-1', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/electrician_3.jpg" 
              alt="Neues Bürogebäude Projekt" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article1.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article1.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article1.description') }}
            </p>
            <button @click="openNewsModal('article1')" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.learn_more') }}</button>
          </div>
        </article>

        <!-- News Artikel 2 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-2', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/solar-panels.jpg" 
              alt="Photovoltaik-Anlagen Installation" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article2.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article2.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article2.description') }}
            </p>
            <button @click="openNewsModal('article2')" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.learn_more') }}</button>
          </div>
        </article>

        <!-- News Artikel 3 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-3', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/heat-pump.jpg" 
              alt="Wärmepumpen Installation" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article3.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article3.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article3.description') }}
            </p>
            <button @click="openNewsModal('article3')" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.learn_more') }}</button>
          </div>
        </article>

        <!-- News Artikel 4 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-4', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/smart-home.jpg" 
              alt="Smart Home Trends 2025" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article4.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article4.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article4.description') }}
            </p>
            <button @click="openNewsModal('article4')" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.learn_more') }}</button>
          </div>
        </article>

        <!-- News Artikel 5 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-5', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/technician-at-work_2.jpg" 
              alt="24/7 Notdienst" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article5.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article5.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article5.description') }}
            </p>
            <a href="#contact" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.contact_emergency') }}</a>
          </div>
        </article>

        <!-- News Artikel 6 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-6', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/industrial-automation_3.jpg" 
              alt="Industrielle Automatisierung" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article6.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article6.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article6.description') }}
            </p>
            <button @click="openNewsModal('article6')" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.learn_more') }}</button>
          </div>
        </article>
      </div>

      <!-- Newsletter Anmeldung -->
      <!--div class="bg-[#0097b2] text-white p-8 rounded-lg text-center">
        <h3 class="text-3xl font-bold mb-4">{{ t('newsletter.title') }}</h3>
        <p class="text-lg mb-6 max-w-2xl mx-auto">
          {{ t('newsletter.description') }}
        </p>
        <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
          <input 
            type="email" 
            :placeholder="$t('newsletter.email_placeholder')" 
            class="flex-1 px-4 py-3 rounded-lg bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-white"
            required
          >
          <button 
            type="submit" 
            class="bg-white text-[#0097b2] px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition whitespace-nowrap"
          >
            {{ t('newsletter.subscribe_button') }}
          </button>
        </form>
        <p class="text-sm mt-4 opacity-80">
          {{ t('newsletter.privacy_note') }}
        </p>
      </div-->

      <!-- Archiv -->
      <div class="mt-16 text-center">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">{{ t('news.archive_title') }}</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">
          {{ t('news.archive_description') }}
        </p>
        <a href="#" class="inline-block bg-[#0097b2] text-white px-8 py-3 rounded-full font-semibold hover:bg-cyan-600 transition">
          {{ t('news.view_archive') }}
        </a>
      </div>
    </div>

    <!-- News Details Modal -->
    <div v-if="showNewsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" @click="closeNewsModal">
      <div class="bg-white dark:bg-gray-800 rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto" @click.stop>
        <div class="sticky top-0 bg-white dark:bg-gray-800 border-b dark:border-gray-700 p-6 flex justify-between items-center">
          <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ selectedNews?.title }}</h2>
          <button @click="closeNewsModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        
        <div class="p-6">
          <!-- Header Image -->
          <div class="mb-6">
            <img 
              :src="selectedNews?.image" 
              :alt="selectedNews?.title" 
              class="w-full h-64 object-cover rounded-lg"
            >
          </div>

          <!-- Article Meta -->
          <div class="flex items-center gap-4 mb-6 text-sm text-gray-600 dark:text-gray-400">
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1m-6 0h8m-9 0a1 1 0 00-1 1v10a1 1 0 001-1V8a1 1 0 00-1-1H7z"></path>
              </svg>
              <span>{{ selectedNews?.date }}</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
              </svg>
              <span>{{ selectedNews?.category }}</span>
            </div>
          </div>

          <!-- Article Content -->
          <div class="prose dark:prose-invert max-w-none">
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">{{ selectedNews?.description }}</p>
            
            <div v-html="selectedNews?.content" class="space-y-4 text-gray-700 dark:text-gray-300"></div>
          </div>

          <!-- Additional Images -->
          <div v-if="selectedNews?.additionalImages" class="mt-8">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ t('news.gallery') }}</h3>
            <div class="grid md:grid-cols-2 gap-4">
              <img 
                v-for="(image, index) in selectedNews.additionalImages" 
                :key="index"
                :src="image.src" 
                :alt="image.alt" 
                class="w-full h-48 object-cover rounded-lg"
              >
            </div>
          </div>

          <!-- Key Points -->
          <div v-if="selectedNews?.keyPoints" class="mt-8">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ t('news.key_points') }}</h3>
            <ul class="space-y-2">
              <li v-for="point in selectedNews.keyPoints" :key="point" class="flex items-start gap-2">
                <svg class="w-5 h-5 text-[#0097b2] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="text-gray-600 dark:text-gray-400">{{ point }}</span>
              </li>
            </ul>
          </div>

          <!-- Contact CTA -->
          <div class="mt-8 pt-6 border-t dark:border-gray-700">
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ t('news.interested') }}</h3>
              <p class="text-gray-600 dark:text-gray-400 mb-4">{{ t('news.contact_us') }}</p>
              <div class="flex flex-col sm:flex-row gap-4">
                <a 
                  href="#contact"
                  class="flex-1 bg-[#0097b2] text-white py-3 px-6 rounded-lg hover:bg-cyan-600 transition text-center font-semibold"
                  @click="closeNewsModal"
                >
                  {{ t('news.contact_button') }}
                </a>
                <button 
                  @click="closeNewsModal"
                  class="flex-1 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 py-3 px-6 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 transition"
                >
                  {{ t('news.close') }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useScrollAnimation } from '../composables/useScrollAnimation.js'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
const { isVisible: headerVisible, elementRef: headerRef } = useScrollAnimation()
const { isVisible: articlesVisible, elementRef: articlesRef } = useScrollAnimation()

// Modal state
const showNewsModal = ref(false)
const selectedNewsId = ref(null)

// News data
const newsData = computed(() => ({
  article1: {
    title: t('news.article1.title'),
    date: t('news.article1.date'),
    category: 'Elektroinstallation',
    description: t('news.article1.description'),
    image: '/img/electrician_3.jpg',
    content: `
      <p>Unser neuestes Projekt zeigt eindrucksvoll, wie moderne Elektroinstallation in Bürogebäuden aussehen kann. Das 12-stöckige Gebäude in der Hamburger Innenstadt wurde mit neuester Technik ausgestattet.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">Projektdetails</h4>
      <p>Die Installation umfasste die komplette Elektroinfrastruktur für über 500 Arbeitsplätze. Dabei kamen modernste Technologien zum Einsatz, die sowohl Energieeffizienz als auch Flexibilität gewährleisten.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">Besondere Herausforderungen</h4>
      <p>Die größte Herausforderung bestand darin, die Installation bei laufendem Betrieb in den unteren Stockwerken durchzuführen. Durch präzise Planung und koordinierte Arbeitsabläufe konnten wir Störungen minimieren.</p>
    `,
    keyPoints: [
      'Komplette Elektroinstallation für 500+ Arbeitsplätze',
      'Modernste energieeffiziente Technologien',
      'Installation bei laufendem Betrieb',
      'Flexible Infrastruktur für zukünftige Anpassungen'
    ],
    additionalImages: [
      { src: '/img/electrical-panel.jpg', alt: 'Schaltschrank Installation' },
      { src: '/img/office-lighting.jpg', alt: 'Bürobeleuchtung' }
    ]
  },
  article2: {
    title: t('news.article2.title'),
    date: t('news.article2.date'),
    category: 'Erneuerbare Energien',
    description: t('news.article2.description'),
    image: '/img/solar-panels.jpg',
    content: `
      <p>Photovoltaik-Anlagen sind ein wichtiger Baustein der Energiewende. Unser Team hat bereits über 200 Anlagen erfolgreich installiert und dabei wertvolle Erfahrungen gesammelt.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">Unsere Expertise</h4>
      <p>Von der ersten Beratung über die Planung bis hin zur Installation und Wartung - wir begleiten Sie durch den gesamten Prozess. Dabei achten wir besonders auf optimale Ausrichtung und maximale Effizienz.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">Wirtschaftlichkeit</h4>
      <p>Moderne PV-Anlagen amortisieren sich bereits nach 8-12 Jahren und bieten danach jahrzehntelang kostenlosen Strom. Zusätzlich steigern sie den Wert Ihrer Immobilie erheblich.</p>
    `,
    keyPoints: [
      'Über 200 erfolgreich installierte Anlagen',
      'Komplettservice von Beratung bis Wartung',
      'Amortisation nach 8-12 Jahren',
      'Erhebliche Wertsteigerung der Immobilie'
    ],
    additionalImages: [
      { src: '/img/solar-installation.jpg', alt: 'Solar Installation' },
      { src: '/img/solar-monitoring.jpg', alt: 'Solar Monitoring' }
    ]
  },
  article3: {
    title: t('news.article3.title'),
    date: t('news.article3.date'),
    category: 'Wärmepumpen',
    description: t('news.article3.description'),
    image: '/img/heat-pump.jpg',
    content: `
      <p>Wärmepumpen sind die Zukunft des Heizens. Sie nutzen die Umweltwärme aus Luft, Wasser oder Erdreich und wandeln sie effizient in Heizenergie um.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">Verschiedene Systeme</h4>
      <p>Je nach örtlichen Gegebenheiten bieten wir verschiedene Wärmepumpensysteme an: Luft-Wasser, Sole-Wasser oder Wasser-Wasser. Jedes System hat seine spezifischen Vorteile.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">Förderungen nutzen</h4>
      <p>Der Staat fördert den Einbau von Wärmepumpen mit bis zu 70% der Investitionskosten. Wir helfen Ihnen bei der Beantragung aller verfügbaren Förderungen.</p>
    `,
    keyPoints: [
      'Bis zu 70% staatliche Förderung möglich',
      'Verschiedene Systeme für jeden Bedarf',
      'Umweltfreundlich und effizient',
      'Langfristige Kosteneinsparungen'
    ],
    additionalImages: [
      { src: '/img/heat-pump-installation.jpg', alt: 'Wärmepumpe Installation' },
      { src: '/img/heat-pump-indoor.jpg', alt: 'Wärmepumpe Innengerät' }
    ]
  },
  article4: {
    title: t('news.article4.title'),
    date: t('news.article4.date'),
    category: 'Smart Home',
    description: t('news.article4.description'),
    image: '/img/smart-home.jpg',
    content: `
      <p>Smart Home Technologien entwickeln sich rasant weiter. 2025 werden neue Standards und Technologien das intelligente Zuhause noch komfortabler und effizienter machen.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">Matter Standard</h4>
      <p>Der neue Matter Standard sorgt für bessere Kompatibilität zwischen verschiedenen Smart Home Systemen. Geräte verschiedener Hersteller können nun nahtlos zusammenarbeiten.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">KI-Integration</h4>
      <p>Künstliche Intelligenz macht Smart Homes noch intelligenter. Systeme lernen die Gewohnheiten der Bewohner und optimieren automatisch Beleuchtung, Heizung und Sicherheit.</p>
    `,
    keyPoints: [
      'Matter Standard für bessere Kompatibilität',
      'KI-gesteuerte Automatisierung',
      'Erhöhte Energieeffizienz',
      'Verbesserte Sicherheitsfunktionen'
    ],
    additionalImages: [
      { src: '/img/smart-lighting.jpg', alt: 'Smart Beleuchtung' },
      { src: '/img/smart-control.jpg', alt: 'Smart Home Steuerung' }
    ]
  },
  article5: {
    title: t('news.article5.title'),
    date: t('news.article5.date'),
    category: 'Service',
    description: t('news.article5.description'),
    image: '/img/technician-at-work_2.jpg',
    content: `
      <p>Elektrische Notfälle können jederzeit auftreten. Unser 24/7 Notdienst steht Ihnen rund um die Uhr zur Verfügung, um schnell und professionell zu helfen.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">Schnelle Reaktionszeit</h4>
      <p>Unser Notdienst-Team ist innerhalb von 30 Minuten vor Ort. Wir verstehen, dass elektrische Probleme nicht warten können und handeln entsprechend schnell.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">Vollständige Ausstattung</h4>
      <p>Unsere Notdienst-Fahrzeuge sind mit allem ausgestattet, was für die meisten Reparaturen benötigt wird. So können wir oft schon beim ersten Besuch eine dauerhafte Lösung bieten.</p>
    `,
    keyPoints: [
      '24/7 Verfügbarkeit an 365 Tagen',
      'Reaktionszeit unter 30 Minuten',
      'Vollständig ausgestattete Fahrzeuge',
      'Erfahrene Notdienst-Techniker'
    ],
    additionalImages: [
      { src: '/img/emergency-van.jpg', alt: 'Notdienst Fahrzeug' },
      { src: '/img/night-service.jpg', alt: 'Nachtdienst' }
    ]
  },
  article6: {
    title: t('news.article6.title'),
    date: t('news.article6.date'),
    category: 'Automatisierung',
    description: t('news.article6.description'),
    image: '/img/industrial-automation_3.jpg',
    content: `
      <p>Industrielle Automatisierung steigert Effizienz und Produktivität erheblich. Unsere maßgeschneiderten Lösungen helfen Unternehmen dabei, ihre Prozesse zu optimieren.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">Individuelle Lösungen</h4>
      <p>Jedes Unternehmen hat spezifische Anforderungen. Wir entwickeln daher individuelle Automatisierungslösungen, die perfekt zu Ihren Prozessen passen.</p>
      
      <h4 class="text-lg font-semibold mt-6 mb-3">Moderne Technologien</h4>
      <p>Wir setzen auf bewährte SPS-Systeme von Siemens, Beckhoff und anderen führenden Herstellern. Dabei achten wir auf Zukunftssicherheit und einfache Wartung.</p>
    `,
    keyPoints: [
      'Maßgeschneiderte Automatisierungslösungen',
      'Bewährte SPS-Systeme',
      'Erhebliche Effizienzsteigerungen',
      'Professionelle Projektbetreuung'
    ],
    additionalImages: [
      { src: '/img/plc-programming.jpg', alt: 'SPS Programmierung' },
      { src: '/img/automatisierung.jpg', alt: 'Industrielle Steuerung' }
    ]
  }
}))

const selectedNews = computed(() => {
  return selectedNewsId.value ? newsData.value[selectedNewsId.value] : null
})

const openNewsModal = (articleId) => {
  selectedNewsId.value = articleId
  showNewsModal.value = true
  document.body.style.overflow = 'hidden'
}

const closeNewsModal = () => {
  showNewsModal.value = false
  selectedNewsId.value = null
  document.body.style.overflow = 'auto'
}
</script>