<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { router } from '@inertiajs/vue3'

const props = defineProps(['plan', 'subscription_id'])

const confirmPayment = () => {
  router.post(`/payment/confirm/${props.subscription_id}`)
}
</script>

<template>
  <MainLayout>
    <div class="container-fluid p-0">
      <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-5">
          <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white text-center">
              <h4 class="mb-0">Confirm Subscription Payment</h4>
            </div>
            <div class="card-body text-center">
              <div class="mb-3">
                <h5 class="card-title mb-2 text-primary">Plan: {{ plan.name }}</h5>
                <p class="fs-5 mb-4">Price: <strong>${{ plan.price }}</strong></p>
              </div>

              <button class="btn btn-success btn-lg px-4" @click="confirmPayment">
                <i class="align-middle me-2" data-feather="credit-card"></i>
                Pay Now (Fake)
              </button>
            </div>
            <div class="card-footer text-muted text-center small">
              This is a simulated checkout screen.
            </div>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
