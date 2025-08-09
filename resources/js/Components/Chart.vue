<script setup>
import { onMounted, watch, ref } from 'vue'
import ChartJS from 'chart.js/auto'

onMounted(() => {

    // Setup Line Chart (Recent Movement)
    const lineCtx = document.getElementById("chartjs-dashboard-line").getContext("2d");
    const gradient = lineCtx.createLinearGradient(0, 0, 0, 225);
    gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
    gradient.addColorStop(1, "rgba(215, 227, 244, 0)");

    new Chart(lineCtx, {
        type: "line",
        data: {
            labels: [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ],
            datasets: [
                {
                    label: "Sales ($)",
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: "#3b82f6",
                    data: [2115, 1562, 1584, 1892, 1587, 1923, 2566, 2448, 2805, 3438, 2917, 3327],
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { reverse: true, grid: { color: "transparent" } },
                y: { ticks: { stepSize: 1000 }, grid: { color: "transparent" } },
            },
        },
    });
})

</script>

<template>
    <div class="card flex-fill w-100">
        <div class="card-header">
            <h5 class="card-title mb-0">Recent Movement</h5>
        </div>
        <div class="card-body py-3">
            <div class="chart chart-sm">
                <canvas id="chartjs-dashboard-line"></canvas>
            </div>
        </div>
    </div>
</template>
