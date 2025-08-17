import { computed } from 'vue';
import { useI18n } from 'vue-i18n';
import { setLocale, getCurrentLocale } from '../i18n';

export function useLanguage() {
  const { locale } = useI18n();
  
  const currentLocale = computed(() => getCurrentLocale());
  
  const changeLanguage = (newLocale) => {
    setLocale(newLocale);
  };
  
  const isGerman = computed(() => currentLocale.value === 'de');
  const isEnglish = computed(() => currentLocale.value === 'en');
  
  return {
    currentLocale,
    changeLanguage,
    isGerman,
    isEnglish
  };
}