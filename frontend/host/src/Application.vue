<script setup>
import {defineAsyncComponent} from "vue";
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'

 const WidgetNavbar = defineAsyncComponent(() => import('navbar/WidgetNavbar'))
</script>

<template>
  <WidgetNavbar />
  <RouterLink to="/about" class="menu-item" active-class="active">About</RouterLink>
  <RouterView />
</template>

<style scoped>

</style>
