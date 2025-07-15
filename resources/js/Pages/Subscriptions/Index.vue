<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Subscriptions</h1>

    <ul v-if="subscriptions.length">
      <li v-for="sub in subscriptions" :key="sub.id" class="border p-2 mb-2">
        <strong>{{ sub.user?.name }}</strong> — {{ sub.plan?.name }}
        <span class="text-sm text-gray-500">({{ sub.status }})</span>
      </li>
    </ul>

    <p v-else>No subscriptions found.</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const subscriptions = ref([])

onMounted(async () => {
  const res = await axios.get('/subscriptions')
  subscriptions.value = res.data
})
</script>
