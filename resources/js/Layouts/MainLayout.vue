<script setup>

import Menu from '@/Components/Menu.vue'
import Footer from '@/Components/Footer.vue'
import Navbar from '@/Components/Navbar.vue'

import { onMounted, ref } from 'vue'
import { usePage } from '@inertiajs/vue3'

const appLogo = usePage().props.appLogo

const isSidebarCollapsed = ref(false)

const toggleSidebar = () => {
    isSidebarCollapsed.value = !isSidebarCollapsed.value
}
onMounted(() => {
    feather.replace()
})
</script>

<template>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar" :class="['sidebar js-sidebar', { collapsed: isSidebarCollapsed }]">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">
                                <img :src="appLogo" alt="Site Logo" style="height: 40px;" />
                    </span>
                </a>

                <Menu />


            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle" @click="toggleSidebar">
                    <i class="hamburger align-self-center"></i>
                </a>
                <Navbar />
            </nav>
            <main class="content">
                <slot />
            </main>

            <Footer />
        </div>
    </div>
</template>
<style scoped>
.sidebar {
    width: 250px;
    transition: all 0.3s ease;
    overflow: hidden;
}

.sidebar.collapsed {
    transform: translateX(-100%);
}
</style>
