<template>
    <MainLayout>
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">{{ user ? 'Edit User' : 'Create User' }}</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <form @submit.prevent="submitForm" enctype="multipart/form-data">
                                <!-- Personal Information -->
                                <fieldset class="mb-4 border rounded p-3">
                                    <legend class="float-none w-auto px-2">Personal Information</legend>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" v-model="form.name" type="text" class="form-control"
                                            placeholder="Enter name" />
                                        <div v-if="form.errors.name" class="text-danger small">{{ form.errors.name }}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input id="username" v-model="form.username" type="text" class="form-control"
                                            placeholder="Enter username" />
                                        <div v-if="form.errors.username" class="text-danger small">{{
                                            form.errors.username }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" v-model="form.email" type="email" class="form-control"
                                            placeholder="Enter email" />
                                        <div v-if="form.errors.email" class="text-danger small">{{ form.errors.email }}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input id="phone" v-model="form.phone" type="text" class="form-control"
                                            placeholder="Enter phone" />
                                        <div v-if="form.errors.phone" class="text-danger small">{{ form.errors.phone }}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select id="gender" v-model="form.gender" class="form-select">
                                            <option value="">Select gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <div v-if="form.errors.gender" class="text-danger small">{{ form.errors.gender
                                            }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="birthday" class="form-label">Birthday</label>
                                        <input id="birthday" v-model="form.birthday" type="date" class="form-control" />
                                        <div v-if="form.errors.birthday" class="text-danger small">{{
                                            form.errors.birthday }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="avatar" class="form-label">Avatar</label>
                                        <input id="avatar" type="file" accept="image/*" class="form-control"
                                            @change="onFileChange" />
                                        <div v-if="avatarPreview" class="mt-2">
                                            <img :src="avatarPreview" alt="Avatar Preview"
                                                style="max-width: 150px; max-height: 150px; border-radius: 8px;" />
                                        </div>
                                        <div v-if="form.errors.avatar" class="text-danger small">{{ form.errors.avatar
                                            }}</div>
                                    </div>
                                </fieldset>

                                <!-- Address Details -->
                                <fieldset class="mb-4 border rounded p-3">
                                    <legend class="float-none w-auto px-2">Address Details</legend>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input id="address" v-model="form.address" type="text" class="form-control"
                                            placeholder="Enter address" />
                                        <div v-if="form.errors.address" class="text-danger small">{{ form.errors.address
                                            }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input id="country" v-model="form.country" type="text" class="form-control"
                                            placeholder="Enter country" />
                                        <div v-if="form.errors.country" class="text-danger small">{{ form.errors.country
                                            }}</div>
                                    </div>
                                </fieldset>

                                <!-- User Settings -->
                                <fieldset class="mb-4 border rounded p-3">
                                    <legend class="float-none w-auto px-2">User Settings</legend>

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" v-model="form.status" class="form-select">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="banned">Banned</option>
                                        </select>
                                        <div v-if="form.errors.status" class="text-danger small">{{ form.errors.status
                                            }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" v-model="form.password" type="password"
                                            class="form-control"
                                            :placeholder="user ? 'Leave blank to keep current password' : 'Enter password'" />
                                        <div v-if="form.errors.password" class="text-danger small">{{
                                            form.errors.password }}</div>
                                    </div>
                                </fieldset>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue'
import MainLayout from '@/Layouts/MainLayout.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    user: Object,
     errors: Object
})
console.log(props.errors)
const form = useForm({
    name: props.user?.name || '',
    username: props.user?.username || '',
    email: props.user?.email || '',
    phone: props.user?.phone || '',
    gender: props.user?.gender || '',
    birthday: props.user?.birthday || '',
    avatar: null,
    address: props.user?.address || '',
    country: props.user?.country || '',
    status: props.user?.status || 'active',
    is_admin: props.user?.is_admin ? 1 : 0,
    password: '',
})

const avatarPreview = ref(props.user?.avatar_url || null)

function onFileChange(event) {
    const file = event.target.files[0]
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader()
        reader.onload = (e) => {
            avatarPreview.value = e.target.result
        }
        reader.readAsDataURL(file)
        form.avatar = file
    } else {
        avatarPreview.value = null
        form.avatar = null
    }
}

const submitForm = () => {
    if (props.user) {
        form.post(route('admin.users.update', props.user.id), {
            _method: 'put',
            forceFormData: true,
            onSuccess: () => {
            },
        })
    } else {
        form.post(route('admin.users.store'), {
            forceFormData: true,
            onSuccess: () => {
            },
        })
    }
}
</script>
