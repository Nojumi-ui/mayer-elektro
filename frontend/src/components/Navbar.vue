<template>
  <nav class="fixed top-0 left-0 w-full bg-white dark:bg-gray-900 shadow dark:shadow-gray-800 z-50 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <!-- Brand with Logo -->
      <router-link to="/" class="flex items-center hover:opacity-80 transition">
        <img 
          :src="isDark ? '/logo_transparent_white.png' : '/logo_transparent_dark.png'" 
          alt="Mayer Elektro Logo" 
          class="h-16 w-auto object-contain"
        />
      </router-link>

      <!-- Desktop Navigation -->
      <div class="hidden md:flex items-center gap-6">
        <ul class="flex gap-6 text-gray-700 dark:text-gray-300 font-medium">
          <li><a href="#home" @click="scrollToSection('home')" class="hover:text-[#0097b2] transition">Home</a></li>

        <!-- Für Bewerber Dropdown (mit Jobs integriert) -->
        <li class="relative group">
          <a href="#bewerber" @click="scrollToSection('bewerber')" class="hover:text-[#0097b2] transition flex items-center">
            {{ t('nav.bewerber') }}
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </a>
          <ul class="absolute top-full left-0 bg-white dark:bg-gray-800 shadow-lg rounded-lg py-2 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border dark:border-gray-700">
            <!-- Jobs Sektion -->
            <li class="px-4 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600">{{ t('nav.jobs') }}</li>
            <li><a href="#stellenangebote" @click="scrollToSection('stellenangebote')" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-[#0097b2] transition text-gray-700 dark:text-gray-300">{{ t('nav.stellenangebote') }}</a></li>
            <li><a href="#initiativbewerbung" @click="scrollToSection('initiativbewerbung')" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-[#0097b2] transition text-gray-700 dark:text-gray-300">{{ t('nav.initiativbewerbung') }}</a></li>
            <li><a href="#bewerbungsablauf" @click="scrollToSection('bewerbungsablauf')" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-[#0097b2] transition text-gray-700 dark:text-gray-300">{{ t('nav.bewerbungsablauf') }}</a></li>
            
            <!-- Bewerber Sektion -->
            <li class="px-4 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600 mt-2">{{ t('nav.bewerber_info') }}</li>
            <li><a href="#ausbildung" @click="scrollToSection('ausbildung')" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-[#0097b2] transition text-gray-700 dark:text-gray-300">{{ t('nav.ausbildung') }}</a></li>
            <li><a href="#qualifizierung" @click="scrollToSection('qualifizierung')" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-[#0097b2] transition text-gray-700 dark:text-gray-300">{{ t('nav.qualifizierung') }}</a></li>
            <li><a href="#fachkraefte" @click="scrollToSection('fachkraefte')" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-[#0097b2] transition text-gray-700 dark:text-gray-300">{{ t('nav.fachkraefte') }}</a></li>
            <li><a href="#vorteile" @click="scrollToSection('vorteile')" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-[#0097b2] transition text-gray-700 dark:text-gray-300">{{ t('nav.vorteile') }}</a></li>
          </ul>
        </li>

        <!-- Für Kunden Dropdown -->
        <li class="relative group">
          <a href="#kunden" @click="scrollToSection('kunden')" class="hover:text-[#0097b2] transition flex items-center">
            {{ t('nav.kunden') }}
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </a>
          <ul class="absolute top-full left-0 bg-white dark:bg-gray-800 shadow-lg rounded-lg py-2 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border dark:border-gray-700">
            <li><a href="#automatisierung" @click="scrollToSection('automatisierung')" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-[#0097b2] transition text-gray-700 dark:text-gray-300">{{ t('nav.automatisierung') }}</a></li>
            <li><a href="#instandhaltung" @click="scrollToSection('instandhaltung')" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-[#0097b2] transition text-gray-700 dark:text-gray-300">{{ t('nav.instandhaltung') }}</a></li>
            <li><a href="#elektroinstallation" @click="scrollToSection('elektroinstallation')" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-[#0097b2] transition text-gray-700 dark:text-gray-300">{{ t('nav.elektroinstallation') }}</a></li>
            <li><a href="#personaldienstleistungen" @click="scrollToSection('personaldienstleistungen')" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-[#0097b2] transition text-gray-700 dark:text-gray-300">{{ t('nav.personaldienstleistungen') }}</a></li>
          </ul>
        </li>

          <li><a href="#news" @click="scrollToSection('news')" class="hover:text-[#0097b2] transition">{{ t('nav.news') }}</a></li>
          <li><a href="#contact" @click="scrollToSection('contact')" class="hover:text-[#0097b2] transition">{{ t('nav.kontakt') }}</a></li>
        </ul>

        <!-- Theme Switcher -->
        <div class="relative">
          <button 
            @click="toggleDesktopDropdown"
            class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 text-gray-700 dark:text-gray-300"
            :title="$t('theme.toggle')"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </button>
          
          <!-- Theme Dropdown -->
          <div 
            v-show="isDesktopDropdownOpen"
            class="absolute top-full right-0 mt-2 bg-white dark:bg-gray-800 shadow-lg rounded-lg py-2 w-40 transition-all duration-200 z-50 border dark:border-gray-700"
          >
            <button 
              @click="setThemeAndCloseDesktop('light')"
              class="w-full text-left px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-gray-700 dark:text-gray-300"
              :class="{ 'text-[#0097b2] dark:text-[#0097b2]': !isDark }"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
              {{ t('theme.light') }}
            </button>
            <button 
              @click="setThemeAndCloseDesktop('dark')"
              class="w-full text-left px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-gray-700 dark:text-gray-300"
              :class="{ 'text-[#0097b2] dark:text-[#0097b2]': isDark }"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
              </svg>
              {{ t('theme.dark') }}
            </button>
            
            <!-- Language Switcher in Theme Dropdown -->
            <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>
            <button 
              @click="changeLanguageAndCloseDesktop('de')"
              class="w-full text-left px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-gray-700 dark:text-gray-300"
              :class="{ 'text-[#0097b2] dark:text-[#0097b2]': currentLocale === 'de' }"
            >
              <span class="text-lg">🇩🇪</span>
              <span class="text-sm">Deutsch</span>
            </button>
            <button 
              @click="changeLanguageAndCloseDesktop('en')"
              class="w-full text-left px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-gray-700 dark:text-gray-300"
              :class="{ 'text-[#0097b2] dark:text-[#0097b2]': currentLocale === 'en' }"
            >
              <span class="text-lg">🇬🇧</span>
              <span class="text-sm">English</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Mobile Menu Button and Switchers -->
      <div class="md:hidden flex items-center gap-2">
        <!-- Mobile Theme Switcher -->
        <div class="relative">
          <button 
            @click="toggleMobileDropdown"
            class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 text-gray-700 dark:text-gray-300"
            :title="$t('theme.toggle')"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </button>
          
          <!-- Mobile Theme Dropdown -->
          <div 
            v-show="isMobileDropdownOpen"
            class="absolute top-full right-0 mt-2 bg-white dark:bg-gray-800 shadow-lg rounded-lg py-2 w-40 transition-all duration-200 z-50 border dark:border-gray-700"
          >
            <button 
              @click="setThemeAndClose('light')"
              class="w-full text-left px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-gray-700 dark:text-gray-300"
              :class="{ 'text-[#0097b2] dark:text-[#0097b2]': !isDark }"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
              {{ t('theme.light') }}
            </button>
            <button 
              @click="setThemeAndClose('dark')"
              class="w-full text-left px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-gray-700 dark:text-gray-300"
              :class="{ 'text-[#0097b2] dark:text-[#0097b2]': isDark }"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
              </svg>
              {{ t('theme.dark') }}
            </button>
            
            <!-- Mobile Language Switcher in Theme Dropdown -->
            <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>
            <button 
              @click="changeLanguageAndClose('de')"
              class="w-full text-left px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-gray-700 dark:text-gray-300"
              :class="{ 'text-[#0097b2] dark:text-[#0097b2]': currentLocale === 'de' }"
            >
              <span class="text-lg">🇩🇪</span>
              <span class="text-sm">Deutsch</span>
            </button>
            <button 
              @click="changeLanguageAndClose('en')"
              class="w-full text-left px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-gray-700 dark:text-gray-300"
              :class="{ 'text-[#0097b2] dark:text-[#0097b2]': currentLocale === 'en' }"
            >
              <span class="text-lg">🇬🇧</span>
              <span class="text-sm">English</span>
            </button>
          </div>
        </div>

        <button
          class="text-gray-700 dark:text-gray-300 focus:outline-none"
          @click="isOpen = !isOpen"
        >
        <svg
          v-if="!isOpen"
          xmlns="http://www.w3.org/2000/svg"
          class="h-8 w-8"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg
          v-else
          xmlns="http://www.w3.org/2000/svg"
          class="h-8 w-8"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      </div>
    </div>

    <!-- Mobile Navigation -->
    <transition name="slide-fade">
      <div
        v-if="isOpen"
        class="md:hidden fixed top-0 left-0 w-full h-full bg-white dark:bg-gray-900 flex flex-col items-center justify-center space-y-8 text-lg font-medium text-gray-700 dark:text-gray-300 z-50 transition-colors duration-200"
      >
        <!-- Mobile Brand -->
        <div class="mb-8 text-center">
          <img 
            :src="isDark ? '/logo_transparent_white.png' : '/logo_transparent_dark.png'" 
            alt="Mayer Elektro Logo" 
            class="h-20 w-auto object-contain mx-auto"
          />
        </div>
        
        <!-- Mobile Menu Items -->
        <a href="#home" @click="scrollToSection('home'); closeMenu()" class="hover:text-[#0097b2] transition py-2">{{ t('nav.home') }}</a>
        <a href="#bewerber" @click="scrollToSection('bewerber'); closeMenu()" class="hover:text-[#0097b2] transition py-2">{{ t('nav.bewerber') }}</a>
        <a href="#kunden" @click="scrollToSection('kunden'); closeMenu()" class="hover:text-[#0097b2] transition py-2">{{ t('nav.kunden') }}</a>
        <a href="#news" @click="scrollToSection('news'); closeMenu()" class="hover:text-[#0097b2] transition py-2">{{ t('nav.news') }}</a>
        <a href="#contact" @click="scrollToSection('contact'); closeMenu()" class="hover:text-[#0097b2] transition py-2">{{ t('nav.kontakt') }}</a>
      </div>
    </transition>
  </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { useI18n } from 'vue-i18n'
import { useRouter, useRoute } from 'vue-router'
import { useTheme } from "../composables/useTheme";
import { useLanguage } from "../composables/useLanguage";

const { t } = useI18n()
const router = useRouter()
const route = useRoute()
const isOpen = ref(false);
const isMobileDropdownOpen = ref(false);
const isDesktopDropdownOpen = ref(false);
const { isDark, setTheme } = useTheme();
const { currentLocale, changeLanguage } = useLanguage();

const closeMenu = () => {
  isOpen.value = false;
};

const toggleMobileDropdown = () => {
  isMobileDropdownOpen.value = !isMobileDropdownOpen.value;
};

const closeMobileDropdown = () => {
  isMobileDropdownOpen.value = false;
};

const toggleDesktopDropdown = () => {
  isDesktopDropdownOpen.value = !isDesktopDropdownOpen.value;
};

const closeDesktopDropdown = () => {
  isDesktopDropdownOpen.value = false;
};

const setThemeAndClose = (theme) => {
  setTheme(theme);
  closeMobileDropdown();
};

const changeLanguageAndClose = (language) => {
  changeLanguage(language);
  closeMobileDropdown();
};

const setThemeAndCloseDesktop = (theme) => {
  setTheme(theme);
  closeDesktopDropdown();
};

const changeLanguageAndCloseDesktop = (language) => {
  changeLanguage(language);
  closeDesktopDropdown();
};

// Schließe Dropdown beim Klick außerhalb
const handleClickOutside = (event) => {
  const dropdown = event.target.closest('.relative');
  if (!dropdown) {
    if (isMobileDropdownOpen.value) {
      closeMobileDropdown();
    }
    if (isDesktopDropdownOpen.value) {
      closeDesktopDropdown();
    }
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});

const scrollToSection = (sectionId) => {
  // Prüfe, ob wir uns auf der Hauptseite befinden
  if (route.path !== '/') {
    // Wenn nicht auf Hauptseite, navigiere zur Hauptseite mit Anker
    router.push(`/#${sectionId}`);
    return;
  }
  
  // Wenn auf Hauptseite, scrolle zur Sektion
  const element = document.getElementById(sectionId);
  if (element) {
    // CSS scroll-margin-top übernimmt das Offset, wir nutzen nur noch scrollIntoView
    element.scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    });
  }
};
</script>

<style>
.slide-fade-enter-active {
  transition: all 0.3s ease;
}
.slide-fade-leave-active {
  transition: all 0.2s ease;
}
.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateY(-10px);
  opacity: 0;
}
</style>
