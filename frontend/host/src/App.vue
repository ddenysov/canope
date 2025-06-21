<template>
  <NavHeader />
  <RouterView />
</template>

<script setup>
import { ref } from 'vue'
import NavHeader from "./components/NavHeader.vue";
</script>

<style>
h1 {
  color: #42b983;
}
</style>
