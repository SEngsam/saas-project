<script setup>
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({ subscriptions: Object })

function formatDate(date) {
    return date ? new Date(date).toLocaleDateString() : ''
}

function badgeClass(status) {
    if (status === 'active') return 'bg-success'
    if (status === 'cancelled') return 'bg-danger'
    if (status === 'expired') return 'bg-secondary'
    return ''
}

function goToCreate() {
    window.location.href = '/subscriptions/create'
}

function goToEdit(id) {
    window.location.href = `/subscriptions/${id}/edit`
}

function deleteSubscription(id) {
    if (confirm('هل أنت متأكد من حذف هذا الاشتراك؟')) {
        Inertia.delete(`/subscriptions/${id}`)
    }
}
</script>

<template>
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Subscriptions List</h5>
            <button @click="goToCreate" class="btn btn-primary btn-sm">
                <i class="bi bi-plus"></i> Add Subscription
            </button>
        </div>

        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Plan</th>
                    <th class="d-none d-xl-table-cell">Start Date</th>
                    <th class="d-none d-xl-table-cell">End Date</th>
                    <th>Status</th>
                    <th class="d-none d-md-table-cell">Payment Method</th>
                    <th class="d-none d-md-table-cell">Payment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="subscriptions.data.length === 0">
                    <td :colspan="8" class="text-center text-muted py-4">
                        No subscriptions added yet.

                    </td>
                </tr>

                <tr v-else v-for="sub in subscriptions.data" :key="sub.id">
                    <td>{{ sub.user.name }}</td>
                    <td>{{ sub.plan.name }}</td>
                    <td class="d-none d-xl-table-cell">{{ formatDate(sub.starts_at) }}</td>
                    <td class="d-none d-xl-table-cell">{{ formatDate(sub.ends_at) }}</td>
                    <td>
                        <span class="badge" :class="badgeClass(sub.status)">
                            {{ sub.status }}
                        </span>
                    </td>
                    <td class="d-none d-md-table-cell">{{ sub.payment_method ?? '-' }}</td>
                    <td class="d-none d-md-table-cell">{{ sub.payment_status }}</td>
                    <td class="table-action">
                        <a class="text-success me-2" @click.prevent="goToEdit(sub.id)" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-edit-2 align-middle">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                            </svg>
                        </a>
                        <a class="text-danger" @click.prevent="deleteSubscription(sub.id)" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-trash align-middle">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                            </svg>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
