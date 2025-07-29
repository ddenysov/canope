<script setup lang="ts">
import {defineProps, ref, watch, inject, computed} from 'vue'
import {useFormStore} from "../store/form.ts";
import InputText from 'primevue/inputtext';
import FieldError from './Common/FieldError.vue';

const store = useFormStore();
const injectedForm = inject<string>('formName', '');

export interface Props {
  original?: string,
  disabled?: boolean,
  name: string,
  label: string,
  form?: string,
  validation?: {},
}

const props = defineProps<Props>();

const formName = computed<string>(() => props.form || injectedForm);

store.$patch({
  values: {
    [formName.value]: {
      [props.name]: props.original,
    },
  },
  validation: {
    [formName.value]: {
      [props.name]: props.validation,
    },
  },
  errors: {
    [formName.value]: {
      [props.name]: '',
    },
  },
  loading: {
    [formName.value]: false,
  },
});
watch(
  () => props.original,
  (newValue: any, oldValue: any) => {
    console.log(`Count changed from ${oldValue} to ${newValue}`);
    store.$patch({
      values: {
        [formName.value]: {
          [props.name]: newValue,
        },
      },
    })
  }
);
store.$patch({
  values: {
    [formName.value]: {
      [props.name]: props.original,
    },
  },
})
</script>

<template>
  <div>
    <label class="p-error text-green-400" :for="name">{{ label }}</label>
    <InputText
      type="text"
      class="w-full"
      v-model="store.values[formName][name]"
    />
    <field-error :form="formName" :name="name" />
  </div>
</template>
