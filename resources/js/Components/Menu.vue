<script setup>
import { route } from 'ziggy-js'
import { computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const currentRoute = computed(() => usePage().url)
const user = usePage().props.auth.user
const isRegularUser = user && user.role !== 'admin'

const isActive = (name) => currentRoute.value.startsWith(route(name))
</script>

<template>
    <ul class="sidebar-nav">
        <!-- Pages Section -->

        <li   class="sidebar-header menu-text">Pages</li>

        <li v-if="isRegularUser" :class="['sidebar-item', isActive('dashboard') && 'active']">
            <a class="sidebar-link" :href="route('dashboard')">
                <i class="align-middle" data-feather="sliders"></i>
                <span class="menu-text align-middle">Dashboard</span>
            </a>
        </li>

        <li v-if="usePage().props.auth?.user?.role === 'admin'"
            :class="['sidebar-item', isActive('admin.dashboard') && 'active']">
            <a class="sidebar-link" :href="route('admin.dashboard')">
                <i class="align-middle" data-feather="home"></i>
                <span class="menu-text align-middle">Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="#">
                <i class="align-middle" data-feather="user"></i>
                <span class="menu-text align-middle">Profile</span>
            </a>
        </li>



        <!-- SaaS Section -->
        <li v-if="isRegularUser" class="sidebar-header menu-text">My SaaS</li>

        <li v-if="isRegularUser" :class="['sidebar-item', isActive('plans.index') && 'active']">
            <a class="sidebar-link" :href="route('plans.index')">
                <i class="align-middle" data-feather="package"></i>
                <span class="menu-text align-middle">Available Plans</span>
            </a>
        </li>

        <li v-if="isRegularUser" :class="['sidebar-item', isActive('subscription.manage') && 'active']">
            <a class="sidebar-link" :href="route('subscription.manage')">
                <i class="align-middle" data-feather="repeat"></i>
                <span class="menu-text align-middle">My Subscriptions</span>
            </a>
        </li>

        <li v-if="isRegularUser" :class="['sidebar-item', isActive('user.invoices') && 'active']">
            <a class="sidebar-link" :href="route('user.invoices')">
                <i class="align-middle" data-feather="file-text"></i>
                <span class="menu-text align-middle">My Invoices</span>
            </a>
        </li>

        <li v-if="isRegularUser" :class="['sidebar-item', isActive('notifications.index') && 'active']">
            <a class="sidebar-link" :href="route('notifications.index')">
                <i class="align-middle" data-feather="bell"></i>
                <span class="menu-text align-middle">Notifications</span>
            </a>
        </li>

        <!-- Admin Section (conditionally shown) -->


        <li v-if="usePage().props.auth?.user?.role === 'admin'"
            :class="['sidebar-item', isActive('admin.users.index') && 'active']">
            <a class="sidebar-link" :href="route('admin.users.index')">
                <i class="align-middle" data-feather="users"></i>
                <span class="menu-text align-middle">Users</span>
            </a>
        </li>

        <li v-if="usePage().props.auth?.user?.role === 'admin'"
            :class="['sidebar-item', isActive('admin.plans.index') && 'active']">
            <a class="sidebar-link" :href="route('admin.plans.index')">
                <i class="align-middle" data-feather="dollar-sign"></i>
                <span class="menu-text align-middle">Plans</span>
            </a>
        </li>

        <li v-if="usePage().props.auth?.user?.role === 'admin'"
            :class="['sidebar-item', isActive('admin.subscriptions.index') && 'active']">
            <a class="sidebar-link" :href="route('admin.subscriptions.index')">
                <i class="align-middle" data-feather="refresh-ccw"></i>
                <span class="menu-text align-middle">Subscriptions</span>
            </a>
        </li>

        <li v-if="usePage().props.auth?.user?.role === 'admin'"
            :class="['sidebar-item', isActive('admin.invoices.index') && 'active']">
            <a class="sidebar-link" :href="route('admin.invoices.index')">
                <i class="align-middle" data-feather="file"></i>
                <span class="menu-text align-middle">Invoices</span>
            </a>
        </li>

        <li v-if="usePage().props.auth?.user?.role === 'admin'"
            :class="['sidebar-item', isActive('admin.reports.index') && 'active']">
            <a class="sidebar-link" :href="route('admin.reports.index')">
                <i class="align-middle" data-feather="bar-chart-2"></i>
                <span class="menu-text align-middle">Reports</span>
            </a>
        </li>
    </ul>
</template>
