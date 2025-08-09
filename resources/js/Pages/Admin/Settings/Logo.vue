<script setup>
import SettingsSidebar from '@/Components/Admin/SettingsSidebar.vue'
import MainLayout from '@/Layouts/MainLayout.vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { defineProps, ref, computed } from 'vue'
import { useToast } from 'vue-toastification'

const toast = useToast()

const props = defineProps({
    settings: Object,
    success: String,
})

// File preview refs
const preloaderPreview = ref(props.settings.app_preloader_url || '')
const logoPreview = ref(props.settings.app_logo_url || '')
const whiteLogoPreview = ref(props.settings.app_white_logo_url || '')
const faviconPreview = ref(props.settings.app_favicon_url || '')

// Initialize form with files as null by default
const form = useForm({
    app_preloader: null,
    app_logo: null,
    app_white_logo: null,
    app_favicon: null,
})

// Handle file input change and preview update
function onFileChange(e, previewRef, formField) {
    const file = e.target.files[0]
    form[formField] = file || null
    if (file) {
        const reader = new FileReader()
        reader.onload = (ev) => {
            previewRef.value = ev.target.result
        }
        reader.readAsDataURL(file)
    } else {
        previewRef.value = ''
    }
}

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
                    <SettingsSidebar />
                </div>

                <!-- Main Form -->
                <div class="col-md-9">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Application Setting</h5>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="submit" enctype="multipart/form-data">
                                <div class="row g-3">
                                    <!-- App Preloader -->
                                    <div class="col-md-6">
                                        <label class="form-label">App Preloader</label>
                                        <input
                                          @change="e => onFileChange(e, preloaderPreview, 'app_preloader')"
                                          type="file" accept="image/*" class="form-control"
                                        />
                                        <div v-if="preloaderPreview" class="mt-2">
                                            <img
                                              :src="preloaderPreview"
                                              alt="App Preloader Preview"
                                              class="img-fluid rounded"
                                              style="max-height: 80px; object-fit: contain;"
                                            />
                                        </div>
                                    </div>

                                    <!-- App Logo -->
                                    <div class="col-md-6">
                                        <label class="form-label">App Logo</label>
                                        <input
                                          @change="e => onFileChange(e, logoPreview, 'app_logo')"
                                          type="file" accept="image/*" class="form-control"
                                        />
                                        <div v-if="logoPreview" class="mt-2">
                                            <img
                                              :src="logoPreview"
                                              alt="App Logo Preview"
                                              class="img-fluid rounded"
                                              style="max-height: 80px; object-fit: contain;"
                                            />
                                        </div>
                                    </div>

                                    <!-- White Logo -->
                                    <div class="col-md-6">
                                        <label class="form-label">White Logo</label>
                                        <input
                                          @change="e => onFileChange(e, whiteLogoPreview, 'app_white_logo')"
                                          type="file" accept="image/*" class="form-control"
                                        />
                                        <div v-if="whiteLogoPreview" class="mt-2">
                                            <img
                                              :src="whiteLogoPreview"
                                              alt="White Logo Preview"
                                              class="img-fluid rounded"
                                              style="max-height: 80px; object-fit: contain;"
                                            />
                                        </div>
                                    </div>

                                    <!-- Favicon -->
                                    <div class="col-md-6">
                                        <label class="form-label">Favicon</label>
                                        <input
                                          @change="e => onFileChange(e, faviconPreview, 'app_favicon')"
                                          type="file" accept="image/*" class="form-control"
                                        />
                                        <div v-if="faviconPreview" class="mt-2">
                                            <img
                                              :src="faviconPreview"
                                              alt="Favicon Preview"
                                              class="img-fluid rounded"
                                              style="max-height: 48px; object-fit: contain;"
                                            />
                                        </div>
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
