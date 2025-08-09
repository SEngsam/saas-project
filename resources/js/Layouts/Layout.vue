<template>
    <div class="wrapper">
        <!-- Sidebar Component -->
        <Sidebar />

        <div class="main">

            <Navbar />

            <main class="content">
                <div class="container-fluid p-0">
                    <slot />
                </div>
            </main>



            <Footer />
        </div>
    </div>
</template>

<script setup>
import Sidebar from './Partials/Sidebar.vue'
import Navbar from './Partials/Navbar.vue'
import Footer from './Partials/Footer.vue'

</script>
