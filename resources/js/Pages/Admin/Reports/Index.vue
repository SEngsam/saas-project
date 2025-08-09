<template>
  <div class="p-6">
    <h1 class="text-xl font-bold mb-4">Generate Reports</h1>

    <form @submit.prevent="submitReport">
      <div class="mb-4">
        <label for="report_type">Report Type</label>
        <select v-model="form.report_type" id="report_type" class="border p-2">
          <option value="sales">Sales</option>
          <option value="users">User Activity</option>
        </select>
      </div>

      <div class="mb-4">
        <label for="start_date">Start Date</label>
        <input v-model="form.start_date" type="date" id="start_date" class="border p-2" />
      </div>

      <div class="mb-4">
        <label for="end_date">End Date</label>
        <input v-model="form.end_date" type="date" id="end_date" class="border p-2" />
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Generate</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

const form = useForm({
  report_type: 'sales',
  start_date: '',
  end_date: '',
})

function submitReport() {
  Inertia.get('/reports/show', form, { preserveState: true })
}
</script>
