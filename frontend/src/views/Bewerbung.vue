<template>
  <section class="max-w-3xl mx-auto px-6 py-16">
    <h2 class="text-2xl font-bold mb-6 reveal">{{ $t('bewerben.title') || 'Bewerbung' }}</h2>

    <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-4 reveal">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <select v-model="form.anrede" class="border p-2 rounded">
          <option value="Herr">Herr</option>
          <option value="Frau">Frau</option>
          <option value="Divers">Divers</option>
        </select>
        <input v-model="form.vorname" placeholder="Vorname" class="border p-2 rounded" required />
      </div>

      <input v-model="form.nachname" placeholder="Nachname" class="w-full border p-2 rounded" required />
      <input v-model="form.email" type="email" placeholder="E-Mail" class="w-full border p-2 rounded" required />
      <input v-model="form.telefon" placeholder="Telefon" class="w-full border p-2 rounded" />

      <div>
        <label class="block text-sm">Unterlagen (pdf, docx, jpg, jpeg) — Gesamt max. 5 MB</label>
        <input type="file" @change="onFileChange" multiple accept=".pdf,.docx,.jpg,.jpeg" />
      </div>

      <div class="space-y-2 text-sm">
        <label class="flex items-start gap-2"><input type="checkbox" v-model="form.privacy_read" /> <span>Ich habe die Datenschutzerklärung gelesen und akzeptiere sie.</span></label>
        <label class="flex items-start gap-2"><input type="checkbox" v-model="form.delete_on_reject" /> <span>Meine Daten sollen nach der Absage gelöscht werden.</span></label>
        <label class="flex items-start gap-2"><input type="checkbox" v-model="form.receive_jobs" /> <span>Ich möchte passende Stellenangebote erhalten.</span></label>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="px-4 py-2 rounded bg-primary text-white">Bewerbung senden</button>
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

const form = reactive({
  anrede: 'Herr', vorname: '', nachname: '', email: '', telefon: '',
  files: [], privacy_read: false, delete_on_reject: false, receive_jobs: false
})
const status = ref(null)

function onFileChange(e) {
  form.files = Array.from(e.target.files)
}

function totalSize(files) {
  return files.reduce((s,f) => s + (f.size || 0), 0)
}

async function submit() {
  status.value = null
  if (!form.privacy_read) {
    status.value = { success: false, message: 'Bitte Datenschutzerklärung bestätigen.' }
    return
  }

  if (totalSize(form.files) > 5 * 1024 * 1024) {
    status.value = { success: false, message: 'Die Gesamtdaten dürfen 5 MB nicht überschreiten.' }
    return
  }

  const fd = new FormData()
  fd.append('anrede', form.anrede)
  fd.append('vorname', form.vorname)
  fd.append('nachname', form.nachname)
  fd.append('email', form.email)
  fd.append('telefon', form.telefon)
  fd.append('delete_on_reject', form.delete_on_reject)
  fd.append('receive_jobs', form.receive_jobs)
  form.files.forEach(f => fd.append('files', f))

  try {
    const res = await axios.post('http://localhost:4000/api/apply', fd, { headers: { 'Content-Type': 'multipart/form-data' }})
    if (res.data && res.data.success) {
      status.value = { success: true, message: 'Bewerbung gesendet — wir melden uns.' }
      // Reset form
      form.anrede = 'Herr'; form.vorname = form.nachname = form.email = form.telefon = ''
      form.files = []; form.privacy_read = form.delete_on_reject = form.receive_jobs = false
    } else {
      status.value = { success: false, message: 'Fehler beim Senden der Bewerbung.' }
    }
  } catch (err) {
    console.error(err)
    status.value = { success: false, message: 'Fehler beim Senden der Bewerbung.' }
  }
}
</script>
