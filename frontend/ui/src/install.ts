import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import UiButton from "./components/button/UiButton.vue";
import UiTextField from "./components/form/UiTextField.vue";

export function install(app: any) {
  console.log('UI Components registered');
  app.use(PrimeVue, {
    theme: {
      preset: Aura
    }
  });
  app.component('UiButton', UiButton);
  app.component('UiTextField', UiTextField);
}
