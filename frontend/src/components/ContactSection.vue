<template>
  <section id="contact" class="py-20 bg-gray-100 dark:bg-gray-800 transition-colors duration-200">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold mb-8 text-gray-800 dark:text-gray-200">{{ t('nav.kontakt') }}</h2>
      <form class="grid gap-4 text-left max-w-xl mx-auto">
        <input type="text" id="name" name="name" :placeholder="t('contact.name_placeholder')" class="p-3 border dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200" />
        <input type="email" id="email" name="email" :placeholder="t('contact.email_placeholder')" class="p-3 border dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200" />
        <textarea id="message" name="message" :placeholder="t('contact.message_placeholder')" rows="5" class="p-3 border dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"></textarea>
        <button type="submit" class="bg-[#0097b2] text-white px-6 py-3 rounded-full shadow hover:bg-cyan-700">
          {{ t('contact.send_button') }}
        </button>
      </form>
    </div>
  </section>
</template>

<script setup>
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
</script>
