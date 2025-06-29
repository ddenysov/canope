<script setup lang="ts">
import Button from 'primevue/button';
import type {UiButtonProps} from "@/button/types/button.type.ts";

const props = defineProps<UiButtonProps>()
</script>

<template>
  <Button
    :label="label"
    :disabled="disabled"
  />
</template>

<style scoped>

</style>
