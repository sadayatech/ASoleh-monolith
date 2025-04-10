<script setup>
import { Head, usePage } from '@inertiajs/vue3';
const title = usePage().props.title ? usePage().props.title : 'Homepage';
</script>

<template>
    <div class="max-w-[480px] mx-auto min-h-screen shadow-lg relative font-display antialiased">
        <Head :title />
        <slot />
    </div>
</template>

<style scoped></style>
