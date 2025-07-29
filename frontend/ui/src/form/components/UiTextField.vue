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

</script>

<template>
  <div>
    <InputText
      type="text"
      class="w-full"
    />
  </div>
</template>
