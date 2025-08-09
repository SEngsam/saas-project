<template>
    <MainLayout>
        <div class="container-fluid p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Invoices</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Invoice #</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="invoices.data.length === 0">
                                <td colspan="8" class="text-center text-muted py-4">
                                    No invoices found.
                                </td>
                            </tr>
                            <tr v-else v-for="invoice in invoices.data" :key="invoice.id">
                                <td>{{ invoice.id }}</td>
                                <td>{{ invoice.user?.name ?? '—' }}</td>
                                <td>{{ invoice.invoice_number }}</td>
                                <td>${{ invoice.amount }}</td>
                                <td>
                                    <span :class="{
                                        'badge bg-success': invoice.status === 'paid',
                                        'badge bg-warning': invoice.status === 'unpaid',
                                        'badge bg-danger': invoice.status === 'overdue'
                                    }">
                                        {{ invoice.status }}
                                    </span>
                                </td>
                                <td>{{ formatDate(invoice.issue_date) }}</td>
                                <td>{{ formatDate(invoice.due_date) }}</td>
                                <td class="text-end">
                                    <Link :href="`/admin/invoices/${invoice.id}/edit`"
                                        class="btn btn-sm btn-outline-primary me-2">
                                    <i data-feather="edit"></i>
                                    </Link>
                                    <button @click="confirmDelete(invoice.id)" class="btn btn-sm btn-outline-danger">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <nav v-if="invoices.links" aria-label="Pagination">
                        <ul class="pagination mt-3">
                            <li v-for="link in invoices.links" :key="link.label" class="page-item"
                                :class="{ active: link.active }">
                                <Link :href="link.url || '#'" class="page-link">
                                <span v-html="link.label"></span>
                                </Link>

                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    invoices: Object,
})

const formatDate = (date) => {
    return new Date(date).toLocaleDateString()
}

const confirmDelete = (id) => {
    if (confirm('Are you sure you want to delete this invoice?')) {
        $inertia.delete(`/admin/invoices/${id}`)
    }
}
</script>
