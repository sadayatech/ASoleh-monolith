<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { Notification, Notivue, NotivueSwipe, push } from "notivue";
import { onMounted } from "vue";
const page = usePage();
onMounted(() => {
    if (page.props.flash.success) {
        push.success(page.props.flash.success);
    }
});
const title = usePage().props.title ? usePage().props.title : "Dashboard";
</script>

<template>
    <div class="font-display antialiased">

        <Head :title />
        <Notivue v-slot="item">
            <NotivueSwipe :item="item">
                <Notification class="" :item="item" />
            </NotivueSwipe>
        </Notivue>
        <slot />
    </div>
</template>
