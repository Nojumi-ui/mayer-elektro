<template>
  <section class="max-w-7xl mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold mb-6 reveal">{{ $t('nav.kunden') }}</h2>

    <div class="grid gap-6 md:grid-cols-2">
      <div class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold text-lg">Automatisierungstechnik / Schaltanlagenbau</h3>
        <p class="mt-2 text-gray-600">{{ $t('kunden.automation') }}</p>
      </div>

      <div class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold text-lg">Instandhaltung</h3>
        <p class="mt-2 text-gray-600">{{ $t('kunden.instandhaltung') }}</p>
      </div>

      <div class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold text-lg">Sicherheitstechnische Dienstleistungen</h3>
        <p class="mt-2 text-gray-600">{{ $t('kunden.sicherheit') }}</p>
      </div>

      <div class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold text-lg">Personaldienstleistungen</h3>
        <p class="mt-2 text-gray-600">{{ $t('kunden.personal') }}</p>
      </div>
    </div>

    <div class="mt-12 grid gap-6 md:grid-cols-2">
      <div class="reveal">
        <img alt="Schaltschrank & Automation" class="rounded-lg shadow-lg w-full"
             src="https://images.unsplash.com/photo-1581091215367-59ab6c8a1f0c?q=80&w=1400&auto=format&fit=crop" />
      </div>
      <div class="reveal flex items-center">
        <div>
          <h4 class="text-xl font-semibold">Elektroinstallation (Fokus)</h4>
          <p class="mt-2 text-gray-600">Insbesondere Elektroinstallation & Modernisierung — wir liefern norm-konforme, effiziente Lösungen für Gebäude und Industrie.</p>
          <router-link to="/kontakt" class="inline-block mt-4 px-4 py-2 rounded border bg-primary text-white">Angebot anfragen</router-link>
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
