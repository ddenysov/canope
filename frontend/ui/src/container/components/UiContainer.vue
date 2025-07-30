<script setup lang="ts">
import type {UiContainerProps} from "@/container/types";

const props = defineProps<UiContainerProps>();
</script>

<template>
  <main
    :class="{
      'items-center': props.layout === 'center',
      'mx-auto': props.layout === 'center',
      'flex': props.layout === 'center',
    }"
    class="h-screen overflow-y-auto bg-white max-w-7xl  py-4 px-4"
  >
    <slot />
  </main>
</template>

<style scoped>

</style>
