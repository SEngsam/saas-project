<script setup>
import { onMounted, ref } from 'vue'
import Chart from 'chart.js/auto'

const chartRef = ref(null)

onMounted(() => {
  const ctx = chartRef.value.getContext('2d')

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["Chrome", "Firefox", "IE"],
      datasets: [{
        data: [4306, 3801, 1689],
        backgroundColor: [
          '#3b82f6', // window.theme.primary
          '#f59e0b', // window.theme.warning
          '#ef4444'  // window.theme.danger
        ],
        borderWidth: 5
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        }
      },
      cutout: '75%'
    }
  })
})
</script>

<template>
  <canvas ref="chartRef"></canvas>
</template>
