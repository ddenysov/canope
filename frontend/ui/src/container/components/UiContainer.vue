<script setup>
import { computed } from 'vue';

// Определяем пропсы компонента
const props = defineProps({
  /**
   * Определяет, как расположены дочерние элементы.
   * - 'default': стандартный контейнер с боковыми отступами и ограничением по ширине.
   * - 'center': центрирует контент по горизонтали и вертикали.
   */
  layout: {
    type: String,
    default: 'default',
    // Валидатор, чтобы принимались только ожидаемые значения
    validator: (value) => ['default', 'center'].includes(value),
  },
});

// Вычисляемое свойство для динамической генерации CSS-классов
const containerClasses = computed(() => {
  // Базовый класс, который заставляет компонент растягиваться на всю доступную высоту
  // Это работает только если родительский элемент является flex-контейнером (например, <div class="flex flex-col h-screen">)
  const baseClasses = ['flex-1'];

  // Классы для центрированного расположения
  if (props.layout === 'center') {
    return [...baseClasses, 'w-full', 'flex', 'items-center', 'justify-center', 'px-4'];
  }

  // Классы для стандартного (default) расположения
  // w-full - ширина 100%
  // max-w-7xl - ограничение максимальной ширины на больших экранах
  // mx-auto - центрирование по горизонтали
  // px-4 sm:px-6 lg:px-8 - адаптивные боковые отступы
  return [...baseClasses, 'w-full', 'max-w-7xl', 'mx-auto', 'px-4', 'sm:px-6', 'lg:px-8'];
});
</script>

<template>
  <main :class="containerClasses">
    <slot />
  </main>
</template>

<style scoped>
/* Стили в этом блоке не требуются, так как используется только Tailwind */
</style>
