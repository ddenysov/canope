<script setup lang="ts">
import {computed, defineProps, inject, ref, watch} from 'vue'
import {useFormStore} from "../store/form.ts";
import { v4 as uuidv4 } from 'uuid';

const injectedForm = inject<string>('formName', '');
const store = useFormStore();
const formName = computed<string>(() => props.form || injectedForm);

export interface Props {
  original?: string,
  disabled?: boolean,
  form?: string,
  validation?: {},
}

const props = defineProps<Props>();
store.$patch({
  values: {
    [formName.value]: {
      id: uuidv4(),
    },
  },
  validation: {
    [formName.value]: {
      id: props.validation,
    },
  },
  errors: {
    [formName.value]: {
      id: '',
    },
  },
  loading: {
    [formName.value]: false,
  },
});
watch(
  () => props.original,
  (newValue: any, oldValue: any) => {
    store.$patch({
      values: {
        [formName.value]: {
          id: newValue,
        },
      },
    })
  }
);

setInterval(() => {
  store.$patch({
    values: {
      [formName.value]: {
        id: uuidv4(),
      },
    },
  })
}, 1000)

</script>

<template>
  <input
    type="hidden"
    v-model="store.values[formName].id"
  />
</template>
