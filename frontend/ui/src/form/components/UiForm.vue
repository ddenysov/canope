<script setup lang="ts">
import { provide } from 'vue';

const props = defineProps({
  name: {
    type: String,
    required: true
  }
});

provide('formName', props.name);
</script>

<template>
  <div class="flex items-center justify-center text-red-800">
    <form class="p-2 rounded shadow-md flex flex-col gap-4 w-full max-w-sm">
      <slot />
    </form>
  </div>
</template>

<style scoped>

</style>
