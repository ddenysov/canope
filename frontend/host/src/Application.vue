<script setup>
import {defineAsyncComponent} from "vue";
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'

 const App = defineAsyncComponent(() => import('ui/App'))
</script>

<template>
  <h1>ololo</h1>

  <UiButton />

  <RouterView />
</template>

<style scoped>

</style>
