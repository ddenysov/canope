import { createApp } from 'vue'
import { createPinia } from 'pinia'
import SignUp from './SignUp.vue'

const app = createApp(SignUp)

app.use(createPinia())

app.mount('#app')
