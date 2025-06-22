<template>
  <Suspense>
    <component :is="remoteComponent" />
  </Suspense>
</template>

<script setup>
import { ref } from 'vue'

const remoteComponent = ref(null)

const load = async () => {
  const module = await import('sign_up/App')
  remoteComponent.value = module.default
}

load()
</script>
