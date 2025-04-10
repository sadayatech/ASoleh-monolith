<script setup>
import { Head, usePage } from '@inertiajs/vue3';
const title = usePage().props.title ? usePage().props.title : 'Dashboard';
</script>

<template>
    <div class="font-display antialiased">
        <Head :title />

        <slot />
    </div>
</template>
