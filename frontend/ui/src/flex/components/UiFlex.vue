<script setup lang="ts">
import { computed } from 'vue';

import {useBooleanClass, useClass} from "../../core/composables/class.ts";
import type {UiFlexProps} from "@/flex/types";
import type {Bit, AlignItems, JustifyContent, Direction, Gap} from "@/flex/types";


const props = defineProps<UiFlexProps>();

const computedClass = computed(() => {
  return [
    useClass<Bit>('grow', props.grow),
    useClass<Bit>('flex-shrink', props.shrink),
    useClass<AlignItems>('align-items', props.alignItems),
    useClass<JustifyContent>('justify-content', props.justifyContent),
    useClass<Direction>('flex', props.direction),
    useClass<Gap>('gap', props.gap),
    useBooleanClass('ui-full-height', props.fullHeight),
  ];
});
</script>

<template>
  <div class="flex" :class="computedClass">
    <slot />
  </div>
</template>
