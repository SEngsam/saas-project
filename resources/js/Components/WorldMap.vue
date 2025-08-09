<script setup>
import { onMounted, ref } from 'vue'
import jsVectorMap from 'jsvectormap'
import 'jsvectormap/dist/maps/world.js'

const mapRef = ref(null)

onMounted(() => {
  const markers = [
    { coords: [31.230391, 121.473701], name: "Shanghai" },
    { coords: [28.704060, 77.102493], name: "Delhi" },
    { coords: [6.524379, 3.379206], name: "Lagos" },
    { coords: [35.689487, 139.691711], name: "Tokyo" },
    { coords: [23.129110, 113.264381], name: "Guangzhou" },
    { coords: [40.7127837, -74.0059413], name: "New York" },
    { coords: [34.052235, -118.243683], name: "Los Angeles" },
    { coords: [41.878113, -87.629799], name: "Chicago" },
    { coords: [51.507351, -0.127758], name: "London" },
    { coords: [40.416775, -3.703790], name: "Madrid" }
  ]

  const map = new jsVectorMap({
    selector: mapRef.value,
    map: 'world',
    zoomButtons: true,
    markers,
    markerStyle: {
      initial: {
        r: 9,
        strokeWidth: 7,
        strokeOpacity: 0.4,
        fill: '#3b82f6'
      },
      hover: {
        fill: '#3b82f6',
        stroke: '#3b82f6'
      }
    },
    zoomOnScroll: false
  })

  window.addEventListener('resize', () => {
    map.updateSize()
  })
})
</script>

<template>
  <div ref="mapRef" style="width: 100%; height: 350px;"></div>
</template>
