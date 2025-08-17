<template>
  <section class="max-w-3xl mx-auto px-6 py-16">
    <h2 class="text-2xl font-bold mb-6 reveal">{{ $t('contact.title') }}</h2>

    <form @submit.prevent="submit" class="space-y-4 reveal">
      <div>
        <label class="block text-sm">Name *</label>
        <input v-model="form.name" required class="w-full border rounded p-2" />
      </div>

      <div>
        <label class="block text-sm">E-Mail *</label>
        <input v-model="form.email" required type="email" class="w-full border rounded p-2" />
      </div>

      <div>
        <label class="block text-sm">Betreff</label>
        <input v-model="form.subject" class="w-full border rounded p-2" />
      </div>

      <div>
        <label class="block text-sm">Nachricht</label>
        <textarea v-model="form.message" rows="6" class="w-full border rounded p-2"></textarea>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="px-4 py-2 rounded bg-primary text-white">Absenden</button>
      </div>
    </form>

    <div v-if="status" class="mt-4 p-3 rounded" :class="status.success ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800'">
      {{ status.message }}
    </div>
  </section>
</template>

<script setup>
import { reactive, ref } from 'vue'
import axios from 'axios'
import { onMounted } from 'vue'
import { revealOnScroll } from '../utils/scroll-trigger'

onMounted(() => revealOnScroll('.reveal'))

const form = reactive({ name: '', email: '', subject: '', message: '' })
const status = ref(null)

async function submit() {
  status.value = null
  try {
    const res = await axios.post('http://localhost:4000/api/contact', form)
    if (res.data && res.data.success) {
      status.value = { success: true, message: 'Vielen Dank — Ihre Nachricht wurde gesendet.' }
      form.name = form.email = form.subject = form.message = ''
    } else {
      status.value = { success: false, message: 'Fehler beim Senden. Bitte erneut versuchen.' }
    }
  } catch (err) {
    console.error(err)
    status.value = { success: false, message: 'Fehler beim Senden. Bitte später erneut versuchen.' }
  }
}
</script>
