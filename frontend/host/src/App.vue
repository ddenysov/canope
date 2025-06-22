<template>
  <NavHeader />
  <RouterView />
</template>

<script setup>
import {ref, defineAsyncComponent} from 'vue'

const remoteComponent = ref(null)
import NavHeader from "./components/NavHeader.vue";
const UiButton = defineAsyncComponent(() => import('ui/UiButton'))

</script>

<style>
h1 {
  color: #42b983;
}
</style>
