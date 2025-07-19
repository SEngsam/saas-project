<script setup>
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
  subscription: Object,
  plans: Array,
  users: Array,
})

const form = useForm({
  user_id: props.subscription?.user_id ?? '',
  plan_id: props.subscription?.plan_id ?? '',
  starts_at: props.subscription?.starts_at ? props.subscription.starts_at.substr(0, 10) : '',
  ends_at: props.subscription?.ends_at ? props.subscription.ends_at.substr(0, 10) : '',
  status: props.subscription?.status ?? 'active',
  payment_method: props.subscription?.payment_method ?? '',
  payment_status: props.subscription?.payment_status ?? 'pending',
})

const isEdit = computed(() => !!props.subscription)

function handleSubmit() {
  if (isEdit.value) {
    form.put(`/subscriptions/${props.subscription.id}`)
  } else {
    form.post('/subscriptions')
  }
}
</script>

<template>
  <form @submit.prevent="handleSubmit" class="card p-4">
    <h5 class="mb-4">{{ isEdit ? 'Edit Subscription' : 'Add Subscription' }}</h5>

    <div class="mb-3">
      <label class="form-label">User</label>
      <select v-model="form.user_id" required class="form-select">
        <option value="" disabled>Select User</option>
        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Plan</label>
      <select v-model="form.plan_id" required class="form-select">
        <option value="" disabled>Select Plan</option>
        <option v-for="plan in plans" :key="plan.id" :value="plan.id">{{ plan.name }}</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Start Date</label>
      <input type="date" v-model="form.starts_at" required class="form-control" />
    </div>

    <div class="mb-3">
      <label class="form-label">End Date</label>
      <input type="date" v-model="form.ends_at" class="form-control" />
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select v-model="form.status" required class="form-select">
        <option value="active">Active</option>
        <option value="cancelled">Cancelled</option>
        <option value="expired">Expired</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Payment Method</label>
      <input type="text" v-model="form.payment_method" placeholder="e.g. Stripe, Paypal" class="form-control" />
    </div>

    <div class="mb-3">
      <label class="form-label">Payment Status</label>
      <select v-model="form.payment_status" required class="form-select">
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
        <option value="failed">Failed</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">{{ isEdit ? 'Update' : 'Save' }}</button>
  </form>
</template>
