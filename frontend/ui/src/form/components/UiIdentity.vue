<script setup lang="ts">
import {defineProps, ref, watch} from 'vue'
import {useFormStore} from "../store/form.ts";
import * as crypto from "crypto";
import { v4 as uuidv4 } from 'uuid';

const store = useFormStore();

export interface Props {
  original?: string,
  disabled?: boolean,
  form: string,
  validation?: {},
}

const props = defineProps<Props>();
store.$patch({
  values: {
    [props.form]: {
      id: uuidv4(),
    },
  },
  validation: {
    [props.form]: {
      id: props.validation,
    },
  },
  errors: {
    [props.form]: {
      id: '',
    },
  },
  loading: {
    [props.form]: false,
  },
});
watch(
  () => props.original,
  (newValue: any, oldValue: any) => {
    store.$patch({
      values: {
        [props.form]: {
          id: newValue,
        },
      },
    })
  }
);

setInterval(() => {
  store.$patch({
    values: {
      [props.form]: {
        id: uuidv4(),
      },
    },
  })
}, 1000)

</script>

<template>
  <input
    type="hidden"
    v-model="store.values[form].id"
  />
</template>
