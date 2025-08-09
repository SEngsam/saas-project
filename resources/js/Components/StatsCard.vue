<template>
  <div class="card me-3">
    <div class="card-body">
      <div class="row">
        <div class="col mt-0">
          <h5 class="card-title" >{{ title }}</h5>
        </div>
        <div class="col-auto">
          <div class="stat text-primary">
            <i class="align-middle" :data-feather="icon"></i>
          </div>
        </div>
      </div>
      <h1 class="mt-1 mb-3">{{ value }}</h1>
      <div class="mb-0">
        <span :class="`text-${changeType}`">
          <i :class="`mdi mdi-${changeIcon}`"></i> {{ change }}
        </span>
        <span class="text-muted">{{ subtitle }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  icon: String,
  value: [String, Number],
  change: String,
  changeType: String,
  changeIcon: String,
  subtitle: String,
})
</script>
