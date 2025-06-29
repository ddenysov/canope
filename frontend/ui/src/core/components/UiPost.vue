<script setup lang="ts">
import { ref } from 'vue'

const payload = ref({ name: 'Dmytro', age: 40 })
const result = ref(null)
const error = ref<string | null>(null)

const send = async () => {
  try {
    const res = await fetch('https://api.example.com/users', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload.value),
    })
    if (!res.ok) throw new Error(res.statusText)
    result.value = await res.json()
  } catch (e: any) {
    error.value = e.message
  }
}
</script>

<template>
  <button @click="send">Отправить</button>
  <pre v-if="result">{{ result }}</pre>
  <p v-if="error">Ошибка: {{ error }}</p>
</template>
