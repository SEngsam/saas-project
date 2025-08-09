<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
const props = defineProps(['invoices'])
</script>

<template>
    <MainLayout>
        <div class="container-fluid p-0">
            <h1 class="h3 mb-4"><strong>My Invoices</strong></h1>

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="invoice in invoices" :key="invoice.id">
                                <td>{{ invoice.invoice_number }}</td>
                                <td>${{ invoice.amount }}</td>
                                <td>
                                    <span :class="invoice.status === 'paid' ? 'text-success' : 'text-warning'">
                                        {{ invoice.status }}
                                    </span>
                                </td>
                                <td>{{ new Date(invoice.due_date).toLocaleDateString() }}</td>
                                <td>{{ new Date(invoice.created_at).toLocaleDateString() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
