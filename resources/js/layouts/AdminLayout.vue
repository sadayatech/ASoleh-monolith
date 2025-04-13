<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { Notification, Notivue, push } from 'notivue';
const page = usePage();
if (page.props.flash.success) {
    push.success(page.props.flash.success);
}
const title = usePage().props.title ? usePage().props.title : 'Dashboard';
</script>

<template>
    <div class="font-display antialiased">

        <Head :title />
        <Notivue v-slot="item">
            <Notification :item="item" />
        </Notivue>
        <slot />
    </div>
</template>
