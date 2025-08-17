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
          {{ t('application.back_to_home') }}
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
          {{ t('application.title') }}
        </h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
          {{ t('application.subtitle') }}
        </p>
      </div>

      <!-- Bewerbungsformular -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <form @submit.prevent="submitApplication" class="space-y-6">
          <!-- Persönliche Daten -->
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.first_name') }} *
              </label>
              <input 
                v-model="form.firstName"
                type="text" 
                required
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.first_name_placeholder')"
              >
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.last_name') }} *
              </label>
              <input 
                v-model="form.lastName"
                type="text" 
                required
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.last_name_placeholder')"
              >
            </div>
          </div>

          <!-- Kontaktdaten -->
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.email') }} *
              </label>
              <input 
                v-model="form.email"
                type="email" 
                required
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.email_placeholder')"
              >
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.phone') }}
              </label>
              <input 
                v-model="form.phone"
                type="tel"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.phone_placeholder')"
              >
            </div>
          </div>

          <!-- Adresse -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              {{ t('application.address') }}
            </label>
            <input 
              v-model="form.address"
              type="text"
              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              :placeholder="t('application.address_placeholder')"
            >
          </div>

          <div class="grid md:grid-cols-3 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.postal_code') }}
              </label>
              <input 
                v-model="form.postalCode"
                type="text"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.postal_code_placeholder')"
              >
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.city') }}
              </label>
              <input 
                v-model="form.city"
                type="text"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.city_placeholder')"
              >
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.country') }}
              </label>
              <select 
                v-model="form.country"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              >
                <option value="Deutschland">Deutschland</option>
                <option value="Österreich">Österreich</option>
                <option value="Schweiz">Schweiz</option>
                <option value="Andere">{{ t('application.other') }}</option>
              </select>
            </div>
          </div>

          <!-- Position -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              {{ t('application.position') }} *
            </label>
            <select 
              v-model="form.position"
              required
              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
            >
              <option value="">{{ t('application.select_position') }}</option>
              <option value="Elektroniker">{{ t('application.positions.electrician') }}</option>
              <option value="Automatisierungstechniker">{{ t('application.positions.automation_technician') }}</option>
              <option value="Projektleiter">{{ t('application.positions.project_manager') }}</option>
              <option value="Auszubildender">{{ t('application.positions.apprentice') }}</option>
              <option value="Initiativbewerbung">{{ t('application.positions.unsolicited') }}</option>
            </select>
          </div>

          <!-- Verfügbarkeit -->
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.availability') }}
              </label>
              <input 
                v-model="form.availability"
                type="date"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              >
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.salary_expectation') }}
              </label>
              <input 
                v-model="form.salaryExpectation"
                type="text"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :placeholder="t('application.salary_placeholder')"
              >
            </div>
          </div>

          <!-- Anschreiben -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              {{ t('application.cover_letter') }}
            </label>
            <textarea 
              v-model="form.coverLetter"
              rows="6"
              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              :placeholder="t('application.cover_letter_placeholder')"
            ></textarea>
          </div>

          <!-- Datei-Uploads -->
          <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
              {{ t('application.documents') }}
            </h3>
            
            <!-- CV Upload -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.cv') }} *
              </label>
              <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-[#0097b2] transition">
                <input 
                  ref="cvInput"
                  type="file" 
                  @change="handleFileUpload($event, 'cv')"
                  accept=".pdf,.doc,.docx"
                  class="hidden"
                  required
                >
                <div v-if="!form.files.cv" @click="$refs.cvInput.click()" class="cursor-pointer">
                  <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                  </svg>
                  <p class="text-gray-600 dark:text-gray-400">{{ t('application.upload_cv') }}</p>
                  <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">PDF, DOC, DOCX (max. 5MB)</p>
                </div>
                <div v-else class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-gray-700 dark:text-gray-300">{{ form.files.cv.name }}</span>
                  </div>
                  <button type="button" @click="removeFile('cv')" class="text-red-500 hover:text-red-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>

            <!-- Weitere Dokumente -->
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ t('application.additional_documents') }}
              </label>
              <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-[#0097b2] transition">
                <input 
                  ref="documentsInput"
                  type="file" 
                  @change="handleFileUpload($event, 'documents')"
                  accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                  multiple
                  class="hidden"
                >
                <div v-if="form.files.documents.length === 0" @click="$refs.documentsInput.click()" class="cursor-pointer">
                  <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                  </svg>
                  <p class="text-gray-600 dark:text-gray-400">{{ t('application.upload_documents') }}</p>
                  <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">{{ t('application.documents_info') }}</p>
                </div>
                <div v-else class="space-y-2">
                  <div v-for="(file, index) in form.files.documents" :key="index" class="flex items-center justify-between bg-gray-50 dark:bg-gray-700 p-2 rounded">
                    <div class="flex items-center gap-2">
                      <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <span class="text-sm text-gray-700 dark:text-gray-300">{{ file.name }}</span>
                    </div>
                    <button type="button" @click="removeDocument(index)" class="text-red-500 hover:text-red-700">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                  <button type="button" @click="$refs.documentsInput.click()" class="text-[#0097b2] hover:underline text-sm">
                    {{ t('application.add_more_documents') }}
                  </button>
                </div>
              </div>
            </div>
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
            <label for="privacy" class="text-sm text-gray-700 dark:text-gray-300">
              {{ t('application.privacy_text') }}
              <a href="/datenschutz" target="_blank" class="text-[#0097b2] hover:underline">
                {{ t('application.privacy_policy') }}
              </a>
            </label>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-center pt-6">
            <button 
              type="submit" 
              :disabled="isSubmitting"
              class="bg-[#0097b2] text-white px-8 py-4 rounded-lg font-semibold hover:bg-cyan-600 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
            >
              <svg v-if="isSubmitting" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ isSubmitting ? t('application.submitting') : t('application.submit') }}
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
          <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">
            {{ t('application.success_title') }}
          </h3>
          <p class="text-gray-600 dark:text-gray-400 mb-6">
            {{ t('application.success_message') }}
          </p>
          <button 
            @click="goBack"
            class="bg-[#0097b2] text-white px-6 py-2 rounded-lg hover:bg-cyan-600 transition"
          >
            {{ t('application.back_to_home') }}
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

const { t } = useI18n()
const router = useRouter()

const isSubmitting = ref(false)
const showSuccessModal = ref(false)

const form = reactive({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  address: '',
  postalCode: '',
  city: '',
  country: 'Deutschland',
  position: '',
  availability: '',
  salaryExpectation: '',
  coverLetter: '',
  files: {
    cv: null,
    documents: []
  },
  privacyAccepted: false
})

const handleFileUpload = (event, type) => {
  const files = Array.from(event.target.files)
  
  if (type === 'cv') {
    const file = files[0]
    if (file && file.size <= 5 * 1024 * 1024) { // 5MB limit
      form.files.cv = file
    } else {
      alert(t('application.file_too_large'))
    }
  } else if (type === 'documents') {
    const validFiles = files.filter(file => file.size <= 5 * 1024 * 1024)
    form.files.documents.push(...validFiles)
    
    if (validFiles.length !== files.length) {
      alert(t('application.some_files_too_large'))
    }
  }
}

const removeFile = (type) => {
  if (type === 'cv') {
    form.files.cv = null
  }
}

const removeDocument = (index) => {
  form.files.documents.splice(index, 1)
}

const submitApplication = async () => {
  isSubmitting.value = true
  
  try {
    const formData = new FormData()
    
    // Formulardaten hinzufügen
    Object.keys(form).forEach(key => {
      if (key !== 'files') {
        formData.append(key, form[key])
      }
    })
    
    // Dateien hinzufügen
    if (form.files.cv) {
      formData.append('cv', form.files.cv)
    }
    
    form.files.documents.forEach((file, index) => {
      formData.append(`document_${index}`, file)
    })
    
    const response = await fetch('/api/submit-application', {
      method: 'POST',
      body: formData
    })
    
    if (response.ok) {
      showSuccessModal.value = true
    } else {
      throw new Error('Submission failed')
    }
  } catch (error) {
    console.error('Error submitting application:', error)
    alert(t('application.error_message'))
  } finally {
    isSubmitting.value = false
  }
}

const goBack = () => {
  router.push('/')
}
</script>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.3s ease;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateY(-10px);
  opacity: 0;
}
</style>