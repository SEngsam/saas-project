<template>
  <div>
    <h3>My Subscription</h3>
    <div v-if="subscription">
      <p>Plan: {{ subscription.plan.name }}</p>
      <p>Status: {{ subscription.is_active ? 'Active' : 'Inactive' }}</p>
      <p>Start: {{ subscription.starts_at }}</p>
      <p>End: {{ subscription.ends_at }}</p>
      <button class="btn btn-danger" @click="cancel(subscription.id)">Cancel</button>
    </div>
    <div v-else>
      <p>No active subscription</p>
      <a href="/plans" class="btn btn-primary">Subscribe Now</a>
    </div>

    <h4 class="mt-4">Subscription History</h4>
    <table class="table">
      <thead><tr><th>Plan</th><th>Status</th><th>Start</th><th>End</th></tr></thead>
      <tbody>
        <tr v-for="sub in history" :key="sub.id">
          <td>{{ sub.plan.name }}</td>
          <td>{{ sub.is_active ? 'Active' : 'Inactive' }}</td>
          <td>{{ sub.starts_at }}</td>
          <td>{{ sub.ends_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
defineProps(['subscription', 'history'])

import { router } from '@inertiajs/vue3'

const cancel = (id) => {
  if (confirm('Are you sure to cancel this subscription?')) {
    router.post(`/subscriptions/${id}/cancel`)
  }
}
</script>
