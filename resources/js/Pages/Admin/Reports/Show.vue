<template>
  <div class="p-6">
    <h1 class="text-xl font-bold mb-4">Report: {{ reportType }}</h1>

    <table class="table-auto border-collapse border border-gray-300 w-full">
      <thead>
        <tr>
          <th class="border border-gray-300 px-4 py-2">Date</th>
          <th class="border border-gray-300 px-4 py-2">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in reportData" :key="item.month || item.day">
          <td class="border border-gray-300 px-4 py-2">{{ item.month || item.day }}</td>
          <td class="border border-gray-300 px-4 py-2">{{ item.total }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
defineProps({
  reportData: Array,
  reportType: String,
})
</script>
