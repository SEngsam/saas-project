<script setup>
import { Inertia } from '@inertiajs/inertia'
import { router } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/inertia-vue3'
import Layout from '@/Layouts/Layout.vue'
import { ref } from 'vue'


const props = defineProps({
    subscriptions: Object,
    filters: Object
})


const filters = ref({
    user: props.filters.user || '',
    plan: props.filters.plan || '',
    status: props.filters.status || ''
})


const search = () => {
    // Inertia.visit('/subscriptions', {
    //     method: 'get',
    //     data: Object.fromEntries(
    //         Object.entries(filters.value).filter(([_, v]) => v !== '')
    //     ),
    //     preserveState: true,
    //     preserveScroll: true,
    // })
    router.get('/subscriptions', filters.value, {
        preserveState: true,
        preserveScroll: true,
    })
}

function formatDate(date) {
    return date ? new Date(date).toLocaleDateString() : ''
}

function badgeClass(status) {
    if (status === 'active') return 'bg-success'
    if (status === 'cancelled') return 'bg-danger'
    if (status === 'expired') return 'bg-secondary'
    return ''
}
</script>

<template>
    <layout>

        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">My Subscriptions</h5>
                <form @submit.prevent="search" class="d-flex gap-2">
                    <input v-model="filters.user" placeholder="User name" class="form-control form-control-sm" />
                    <input v-model="filters.plan" placeholder="Plan name" class="form-control form-control-sm" />
                    <select v-model="filters.status" class="form-select form-select-sm">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="expired">Expired</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <button class="btn btn-primary btn-sm" type="submit">Search</button>
                </form>
            </div>

            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th>Plan</th>
                        <th class="d-none d-xl-table-cell">Start Date</th>
                        <th class="d-none d-xl-table-cell">End Date</th>
                        <th>Status</th>
                        <th class="d-none d-md-table-cell">Payment Method</th>
                        <th class="d-none d-md-table-cell">Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="subscriptions.length === 0">
                        <td :colspan="6" class="text-center text-muted py-4">
                            You don’t have any subscriptions yet.
                        </td>
                    </tr>

                    <tr v-for="sub in subscriptions" :key="sub.id">
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
                    </tr>
                </tbody>
            </table>
        </div>
    </layout>
</template>
