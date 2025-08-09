<script setup>
import { onMounted, ref } from 'vue'
import Chart from 'chart.js/auto'

const chartRef = ref(null)

onMounted(() => {
    const ctx = chartRef.value.getContext('2d')

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "This year",
                backgroundColor: '#3b82f6', // بدل window.theme.primary بلون ثابت أو import من theme
                borderColor: '#3b82f6',
                hoverBackgroundColor: '#3b82f6',
                hoverBorderColor: '#3b82f6',
                data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                barPercentage: 0.75,
                categoryPercentage: 0.5
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    ticks: {
                        stepSize: 20
                    },
                    grid: {
                        display: false
                    },
                    stacked: false
                },
                x: {
                    grid: {
                        color: 'transparent'
                    },
                    stacked: false
                }
            }
        }
    })
})
</script>

<template>
    <canvas ref="chartRef"></canvas>
</template>
