import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import Application from './Application.vue';
import router from './router'

const app = createApp(Application)

app.use(createPinia())
app.use(router)

import('ui/install').then(({ install }) => {
  install(app);
  app.mount('#app');
});
