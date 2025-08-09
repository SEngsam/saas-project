<script setup>
import SettingsSidebar from '@/Components/Admin/SettingsSidebar.vue'
import MainLayout from '@/Layouts/MainLayout.vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { defineProps, watch, computed } from 'vue'
import { useToast } from 'vue-toastification'

const toast = useToast()

const props = defineProps({
    settings: Object,
    success: String,    // match Laravel flash key here
})

// Initialize form with settings
const form = useForm({
    app_name: props.settings.app_name,
    app_email: props.settings.app_email,
    app_contact: props.settings.app_contact,
    app_location: props.settings.app_location,
    app_copyright: props.settings.app_copyright,
    footer_text: props.settings.footer_text,
    developed_by: props.settings.developed_by,
    timezone: props.settings.timezone,
})

// Submit handler to post form
const submit = () => {
    form.post(route('admin.settings.update'), {
        onSuccess: () => {
            toast.success('Settings updated successfully!')
        },
        onError: () => {
            toast.error('Failed to update settings.')
        },
    })
}

// Watch Laravel flash success and show toast immediately on page load
// watch(
//   () => props.success,
//   (val) => {
//     if (val) {
//       toast.success(val)
//     }
//   },
//   { immediate: true }
// )

// Current route name for sidebar active link logic (optional)
const { props: pageProps } = usePage()
const currentRouteName = computed(() => pageProps.value?.routeName || pageProps.value?.component || '')
const isActive = (routeName) => currentRouteName.value === routeName
</script>
<template>
    <MainLayout>
        <div class="container-fluid p-0">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body p-0">
                            <SettingsSidebar />
                        </div>
                    </div>
                </div>

                <!-- Main Form -->
                <div class="col-md-9">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Application Setting</h5>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="submit">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">App Name *</label>
                                        <input v-model="form.app_name" type="text" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">App Email *</label>
                                        <input v-model="form.app_email" type="email" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">App Contact Number *</label>
                                        <input v-model="form.app_contact" type="text" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">App Location *</label>
                                        <input v-model="form.app_location" type="text" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">App Copyright *</label>
                                        <input v-model="form.app_copyright" type="text" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Footer Text *</label>
                                        <input v-model="form.footer_text" type="text" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Developed By *</label>
                                        <input v-model="form.developed_by" type="text" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Timezone *</label>
                                        <select v-model="form.timezone" class="form-select" required>
                                            <option value="UTC">UTC</option>
                                            <option value="Asia/Gaza">Asia/Gaza</option>
                                            <option value="Asia/Riyadh">Asia/Riyadh</option>
                                            <option value="Europe/London">Europe/London</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4 text-end">
                                    <button type="submit" class="btn btn-primary px-4">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
