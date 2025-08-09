<script setup>
import { watch, ref, onMounted } from 'vue'

const props = defineProps({
  data: {
    type: [Array, Object],
    required: true
  }
})

const chartRef = ref(null)

function renderChart(inputData) {
  const ctx = chartRef.value.getContext('2d')

  const entries = Array.isArray(inputData)
    ? inputData
    : Object.entries(inputData).map(([label, value]) => ({ label, value }))

  const labels = entries.map(item => item.label)
  const values = entries.map(item => item.value)

  new Chart(ctx, {
    type: 'line',
    data: {
      labels,
      datasets: [{
        label: 'Monthly Data',
        fill: true,
        backgroundColor: 'rgba(59,130,246,0.1)',
        borderColor: '#3b82f6',
        data: values
      }]
    },
    options: {
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false }
      }
    }
  })
}

onMounted(() => {
  renderChart(props.data)
})

watch(() => props.data, (newVal) => {
  renderChart(newVal)
})
</script>

<template>
  <canvas ref="chartRef" ></canvas>
</template>
