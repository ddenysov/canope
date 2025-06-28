declare module 'ui/UiTextField' {
  import { DefineComponent } from 'vue';

  export interface Props {
    original?: string;
    disabled?: boolean;
    name: string;
    label: string;
    form: string;
    validation?: Record<string, unknown>;
  }

  const component: DefineComponent<Props>;
  export default component;
}

