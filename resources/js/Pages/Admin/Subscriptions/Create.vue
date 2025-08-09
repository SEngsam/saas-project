<template>
  <MainLayout>
    <div class="container-fluid p-4">
      <h1 class="h3 mb-4">Create Subscription</h1>

      <div class="card shadow-sm">
        <div class="card-body">
          <SubscriptionForm
            :users="users"
            :plans="plans"
            :errors="errors"
            @submit="submitForm"
            @cancel="cancel"
          />
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import SubscriptionForm from './Form.vue'
import MainLayout from '@/Layouts/MainLayout.vue'

const props = defineProps({
  users: Array,
  plans: Array,
  errors: Object,
})

const submitForm = (form) => {
  form.post('/admin/subscriptions')
}

const cancel = () => {
  window.history.back()
}
</script>
