<template>
  <section id="contact" class="py-20 bg-gray-100 dark:bg-gray-800 transition-colors duration-200">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold mb-8 text-gray-800 dark:text-gray-200">{{ t('nav.kontakt') }}</h2>
      
      <!-- Success Message -->
      <div v-if="showSuccess" class="mb-6 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 rounded-lg max-w-xl mx-auto">
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          {{ t('contact.success_message') }}
        </div>
      </div>

      <!-- Error Message -->
      <div v-if="showError" class="mb-6 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 rounded-lg max-w-xl mx-auto">
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
          </svg>
          {{ errorMessage || t('contact.error_message') }}
        </div>
      </div>

      <form @submit.prevent="submitForm" class="grid gap-4 text-left max-w-xl mx-auto">
        <input 
          v-model="form.name" 
          type="text" 
          id="name" 
          name="name" 
          :placeholder="t('contact.name_placeholder')" 
          required
          class="p-3 border dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-[#0097b2] focus:border-transparent" 
        />
        <input 
          v-model="form.email" 
          type="email" 
          id="email" 
          name="email" 
          :placeholder="t('contact.email_placeholder')" 
          required
          class="p-3 border dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-[#0097b2] focus:border-transparent" 
        />
        <textarea 
          v-model="form.message" 
          id="message" 
          name="message" 
          :placeholder="t('contact.message_placeholder')" 
          rows="5" 
          required
          class="p-3 border dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-[#0097b2] focus:border-transparent"
        ></textarea>
        <button 
          type="submit" 
          :disabled="isSubmitting"
          class="bg-[#0097b2] text-white px-6 py-3 rounded-full shadow hover:bg-cyan-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
        >
          <span v-if="isSubmitting" class="flex items-center justify-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ t('contact.sending_button') }}
          </span>
          <span v-else>
            {{ t('contact.send_button') }}
          </span>
        </button>
      </form>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

// Form data
const form = ref({
  name: '',
  email: '',
  message: ''
})

// State management
const isSubmitting = ref(false)
const showSuccess = ref(false)
const showError = ref(false)
const errorMessage = ref('')

// Submit form function
const submitForm = async () => {
  isSubmitting.value = true
  showSuccess.value = false
  showError.value = false
  errorMessage.value = ''

  try {
    console.log('Sending contact form:', form.value)
    const response = await fetch('/api/contact', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(form.value)
    })
    console.log('Response status:', response.status)

    const result = await response.json()

    if (response.ok) {
      // Success
      showSuccess.value = true
      form.value = { name: '', email: '', message: '' } // Reset form
      
      // Hide success message after 10 seconds
      setTimeout(() => {
        showSuccess.value = false
      }, 10000)
    } else {
      // Error from server
      showError.value = true
      errorMessage.value = result.message || t('contact.error_message')
      
      // Hide error message after 5 seconds
      setTimeout(() => {
        showError.value = false
        errorMessage.value = ''
      }, 5000)
    }
  } catch (error) {
    // Network or other error
    console.error('Contact form error:', error)
    showError.value = true
    errorMessage.value = t('contact.network_error')
    
    // Hide error message after 5 seconds
    setTimeout(() => {
      showError.value = false
      errorMessage.value = ''
    }, 5000)
  } finally {
    isSubmitting.value = false
  }
}
</script>
