<script setup>
import { ref } from "vue";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
const showModal = ref(false);
console.log(usePage().props);
const total = usePage().props.total;
const carts = ref(JSON.parse(JSON.stringify(usePage().props.carts))); // clone to avoid mutating props
const itemToDelete = ref(null); // Simpan item yang akan dihapus

const openModal = (index) => {
    itemToDelete.value = index;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    itemToDelete.value = null;
};

const goBack = () => {
    router.visit("/");
};

const increaseQty = (index) => {
    if (carts.value[index].amount < carts.value[index].item.stock) {
        carts.value[index].amount++;
    }
};

const decreaseQty = (index) => {
    if (carts.value[index].amount > 1) {
        carts.value[index].amount--;
    }
};

const confirmDelete = () => {
    if (itemToDelete.value !== null) {
        carts.value.splice(itemToDelete.value, 1);
    }
    closeModal();
};
</script>

<template>
    <div class="bg-bgGray min-h-screen pb-20">
        <Head title="Keranjang" />

        <!-- Header -->
        <section class="bg-primary w-full p-4">
            <div class="flex items-center">
                <p
                    class="text-textDark text-2xl translate-y-0.5 cursor-pointer"
                    @click="goBack"
                >
                    <i class="fi fi-rr-arrow-left"></i>
                </p>
                <h1
                    class="text-textDark text-lg font-semibold absolute left-1/2 -translate-x-1/2"
                >
                    Keranjang
                </h1>
            </div>
        </section>

        <!-- List Item -->
        <section class="mt-2 p-4">
            <div class="flex flex-col gap-4">
                <div
                    v-for="(cart, index) in carts"
                    :key="index"
                    class="flex gap-4"
                >
                    <div
                        class="w-[calc(50%-56px)] rounded-2xl overflow-hidden relative"
                    >
                        <img
                            :src="cart.item.media_path"
                            class="absolute top-0 left-0 w-full h-full object-cover"
                            alt=""
                        />
                    </div>
                    <div class="w-[56%] max-w-[480px]">
                        <h1 class="line-clamp-1">{{ cart.item.name }}</h1>
                        <h2 class="font-bold">Rp{{ cart.item.price }}</h2>
                        <p class="text-xs text-secondary mt-1">
                            Sisa {{ cart.item.stock }}
                        </p>
                        <div
                            class="flex justify-between items-center w-32 mt-3 bg-white px-4 rounded-full"
                        >
                            <button
                                @click="decreaseQty(index)"
                                class="bg-transparent py-2 cursor-pointer"
                            >
                                <p class="text-textDark">
                                    <i class="fi fi-rr-minus"></i>
                                </p>
                            </button>
                            <span class="font-semibold mx-auto">{{
                                cart.amount
                            }}</span>
                            <button
                                @click="increaseQty(index)"
                                class="bg-transparent py-2 cursor-pointer"
                            >
                                <p class="text-textDark">
                                    <i class="fi fi-rr-plus"></i>
                                </p>
                            </button>
                        </div>
                    </div>
                    <button
                        type="button"
                        class="flex items-center"
                        @click="openModal(index)"
                    >
                        <p class="text-secondary text-xl cursor-pointer">
                            <i class="fi fi-rr-trash"></i>
                        </p>
                    </button>
                </div>
            </div>
        </section>

        <!-- Checkout Footer -->
        <div
            class="fixed z-10 bottom-0 left-1/2 -translate-y-4 -translate-x-1/2 w-[calc(100%-32px)] max-w-[448px] bg-white shadow-sm rounded-full flex justify-around py-2"
        >
            <div class="flex justify-between items-center w-full px-4">
                <p class="text-textDark font-bold">Rp{{ total }}</p>
                <Link href="/checkout">
                    <button
                        class="bg-primary px-6 py-3 rounded-full cursor-pointer translate-x-1.5 hover:brightness-90 duration-300"
                    >
                        <p class="font-semibold">Checkout</p>
                    </button>
                </Link>
            </div>
        </div>

        <!-- Modal Overlay -->
        <Transition name="fade">
            <div
                v-if="showModal"
                class="fixed inset-0 bg-black/50 flex items-center justify-center z-20"
                @click="closeModal"
            ></div>
        </Transition>

        <!-- Modal Box -->
        <Transition name="scale">
            <div
                v-if="showModal"
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 scale-100 bg-white w-[80%] max-w-[480px] py-8 px-6 rounded-4xl shadow-lg text-center z-30"
            >
                <div>
                    <p class="text-center text-textDark text-xl font-semibold">
                        Apakah Anda yakin ingin menghapus item ini?
                    </p>
                </div>
                <div class="flex justify-between mt-4 gap-2">
                    <button
                        @click="closeModal"
                        class="w-full text-secondary py-3 rounded-full font-medium cursor-pointer"
                    >
                        Batal
                    </button>
                    <button
                        @click="confirmDelete"
                        class="w-full bg-primary text-textDark py-3 rounded-full font-medium cursor-pointer hover:brightness-90 duration-300"
                    >
                        Hapus
                    </button>
                </div>
            </div>
        </Transition>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.1s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.scale-enter-active,
.scale-leave-active {
    transition:
        transform 0.2s ease-out,
        opacity 0.2s ease-out;
}
.scale-enter-from {
    transform: scale(0.8);
    opacity: 0;
}
.scale-leave-to {
    transform: scale(0.8);
    opacity: 0;
}
</style>
