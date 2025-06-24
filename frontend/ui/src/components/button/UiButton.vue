<script setup lang="ts">
import Button from 'primevue/button';
import type {ThemeProps} from "@/types/props/ThemeProps.ts";
import type {LabelProps} from "@/types/props/LabelProps.ts";
interface UiButtonProps extends ThemeProps, LabelProps {}

const props = defineProps<UiButtonProps>()
</script>

<template>
  <Button :label="label" />
</template>

<style scoped>

</style>
