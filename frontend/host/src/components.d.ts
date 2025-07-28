export {}

import type * as UiLibrary from '../../ui/src/index.ts';

declare module 'vue' {
  export interface GlobalComponents {
    // Замените 'путь/к/вашему/компоненту.vue' на реальный путь в node_modules
    UiNavbar: typeof UiLibrary.UiNavbar,
    UiButton: typeof UiLibrary.UiButton,
  }
}
