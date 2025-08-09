<script setup>
import { onMounted, ref } from 'vue'
import flatpickr from 'flatpickr'
import 'flatpickr/dist/flatpickr.css'

const datepickerRef = ref(null)

onMounted(() => {
  const date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000)
  const defaultDate = `${date.getUTCFullYear()}-${date.getUTCMonth() + 1}-${date.getUTCDate()}`

  flatpickr(datepickerRef.value, {
    inline: true,
    prevArrow: '<span title="Previous month">&laquo;</span>',
    nextArrow: '<span title="Next month">&raquo;</span>',
    defaultDate
  })
})
</script>

<template>
  <div ref="datepickerRef" id="datetimepicker-dashboard"></div>
</template>
