// stores/form.js
import { createPinia, setActivePinia, getActivePinia, defineStore } from 'pinia'
setActivePinia(createPinia())
console.log('active pinia 2?', getActivePinia())
export const useFormStore = defineStore('form', {

})
