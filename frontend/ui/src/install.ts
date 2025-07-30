import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/material';
import {
  UiButton,
  UiTextField,
  UiSubmitButton,
  UiForm,
  UiIdentity,
  UiFlex,
  UiNavbar,
  UiPanel,
  UiStack,
  UiInline,
  UiContainer,
  UiFill,
} from "./index.ts";

import './assets/css/tailwind.css';
import 'primeicons/primeicons.css'


export async function install(app: any) {
  console.log('UI Components registered');
  app.use(PrimeVue, {
    theme: {
      preset: Aura,
      options: {
        darkModeSelector: '.my-app-dark',
      }
    }
  });
  app.component('UiForm', UiForm);
  app.component('UiButton', UiButton);
  app.component('UiTextField', UiTextField);
  app.component('UiSubmitButton', UiSubmitButton);
  app.component('UiIdentity', UiIdentity);
  app.component('UiFlex', UiFlex);
  app.component('UiNavbar', UiNavbar);
  app.component('UiContainer', UiContainer);
  app.component('UiPanel', UiPanel);
  app.component('UiStack', UiStack);
  app.component('UiInline', UiInline);
  app.component('UiFill', UiFill);
}
