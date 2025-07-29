<script setup>
import { RouterView, useRouter } from 'vue-router';
const router = useRouter();
</script>

<template>
  <UiNavbar>
    <template #end>
      <UiButton :text="true" label="Покатушки" />
      <UiButton :text="true" label="Увійти" />
      <UiButton @click="() => { router.push('sign_up') }" label="Реєстрація" />
    </template>
  </UiNavbar>
  <UiContainer>
    <RouterView />
  </UiContainer>
</template>

<style scoped>

</style>
