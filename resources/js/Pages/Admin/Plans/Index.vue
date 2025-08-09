<template>
  <MainLayout>
    <div class="container-fluid py-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Plans</h1>
        <Link href="/admin/plans/create" class="btn btn-primary">
          <i data-feather="plus"></i> <span class="ms-1">Add Plan</span>
        </Link>
      </div>

      <div class="card">
        <div class="card-body">
          <table class="table table-hover table-bordered align-middle text-nowrap">
            <thead class="table-light">
              <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Duration (days)</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="plan in plans" :key="plan.id">
                <td>{{ plan.name }}</td>
                <td>{{ plan.price }} $</td>
                <td>{{ plan.duration }}</td>
                <td>
                  <span :class="plan.is_active ? 'badge bg-success' : 'badge bg-secondary'">
                    {{ plan.is_active ? 'Active' : 'Inactive' }}
                  </span>
                </td>
                <td>
                  <Link :href="`/admin/plans/${plan.id}/edit`" class="btn btn-sm btn-outline-primary me-2">
                    <i data-feather="edit"></i>
                  </Link>
                  <button @click="confirmDelete(plan.id)" class="btn btn-sm btn-outline-danger">
                    <i data-feather="trash-2"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>

          <nav v-if="plans.last_page > 1" class="mt-3">
            <ul class="pagination">
              <li v-for="page in plans.last_page" :key="page" :class="['page-item', { active: page === plans.current_page }]">
                <a class="page-link" href="#" @click.prevent="$inertia.get(plans.path + '?page=' + page)">
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
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({ plans: Object });

const confirmDelete = (id) => {
  if (confirm('Are you sure you want to delete this plan?')) {
    $inertia.delete(`/admin/plans/${id}`);
  }
};
</script>

<style scoped>
.table th,
.table td {
  vertical-align: middle;
}
</style>
