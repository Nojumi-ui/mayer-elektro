<template>
  <section id="about" class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
      <div>
        <h2 class="text-4xl font-bold mb-6 text-gray-800 dark:text-gray-200">{{ $t('about.title') }}</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-4">
          {{ $t('about.description1') }}
        </p>
        <p class="text-gray-600 dark:text-gray-400">
          {{ $t('about.description2') }}
        </p>
      </div>
      <img src="https://source.unsplash.com/600x400/?electricity" alt="Über uns" class="rounded-2xl shadow-lg"/>
    </div>
  </section>
</template>
