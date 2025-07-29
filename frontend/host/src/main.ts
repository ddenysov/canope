import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import Application from './Application.vue';
import router from './router'

const app = createApp(Application)
const pinia = createPinia();
app.use(pinia)
app.use(router)

import('ui/install').then(({ install }) => {
  console.log(install);
  if (install) {
    install(app)
  } else {
    console.error('ui/install is not a function')
  }
  app.mount('#app');
});
