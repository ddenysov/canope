import { createApp } from 'vue'
import App from './App.vue'
import { router } from './router'

const app = createApp(App);
app.use(router);

import('ui/install').then(({ install }) => {
  install(app);
  app.mount('#app');
});