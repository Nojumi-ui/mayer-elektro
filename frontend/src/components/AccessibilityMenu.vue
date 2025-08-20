<template>
  <div class="accessibility-menu">
    <!-- Skip-Link wurde in App.vue verschoben -->
    
    <!-- Barrierefreiheits-Button -->
    <button 
      @click="toggleMenu" 
      class="accessibility-toggle"
      aria-expanded="isOpen"
      :aria-label="t('accessibility.button_label')"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
      </svg>
      <span class="sr-only">{{ t('accessibility.button_label') }}</span>
    </button>
    
    <!-- Barrierefreiheits-Menü -->
    <div 
      v-if="isOpen" 
      class="accessibility-panel"
      role="dialog"
      aria-labelledby="accessibility-title"
    >
      <div class="accessibility-panel-header">
        <h2 id="accessibility-title" class="text-lg font-semibold">{{ t('accessibility.title') }}</h2>
        <button 
          @click="toggleMenu" 
          class="close-button"
          :aria-label="t('accessibility.close_label')"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      
      <div class="accessibility-panel-content">
        <div class="accessibility-option">
          <label class="flex items-center">
            <input 
              type="checkbox" 
              :checked="highContrast" 
              @change="toggleHighContrast()"
              class="form-checkbox"
            >
            <span class="ml-2">{{ t('accessibility.high_contrast.title') }}</span>
          </label>
          <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ t('accessibility.high_contrast.description') }}
          </p>
        </div>
        
        <div class="accessibility-option">
          <label class="flex items-center">
            <input 
              type="checkbox" 
              :checked="largeText" 
              @change="toggleLargeText()"
              class="form-checkbox"
            >
            <span class="ml-2">{{ t('accessibility.large_text.title') }}</span>
          </label>
          <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ t('accessibility.large_text.description') }}
          </p>
        </div>
        
        <div class="accessibility-option">
          <label class="flex items-center">
            <input 
              type="checkbox" 
              :checked="reducedMotion" 
              @change="toggleReducedMotion()"
              class="form-checkbox"
            >
            <span class="ml-2">{{ t('accessibility.reduced_motion.title') }}</span>
          </label>
          <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ t('accessibility.reduced_motion.description') }}
          </p>
        </div>
      </div>
      
      <div class="accessibility-panel-footer">
        <p class="text-sm text-gray-600 dark:text-gray-400">
          {{ t('accessibility.footer_note') }}
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { useI18n } from 'vue-i18n';
import { useAccessibility } from '../composables/useAccessibility';

// i18n
const { t } = useI18n();

// Barrierefreiheits-Funktionen
const { 
  highContrast, 
  largeText, 
  reducedMotion, 
  toggleHighContrast, 
  toggleLargeText, 
  toggleReducedMotion 
} = useAccessibility();

// Menü-Status
const isOpen = ref(false);

// Menü öffnen/schließen
const toggleMenu = () => {
  isOpen.value = !isOpen.value;
};

// Menü schließen, wenn außerhalb geklickt wird
const handleClickOutside = (event) => {
  const panel = document.querySelector('.accessibility-panel');
  const button = document.querySelector('.accessibility-toggle');
  
  if (isOpen.value && panel && button && 
      !panel.contains(event.target) && 
      !button.contains(event.target)) {
    isOpen.value = false;
  }
};

// Event-Listener hinzufügen/entfernen
onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside);
});
</script>

<style scoped>
.accessibility-menu {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 50;
}

.accessibility-toggle {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background-color: #0097b2;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  border: none;
  cursor: pointer;
  transition: background-color 0.2s;
}

.accessibility-toggle:hover {
  background-color: #007a8f;
}

.accessibility-panel {
  position: absolute;
  bottom: 60px;
  right: 0;
  width: 320px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  overflow: hidden;
}

.dark .accessibility-panel {
  background-color: #1f2937;
  color: white;
}

.accessibility-panel-header {
  padding: 16px;
  border-bottom: 1px solid #e5e7eb;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.dark .accessibility-panel-header {
  border-bottom-color: #374151;
}

.close-button {
  background: transparent;
  border: none;
  color: #6b7280;
  cursor: pointer;
  padding: 4px;
  border-radius: 4px;
}

.dark .close-button {
  color: #9ca3af;
}

.close-button:hover {
  background-color: #f3f4f6;
}

.dark .close-button:hover {
  background-color: #374151;
}

.accessibility-panel-content {
  padding: 16px;
}

.accessibility-option {
  margin-bottom: 16px;
}

.accessibility-option:last-child {
  margin-bottom: 0;
}

.accessibility-panel-footer {
  padding: 12px 16px;
  border-top: 1px solid #e5e7eb;
  background-color: #f9fafb;
}

.dark .accessibility-panel-footer {
  border-top-color: #374151;
  background-color: #111827;
}

.form-checkbox {
  width: 18px;
  height: 18px;
  border-radius: 4px;
  border: 2px solid #d1d5db;
  appearance: none;
  background-color: white;
  cursor: pointer;
  position: relative;
}

.dark .form-checkbox {
  border-color: #4b5563;
  background-color: #1f2937;
}

.form-checkbox:checked {
  background-color: #0097b2;
  border-color: #0097b2;
}

.form-checkbox:checked::after {
  content: '';
  position: absolute;
  top: 2px;
  left: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}

.dark .form-checkbox:checked {
  background-color: #0097b2;
  border-color: #0097b2;
}
</style>