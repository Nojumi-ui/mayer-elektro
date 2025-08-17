import { createI18n } from "vue-i18n";
import de from "./locales/de.json";
import en from "./locales/en.json";

// Gespeicherte Sprache aus localStorage laden oder Standardsprache verwenden
const getStoredLocale = () => {
  const stored = localStorage.getItem('locale');
  if (stored && ['de', 'en'].includes(stored)) {
    return stored;
  }
  
  // Browser-Sprache erkennen
  const browserLang = navigator.language.split('-')[0];
  return ['de', 'en'].includes(browserLang) ? browserLang : 'de';
};

const i18n = createI18n({
  legacy: false,
  locale: getStoredLocale(),
  fallbackLocale: "de",
  messages: {
    de,
    en,
  },
});

// Funktion zum Wechseln der Sprache
export const setLocale = (locale) => {
  if (['de', 'en'].includes(locale)) {
    i18n.global.locale.value = locale;
    localStorage.setItem('locale', locale);
    document.documentElement.lang = locale;
  }
};

// Aktuelle Sprache abrufen
export const getCurrentLocale = () => {
  return i18n.global.locale.value;
};

// Sprache beim Start setzen
document.documentElement.lang = getCurrentLocale();

export default i18n;
