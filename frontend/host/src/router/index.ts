import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/sign_up',
      name: 'sign_up',
      component: () => import('../views/SignUpView.vue'),
    },
    {
      path: '/sign_in',
      name: 'sign_in',
      component: () => import('../views/SignInView.vue'),
    },
  ],
})

export default router
