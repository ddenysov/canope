<template>
  <Suspense>
    <component :is="remoteComponent" />
    <template #fallback>
      <div>Загрузка...</div>
    </template>
  </Suspense>
</template>

<script setup>
import { ref } from 'vue'

const remoteComponent = ref(null)

const load = async () => {
  const module = await import("remote/App")
  remoteComponent.value = module.default
}

load()
</script>
