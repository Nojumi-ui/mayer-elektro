<template>
  <section id="services" class="py-20 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
    <div class="max-w-6xl mx-auto px-6">
      <div class="text-center mb-12">
        <div class="flex flex-col items-center gap-4 mb-4">
          <img 
            :src="isDark ? '/logo_transparent_white.png' : '/logo_transparent_dark.png'" 
            alt="Mayer Elektro Logo" 
            class="h-24 w-auto object-contain"
          />
          <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-200">{{ $t("nav.services") }}</h2>
        </div>
      </div>
      <div class="grid md:grid-cols-3 gap-8">
        <div v-for="(service, index) in services" :key="index" ref="serviceCards"
             class="p-6 bg-white dark:bg-gray-700 rounded-2xl shadow-lg opacity-0 transform translate-y-10 transition-colors duration-200">
          <h3 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">{{ service.title }}</h3>
          <p class="text-gray-600 dark:text-gray-400">{{ service.text }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted, ref, computed } from "vue";
import { useI18n } from 'vue-i18n';
import { useTheme } from "../composables/useTheme";
import gsap from "gsap";

const serviceCards = ref([]);
const { t } = useI18n();
const { isDark } = useTheme();

const services = computed(() => [
  { title: t("services.electrical_installation"), text: t("services.electrical_desc") },
  { title: t("services.automation_technology"), text: t("services.automation_desc") },
  { title: t("services.maintenance"), text: t("services.maintenance_desc") },
]);

onMounted(() => {
  gsap.to(serviceCards.value, {
    opacity: 1,
    y: 0,
    duration: 0.8,
    stagger: 0.2,
    scrollTrigger: {
      trigger: "#services",
      start: "top 80%",
    }
  });
});
</script>
