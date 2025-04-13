<template>
    <button
        :key="item.id"
        @click="addToLocalCart(item)"
        type="button"
        class="col-span-1 bg-primaryThin p-4 mt-4 rounded-3xl flex gap-4 text-start cursor-pointer"
    >
        <div
            class="w-[calc(50%-56px)] h-[12vh] sm:w-[8vw] rounded-2xl overflow-hidden relative"
        >
            <img
                :src="item.image"
                class="absolute top-0 left-0 w-full h-full object-cover"
                alt=""
            />
        </div>
        <div class="my-auto">
            <h1 class="line-clamp-1">{{ item.name }}</h1>
            <h2 class="font-bold">
                Rp{{ Number(item.price).toLocaleString("id-ID") }}
            </h2>
            <p class="text-xs text-textDark mt-1">Stok: {{ item.stock }}</p>
        </div>
        <div class="flex items-center ml-auto my-auto">
            <p class="text-textDark"><i class="fi fi-rr-plus"></i></p>
        </div>
    </button>
</template>

<script setup>
const quantity = ref(1);
const item = defineProps({
    id: Number,
    name: String,
    price: Number,
    image: String,
    stock: Number,
});
</script>
