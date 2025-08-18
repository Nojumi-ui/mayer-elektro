<template>
  <section id="about" class="py-20 bg-white dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
      <div>
        <div class="flex items-center gap-4 mb-6">
          <img 
            src="/favicon-muster-transparent-blau.png" 
            alt="Mayer Elektro Logo" 
            class="w-12 h-12 object-contain"
          />
          <div class="flex flex-col">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-200 leading-none">{{ $t('about.title') }}</h2>
            <div class="flex items-center gap-2 mt-1">
              <span class="text-lg font-black tracking-tight text-gray-800 dark:text-gray-200">MAYER</span>
              <span class="text-lg font-light text-gray-700 dark:text-gray-300">ELEKTRO</span>
              <span class="text-xs font-bold tracking-widest text-[#0097b2]">ELEKTROINSTALLATION</span>
            </div>
          </div>
        </div>
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
