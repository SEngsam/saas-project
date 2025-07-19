<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'

const plans = $page.props.plans || []

const form = useForm({
  plan_id: plans.length > 0 ? plans[0].id : null,
  payment_method: 'manual',
})

function submit() {
  form.post('/checkout', {
    onSuccess: () => {
      alert('Subscription successful!')
    },
    onError: () => {
      alert('Failed to subscribe.')
    }
  })
}
</script>

<template>
  <div class="max-w-md mx-auto p-4">
    <h1 class="text-2xl mb-4">Subscribe to a Plan</h1>

    <label for="plan">Choose a Plan:</label>
    <select id="plan" v-model="form.plan_id" class="w-full mb-4 p-2 border rounded">
      <option v-for="plan in plans" :key="plan.id" :value="plan.id">
        {{ plan.name }} — ${{ plan.price }}
      </option>
    </select>

    <label for="payment_method">Payment Method:</label>
    <select id="payment_method" v-model="form.payment_method" class="w-full mb-4 p-2 border rounded">
      <option value="manual">Manual (Fake Payment)</option>
      <!-- لاحقًا يمكن تضيف بوابات الدفع هنا -->
    </select>

    <button
      @click.prevent="submit"
      :disabled="form.processing"
      class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 disabled:opacity-50"
    >
      Subscribe
    </button>

    <div v-if="form.errors" class="mt-4 text-red-600">
      <div v-for="(error, field) in form.errors" :key="field">
        {{ error }}
      </div>
    </div>
  </div>
</template>
