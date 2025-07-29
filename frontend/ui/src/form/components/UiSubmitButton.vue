<script setup lang="ts">
import { useFormStore} from "../store/form.ts";
import {UiButton} from "../../index.ts";
import type {UiButtonProps} from "@/button/types/button.type.ts";
import {computed, inject} from "vue";

interface SubmitButtonProps extends UiButtonProps {
  form?: string,
  action: any,
}
const injectedForm = inject<string>('formName', '');
const store = useFormStore();
const props = defineProps<SubmitButtonProps>();
const emit = defineEmits(['error', 'submit', 'click'])
const formName = computed<string>(() => props.form || injectedForm);

const onClick = async () => {
  try {
    const res = await store.submit(formName.value, props.action);
    emit('submit', { res, values: store.getValues(formName.value)});
  } catch (e: any) {
    emit('error', e.data);
  }
}
</script>

<template>
  <ui-button
    @click="onClick"
    :label="label"
  />
</template>
