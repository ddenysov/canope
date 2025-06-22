import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import UiButton from "./components/button/UiButton.vue";

export function install(app: any) {
  console.log('ololo');
  app.use(PrimeVue, {
    theme: {
      preset: Aura
    }
  });
  app.component('UiButton', UiButton);
}
