<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200 pt-28">
    <!-- Header mit Zurück-Button -->
    <div class="bg-white dark:bg-gray-800 shadow-sm border-b dark:border-gray-700">
      <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between">
        <button 
          @click="goBack"
          class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-[#0097b2] transition"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          {{ t('application.back_to_home') || 'Zurück zur Hauptseite' }}
        </button>
        
        <!-- Logo -->
        <div class="flex flex-col items-center">
          <span class="text-lg font-black tracking-tight text-gray-800 dark:text-gray-200 leading-none">
            <span class="bg-gradient-to-r from-gray-800 to-gray-600 dark:from-gray-200 dark:to-gray-400 bg-clip-text text-transparent">MAYER</span>
            <span class="font-light text-gray-700 dark:text-gray-300"> ELEKTRO</span>
          </span>
          <span class="text-xs font-bold tracking-widest text-[#0097b2] leading-none mt-0.5">ELEKTROINSTALLATION</span>
        </div>
        
        <div class="w-20"></div> <!-- Spacer für Zentrierung -->
      </div>
    </div>

    <!-- Hauptinhalt -->
    <div class="max-w-4xl mx-auto px-6 py-8">
      <!-- Header -->
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-4">
          {{ t('application.title') || 'Bewerbungsformular' }}
        </h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
          {{ t('application.subtitle') || 'Werden Sie Teil unseres Teams! Senden Sie uns Ihre Bewerbung und starten Sie Ihre Karriere bei Mayer Elektro.' }}
        </p>
      </div>

      <!-- Bewerbungsformular -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <form @submit.prevent="submitApplication" class="space-y-6">
          <!-- Persönliche Daten -->
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.first_name') || 'Vorname' }} *
              </label>
              <input 
                v-model="form.firstName"
                type="text" 
                required
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.first_name_placeholder') || 'Ihr Vorname'"
              >
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.last_name') || 'Nachname' }} *
              </label>
              <input 
                v-model="form.lastName"
                type="text" 
                required
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.last_name_placeholder') || 'Ihr Nachname'"
              >
            </div>
          </div>

          <!-- Kontaktdaten -->
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.email') || 'E-Mail-Adresse' }} *
              </label>
              <input 
                v-model="form.email"
                type="email" 
                required
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.email_placeholder') || 'ihre.email@beispiel.de'"
              >
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.phone') || 'Telefonnummer' }}
              </label>
              <input 
                v-model="form.phone"
                type="tel"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.phone_placeholder') || '+49 123 456 789'"
              >
            </div>
          </div>

          <!-- Position -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              {{ t('application.position') || 'Gewünschte Position' }} *
            </label>
            <select 
              v-model="form.position"
              required
              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
            >
              <option value="">{{ t('application.select_position') || 'Position auswählen' }}</option>
              <option value="Elektroniker">{{ t('application.positions.electrician') || 'Elektroniker' }}</option>
              <option value="Automatisierungstechniker">{{ t('application.positions.automation_technician') || 'Automatisierungstechniker' }}</option>
              <option value="Projektleiter">{{ t('application.positions.project_manager') || 'Projektleiter' }}</option>
              <option value="Auszubildender">{{ t('application.positions.apprentice') || 'Auszubildender' }}</option>
              <option value="Initiativbewerbung">{{ t('application.positions.unsolicited') || 'Initiativbewerbung' }}</option>
            </select>
          </div>

          <!-- Verfügbarkeit -->
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.availability') || 'Verfügbar ab' }}
              </label>
              <input 
                v-model="form.availability"
                type="date"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              >
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.salary_expectation') || 'Gehaltsvorstellung' }}
              </label>
              <input 
                v-model="form.salaryExpectation"
                type="text"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.salary_placeholder') || 'z.B. 45.000 € p.a.'"
              >
            </div>
          </div>

          <!-- Anschreiben -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              {{ t('application.cover_letter') || 'Anschreiben' }}
            </label>
            <textarea 
              v-model="form.coverLetter"
              rows="6"
              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              :placeholder="t('application.cover_letter_placeholder') || 'Erzählen Sie uns, warum Sie zu Mayer Elektro passen...'"
            ></textarea>
          </div>

          <!-- Datenschutz -->
          <div class="flex items-start gap-3">
            <input 
              v-model="form.privacyAccepted"
              type="checkbox" 
              id="privacy"
              required
              class="mt-1 w-4 h-4 text-[#0097b2] border-gray-300 rounded focus:ring-[#0097b2]"
            >
            <label for="privacy" class="text-sm text-gray-600 dark:text-gray-400">
              {{ t('application.privacy_text') || 'Ich stimme der Verarbeitung meiner Daten gemäß der' }}
              <a href="#" class="text-[#0097b2] hover:underline">{{ t('application.privacy_policy') || 'Datenschutzerklärung' }}</a> zu. *
            </label>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-center pt-6">
            <button 
              type="submit"
              :disabled="isSubmitting"
              class="bg-[#0097b2] text-white px-8 py-3 rounded-lg hover:bg-[#007a94] transition font-semibold text-lg min-w-[200px] disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="!isSubmitting">{{ t('application.submit') || 'Bewerbung absenden' }}</span>
              <span v-else class="flex items-center justify-center gap-2">
                <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ t('application.submitting') || 'Wird gesendet...' }}
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Success Modal -->
    <div v-if="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white dark:bg-gray-800 rounded-lg p-8 max-w-md mx-4">
        <div class="text-center">
          <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">
            {{ t('application.success_title') || 'Bewerbung erfolgreich gesendet!' }}
          </h3>
          <p class="text-gray-600 dark:text-gray-400 mb-6">
            {{ t('application.success_message') || 'Vielen Dank für Ihre Bewerbung. Wir werden uns in Kürze bei Ihnen melden.' }}
          </p>
          <button 
            @click="goBack"
            class="bg-[#0097b2] text-white px-6 py-2 rounded-lg hover:bg-[#007a94] transition"
          >
            Zur Startseite
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useI18n } from 'vue-i18n'
import { useRouter } from 'vue-router'

// Safe i18n initialization with fallback
let t
try {
  const i18n = useI18n()
  t = i18n.t
} catch (error) {
  console.warn('i18n not available, using fallback')
  t = (key) => key
}

const router = useRouter()

const isSubmitting = ref(false)
const showSuccessModal = ref(false)

const form = reactive({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  position: '',
  availability: '',
  salaryExpectation: '',
  coverLetter: '',
  privacyAccepted: false
})

const submitApplication = async () => {
  isSubmitting.value = true
  
  try {
    // Simuliere API-Aufruf
    await new Promise(resolve => setTimeout(resolve, 2000))
    
    console.log('Bewerbung gesendet:', form)
    showSuccessModal.value = true
  } catch (error) {
    console.error('Fehler beim Senden der Bewerbung:', error)
    alert(t('application.error_message') || 'Es ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.')
  } finally {
    isSubmitting.value = false
  }
}

const goBack = () => {
  router.push('/')
}
</script>