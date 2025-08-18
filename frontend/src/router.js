import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/Home.vue";
import ApplicationFormFixed from "./components/ApplicationFormFixed.vue";

const routes = [
  { path: "/", component: Home },
  { path: "/bewerbungsformular", component: ApplicationFormFixed },
  // Fallback für unbekannte Routen
  { path: "/:pathMatch(.*)*", redirect: "/" }
];

export default createRouter({
  history: createWebHistory(),
  routes
});