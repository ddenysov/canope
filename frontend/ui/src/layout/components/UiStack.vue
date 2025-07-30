<!-- src/components/UiStack.vue -->
<script lang="ts" setup>
import { computed } from 'vue'

const props = withDefaults(
  defineProps<{
    gap?: 'xs' | 'sm' | 'md' | 'lg' | 'xl'
    align?: 'start' | 'center' | 'end' | 'stretch'
    justify?: 'start' | 'center' | 'between' | 'end'
  }>(),
  {
    gap: 'md',
    align: 'stretch',
    justify: 'start'
  }
)

// соответствие ключей размеру gap‑класса
const gapClassMap = {
  xs: 'gap-1',
  sm: 'gap-2',
  md: 'gap-4',
  lg: 'gap-6',
  xl: 'gap-8'
} as const

const classes = computed(() => [
  'flex',
  'flex-col',
  gapClassMap[props.gap],
  `items-${props.align}`,
  `justify-${props.justify}`
])
</script>

<template>
  <div :class="classes">
    <slot />
  </div>
</template>
