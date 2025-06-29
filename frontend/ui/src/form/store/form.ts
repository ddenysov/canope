// stores/form.js
import {defineStore} from 'pinia'
import {bool, ValidationError} from 'yup'
import {useCreateYupSchema} from '../composables/schema'
import type {FormState, Value} from "../types/types.ts";
import {useClient} from "../../core/composables/client.ts";
const client = useClient();

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
      console.log('OLOLO');
      Object.entries(this.errors[form]).forEach((entry: any) => {
        console.log(entry);
        this.clearFieldError(form, entry[0]);
      })
    },

    async validate(form: string) {
      const yupSchema = useCreateYupSchema(this.validation[form]);
      this.clearAllErrors(form);

      try {
        await yupSchema.validate(this.getValues(form), {abortEarly: false});
      } catch (e: any) {
        e.inner.reverse().forEach((e: ValidationError) => {
          this.setFieldError(form, e.path ?? '', e.message);
        });
        throw e;
      }
    },

    /**
     * Submit given form
     * @param form
     * @param action
     */
    async submit(form: string, action: any): Promise<any> {
      await this.validate(form);

      try {
        const values = this.getValues(form);
        this.setLoading(form, true);

        const res = await client.post(action, values);
        this.setLoading(form, false);

        return new Promise(fn => {});
      } catch (e: any) {
        Object.values(e.data.errors).forEach((e: any) => {
          this.setFieldError(form, e.key ?? '', e.message);
        });
        this.setLoading(form, false);
        throw e;
      }
    }
  }
})
