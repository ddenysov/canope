<script setup lang="ts">
import { ref, onMounted } from 'vue'

const items = ref<any[]>([])
const error = ref<string | null>(null)

onMounted(async () => {
  try {
    const res = await fetch('https://api.example.com/items')
    if (!res.ok) throw new Error(res.statusText)
    items.value = await res.json()
  } catch (e: any) {
    error.value = e.message
  }
})
</script>

<template>
  <div>
    <h3>Список</h3>
    <ul>
      <li v-for="item in items" :key="item.id">{{ item.name }}</li>
    </ul>
    <p v-if="error">Ошибка: {{ error }}</p>
  </div>
</template>
