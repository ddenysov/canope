<script setup lang="ts">
import { useFormStore} from "../store/form.ts";
import {UiButton} from "../../index.ts";
import type {UiButtonProps} from "@/button/types/button.type.ts";

interface SubmitButtonProps extends UiButtonProps {
  form: string,
  action: any,
}
const store = useFormStore();
const props = defineProps<SubmitButtonProps>();
const emit = defineEmits(['error', 'submit', 'click'])

const onClick = async () => {
  try {
    const res = await store.submit(props.form, props.action);
    emit('submit', { res, values: store.getValues(props.form)});
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
