<script setup>
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
    users: Object
});

function badgeClass(role) {
    return role === 'admin' ? 'bg-primary' : 'bg-secondary';
}

function goToCreate() {
    window.location.href = '/admin/users/create'
}

function goToEdit(id) {
    window.location.href = `/admin/users/${id}/edit`
}

function deleteUser(id) {
    if (confirm('هل أنت متأكد من حذف هذا المستخدم؟')) {
        Inertia.delete(`/admin/users/${id}`)
    }
}
</script>

<template>
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Users List</h5>
            <button @click="goToCreate" class="btn btn-primary btn-sm">
                <i class="bi bi-plus"></i> Add User
            </button>
        </div>

        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="d-none d-xl-table-cell">Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td class="d-none d-xl-table-cell">{{ new Date(user.created_at).toLocaleDateString() }}</td>
                    <td>
                        <span class="badge" :class="badgeClass(user.role)">
                            {{ user.role }}
                        </span>
                    </td>
                    <td class="table-action">
                        <button @click="goToEdit(user.id)" class="btn btn-sm btn-primary me-2">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button @click="deleteUser(user.id)" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-3">
            <button
                v-if="users.prev_page_url"
                @click="$inertia.visit(users.prev_page_url)"
                class="btn btn-sm btn-outline-primary me-2"
            >
                Previous
            </button>

            <button
                v-if="users.next_page_url"
                @click="$inertia.visit(users.next_page_url)"
                class="btn btn-sm btn-outline-primary"
            >
                Next
            </button>
        </div>
    </div>
</template>
