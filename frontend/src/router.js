import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/Home.vue";
import ApplicationForm from "./components/ApplicationForm.vue";
import Impressum from "./components/Impressum.vue";
import AGBs from "./components/AGBs.vue";
import Datenschutz from "./components/Datenschutz.vue";

const routes = [
  { 
    path: "/", 
    component: Home,
    meta: {
      title: 'Mayer Elektro - Elektroinstallation & Gebäudetechnik Hamburg',
      metaTags: [
        {
          name: 'description',
          content: 'Mayer Elektro in Hamburg bietet professionelle Elektroinstallation, Automatisierung, Instandhaltung und Personaldienstleistungen. Zuverlässig und regional seit über 15 Jahren.'
        }
      ]
    }
  },
  { 
    path: "/bewerbungsformular", 
    component: ApplicationForm,
    meta: {
      title: 'Bewerbungsformular - Mayer Elektro Hamburg',
      metaTags: [
        {
          name: 'description',
          content: 'Bewerben Sie sich bei Mayer Elektro in Hamburg. Wir suchen qualifizierte Elektrofachkräfte für spannende Projekte in der Elektroinstallation und Gebäudetechnik.'
        }
      ]
    }
  },
  { 
    path: "/impressum", 
    component: Impressum,
    meta: {
      title: 'Impressum - Mayer Elektro Hamburg',
      metaTags: [
        {
          name: 'description',
          content: 'Impressum der Mayer Elektro- und Gebäudetechnik GmbH in Hamburg. Hier finden Sie alle rechtlich relevanten Informationen zu unserem Unternehmen.'
        }
      ]
    }
  },
  { 
    path: "/agb", 
    component: AGBs,
    meta: {
      title: 'Allgemeine Geschäftsbedingungen - Mayer Elektro Hamburg',
      metaTags: [
        {
          name: 'description',
          content: 'Die Allgemeinen Geschäftsbedingungen (AGB) der Mayer Elektro- und Gebäudetechnik GmbH in Hamburg.'
        }
      ]
    }
  },
  { 
    path: "/datenschutz", 
    component: Datenschutz,
    meta: {
      title: 'Datenschutzerklärung - Mayer Elektro Hamburg',
      metaTags: [
        {
          name: 'description',
          content: 'Datenschutzerklärung der Mayer Elektro- und Gebäudetechnik GmbH. Informationen zum Umgang mit Ihren Daten auf unserer Webseite.'
        }
      ]
    }
  },
  // Fallback für unbekannte Routen
  { path: "/:pathMatch(.*)*", redirect: "/" }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  // Scroll-Verhalten anpassen für bessere Benutzererfahrung
  scrollBehavior(to, from, savedPosition) {
    // Wenn zurück-Button gedrückt wurde, zur gespeicherten Position scrollen
    if (savedPosition) {
      return savedPosition;
    }
    // Wenn Hash in der URL, dorthin scrollen
    if (to.hash) {
      return {
        el: to.hash,
        behavior: 'smooth',
        top: 80 // Offset für die Navbar
      };
    }
    // Ansonsten zum Seitenanfang scrollen
    return { top: 0 };
  }
});

// Dynamische Titel für jede Seite
router.beforeEach((to, from, next) => {
  // Setze den Seitentitel basierend auf den Route-Metadaten
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);
  const nearestWithMeta = to.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);

  if (nearestWithTitle) {
    document.title = nearestWithTitle.meta.title;
  }

  // Entferne alle Meta-Tags, die wir zuvor gesetzt haben
  Array.from(document.querySelectorAll('[data-vue-router-controlled]')).forEach(
    el => el.parentNode.removeChild(el)
  );

  // Füge neue Meta-Tags hinzu
  if (nearestWithMeta) {
    nearestWithMeta.meta.metaTags.forEach(tagDef => {
      const tag = document.createElement('meta');
      Object.keys(tagDef).forEach(key => {
        tag.setAttribute(key, tagDef[key]);
      });
      tag.setAttribute('data-vue-router-controlled', '');
      document.head.appendChild(tag);
    });
  }

  next();
});

export default router;