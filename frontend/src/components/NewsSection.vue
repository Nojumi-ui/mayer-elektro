<template>
  <section id="news" class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-6">
      <div ref="headerRef" class="text-center mb-16">
        <h2 :class="['text-4xl md:text-5xl font-bold text-gray-800 dark:text-gray-200 mb-6 fade-in-up', { visible: headerVisible }]">{{ t('news.title') }}</h2>
        <p :class="['text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto fade-in-up stagger-1', { visible: headerVisible }]">
          {{ t('news.subtitle') }}
        </p>
      </div>

      <div ref="articlesRef" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <!-- News Artikel 1 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-1', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/electrical-panel_2.jpg" 
              alt="Neues Bürogebäude Projekt" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article1.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article1.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article1.description') }}
            </p>
            <a href="#leistungen" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.learn_more') }}</a>
          </div>
        </article>

        <!-- News Artikel 2 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-2', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/solar-panels.jpg" 
              alt="Photovoltaik-Anlagen Installation" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article2.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article2.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article2.description') }}
            </p>
            <a href="#leistungen" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.learn_more') }}</a>
          </div>
        </article>

        <!-- News Artikel 3 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-3', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/heat-pump.jpg" 
              alt="Wärmepumpen Installation" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article3.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article3.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article3.description') }}
            </p>
            <a href="#leistungen" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.learn_more') }}</a>
          </div>
        </article>

        <!-- News Artikel 4 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-4', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/smart-home.jpg" 
              alt="Smart Home Trends 2025" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article4.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article4.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article4.description') }}
            </p>
            <a href="#leistungen" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.learn_more') }}</a>
          </div>
        </article>

        <!-- News Artikel 5 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-5', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/technician-at-work_2.jpg" 
              alt="24/7 Notdienst" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article5.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article5.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article5.description') }}
            </p>
            <a href="#contact" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.contact_emergency') }}</a>
          </div>
        </article>

        <!-- News Artikel 6 -->
        <article :class="['bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition fade-in-up stagger-6', { visible: articlesVisible }]">
          <div class="h-48 overflow-hidden">
            <img 
              src="/img/automatisierung_2.jpg" 
              alt="Industrielle Automatisierung" 
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
            >
          </div>
          <div class="p-6">
            <div class="text-sm text-[#0097b2] font-semibold mb-2">{{ t('news.article6.date') }}</div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-3">{{ t('news.article6.title') }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              {{ t('news.article6.description') }}
            </p>
            <a href="#leistungen" class="text-[#0097b2] font-semibold hover:underline">{{ t('news.learn_more') }}</a>
          </div>
        </article>
      </div>

      <!-- Newsletter Anmeldung -->
      <!--div class="bg-[#0097b2] text-white p-8 rounded-lg text-center">
        <h3 class="text-3xl font-bold mb-4">{{ t('newsletter.title') }}</h3>
        <p class="text-lg mb-6 max-w-2xl mx-auto">
          {{ t('newsletter.description') }}
        </p>
        <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
          <input 
            type="email" 
            :placeholder="$t('newsletter.email_placeholder')" 
            class="flex-1 px-4 py-3 rounded-lg bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-white"
            required
          >
          <button 
            type="submit" 
            class="bg-white text-[#0097b2] px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition whitespace-nowrap"
          >
            {{ t('newsletter.subscribe_button') }}
          </button>
        </form>
        <p class="text-sm mt-4 opacity-80">
          {{ t('newsletter.privacy_note') }}
        </p>
      </div-->

      <!-- Archiv -->
      <div class="mt-16 text-center">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">{{ t('news.archive_title') }}</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">
          {{ t('news.archive_description') }}
        </p>
        <a href="#" class="inline-block bg-[#0097b2] text-white px-8 py-3 rounded-full font-semibold hover:bg-cyan-600 transition">
          {{ t('news.view_archive') }}
        </a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useScrollAnimation } from '../composables/useScrollAnimation.js'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
// News articles translations completely rebuilt
const { isVisible: headerVisible, elementRef: headerRef } = useScrollAnimation()
const { isVisible: articlesVisible, elementRef: articlesRef } = useScrollAnimation()
</script>