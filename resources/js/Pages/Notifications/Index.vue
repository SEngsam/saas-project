<script setup>
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'
import MainLayout from '@/Layouts/MainLayout.vue'

const page = usePage()
const notifications = ref(page.props.notifications)

function markAsRead(id) {
  Inertia.post(`/notifications/${id}/read`)
}
</script>

<template>
  <MainLayout>
     <div class="container-fluid p-0">
    <h1 class="h3 mb-4"><strong>Notifications</strong> - All Messages</h1>

    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">User Notifications</h5>
      </div>
      <div class="card-body">
        <div v-if="notifications.length > 0" class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Message</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(notif, index) in notifications" :key="notif.id">
                <td>{{ index + 1 }}</td>
                <td>{{ notif.data.message }}</td>
                <td>{{ new Date(notif.created_at).toLocaleString() }}</td>
                <td>
                  <span :class="notif.read_at ? 'badge bg-success' : 'badge bg-warning'">
                    {{ notif.read_at ? 'Read' : 'Unread' }}
                  </span>
                </td>
                <td>
                  <button
                    v-if="!notif.read_at"
                    @click="markAsRead(notif.id)"
                    class="btn btn-sm btn-outline-primary"
                  >
                    Mark as Read
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div v-else class="alert alert-info mb-0">
          No notifications available.
        </div>
      </div>
    </div>
  </div>
  </MainLayout>
</template>
