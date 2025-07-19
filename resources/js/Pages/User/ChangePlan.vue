<script setup>
import Layout from '@/Layouts/Layout.vue'
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'
import { onMounted } from 'vue';

const page = usePage()
const user = computed(() => page.props.auth.user)
const props = defineProps({
    plans: Array,

});
const currentPlanId = computed(() => page.props.current_plan_id)

const form = useForm({
    plan_id: currentPlanId,
})

function submit() {
    form.put(route('user.subscription.change-plan'), {
        preserveScroll: true,
    })
}
onMounted(() => {
    console.log('plans:', props.plans)
})
</script>

<template>

    <Head title="Change Plan" />
    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Change Your Plan</h2>
        </template>

        <div class="py-6">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow sm:rounded-lg p-6 space-y-4">
                    <p class="text-gray-700 mb-4">
                        Current Plan:
                        <strong>
                            {{Array.isArray(plans) ? (plans.find(p => p.id === currentPlanId)?.name
                                ??
                                'None') : 'Loading...'}}


                        </strong>
                    </p>

                    <form @submit.prevent="submit">
                        <div class="space-y-4">
                            <div v-for="plan in plans" :key="plan.id" class="p-4 border rounded hover:shadow">
                                <label class="flex items-center space-x-4 cursor-pointer">
                                    <input type="radio" :value="plan.id" v-model="form.plan_id"
                                        :disabled="plan.id === currentPlanId" />
                                    <div>
                                        <div class="font-semibold">{{ plan.name }}</div>
                                        <div class="text-gray-500">{{ plan.price }} USD / {{ plan.duration_days }} days
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                                :disabled="form.processing || form.plan_id === currentPlanId">
                                Change Plan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Layout>
</template>
