<template>
  <MainLayout>
    <div class="container-fluid py-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Add New Plan</h1>
        <Link href="/admin/plans" class="btn btn-outline-secondary">
          <i data-feather="arrow-left"></i> <span class="ms-1">Back</span>
        </Link>
      </div>

      <div class="card">
        <div class="card-body">
          <PlanForm :form="form" :errors="errors" @submit="submitForm" />
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import PlanForm from './Form.vue'
import { useForm } from '@inertiajs/vue3'
import { Link, router } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  price: '',
  duration: '',
  features: '',
  is_active: 1
})

const submitForm = () => {
  form.post('/admin/plans')
}

const errors = form.errors
</script>
