<template>
  <form @submit.prevent="submitForm">

    <!-- User Select -->
    <div class="mb-3">
      <label for="user" class="form-label">User</label>
      <select v-model="form.user_id" id="user" class="form-select" @change="onUserChange">
        <option value="">Select a user</option>
        <option v-for="user in users" :key="user.id" :value="user.id">
          {{ user.name }}
        </option>
      </select>
      <div v-if="errors.user_id" class="text-danger">{{ errors.user_id }}</div>
    </div>

    <!-- Subscription Select -->
    <div class="mb-3">
      <label for="subscription" class="form-label">Subscription</label>
      <select v-model="form.subscription_id" id="subscription" class="form-select" :disabled="subscriptionsForUser.length === 0">
        <option value="">Select a subscription (optional)</option>
        <option v-for="sub in subscriptionsForUser" :key="sub.id" :value="sub.id">
          {{ sub.plan.name }} ({{ formatDate(sub.start_date) }} - {{ formatDate(sub.end_date) }})
        </option>
      </select>
      <div v-if="errors.subscription_id" class="text-danger">{{ errors.subscription_id }}</div>
    </div>

    <!-- Plan Select (optional) -->
    <div class="mb-3">
      <label for="plan" class="form-label">Plan</label>
      <select v-model="form.plan_id" id="plan" class="form-select">
        <option value="">Select a plan (optional)</option>
        <option v-for="plan in plans" :key="plan.id" :value="plan.id">{{ plan.name }}</option>
      </select>
      <div v-if="errors.plan_id" class="text-danger">{{ errors.plan_id }}</div>
    </div>

    <!-- Invoice Details -->
    <div class="mb-3">
      <label for="amount" class="form-label">Amount</label>
      <input type="number" v-model="form.amount" id="amount" class="form-control" />
      <div v-if="errors.amount" class="text-danger">{{ errors.amount }}</div>
    </div>

    <div class="mb-3">
      <label for="due_date" class="form-label">Due Date</label>
      <input type="date" v-model="form.due_date" id="due_date" class="form-control" />
      <div v-if="errors.due_date" class="text-danger">{{ errors.due_date }}</div>
    </div>

    <button type="submit" class="btn btn-primary">Save Invoice</button>
  </form>
</template>

<script setup>
import { ref, computed, watch } from 'vue'

const props = defineProps({
  users: Array,
  subscriptions: {
    type: Array,
    default: () => [],
  },
  plans: Array,
  errors: Object,
  initialData: Object,
})
const form = ref({
  user_id: props.initialData?.user_id || '',
  subscription_id: props.initialData?.subscription_id || '',
  plan_id: props.initialData?.plan_id || '',
  amount: props.initialData?.amount || '',
  due_date: props.initialData?.due_date || '',
})

const subscriptionsForUser = computed(() => {
  return props.subscriptions.filter(sub => sub.user_id === form.value.user_id)
})

const formatDate = (dateStr) => {
  if (!dateStr) return ''
  return new Date(dateStr).toLocaleDateString()
}

function submitForm() {
  // Emit event or call inertia post
  // Example: emit('submit', form.value)
  // or directly use inertia form submit here
}

function onUserChange() {
  // Reset subscription and plan when user changes
  form.value.subscription_id = ''
  form.value.plan_id = ''
}
</script>
