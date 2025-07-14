import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import {install} from './install.ts';
import './assets/css/tailwind.css'

const app = createApp(App)

app.use(createPinia())
install(app);
app.mount('#app')
