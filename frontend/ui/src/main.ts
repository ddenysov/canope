import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import {install} from './install.ts';

const app = createApp(App)

app.use(createPinia())
install(app);
app.mount('#app')
