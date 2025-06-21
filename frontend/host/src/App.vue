<template>
  <h1>{{ message }}</h1>
  <RemoteWrapper />
</template>

<script setup>
import { ref } from 'vue'
import RemoteWrapper from './components/RemoteWrapper.vue'

const message = ref('Host')
</script>

<style>
h1 {
  color: #42b983;
}
</style>
