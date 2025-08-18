<template>
  <section id="hero" class="h-screen flex flex-col justify-center items-center bg-gradient-to-r from-cyan-600 to-[#0097b2] text-white transition-colors duration-200">
    <div class="text-center mb-8 animate-fade">
      <img 
        src="/logo_transparent_white.png" 
        alt="Mayer Elektro Logo" 
        class="h-40 md:h-48 w-auto mx-auto mb-6 drop-shadow-2xl opacity-90 hover:opacity-100 transition-opacity duration-300"
      />
    </div>
    <p class="text-xl md:text-2xl mb-8 text-center max-w-3xl px-6">{{ $t("home.subtitle") }}</p>
    <a href="#services" class="bg-white dark:bg-gray-100 text-[#0097b2] px-8 py-4 rounded-full shadow-lg hover:bg-gray-100 dark:hover:bg-gray-200 transition font-semibold">{{ $t("home.cta") }}</a>
  </section>
</template>
