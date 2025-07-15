<script setup>
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({ plans: Object })

function formatDate(date) {
    return date ? new Date(date).toLocaleDateString() : ''
}

function badgeClass(status) {
    if (status === 'active') return 'bg-success'
    if (status === 'inactive') return 'bg-secondary'
    if (status === 'cancelled') return 'bg-danger'
    return ''
}

function goToCreate() {
    window.location.href = '/plans/form'
}

function goToEdit(id) {
    window.location.href = `/plans/form/${id}`
}

function deletePlan(id) {
    if (confirm('هل أنت متأكد من حذف هذه الخطة؟')) {
        Inertia.delete(`/plans/${id}`)
    }
}
</script>

<template>
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Plans List</h5>
            <button @click="goToCreate" class="btn btn-primary btn-sm">
                <i class="bi bi-plus"></i> Add Plan
            </button>
        </div>

        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="d-none d-xl-table-cell">Start Date</th>
                    <th class="d-none d-xl-table-cell">End Date</th>
                    <th>Status</th>
                    <th class="d-none d-md-table-cell">Assignee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="plan in plans.data" :key="plan.id">
                    <td>{{ plan.name }}</td>
                    <td class="d-none d-xl-table-cell">{{ formatDate(plan.start_date) }}</td>
                    <td class="d-none d-xl-table-cell">{{ formatDate(plan.end_date) }}</td>
                    <td>
                        <span class="badge" :class="badgeClass(plan.status)">
                            {{ plan.status }}
                        </span>
                    </td>
                    <td class="d-none d-md-table-cell">{{ plan.assignee }}</td>
                    <!-- <td>
                        <button @click="goToEdit(plan.id)" class="btn btn-sm btn-primary me-2">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button @click="deletePlan(plan.id)" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td> -->

                    <td class="table-action">
                        <a class="text-success me-2" @click="goToEdit(plan.id)" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-edit-2 align-middle">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                            </svg></a>
                        <a class="text-danger" @click="deletePlan(plan.id)" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-trash align-middle">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                            </svg></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
