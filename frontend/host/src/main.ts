import './assets/main.css'

import { createApp } from 'vue'

import Application from './Application.vue';
import router from './router'
import { setActivePinia, createPinia } from 'pinia'


const pinia = createPinia();
const app = createApp(Application)
app.use(pinia)
app.use(router)

async function initRemotePinia() {
  const { default: pinia } = await import('store/store')
  setActivePinia(pinia)
}

await initRemotePinia()

import('ui/install').then(({ install }) => {
  console.log(install);
  if (install) {
    install(app)
  } else {
    console.error('ui/install is not a function')
  }
  app.mount('#app');
});
