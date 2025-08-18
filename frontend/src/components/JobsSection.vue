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
        
        <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-6">
          <div v-for="(job, index) in jobs" :key="index"
               :class="['bg-gray-50 dark:bg-gray-800 rounded-lg p-6 hover:shadow-lg dark:hover:shadow-gray-700 transition scale-in', `stagger-${index + 1}`, { visible: jobsVisible }]">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 bg-[#0097b2] rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="job.icon"></path>
                </svg>
              </div>
              <div class="text-right">
                <span class="text-sm text-gray-500 dark:text-gray-400 block">{{ job.type }}</span>
                <span class="text-xs text-gray-400 dark:text-gray-500">{{ job.location }}</span>
              </div>
            </div>
            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2 word-break-responsive">{{ job.title }}</h4>
            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ job.startDate }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 word-break-responsive">{{ job.description }}</p>
            <div class="flex gap-2">
              <button 
                @click="openJobDetails(job)"
                class="flex-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 py-2 px-4 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition text-center"
              >
                {{ t('jobs.more_details') }}
              </button>
              <a 
                href="/bewerbungsformular"
                class="flex-1 bg-[#0097b2] text-white py-2 px-4 rounded-lg hover:bg-cyan-600 transition text-center cursor-pointer no-underline"
                @click="handleClick"
              >
                {{ t('jobs.apply_now') }}
              </a>
            </div>
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

    <!-- Job Details Modal -->
    <div v-if="showJobModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" @click="closeJobModal">
      <div class="bg-white dark:bg-gray-800 rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto" @click.stop>
        <div class="sticky top-0 bg-white dark:bg-gray-800 border-b dark:border-gray-700 p-6 flex justify-between items-center">
          <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 word-break-responsive">{{ selectedJob?.title }}</h2>
          <button @click="closeJobModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        
        <div class="p-6">
          <div class="grid md:grid-cols-3 gap-4 mb-6">
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <span class="text-gray-600 dark:text-gray-400">{{ selectedJob?.location }}</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2V6"></path>
              </svg>
              <span class="text-gray-600 dark:text-gray-400">{{ selectedJob?.type }}</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-[#0097b2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1m-6 0h8m-9 0a1 1 0 00-1 1v10a1 1 0 001 1h10a1 1 0 001-1V8a1 1 0 00-1-1H7z"></path>
              </svg>
              <span class="text-gray-600 dark:text-gray-400">{{ selectedJob?.startDate }}</span>
            </div>
          </div>

          <div class="mb-6">
            <p class="text-gray-600 dark:text-gray-400 word-break-responsive">{{ selectedJob?.description }}</p>
            <p v-if="selectedJob?.note" class="text-sm text-blue-600 dark:text-blue-400 mt-2 italic">{{ selectedJob.note }}</p>
          </div>

          <div class="space-y-6">
            <div>
              <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3">Ihre Aufgaben</h3>
              <ul class="space-y-2">
                <li v-for="task in selectedJob?.tasks" :key="task" class="flex items-start gap-2">
                  <svg class="w-5 h-5 text-[#0097b2] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <span class="text-gray-600 dark:text-gray-400 word-break-responsive">{{ task }}</span>
                </li>
              </ul>
            </div>

            <div>
              <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3">Das bringen Sie mit</h3>
              <ul class="space-y-2">
                <li v-for="requirement in selectedJob?.requirements" :key="requirement" class="flex items-start gap-2">
                  <svg class="w-5 h-5 text-[#0097b2] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <span class="text-gray-600 dark:text-gray-400 word-break-responsive">{{ requirement }}</span>
                </li>
              </ul>
            </div>

            <div>
              <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3">Das bieten wir Ihnen</h3>
              <ul class="space-y-2">
                <li v-for="benefit in selectedJob?.benefits" :key="benefit" class="flex items-start gap-2">
                  <svg class="w-5 h-5 text-[#0097b2] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <span class="text-gray-600 dark:text-gray-400 word-break-responsive">{{ benefit }}</span>
                </li>
              </ul>
            </div>
          </div>

          <div class="mt-8 pt-6 border-t dark:border-gray-700">
            <div class="flex flex-col sm:flex-row gap-4">
              <a 
                href="/bewerbungsformular"
                class="flex-1 bg-[#0097b2] text-white py-3 px-6 rounded-lg hover:bg-cyan-600 transition text-center font-semibold"
                @click="closeJobModal"
              >
                Jetzt bewerben
              </a>
              <button 
                @click="closeJobModal"
                class="flex-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 py-3 px-6 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition"
              >
                Schließen
              </button>
            </div>
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
import { ref, computed } from 'vue'
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

// Job Details Modal
const showJobModal = ref(false)
const selectedJob = ref(null)

const openJobDetails = (job) => {
  selectedJob.value = job
  showJobModal.value = true
}

const closeJobModal = () => {
  showJobModal.value = false
  selectedJob.value = null
}

const jobs = computed(() => [
  {
    id: 'elektroniker-energie-gebaeudetechnik',
    title: 'Elektroniker für Energie- und Gebäudetechnik (m/w/d)',
    location: 'Hamburg',
    type: 'Vollzeit',
    startDate: 'ab sofort',
    description: 'Austausch von Zählerschränken, Unterstützung von Solarprojekten, Installation von Photovoltaikanlagen und Batteriespeichersystemen.',
    icon: 'M13 10V3L4 14h7v7l9-11h-7z',
    tasks: [
      'Austausch von Zählerschränken: Durchführung von Demontage und Montage, Verkabelung sowie Prüfung der elektrischen Anlagen auf Funktionalität und Sicherheit',
      'Unterstützung von Solarprojekten: Installation und Wartung von Photovoltaikanlagen, Anschluss an bestehende Netzwerke sowie Fehlerdiagnose und Behebung',
      'Durchführung von elektrischen und mechanischen Arbeiten: Installation, Verkabelung und Montage von Photovoltaikanlagen sowie Batteriespeichersystemen',
      'Zusammenarbeit mit anderen Installateuren und Technikern: Sicherstellung einer termingerechten und budgetkonformen Umsetzung von Projekten',
      'Projektunterstützung im Industriebereich: Mitarbeit an industriellen Elektroinstallationen, Wartungs- und Reparaturarbeiten'
    ],
    requirements: [
      'Abgeschlossene Berufsausbildung als Elektroniker für Energie- und Gebäudetechnik oder vergleichbare Qualifikation',
      'Erfahrung im Umgang mit Zählerschränken und elektrischen Installationen',
      'Idealerweise Kenntnisse im Bereich Photovoltaik und erneuerbare Energien',
      'Fähigkeit zur Arbeit im Team und selbstständige Arbeitsweise',
      'Zuverlässigkeit, Flexibilität und ein hohes Maß an Engagement',
      'Führerschein der Klasse B von Vorteil'
    ],
    benefits: [
      'Langfristige Perspektive in einem innovativen Unternehmen',
      'Unbefristeter zukunftssicherer Arbeitsplatz',
      'Bereitstellung von Arbeitskleidung und Schutzausrüstung',
      'Möglichkeit zur privaten Nutzung des Firmenfahrzeuges nach der Probezeit',
      'Spannende und abwechslungsreiche Aufgaben in einem zukunftsorientierten Unternehmen',
      'Möglichkeiten zur Weiterbildung und Entwicklung',
      'Ein angenehmes Arbeitsumfeld mit einem motivierten Team',
      'Übertarifliche Vergütung und attraktive Zusatzleistungen',
      '30 Tage Urlaub'
    ]
  },
  {
    id: 'projektleiter-elektrotechnik',
    title: 'Projektleiter Elektrotechnik (m/w/d)',
    location: 'Hamburg',
    type: 'Vollzeit',
    startDate: 'nach Vereinbarung',
    description: 'Vollständige Leitung elektrotechnischer Projekte von der Planung bis zur erfolgreichen Abnahme. Führung des Projektteams und Koordination interner sowie externer Partner.',
    icon: 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
    tasks: [
      'Vollständige Leitung elektrotechnischer Projekte – von der Planung bis zur erfolgreichen Abnahme',
      'Fachliche Führung des Projektteams und Koordination interner sowie externer Partner',
      'Überwachung von Budgets, Terminen und Qualität',
      'Technische Ansprechpartner für Kunden und lösungsorientierte Kommunikation',
      'Mitwirkung bei der kontinuierlichen Optimierung der Projektabläufe'
    ],
    requirements: [
      'Abgeschlossene Ausbildung, Studium oder Techniker/Meister im Bereich Elektrotechnik, Energietechnik oder ähnlichem Bereich',
      'Fundierte Berufserfahrung in der Projektleitung im elektrotechnischen Bereich',
      'Technisches Verständnis, organisatorisches Talent und klare Kommunikationsweise',
      'Freude am eigenverantwortlichen Arbeiten und am Führen von Menschen',
      'Sicherer Umgang mit MS Office; Kenntnisse in CAD/Projektsoftware von Vorteil',
      'Kenntnisse der relevanten Normen und Vorschriften (VDE, VOB, HOAI)',
      'Kenntnisse zu Photovoltaik von Vorteil aber kein Muss',
      'Führerscheinklasse B'
    ],
    benefits: [
      'Unbefristetes Arbeitsverhältnis in einem innovativen Umfeld',
      'Spannende Projekte, bei denen Sie wirklich gestalten dürfen',
      'Ein wertschätzendes Arbeitsumfeld, in dem Ihre Meinung zählt',
      'Viel Freiraum für Eigenverantwortung und Ideen',
      'Attraktive Vergütung plus Zusatzleistungen (z. B. Jobrad, Weiterbildung, Firmen-Events)',
      'Ein starkes Team, das zusammenhält und gemeinsam wächst',
      '30 Tage Jahresurlaub für Ihre Erholung'
    ]
  },
  {
    id: 'monteur-waermepumpe',
    title: 'Monteur Wärmepumpe (m/w/d)',
    location: 'Hamburg',
    type: 'Freelance / Vollzeit',
    startDate: 'nach Vereinbarung',
    description: 'Setzen und anschließen von Wärmepumpen (hydraulischer Teil), Montagearbeiten im Bereich Heizungstechnik und Vorbereitung von Inbetriebnahmen.',
    icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
    tasks: [
      'Setzen und anschließen von Wärmepumpen (hydraulischer Teil)',
      'Montagearbeiten im Bereich Heizungstechnik (z. B. Rohrleitungen, Pufferspeicher, Außeneinheiten)',
      'Vorbereitung und Durchführung von Inbetriebnahmen in Zusammenarbeit mit dem Hersteller oder Technikteam',
      'Dokumentation der Arbeiten und Rückmeldung ans Projektteam',
      'Freundlicher Umgang mit unseren Kunden vor Ort'
    ],
    requirements: [
      'Berufserfahrung in der Heizungs-, Lüftungs- oder Kältetechnik',
      'Kenntnisse im Bereich Wärmepumpenmontage',
      'Selbstständige und strukturierte Arbeitsweise',
      'Teamgeist, Zuverlässigkeit und Spaß an der Arbeit mit modernen Systemen',
      'Führerschein Klasse B'
    ],
    benefits: [
      'Unbefristetes Arbeitsverhältnis in einem innovativen Umfeld',
      'Spannende Projekte, bei denen Sie wirklich gestalten dürfen',
      'Ein wertschätzendes Arbeitsumfeld, in dem Ihre Meinung zählt',
      'Viel Freiraum für Eigenverantwortung und Ideen',
      'Attraktive Vergütung plus Zusatzleistungen (z. B. Corporate-Benefits, Weiterbildung, Firmen-Events)',
      'Ein starkes Team, das zusammenhält und gemeinsam wächst',
      '30 Tage Jahresurlaub für Ihre Erholung'
    ],
    note: 'Hinweis: Der elektrische Anschluss wird durch unser eigenes Team übernommen.'
  },
  {
    id: 'elektroniker-allgemein',
    title: 'Elektroniker jeglicher Richtungen (m/w/d)',
    location: 'Hamburg',
    type: 'Vollzeit',
    startDate: 'nach Vereinbarung',
    description: 'Vielseitige Tätigkeiten im Bereich Elektrotechnik, von Zählerschränken über Solarprojekte bis hin zu industriellen Elektroinstallationen.',
    icon: 'M13 10V3L4 14h7v7l9-11h-7z',
    tasks: [
      'Austausch von Zählerschränken: Durchführung von Demontage und Montage, Verkabelung sowie Prüfung der elektrischen Anlagen auf Funktionalität und Sicherheit',
      'Unterstützung von Solarprojekten: Installation und Wartung von Photovoltaikanlagen, Anschluss an bestehende Netzwerke sowie Fehlerdiagnose und -behebung',
      'Durchführung von elektrischen und mechanischen Arbeiten: Installation, Verkabelung und Montage von Photovoltaikanlagen sowie Batteriespeichersystemen',
      'Zusammenarbeit mit anderen Installateuren und Technikern: Sicherstellung einer termingerechten und budgetkonformen Umsetzung von Projekten',
      'Projektunterstützung im Industriebereich: Mitarbeit an industriellen Elektroinstallationen, Wartungs- und Reparaturarbeiten'
    ],
    requirements: [
      'Abgeschlossene Berufsausbildung als Elektroniker oder vergleichbare Qualifikation',
      'Erfahrung im Umgang mit Zählerschränken und elektrischen Installationen',
      'Idealerweise Kenntnisse im Bereich Photovoltaik und erneuerbare Energien',
      'Fähigkeit zur Arbeit im Team und selbstständige Arbeitsweise',
      'Zuverlässigkeit, Flexibilität und ein hohes Maß an Engagement',
      'Führerschein der Klasse B'
    ],
    benefits: [
      'Unbefristetes Arbeitsverhältnis in einem innovativen Umfeld',
      'Spannende Projekte, bei denen Sie wirklich gestalten dürfen',
      'Ein wertschätzendes Arbeitsumfeld, in dem Ihre Meinung zählt',
      'Viel Freiraum für Eigenverantwortung und Ideen',
      'Attraktive Vergütung plus Zusatzleistungen (z. B. Corporate-Benefits, Weiterbildung, Firmen-Events)',
      'Ein starkes Team, das zusammenhält und gemeinsam wächst',
      '30 Tage Jahresurlaub für Ihre Erholung'
    ]
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