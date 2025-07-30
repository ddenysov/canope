<!-- src/components/UiInline.vue -->
<script lang="ts" setup>
import { computed } from 'vue'

const props = withDefaults(
  defineProps<{
    gap?: 'xs' | 'sm' | 'md' | 'lg' | 'xl'
    align?: 'start' | 'center' | 'end' | 'stretch' | 'baseline'
    justify?: 'start' | 'center' | 'between' | 'end'
    wrap?: boolean
  }>(),
  {
    gap: 'md',
    align: 'center',
    justify: 'start',
    wrap: false
  }
)

const gapClassMap = {
  xs: 'gap-1',
  sm: 'gap-2',
  md: 'gap-4',
  lg: 'gap-6',
  xl: 'gap-8'
} as const

const classes = computed(() => [
  'flex',
  'flex-row',
  props.wrap ? 'flex-wrap' : 'flex-nowrap',
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
