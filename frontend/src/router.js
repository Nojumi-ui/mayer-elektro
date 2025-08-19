import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/Home.vue";
import ApplicationForm from "./components/ApplicationForm.vue";
import Impressum from "./components/Impressum.vue";
import AGBs from "./components/AGBs.vue";
import Datenschutz from "./components/Datenschutz.vue";

const routes = [
  { path: "/", component: Home },
  { path: "/bewerbungsformular", component: ApplicationForm },
  { path: "/impressum", component: Impressum },
  { path: "/agb", component: AGBs },
  { path: "/datenschutz", component: Datenschutz },
  // Fallback für unbekannte Routen
  { path: "/:pathMatch(.*)*", redirect: "/" }
];

export default createRouter({
  history: createWebHistory(),
  routes
});