import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import i18n from "./i18n";
import { register as registerServiceWorker } from './registerServiceWorker';

import "./index.css";
import "./assets/accessibility.css";

// Service Worker für PWA-Funktionalität registrieren
registerServiceWorker();

const app = createApp(App);
app.use(router);
app.use(i18n);
app.mount("#app");
