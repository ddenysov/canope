import { createApp } from 'vue'
import { createPinia } from 'pinia'

import WidgetNavbar from './WidgetNavbar.vue'
//import router from './router'

const app = createApp(WidgetNavbar)
app.use(createPinia())
//app.use(router)

app.mount('#app')
