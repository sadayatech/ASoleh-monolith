<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { usePage, router, Link, Head } from "@inertiajs/vue3";
import BottomNavbar from "@/components/BottomNavbar.vue";
import { konversiStatus } from "@/lib/utils";

const page = usePage();
const route = { path: page.url };

// Ambil data dari backend
const transactions = ref(page.props.transactions ?? []);
// Fungsi tombol kembali
const handleBackButton = () => {
    if (route.path === "/transaksi") {
        router.replace("/");
    }
};

onMounted(() => {
    if (route.path === "/transaksi") {
        window.history.pushState(null, "", window.location.href);
        window.addEventListener("popstate", handleBackButton);
    }
});

onUnmounted(() => {
    window.removeEventListener("popstate", handleBackButton);
});
</script>

<template>
    <div class="bg-bgGray min-h-screen pb-20">
        <Head title="Transaksi" />

        <section class="p-4">
            <h1 class="text-textDark text-lg font-semibold">
                Riwayat Transaksi
                <span class="text-textGrayDark font-normal ms-2"
                    >({{ transactions.length }})</span
                >
            </h1>
            <div class="mt-4 space-y-2.5">
                <template v-if="transactions.length">
                    <Link
                        v-for="(order, index) in transactions"
                        :key="index"
                        :href="`/detail-transaksi/${order.transaction_code}`"
                        class="block bg-white p-4 space-y-5 rounded-2xl hover:bg-textGray duration-300"
                    >
                        <div class="flex justify-between">
                            <div>
                                <h2 class="text-textDark font-semibold">
                                    {{ order.transaction_code }}
                                </h2>
                                <p class="text-textGrayDark text-sm">
                                    {{
                                        new Date(
                                            order.created_at,
                                        ).toLocaleString("id-ID")
                                    }}
                                </p>
                            </div>
                            <div>
                                <p class="text-primary text-sm">
                                    {{konversiStatus(order.status)}}
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <h2 class="text-textDark line-clamp-2">
                                    {{ order.consumer_name }}
                                </h2>
                            </div>
                            <div class="text-end">
                                <h2 class="text-textDark font-bold">
                                    Rp{{
                                        Number(
                                            order.total_amount,
                                        ).toLocaleString("id-ID")
                                    }}
                                </h2>
                                <p class="text-textGrayDark text-sm">-</p>
                            </div>
                        </div>
                    </Link>
                </template>

                <p v-else class="text-textGrayDark text-center mt-10">
                    Tidak ada transaksi ditemukan.
                </p>
            </div>
        </section>
    </div>

    <!-- Bottom Navbar -->
    <BottomNavbar />
</template>

<style scoped></style>
