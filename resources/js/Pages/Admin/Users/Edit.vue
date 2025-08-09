<template>
    <UserForm :user="user" />
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import UserForm from '@/Pages/Admin/Users/Form.vue'
const props = defineProps({ user: Object })
</script>
