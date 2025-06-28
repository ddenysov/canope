<script setup lang="ts">
import {defineProps, ref, watch} from 'vue'
import {useFormStore} from "../store d/form.ts";
import InputText from 'primevue/inputtext';

const store = useFormStore();

const value = ref('asd');

export interface Props {
  original?: string,
  disabled?: boolean,
  name: string,
  label: string,
  form: string,
  validation?: {},
}

const props = defineProps<Props>();
/**
store.$patch({
  values: {
    [props.form]: {
      [props.name]: props.original,
    },
  },
  validation: {
    [props.form]: {
      [props.name]: props.validation,
    },
  },
  errors: {
    [props.form]: {
      [props.name]: '',
    },
  },
  loading: {
    [props.form]: false,
  },
});
*/
watch(
  () => props.original,
  (newValue: any, oldValue: any) => {
    console.log(`Count changed from ${oldValue} to ${newValue}`);
    /**
    store.$patch({
      values: {
        [props.form]: {
          [props.name]: newValue,
        },
      },
    })
      */
  }
);
/**
store.$patch({
  values: {
    [props.form]: {
      [props.name]: props.original,
    },
  },
})
 */
</script>

<template>
  <InputText
    type="text"
    v-model="value"
  />
</template>
