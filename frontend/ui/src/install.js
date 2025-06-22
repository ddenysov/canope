import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';

export function install(app) {
  console.log('ololo');
  app.use(PrimeVue, {
    theme: {
      preset: Aura
    }
  });
}
