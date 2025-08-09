<template>
  <MainLayout>
    <div class="container-fluid p-4">
      <h1 class="h3 mb-4">Edit Subscription</h1>

      <div class="card shadow-sm">
        <div class="card-body">
          <SubscriptionForm
            :users="users"
            :plans="plans"
            :subscription="subscription"
            :errors="errors"
            :isEdit="true"
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
  subscription: Object,
  errors: Object,
})

const submitForm = (form) => {
  $inertia.put(`/admin/subscriptions/${props.subscription.id}`, form)
}

const cancel = () => {
  $inertia.get('/admin/subscriptions')
}
</script>
