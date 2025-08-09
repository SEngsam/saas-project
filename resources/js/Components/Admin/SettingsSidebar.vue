<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const { props } = usePage()
const currentRoute = computed(() => props.value?.routeName)
const isActive = (name) => currentRoute.value === name
</script>

<template>
    <div class="list-group list-group-flush bg-white">
        <Link :href="route('admin.settings.application')" class="list-group-item list-group-item-action"
            :class="{ active: isActive('admin.settings.application') }">Application Setting</Link>
        <Link :href="route('admin.settings.storage')" class="list-group-item list-group-item-action"
            :class="{ active: isActive('admin.settings.storage') }">Storage Setting</Link>
        <Link :href="route('admin.settings.logo')" class="list-group-item list-group-item-action"
            :class="{ active: isActive('admin.settings.logo') }">Logo Setting</Link>
        <Link :href="route('admin.settings.color')" class="list-group-item list-group-item-action"
            :class="{ active: isActive('admin.settings.color') }">Color Setting</Link>
        <a href="#" class="list-group-item list-group-item-action">Maintenance Mode</a>
        <a href="#" class="list-group-item list-group-item-action">Cache Settings</a>
        <a href="#" class="list-group-item list-group-item-action">Affiliate Settings</a>
    </div>
</template>
