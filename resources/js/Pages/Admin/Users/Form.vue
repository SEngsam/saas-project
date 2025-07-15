<script setup>
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
  user: Object,
})

const isEdit = computed(() => !!props.user)

const form = useForm({
  name: props.user?.name ?? '',
  email: props.user?.email ?? '',
  password: '',
  password_confirmation: '',
  role: props.user?.role ?? 'user',
})

function submit() {
  if (isEdit.value) {
    form.put(`/admin/users/${props.user.id}`)
  } else {
    form.post('/admin/users')
  }
}
</script>

<template>
  <div class="card">
    <div class="card-header">
      <h5>{{ isEdit ? 'Edit User' : 'Add User' }}</h5>
    </div>
    <div class="card-body">
      <form @submit.prevent="submit">
        <div class="mb-3">
          <label>Name</label>
          <input v-model="form.name" type="text" class="form-control" required />
          <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
        </div>

        <div class="mb-3">
          <label>Email</label>
          <input v-model="form.email" type="email" class="form-control" required />
          <div v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</div>
        </div>

        <div class="mb-3">
          <label>Password</label>
          <input v-model="form.password" type="password" :required="!isEdit" class="form-control" />
          <div v-if="form.errors.password" class="text-danger">{{ form.errors.password }}</div>
        </div>

        <div class="mb-3">
          <label>Confirm Password</label>
          <input v-model="form.password_confirmation" type="password" :required="!isEdit" class="form-control" />
        </div>

        <div class="mb-3">
          <label>Role</label>
          <select v-model="form.role" class="form-select" required>
            <option value="admin">Admin</option>
            <option value="user">User</option>
          </select>
          <div v-if="form.errors.role" class="text-danger">{{ form.errors.role }}</div>
        </div>

        <button type="submit" class="btn btn-primary">{{ isEdit ? 'Update' : 'Save' }}</button>
      </form>
    </div>
  </div>
</template>
