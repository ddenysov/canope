<!-- src/components/UiContainer.vue -->
<script lang="ts" setup>
import { computed } from 'vue'

const props = withDefaults(
  defineProps<{
    size?: 'sm' | 'md' | 'lg' | 'xl' | '2xl'
    padded?: boolean         // горизонтальные паддинги
    as?: string              // HTML‑тег, по умолчанию div
  }>(),
  {
    size: 'xl',
    padded: true,
    as: 'div'
  }
)

const sizeClassMap = {
  sm: 'max-w-screen-sm',
  md: 'max-w-screen-md',
  lg: 'max-w-screen-lg',
  xl: 'max-w-screen-xl',
  '2xl': 'max-w-screen-2xl'
} as const

const classes = computed(() => [
  'w-full',
  'mx-auto',
  sizeClassMap[props.size],
  props.padded ? 'px-4 sm:px-6 lg:px-8' : ''
])
</script>

<template>
  <component :is="props.as" :class="classes">
    <slot />
  </component>
</template>
