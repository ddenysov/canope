import { createRouter, createWebHistory } from 'vue-router'
import Home from "./components/Home.vue";
import SignUp from "./components/SignUp.vue";

export const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: Home },
    { path: '/sign-up', component: SignUp },
  ]
})
