<!-- src/components/UiFill.vue -->
<script lang="ts" setup>
import { computed } from 'vue'

type CenterMode = 'none' | 'x' | 'y' | 'both'

const props = withDefaults(
  defineProps<{
    center?: CenterMode   // как центрировать контент
    as?: string           // HTML‑тег, по умолчанию div
  }>(),
  {
    center: 'none',
    as: 'div'
  }
)

const centerClassMap: Record<CenterMode, string[]> = {
  none: [],
  x: ['items-center'],
  y: ['justify-center'],
  both: ['items-center', 'justify-center']
}

const classes = computed(() => [
  'flex',          // делает внутреннее размещение гибким
  'flex-1',        // занимает всё оставшееся место
  'w-full',        // ширина 100%
  'h-full',        // высота 100%
  'min-h-0',       // чтобы вложенные скроллы работали
  'flex-col',      // основная ось вертикальная
  ...centerClassMap[props.center]
])
</script>

<template>
  <component :is="props.as" :class="classes">
    <slot />
  </component>
</template>
