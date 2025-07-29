// stores/form.js
import {bool, ValidationError} from 'yup'
import type {FormState, Value} from "../types/types.ts";
import {useClient} from "../../core/composables/client.ts";
const client = useClient();
import { setActivePinia, defineStore } from 'pinia'
async function initRemotePinia() {
  const { default: pinia } = await import('store/store')
  setActivePinia(pinia)
  console.log('PINIA UI')
  console.log(pinia)
}
await initRemotePinia();
export const useFormStore = defineStore('form', {
  /**
   * State
   */
  state: (): FormState => {
    return {
      values: {},
      validation: {},
      errors: {},
      loading: {},
    }
  },

  /**
   * Actions
   */
  actions: {
    /**
     * Set form loading state
     * @param form
     * @param value
     */
    setLoading(form: string, value: boolean) {
      this.$patch({
        loading: {
          [form]: value,
        }
      })
    },

    /**
     * Set form errors
     * @param form
     * @param value
     */
    setErrors(form: string, value: any) {
      this.$patch({
        errors: {
          [form]: value,
        }
      })
    },

    /**
     * Set field error
     * @param form
     * @param field
     * @param value
     */
    setFieldError(form: string, field: string, value: any) {
      this.$patch({
        errors: {
          [form]: {
            [field]: value
          },
        }
      })
    },

    /**
     * Clear field error
     * @param form
     * @param field
     */
    clearFieldError(form: string, field: string): void {
      this.setFieldError(form, field, '');
    },

    /**
     * Get field error
     * @param form
     * @param field
     */
    getFieldError(form: string, field: string): string {
      return this.errors[form][field];
    },

    /**
     * Has field error
     * @param form
     * @param field
     */
    hasFieldError(form: string, field: string): boolean {
      return !!this.getFieldError(form, field);
    },

    /**
     *
     * @param form
     */
    getValues(form: string): Value<string> {
      return this.values[form];
    },


    /**
     * Is field loading
     * @param form
     */
    isLoading(form: string): any {
      return !!this.loading[form];
    },

    /**
     * Clear all form errors
     * @param form
     */
    clearAllErrors(form: string) {
      Object.entries(this.errors[form]).forEach((entry: any) => {
        this.clearFieldError(form, entry[0]);
      })
    },

    /**
     * Submit given form
     * @param form
     * @param action
     */
    async submit(form: string, action: any): Promise<any> {
      try {
        this.clearAllErrors(form);
        const values = this.getValues(form);
        this.setLoading(form, true);

        console.log('POST');
        const res = await client.post(action, values);
        console.log('BACKEND RES');
        const json = await res?.json();
        console.log(json);

        if (!res?.ok) {
          console.log('NOT OK');
          Object.entries(json.errors).forEach((e: any) => {
            console.log('EEEE');
            console.log(e);
            this.setFieldError(form, e[0], e[1][0]);
          });
        }

        this.setLoading(form, false);

        return new Promise(fn => {});
      } catch (e: any) {
        console.log('BACKEND ERRORS');
        console.log(e);
        Object.values(e.data.errors).forEach((e: any) => {
          this.setFieldError(form, e.key ?? '', e.message);
        });
        this.setLoading(form, false);
        throw e;
      }
    }
  },
})
