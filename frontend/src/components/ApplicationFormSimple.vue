<template>
  <div class="min-h-screen bg-gray-50 pt-28 pb-12">
    <div class="max-w-4xl mx-auto px-6">
      <!-- Header -->
      <div class="text-center mb-8">
        <button 
          @click="goBack"
          class="inline-flex items-center gap-2 text-gray-600 hover:text-[#0097b2] transition mb-6"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Zurück zur Startseite
        </button>
        
        <h1 class="text-4xl font-bold text-gray-800 mb-4">
          Bewerbungsformular
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
          Bewerben Sie sich jetzt bei Mayer Elektro
        </p>
      </div>

      <!-- Formular -->
      <div class="bg-white rounded-lg shadow-lg p-8">
        <form @submit.prevent="submitApplication" class="space-y-6">
          <!-- Name -->
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Vorname *
              </label>
              <input 
                v-model="form.firstName"
                type="text" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent"
                placeholder="Ihr Vorname"
              >
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Nachname *
              </label>
              <input 
                v-model="form.lastName"
                type="text" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent"
                placeholder="Ihr Nachname"
              >
            </div>
          </div>

          <!-- E-Mail -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              E-Mail *
            </label>
            <input 
              v-model="form.email"
              type="email" 
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent"
              placeholder="ihre.email@beispiel.de"
            >
          </div>

          <!-- Position -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Gewünschte Position *
            </label>
            <select 
              v-model="form.position"
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent"
            >
              <option value="">Bitte wählen Sie eine Position</option>
              <option value="Elektroniker">Elektroniker</option>
              <option value="Automatisierungstechniker">Automatisierungstechniker</option>
              <option value="Projektleiter">Projektleiter</option>
              <option value="Auszubildender">Auszubildender</option>
              <option value="Initiativbewerbung">Initiativbewerbung</option>
            </select>
          </div>

          <!-- Nachricht -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Anschreiben
            </label>
            <textarea 
              v-model="form.message"
              rows="6"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent"
              placeholder="Erzählen Sie uns etwas über sich..."
            ></textarea>
          </div>

          <!-- Submit Button -->
          <div class="text-center">
            <button 
              type="submit"
              class="bg-[#0097b2] text-white px-8 py-3 rounded-lg font-semibold hover:bg-cyan-600 transition"
            >
              Bewerbung absenden
            </button>
          </div>
        </form>

        <!-- Success Message -->
        <div v-if="submitted" class="mt-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
          <h3 class="font-semibold">Bewerbung erfolgreich gesendet!</h3>
          <p>Vielen Dank für Ihre Bewerbung. Wir werden uns bald bei Ihnen melden.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const form = ref({
  firstName: '',
  lastName: '',
  email: '',
  position: '',
  message: ''
})

const submitted = ref(false)

const goBack = () => {
  router.push('/')
}

const submitApplication = () => {
  // Hier würde normalerweise die Bewerbung an den Server gesendet
  console.log('Bewerbung gesendet:', form.value)
  submitted.value = true
  
  // Form zurücksetzen nach 3 Sekunden
  setTimeout(() => {
    submitted.value = false
    form.value = {
      firstName: '',
      lastName: '',
      email: '',
      position: '',
      message: ''
    }
  }, 3000)
}
</script>