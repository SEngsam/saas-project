<script setup>
import Layout from '@/Layouts/Layout.vue';
const props = defineProps({
    payments: Array
})
console.log(props.payments[0].plan.price)
</script>

<template>
    <Layout>
        <div class="container mt-5">
            <h2 class="mb-4">Billing History</h2>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(payment, index) in payments" :key="payment.id">
                        <td>{{ index + 1 }}</td>
                        <td>${{ payment.plan.price }}</td>
                        <td>{{ payment.payment_method }}</td>
                        <td>{{ new Date(payment.created_at).toLocaleDateString() }}</td>
                    </tr>
                    <tr v-if="payments.length === 0">
                        <td colspan="4" class="text-center">No billing history found.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </Layout>
</template>
