<script setup>
import { router } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

defineProps(['plans'])

const subscribe = (planId) => {
    router.post(`/plans/${planId}/subscribe`)
}
</script>

<template>
    <MainLayout>
        <div class="container-fluid p-0">
            <h1 class="h3 mb-4">
                <strong>Subscribe</strong> to a plan
            </h1>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4" v-for="plan in plans" :key="plan.id">
                        <div class="card shadow-sm border-primary h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-primary">{{ plan.name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ plan.price }} $</h6>

                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item" v-for="(f, i) in JSON.parse(plan.features)" :key="i">
                                        ✅ {{ f }}
                                    </li>
                                </ul>

                                <button class="btn btn-primary mt-auto" @click="subscribe(plan.id)">
                                    Subscribe now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
