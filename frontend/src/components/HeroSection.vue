<template>
  <section id="hero" class="h-screen flex flex-col justify-center items-center bg-gradient-to-r from-cyan-600 to-[#0097b2] text-white transition-colors duration-200">
    <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade">{{ $t("home.welcome") }}</h1>
    <p class="text-xl md:text-2xl mb-8">{{ $t("home.subtitle") }}</p>
    <a href="#services" class="bg-white dark:bg-gray-100 text-[#0097b2] px-6 py-3 rounded-full shadow-lg hover:bg-gray-100 dark:hover:bg-gray-200 transition">{{ $t("home.cta") }}</a>
  </section>
</template>
