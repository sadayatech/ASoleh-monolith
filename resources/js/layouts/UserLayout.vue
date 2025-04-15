<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { Notification, Notivue, NotivueSwipe, push } from 'notivue';
const page = usePage();

if (page.props.flash.success) {
  push.success(page.props.flash.success);
}
const title = usePage().props.title ? usePage().props.title : 'Homepage';
</script>

<template>
  <div
    class="max-w-[480px] mx-auto min-h-screen shadow-lg relative font-display antialiased"
  >
    <Head :title />
    <Notivue v-slot="item">
      <NotivueSwipe :item="item">
        <Notification :item="item" />
      </NotivueSwipe>
    </Notivue>
    <slot />
  </div>
</template>
