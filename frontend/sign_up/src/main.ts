import { createApp } from 'vue'
import { createPinia } from 'pinia'
import SignUp from './SignUp.vue'
import { install } from '@local/ui/src/index.ts';
import './assets/tailwind.css'

const app = createApp(SignUp)

app.use(createPinia())
install(app);

app.mount('#app')
