import { createApp } from 'vue'
import { createPinia } from 'pinia'
import SignUp from './SignUp.vue'
import SignIn from './SignIn.vue'

const app = createApp(SignUp)
app.use(createPinia())
