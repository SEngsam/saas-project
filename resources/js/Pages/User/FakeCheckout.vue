<script setup>
import Layout from '@/Layouts/Layout.vue'
import { reactive, watch } from 'vue';
import { router } from '@inertiajs/vue3';
const props = defineProps({
    plan: Object,
})

const form = reactive({
    plan_id: null,
    payment_method: 'fake'
});

watch(
    () => props.plan,
    (newPlan) => {
        if (newPlan) {
            form.plan_id = newPlan.id;
        }
    },
    { immediate: true } // ينفذ أول مرة مباشرة
);


function submit() {
    router.post(route('user.subscription.checkout'), form);
}

</script>

<template>
    <Layout>

        <Head title="Fake Checkout" />
        <div class="container mt-4">
            <h2>Payment (Fake)</h2>
            <p>You are subscribing to <strong>{{ plan.name }}</strong> for ${{ plan.price }}.</p>

            <form @submit.prevent="submit">
                <button type="submit" class="btn btn-success mt-3" :disabled="form.processing">Confirm Payment</button>
            </form>
        </div>
    </Layout>
</template>
