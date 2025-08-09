<template>
  <MainLayout>
    <div class="container-fluid p-4">
      <h1 class="h3 mb-4">User Management</h1>
      <div class="row">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
              <span class="fw-semibold">Users List</span>
              <button
                @click="$inertia.get('/admin/users/create')"
                class="btn btn-sm btn-primary"
              >
                <i data-feather="plus" class="me-1"></i> Create New User
              </button>
            </div>

            <div class="card-body">
              <table class="table table-responsive table-hover align-middle text-nowrap">
                <thead class="table-light">
                  <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users.data" :key="user.id">
                    <td>{{ user.name }}</td>
                    <td>{{ user.username ?? '-' }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.phone ?? '-' }}</td>
                    <td>
                      <span class="badge bg-info">
                        {{ user.roles?.[0]?.name ?? 'N/A' }}
                      </span>
                    </td>
                    <td>
                      <span :class="{
                        'badge bg-success': user.status === 'active',
                        'badge bg-warning text-dark': user.status === 'inactive',
                        'badge bg-danger': user.status === 'banned'
                      }">
                        {{ user.status }}
                      </span>
                    </td>
                    <td class="text-end">
                      <button
                        @click="$inertia.get(`/admin/users/${user.id}`)"
                        class="btn btn-sm btn-outline-primary me-2"
                        title="Edit"
                      >
                        <i data-feather="edit"></i>
                      </button>
                      <button
                        @click="confirmDelete(user.id)"
                        class="btn btn-sm btn-outline-danger"
                        title="Delete"
                      >
                        <i data-feather="trash-2"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </MainLayout>
</template>

<script setup>
import { onMounted } from 'vue'
import MainLayout from '@/Layouts/MainLayout.vue'

const props = defineProps({ users: Object })

const confirmDelete = (id) => {
  if (confirm('Are you sure you want to delete this user?')) {
    $inertia.delete(`/admin/users/${id}`)
  }
}

onMounted(() => {
  feather.replace()
})
</script>
