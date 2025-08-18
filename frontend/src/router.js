import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/Home.vue";
import ApplicationForm from "./components/ApplicationForm.vue";
import Impressum from "./components/Impressum.vue";

const routes = [
  { path: "/", component: Home },
  { path: "/bewerbungsformular", component: ApplicationForm },
  { path: "/impressum", component: Impressum },
  // Fallback für unbekannte Routen
  { path: "/:pathMatch(.*)*", redirect: "/" }
];

export default createRouter({
  history: createWebHistory(),
  routes
});