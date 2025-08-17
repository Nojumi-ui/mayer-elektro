import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/Home.vue";
import ApplicationForm from "./components/ApplicationForm.vue";

const routes = [
  { path: "/", component: Home },
  { path: "/bewerbungsformular", component: ApplicationForm }
];

export default createRouter({
  history: createWebHistory(),
  routes
});