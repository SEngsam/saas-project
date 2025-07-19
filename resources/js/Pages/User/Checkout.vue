<script setup>
import Layout from '@/Layouts/Layout.vue'
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const page = usePage()
const plan = computed(() => page.props.plan)
const from = computed(() => page.props.from)

const form = useForm({
  plan_id: plan.value.id,
  payment_method: 'paypal', // مبدئيًا فقط، يمكنك تغييره لاحقًا
})

function submit() {
  form.post(route('user.subscription.pay'), {
    preserveScroll: true,
  })
}
</script>

<template>
  <Layout>
    <Head title="Checkout" />
    <div class="container mt-5">
      <h1 class="mb-4">Checkout</h1>
      <div class="card mb-3">
        <div class="card-body">
          <h5>{{ plan.name }}</h5>
          <p>${{ plan.price }}</p>
          <p>{{ plan.description }}</p>
        </div>
      </div>

      <form @submit.prevent="submit">
        <input type="hidden" v-model="form.plan_id" />

        <div class="mb-3">
          <label class="form-label">Payment Method</label>
          <select class="form-select" v-model="form.payment_method">
            <option value="paypal">PayPal</option>
            <option value="credit_card">Credit Card</option>
          </select>
        </div>

        <button class="btn btn-primary" type="submit" :disabled="form.processing">
          Pay Now
        </button>
      </form>
    </div>
  </Layout>
</template>
