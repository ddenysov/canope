import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import {
  UiButton,
  UiTextField,
  UiSubmitButton,
  UiForm,
  UiIdentity,
  UiFlex
} from "./index.ts";

import './assets/css/tailwind.css';

export async function install(app: any) {
  console.log('UI Components registered');
  app.use(PrimeVue, {
    theme: {
      preset: Aura
    }
  });
  app.component('UiForm', UiForm);
  app.component('UiButton', UiButton);
  app.component('UiTextField', UiTextField);
  app.component('UiSubmitButton', UiSubmitButton);
  app.component('UiIdentity', UiIdentity);
  app.component('UiFlex', UiFlex);
}
