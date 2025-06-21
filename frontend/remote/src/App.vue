<template>
  <h1>{{ message }}</h1>
</template>

<script setup>
import { ref } from 'vue'

const message = ref('Remote')
</script>

<style>
h1 {
  color: #b94246;
}
</style>
