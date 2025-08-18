<template>
  <section id="hero" class="h-screen flex flex-col justify-center items-center bg-gradient-to-r from-cyan-600 to-[#0097b2] text-white transition-colors duration-200">
    <div class="text-center mb-8 animate-fade">
      <img 
        src="/favicon-muster-transparent-blau.png" 
        alt="Mayer Elektro Logo" 
        class="w-24 h-24 md:w-32 md:h-32 mx-auto mb-6 drop-shadow-2xl filter brightness-0 invert opacity-90 hover:opacity-100 transition-opacity duration-300"
      />
      <div class="flex flex-col items-center">
        <h1 class="text-4xl md:text-6xl font-black tracking-tight leading-none mb-2">
          <span class="text-white">MAYER</span>
          <span class="font-light text-white/90"> ELEKTRO</span>
        </h1>
        <span class="text-sm md:text-base font-bold tracking-widest text-white/80 leading-none">ELEKTROINSTALLATION</span>
      </div>
    </div>
    <p class="text-xl md:text-2xl mb-8 text-center max-w-3xl px-6">{{ $t("home.subtitle") }}</p>
    <a href="#services" class="bg-white dark:bg-gray-100 text-[#0097b2] px-8 py-4 rounded-full shadow-lg hover:bg-gray-100 dark:hover:bg-gray-200 transition font-semibold">{{ $t("home.cta") }}</a>
  </section>
</template>
