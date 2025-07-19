<script setup>
import Layout from '@/Layouts/Layout.vue'
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const page = usePage()
const props = defineProps({
    plans: Array,
})

const currentPlanId = computed(() => page.props.current_plan_id)

const form = useForm({
    plan_id: currentPlanId.value || null,
})

function confirmChange() {
    // نحول المستخدم لصفحة التأكيد
    window.location.href = route('user.subscription.confirm', { plan_id: form.plan_id })
}
</script>

<template>
    <Layout>
        <Head title="Change Plan" />
        <div class="container mt-4">
            <h1 class="mb-4">Choose a New Plan</h1>
            <form @submit.prevent="confirmChange">
                <div class="row">
                    <div v-for="plan in plans" :key="plan.id" class="col-md-4 mb-3">
                        <label class="card cursor-pointer" :class="{ 'border-primary': plan.id === form.plan_id }" style="display: block;">
                            <input type="radio" name="plan" :value="plan.id" v-model="form.plan_id" class="form-check-input" style="margin: 10px;" />
                            <div class="card-body">
                                <h5 class="card-title">{{ plan.name }}</h5>
                                <p class="card-text">${{ plan.price }}</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success" :disabled="!form.plan_id">
                        Confirm & Continue
                    </button>
                </div>
            </form>
        </div>
    </Layout>
</template>
