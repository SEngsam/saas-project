<template>
  <MainLayout>
    <div class="container-fluid py-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Edit Plan</h1>
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
import MainLayout from '@/Layouts/MainLayout.vue';
import PlanForm from './Form.vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({ plan: Object })

const form = useForm({
  name: props.plan.name,
  price: props.plan.price,
  duration: props.plan.duration,
  features: props.plan.features,
  is_active: props.plan.is_active,
})

const errors = form.errors

const submitForm = () => {
  form.put(`/admin/plans/${props.plan.id}`)
}
</script>
PlanForm
