<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const isOpen = ref(false);
const selectedProduct = ref({});
const qty = ref(1);

const form = useForm({
    item_id: null,
    amount: 1,
});

const openOffcanvas = (product) => {
    selectedProduct.value = product;
    qty.value = 1;
    form.item_id = product.id;
    form.amount = 1;
    isOpen.value = true;
};

const closeOffcanvas = () => {
    isOpen.value = false;
    setTimeout(() => {
        selectedProduct.value = {};
    }, 500);
};

const increaseQty = () => {
    if (qty.value < selectedProduct.value.stock) {
        qty.value++;
    }
};

const decreaseQty = () => {
    if (qty.value > 1) {
        qty.value--;
    }
};

watch(qty, (newQty) => {
    form.amount = newQty;
});

const submit = () => {
    form.post("/cart/add", {
        onSuccess: () => {
            closeOffcanvas();
            form.reset();
        },
    });
};

defineExpose({ openOffcanvas });
</script>

<template>
    <!-- Background Gelap -->
    <div
        class="fixed inset-0 z-20 bg-black mx-auto max-w-[480px] transition-opacity duration-300"
        :class="isOpen ? 'opacity-50' : 'opacity-0 pointer-events-none'"
        @click="closeOffcanvas"
    ></div>

    <!-- Offcanvas -->
    <section
        class="fixed bottom-0 z-30 bg-white p-4 w-full max-w-[480px] max-h-[315px] rounded-t-4xl duration-300"
        :class="isOpen ? 'translate-y-0' : 'translate-y-full'"
    >
        <div class="flex gap-4">
            <div
                class="w-[calc(50%-56px)] rounded-2xl overflow-hidden relative"
            >
                <img
                    :src="selectedProduct.image"
                    class="absolute top-0 left-0 w-full h-full object-cover"
                    alt=""
                />
            </div>
            <div class="w-[56%] max-w-[480px]">
                <h1 class="line-clamp-1">{{ selectedProduct.name }}</h1>
                <h2 class="font-bold">Rp{{ selectedProduct.price }}</h2>
                <p class="text-xs text-secondary mt-1">
                    Sisa {{ selectedProduct.stock }}
                </p>
                <div
                    class="flex justify-between items-center w-32 mt-3 bg-bgGray px-4 rounded-full"
                >
                    <button
                        @click="decreaseQty"
                        class="bg-transparent py-2 cursor-pointer"
                    >
                        <p class="text-textDark">
                            <i class="fi fi-rr-minus"></i>
                        </p>
                    </button>
                    <span class="font-semibold mx-auto">{{ qty }}</span>
                    <button
                        @click="increaseQty"
                        class="bg-transparent py-2 cursor-pointer"
                    >
                        <p class="text-textDark">
                            <i class="fi fi-rr-plus"></i>
                        </p>
                    </button>
                </div>
            </div>
        </div>
        <button
            @click.prevent="submit"
            class="bg-primary w-full py-3 mt-4 rounded-full cursor-pointer hover:brightness-90 duration-300"
        >
            <p class="font-bold">Tambahkan ke Keranjang</p>
        </button>
    </section>
</template>
