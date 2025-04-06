<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import BottomOffcanvas from "@/components/BottomOffcanvas.vue";
import BottomNavbar from "@/components/BottomNavbar.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
const offcanvasRef = ref(null);
const showOffcanvas = (product) => {
    offcanvasRef.value.openOffcanvas(product);
};

const route = { path: usePage().url };
const page = usePage();
const items = page.props.items;
// Data produk dalam array
const products = ref(
    //     [
    //     {
    //         id: 1,
    //         name: "Risol Ayam Pedas",
    //         price: 2000,
    //         stock: 12,
    //         image: "assets/images/Risol.jpeg",
    //     },
    //     {
    //         id: 2,
    //         name: "Risol Ayam",
    //         price: 2000,
    //         stock: 12,
    //         image: "assets/images/Risol.jpeg",
    //     },
    //     {
    //         id: 3,
    //         name: "Risol Ayam",
    //         price: 2000,
    //         stock: 12,
    //         image: "assets/images/Risol.jpeg",
    //     },
    //     {
    //         id: 4,
    //         name: "Risol Ayam",
    //         price: 2000,
    //         stock: 12,
    //         image: "assets/images/Risol.jpeg",
    //     },
    // ]
    items.map((item) => ({
        id: item.id,
        name: item.name,
        price: item.price,
        stock: item.stock,
        image: item.image,
    })),
);

// Blokir tombol kembali di halaman Home
const blockBackButton = () => {
    if (route.path === "/") {
        window.history.pushState(null, "", window.location.href);
    }
};

onMounted(() => {
    if (route.path === "/") {
        window.history.pushState(null, "", window.location.href);
        window.addEventListener("popstate", blockBackButton);
    }
});

onUnmounted(() => {
    window.removeEventListener("popstate", blockBackButton);
});
</script>

<template>
    <main class="bg-bgGray min-h-screen">
        <Head title="Beranda" />
        <section class="bg-primary py-6 px-4 space-y-5">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-textDark">
                    Selamat Datang
                </h1>
                <Link href="/keranjang" class="text-textDark text-2xl">
                    <i class="fi fi-rr-shopping-cart"></i>
                </Link>
            </div>
            <div>
                <div class="relative">
                    <input
                        type="search"
                        class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                        placeholder="Cari menu hari ini"
                    />
                    <div
                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                    >
                        <p class="text-textDark text-xl">
                            <i class="fi fi-rr-search"></i>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <img src="/assets/images/SPANDUK SPW SECONDARY.jpg" alt="" />
        </section>

        <section
            class="bg-bgGray py-5 px-4 rounded-t-4xl -translate-y-7 space-y-4"
        >
            <h1 class="text-textDark text-lg font-bold">Semua Menu</h1>

            <!-- Grid Produk -->
            <div class="grid grid-cols-2 gap-4 pb-20">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="flex flex-col bg-white p-3 rounded-2xl w-full max-w-[480px] h-[315px]"
                >
                    <div
                        class="h-[50%] w-full rounded-2xl overflow-hidden relative"
                    >
                        <img
                            :src="product.image"
                            class="absolute top-0 left-0 w-full h-full object-cover"
                            alt=""
                        />
                    </div>
                    <div class="flex flex-col justify-between flex-1">
                        <div class="my-2">
                            <h1 class="line-clamp-2">{{ product.name }}</h1>
                            <h2 class="font-bold">
                                Rp{{ product.price.toLocaleString() }}
                            </h2>
                            <p class="text-xs text-secondary mt-1">
                                Sisa {{ product.stock }}
                            </p>
                        </div>
                        <button
                            @click="showOffcanvas(product)"
                            class="bg-primary w-full py-2 rounded-full cursor-pointer hover:brightness-90 duration-300"
                        >
                            Beli
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bottom Navbar -->
        <BottomNavbar />

        <!-- Offcanvas hanya ada satu -->
        <BottomOffcanvas ref="offcanvasRef" />
    </main>
</template>

<style scoped></style>
