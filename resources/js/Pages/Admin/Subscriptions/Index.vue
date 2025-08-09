<template>
    <MainLayout>
        <div class="container-fluid p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3 mb-0">Subscriptions</h1>
                <Link href="/admin/subscriptions/create" class="btn btn-primary">
                <i data-feather="plus"></i> <span class="ms-1">Add Subscription</span>
                </Link>
            </div>
            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>User</th>
                                <th>Plan</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="subscriptions.data.length === 0">
                                <td colspan="6" class="text-center text-muted py-4">
                                    No subscriptions found.
                                </td>
                            </tr>
                            <tr v-else v-for="sub in subscriptions.data" :key="sub.id">
                                <td>{{ sub.user?.name ?? '—' }}</td>
                                <td>{{ sub.plan?.name ?? '—' }}</td>
                                <td>{{ formatDate(sub.start_date) }}</td>
                                <td>{{ formatDate(sub.end_date) }}</td>
                                <td>
                                    <span :class="{
                                        'badge bg-success': sub.is_active,
                                        'badge bg-danger': !sub.is_active
                                    }">
                                        {{ sub.is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button @click="$inertia.get(`/admin/subscriptions/${sub.id}/edit`)"
                                        class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                        <i data-feather="edit"></i>
                                    </button>
                                    <button @click="confirmDelete(sub.id)" class="btn btn-sm btn-outline-danger"
                                        title="Delete">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                    </table>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li v-for="page in subscriptions.last_page" :key="page"
                                :class="['page-item', { active: page === subscriptions.current_page }]">
                                <a href="#" class="page-link"
                                    @click.prevent="$inertia.get(subscriptions.path + '?page=' + page)">
                                    {{ page }}
                                </a>
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
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    subscriptions: Object,
})
console.log(props.subscriptions)

const confirmDelete = (id) => {
    if (confirm('Are you sure you want to delete this subscription?')) {
        $inertia.delete(`/admin/subscriptions/${id}`)
    }
}

const formatDate = (dateStr) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric' }
    return new Date(dateStr).toLocaleDateString(undefined, options)
}
</script>
