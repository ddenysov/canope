<script setup>
import {RouterView, useRouter} from 'vue-router';

const router = useRouter();

import {getActivePinia} from 'pinia'

console.log('active pinia?', getActivePinia())
</script>

<template>
  <div class="flex flex-col h-screen">
    <UiNavbar>
      <template #end>
        <UiButton @click="() => { router.push({ name: 'home' }) }" :text="true" label="Покатушки" />
        <UiButton :text="true" label="Увійти" />
        <UiButton @click="() => { router.push('sign_up') }" label="Реєстрація" />
      </template>
    </UiNavbar>
    <RouterView />
  </div>
</template>

<style scoped>

</style>
