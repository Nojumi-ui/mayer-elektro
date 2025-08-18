import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/Home.vue";
import ApplicationForm from "./components/ApplicationForm.vue";
import ApplicationFormSimple from "./components/ApplicationFormSimple.vue";

const routes = [
  { path: "/", component: Home },
  { path: "/bewerbungsformular", component: ApplicationFormSimple },
  { path: "/bewerbungsformular-original", component: ApplicationForm },
  // Fallback für unbekannte Routen
  { path: "/:pathMatch(.*)*", redirect: "/" }
];

export default createRouter({
  history: createWebHistory(),
  routes
});