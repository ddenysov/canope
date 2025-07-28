<script setup>
import { RouterView } from 'vue-router'
import AppNavbar from "@/components/AppNavbar.vue";
import AppContainer from "@/components/AppContainer.vue";

</script>

<template>
  <UiNavbar />
  <AppContainer>
    <RouterView />
  </AppContainer>
</template>

<style scoped>

</style>
