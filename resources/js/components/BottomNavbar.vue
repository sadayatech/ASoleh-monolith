<script setup>
import { usePage } from "@inertiajs/vue3";
const route = { path: usePage().url };
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <nav
        class="fixed z-10 bottom-0 left-1/2 -translate-y-4 -translate-x-1/2 w-[calc(100%-32px)] max-w-[448px] bg-white shadow-sm rounded-full flex justify-around py-2"
    >
        <Link
            href="/"
            :class="
                route.path === '/'
                    ? 'text-secondary'
                    : 'text-textGrayDark scale-90'
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
                    ? 'text-secondary'
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
                    ? 'text-secondary'
                    : 'text-textGrayDark scale-[85%]'
            "
            class="text-center"
        >
            <p class="text-2xl"><i class="fi fi-sr-user"></i></p>
            <p class="text-sm -translate-y-1">Akun</p>
        </Link>
    </nav>
</template>

<style scoped></style>
