<template>
  <section class="max-w-6xl mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold mb-6 reveal">{{ $t('nav.bewerber') }}</h2>

    <div class="grid gap-6 md:grid-cols-2">
      <article class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold text-xl mb-2">Jobs</h3>
        <p class="text-gray-600">{{ $t('bewerber.jobs') }}</p>
        <router-link to="/bewerbung" class="inline-block mt-4 px-4 py-2 rounded bg-primary text-white">Jetzt bewerben</router-link>
      </article>

      <article class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold text-xl mb-2">Initiativbewerbung</h3>
        <p class="text-gray-600">{{ $t('bewerber.initiativ') }}</p>
      </article>

      <article class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold text-xl mb-2">Werkvertrag</h3>
        <p class="text-gray-600">Transparente Verträge für projektbezogene Einsätze mit fairer Vergütung.</p>
      </article>

      <article class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold text-xl mb-2">Ausbildung</h3>
        <p class="text-gray-600">{{ $t('bewerber.ausbildung') }}</p>
      </article>

      <article class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold text-xl mb-2">Bewerbungsablauf</h3>
        <p class="text-gray-600">{{ $t('bewerber.prozess') }}</p>
      </article>

      <article class="p-6 border rounded-lg reveal">
        <h3 class="font-semibold text-xl mb-2">Qualifizierungsangebote</h3>
        <p class="text-gray-600">Interne & externe Schulungen, Safety-Trainings und Zertifizierungen.</p>
      </article>
    </div>

    <div class="mt-10 text-center reveal">
      <img class="mx-auto rounded-lg shadow-lg w-full max-w-3xl" alt="Team & Ausbildung"
           src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1400&auto=format&fit=crop" />
    </div>
  </section>
</template>

<script setup>
import { onMounted } from 'vue'
import { revealOnScroll } from '../utils/scroll-trigger'
onMounted(() => revealOnScroll('.reveal'))
</script>
