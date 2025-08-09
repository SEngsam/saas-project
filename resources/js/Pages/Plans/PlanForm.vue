<script setup>
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({ plan: Object })

const form = useForm({
    name: props.plan?.name ?? '',
    price: props.plan?.price ?? '',
    duration_days: props.plan?.duration_days ?? '',
    description: props.plan?.description ?? '',
    start_date: props.plan?.start_date ?? '',
    end_date: props.plan?.end_date ?? '',
    status: props.plan?.status ?? 'active',
    assignee: props.plan?.assignee ?? '',
})

const isEdit = computed(() => !!props.plan)

function handleSubmit() {
    if (isEdit.value && props.plan?.id) {
        form.put(`/plans/${props.plan.id}`)
    } else {
        form.post('/plans')
    }
}
</script>

<template>
    <form @submit.prevent="handleSubmit">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ isEdit ? 'Edit Plan' : 'Add Plan' }}</h5>
            </div>

            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Plan Name</label>
                        <input v-model="form.name" type="text" class="form-control" placeholder="Plan Name" required />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Price</label>
                        <input v-model.number="form.price" type="number" class="form-control" placeholder="Price" required />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Duration Days</label>
                        <input v-model.number="form.duration_days" type="number" class="form-control" placeholder="Duration Days" required />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select v-model="form.status" class="form-select">
                            <option value="active">Active</option>
                            <option value="expired">Inactive</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Start Date</label>
                        <input v-model="form.start_date" type="date" class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">End Date</label>
                        <input v-model="form.end_date" type="date" class="form-control" />
                    </div>

                    <div class="col-12">
                        <label class="form-label">Assignee</label>
                        <input v-model="form.assignee" type="text" class="form-control" placeholder="Example: Sana Mousa" />
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea v-model="form.description" class="form-control" rows="4" placeholder="Add description for plan"></textarea>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">{{ isEdit ? 'Update' : 'Save' }}</button>
            </div>
        </div>
    </form>
</template>
