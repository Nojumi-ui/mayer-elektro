<template>
  <section class="max-w-6xl mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold mb-6 reveal">Über Uns</h2>

    <div class="grid gap-6 md:grid-cols-2">
      <div class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold">Standorte</h3>
        <p class="mt-2 text-gray-600">{{ $t('ueberuns.standorte') }}</p>
      </div>

      <div class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold">Compliance & Datenschutz</h3>
        <p class="mt-2 text-gray-600">{{ $t('ueberuns.compliance') }}</p>
        <router-link to="/downloads" class="inline-block mt-3 text-sm underline">Downloads</router-link>
      </div>

      <div class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold">News</h3>
        <p class="mt-2 text-gray-600">{{ $t('ueberuns.news') }}</p>
      </div>

      <div class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold">Downloads</h3>
        <p class="mt-2 text-gray-600">{{ $t('ueberuns.downloads') }}</p>
        <div class="mt-4">
          <a class="text-primary underline" href="/static/Musterdatenblatt.pdf" target="_blank">Muster Datenblatt (PDF)</a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted } from 'vue'
import { revealOnScroll } from '../utils/scroll-trigger'
onMounted(() => revealOnScroll('.reveal'))
</script>
