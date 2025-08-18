<template>
  <div class="min-h-screen bg-red-100 pt-28">
    <div class="max-w-4xl mx-auto px-6 py-8">
      <h1 class="text-4xl font-bold text-red-800 mb-4">
        TEST BEWERBUNGSFORMULAR
      </h1>
      <p class="text-xl text-red-600">
        Dies ist eine Test-Komponente, um zu überprüfen, ob das Routing funktioniert.
      </p>
      <button @click="goBack" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
        Zurück zur Startseite
      </button>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const goBack = () => {
  router.push('/')
}
</script>