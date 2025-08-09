<template>
  <form @submit.prevent="submitForm" class="p-3">

    <fieldset class="mb-4 border rounded p-3">
      <legend class="float-none w-auto px-2">Plan Details</legend>

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
          id="name"
          v-model="form.name"
          type="text"
          class="form-control"
          placeholder="Enter plan name"
          @input="generateSlug"
        />
        <div v-if="errors.name" class="text-danger small">{{ errors.name }}</div>
      </div>

      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input
          id="slug"
          v-model="form.slug"
          type="text"
          class="form-control"
          readonly
          placeholder="Slug will be generated automatically"
        />
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input
          id="price"
          v-model="form.price"
          type="number"
          min="0"
          step="0.01"
          class="form-control"
          placeholder="Enter price"
        />
        <div v-if="errors.price" class="text-danger small">{{ errors.price }}</div>
      </div>

      <div class="mb-3">
        <label for="duration" class="form-label">Duration (days)</label>
        <input
          id="duration"
          v-model="form.duration"
          type="number"
          min="1"
          class="form-control"
          placeholder="Enter duration in days"
        />
        <div v-if="errors.duration" class="text-danger small">{{ errors.duration }}</div>
      </div>

      <div class="mb-3">
        <label for="features" class="form-label">Features</label>
        <textarea
          id="features"
          v-model="form.features"
          class="form-control"
          placeholder="Enter features separated by commas"
        ></textarea>
        <div v-if="errors.features" class="text-danger small">{{ errors.features }}</div>
      </div>

      <div class="form-check mb-3">
        <input
          class="form-check-input"
          type="checkbox"
          id="is_active"
          v-model="form.is_active"
          :true-value="1"
          :false-value="0"
        />
        <label class="form-check-label" for="is_active">Active</label>
      </div>
    </fieldset>

    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useEmit } from 'vue'

const props = defineProps({
  form: Object,
  errors: Object,
})

const emit = defineEmits(['submit'])

function slugify(text) {
  return text
    .toString()
    .toLowerCase()
    .trim()
    .replace(/\s+/g, '-')
    .replace(/[^\w\-]+/g, '')
    .replace(/\-\-+/g, '-')
}

const generateSlug = () => {
  if (props.form.name) {
    props.form.slug = slugify(props.form.name)
  } else {
    props.form.slug = ''
  }
}

const submitForm = () => emit('submit')
</script>
