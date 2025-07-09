import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import {
  UiButton,
  UiTextField,
  UiSubmitButton,
  UiIdentity,
  UiFlex
} from "./index.ts";

export function install(app: any) {
  console.log('UI Components registered');
  app.use(PrimeVue, {
    theme: {
      preset: Aura
    }
  });
  app.component('UiButton', UiButton);
  app.component('UiTextField', UiTextField);
  app.component('UiSubmitButton', UiSubmitButton);
  app.component('UiIdentity', UiIdentity);
  app.component('UiFlex', UiFlex);
}
