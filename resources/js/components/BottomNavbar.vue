<script setup>
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const fullUrl = usePage().url;
const route = { path: fullUrl.split('?')[0].split('#')[0] };
</script>
<template>
  <nav
    class="fixed z-10 bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[448px] bg-white shadow-2xl rounded-t-4xl flex justify-around pt-3 pb-2"
  >
    <Link
      href="/"
      :class="
        route.path === '/' ? 'text-primary' : 'text-textGrayDark scale-90'
      "
      class="text-center"
    >
      <p class="text-2xl"><i class="fi fi-sc-home"></i></p>
      <p class="text-sm -translate-y-1">Home</p>
    </Link>

    <Link
      href="/transaksi"
      :class="
        route.path === '/transaksi'
          ? 'text-primary'
          : 'text-textGrayDark scale-90'
      "
      class="text-center"
    >
      <p class="text-2xl"><i class="fi fi-sc-receipt"></i></p>
      <p class="text-sm -translate-y-1">Transaksi</p>
    </Link>

    <Link
      href="/akun"
      :class="
        route.path === '/akun'
          ? 'text-primary'
          : 'text-textGrayDark scale-[85%]'
      "
      class="text-center"
    >
      <p class="text-2xl"><i class="fi fi-sr-user"></i></p>
      <p class="text-sm -translate-y-1">Akun</p>
    </Link>
  </nav>
</template>
