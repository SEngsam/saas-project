<script setup>
import Layout from '@/Layouts/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'

const props = defineProps({
    new_plan: Object,
    current_plan: Object,
})

function proceedToCheckout() {
    window.location.href = route('user.subscription.checkout-view', { plan_id: props.new_plan.id })
}
</script>

<template>
    <Layout>

        <Head title="Confirm Plan" />
        <div class="container mt-4">
            <h2>Confirm Plan Change</h2>

            <p><strong>Current Plan:</strong> {{ current_plan?.name || 'None' }}</p>
            <p><strong>New Plan:</strong> {{ new_plan.name }} - ${{ new_plan.price }}</p>

            <button class="btn btn-primary mt-3" @click="proceedToCheckout">Proceed to Checkout</button>
        </div>
    </Layout>
</template>
