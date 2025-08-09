<script setup>
import Layout from '@/Layouts/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';


const page = usePage();
const user = computed(() => page.props.auth.user);
const subscription = computed(() => page.props.activeSubscription || null);


</script>

<template>

    <Head title="Dashboard" />

    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <p v-if="user">مرحبا {{ user.name }}</p>
                    <p v-else class="text-red-500">المستخدم غير مسجل الدخول.</p>

                    <div v-if="subscription">
                        <p class="mt-4 text-gray-700">
                            لديك اشتراك نشط: <strong>{{ subscription.plan.name }}</strong>
                        </p>
                        <p>تاريخ الانتهاء: {{ subscription.ends_at }}</p>
                        <p>
                            الحالة:
                            <span :class="subscription.status === 'active' ? 'text-green-600' : 'text-red-600'">
                                {{ subscription.status }}
                            </span>
                        </p>
                    </div>
                    <div v-else>
                        <p class="mt-4 text-red-500">ليس لديك اشتراك حالياً.</p>
                    </div>

                </div>
            </div>
        </div>
    </Layout>
</template>
