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
          Zurück zur Startseite
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
          Bewerbungsformular
        </h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
          Werden Sie Teil unseres Teams! Senden Sie uns Ihre Bewerbung und starten Sie Ihre Karriere bei Mayer Elektro.
        </p>
      </div>

      <!-- Bewerbungsformular -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <form @submit.prevent="submitApplication" class="space-y-6">
          <!-- Persönliche Daten -->
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Vorname *
              </label>
              <input 
                v-model="form.firstName"
                type="text" 
                required
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                placeholder="Ihr Vorname"
              >
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Nachname *
              </label>
              <input 
                v-model="form.lastName"
                type="text" 
                required
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                placeholder="Ihr Nachname"
              >
            </div>
          </div>

          <!-- E-Mail -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              E-Mail *
            </label>
            <input 
              v-model="form.email"
              type="email" 
              required
              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              placeholder="ihre.email@beispiel.de"
            >
          </div>

          <!-- Position -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Gewünschte Position *
            </label>
            <select 
              v-model="form.position"
              required
              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
            >
              <option value="">Bitte wählen Sie eine Position</option>
              <option value="Elektroniker">Elektroniker</option>
              <option value="Automatisierungstechniker">Automatisierungstechniker</option>
              <option value="Projektleiter">Projektleiter</option>
              <option value="Auszubildender">Auszubildender</option>
              <option value="Initiativbewerbung">Initiativbewerbung</option>
            </select>
          </div>

          <!-- Anschreiben -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Anschreiben
            </label>
            <textarea 
              v-model="form.coverLetter"
              rows="6"
              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              placeholder="Erzählen Sie uns etwas über sich und warum Sie bei Mayer Elektro arbeiten möchten..."
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
              Ich stimme der Verarbeitung meiner personenbezogenen Daten gemäß der 
              <a href="#" class="text-[#0097b2] hover:underline">Datenschutzerklärung</a> zu. *
            </label>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-center pt-6">
            <button 
              type="submit"
              :disabled="isSubmitting"
              class="bg-[#0097b2] text-white px-8 py-3 rounded-lg hover:bg-[#007a94] transition font-semibold text-lg min-w-[200px] disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="!isSubmitting">Bewerbung absenden</span>
              <span v-else class="flex items-center justify-center gap-2">
                <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Wird gesendet...
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
            Bewerbung erfolgreich gesendet!
          </h3>
          <p class="text-gray-600 dark:text-gray-400 mb-6">
            Vielen Dank für Ihre Bewerbung. Wir werden uns in Kürze bei Ihnen melden.
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
import { useRouter } from 'vue-router'

const router = useRouter()

const isSubmitting = ref(false)
const showSuccessModal = ref(false)

const form = reactive({
  firstName: '',
  lastName: '',
  email: '',
  position: '',
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
    alert('Es ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.')
  } finally {
    isSubmitting.value = false
  }
}

const goBack = () => {
  router.push('/')
}
</script>