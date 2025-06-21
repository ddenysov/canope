<template>
  <h1>{{ message }}</h1>
</template>

<script setup>
import { ref } from 'vue'

const message = ref('XOCT')
</script>

<style>
h1 {
  color: #42b983;
}
</style>
