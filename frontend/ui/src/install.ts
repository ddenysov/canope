import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import {UiButton, UiTextField, UiSubmitButton} from "./index.ts";

export function install(app: any) {
  console.log('UI Components registered');
  app.use(PrimeVue, {
    theme: {
      preset: Aura
    }
  });
}
