<template>
  <MainLayout>
    <div class="container-fluid p-4">
      <h1 class="h3 mb-4">Create Invoice</h1>
      <div class="card shadow-sm">
        <div class="card-body">
          <InvoiceForm
            :users="users"
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
import MainLayout from '@/Layouts/MainLayout.vue'
import InvoiceForm from './Form.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  users: Array,
  errors: Object,
})

const form = useForm({
  user_id: '',
  amount: '',
  due_date: '',
  status: 'unpaid',
})

const submitForm = () => {
  form.post('/admin/invoices')
}

const cancel = () => {
  window.history.back()
}
</script>
