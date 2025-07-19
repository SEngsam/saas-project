<script setup>
import { computed } from 'vue'
import Layout from '@/Layouts/Layout.vue';

const user = $page.props.auth.user;
const  subscription = $page.props.activeSubscription;
</script>

<template>
    <Layout>
        <div class="max-w-3xl mx-auto p-6">
            <h1 class="text-3xl font-bold mb-6">Welcome, {{ user.name }}!</h1>

            <div v-if="activeSubscription" class="bg-green-100 p-4 rounded shadow">
                <h2 class="text-xl font-semibold mb-2">Your Active Subscription</h2>
                <p><strong>Plan:</strong> {{ activeSubscription.plan.name }}</p>
                <p><strong>Status:</strong> {{ activeSubscription.status }}</p>
                <p><strong>Starts At:</strong> {{ new Date(activeSubscription.starts_at).toLocaleDateString() }}</p>
                <p><strong>Ends At:</strong>
                    {{ activeSubscription.ends_at ? new Date(activeSubscription.ends_at).toLocaleDateString() : 'No end
                    date' }}
                </p>
            </div>

            <div v-else class="bg-yellow-100 p-4 rounded shadow">
                <p>You currently have no active subscription.</p>
                <a href="/checkout" class="text-blue-600 underline">Subscribe to a plan</a>
            </div>
        </div>
    </Layout>
</template>
