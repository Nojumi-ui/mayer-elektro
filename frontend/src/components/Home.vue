<template>
  <div>
    <HomeSection />
    <JobsSection />
    <BewerberSectionNew />
    <KundenSectionNew />
    <NewsSection />
    <ContactSection />
  </div>
</template>

<script setup>
import { onMounted, nextTick } from 'vue'
import { useRoute } from 'vue-router'
import HomeSection from "./HomeSection.vue";
import JobsSection from "./JobsSection.vue";
import BewerberSectionNew from "./BewerberSectionNew.vue";
import KundenSectionNew from "./KundenSectionNew.vue";
import NewsSection from "./NewsSection.vue";
import ContactSection from "./ContactSection.vue";

const route = useRoute()

// Scrolle zur Sektion wenn ein Anker in der URL ist
onMounted(async () => {
  await nextTick()
  
  // Prüfe auf Hash in der URL
  if (route.hash) {
    const sectionId = route.hash.substring(1) // Entferne das #
    const element = document.getElementById(sectionId)
    
    if (element) {
      // Kurze Verzögerung, damit alle Komponenten geladen sind
      setTimeout(() => {
        element.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        })
      }, 100)
    }
  }
})
</script>
