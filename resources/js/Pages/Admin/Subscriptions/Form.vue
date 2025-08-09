<template>
  <form @submit.prevent="submitForm">
    <div class="mb-3">
      <label for="user_id" class="form-label">User</label>
      <select id="user_id" v-model="form.user_id" class="form-select">
        <option value="">Select User</option>
        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
      </select>
      <div v-if="errors.user_id" class="text-danger small">{{ errors.user_id }}</div>
    </div>

    <div class="mb-3">
      <label for="plan_id" class="form-label">Plan</label>
      <select id="plan_id" v-model="form.plan_id" class="form-select">
        <option value="">Select Plan</option>
        <option v-for="plan in plans" :key="plan.id" :value="plan.id">{{ plan.name }}</option>
      </select>
      <div v-if="errors.plan_id" class="text-danger small">{{ errors.plan_id }}</div>
    </div>

    <div class="mb-3">
      <label for="start_date" class="form-label">Start Date</label>
      <input type="date" id="start_date" v-model="form.start_date" class="form-control">
      <div v-if="errors.start_date" class="text-danger small">{{ errors.start_date }}</div>
    </div>

    <div class="mb-3">
      <label for="end_date" class="form-label">End Date</label>
      <input type="date" id="end_date" v-model="form.end_date" class="form-control">
      <div v-if="errors.end_date" class="text-danger small">{{ errors.end_date }}</div>
    </div>

    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" id="is_active" v-model="form.is_active" />
      <label class="form-check-label" for="is_active">Active</label>
      <div v-if="errors.is_active" class="text-danger small">{{ errors.is_active }}</div>
    </div>

    <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="button" class="btn btn-secondary" @click="cancel">Cancel</button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const emit = defineEmits(['submit', 'cancel'])
const props = defineProps({
  users: Array,
  plans: Array,
  errors: Object,
})

const form = useForm({
  user_id: '',
  plan_id: '',
  start_date: '',
  end_date: '',
  is_active: true
})

const submitForm = () => {
  emit('submit', form)
}

const cancel = () => {
  emit('cancel')
}
</script>
