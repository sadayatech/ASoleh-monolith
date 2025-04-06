<script setup>
import { Head } from "@inertiajs/vue3";

const goBack = () => {
    const ref = document.referrer;
    if (ref && ref.includes(window.location.hostname)) {
        window.history.back();
        window.history.back();
    } else {
        router.visit("/");
    }
};
</script>

<template>
    <Head title="Pusat bantuan" />

    <div class="bg-white min-h-screen">
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
                    Pusat Bantuan
                </h1>
            </div>
        </section>
        <section class="max-w-[480px] p-4">
            <div
                class="flex flex-col justify-center items-center translate-y-[15vh]"
            >
                <div class="w-[70%] overflow-hidden relative">
                    <img
                        src="/assets/images/customer-service.png"
                        alt="customer service"
                    />
                </div>
                <div class="text-center mt-8 px-8">
                    <p class="text-textDark">Perlu Bantuan?</p>
                </div>
                <button
                    type="button"
                    class="bg-primary w-full py-3 mt-4 rounded-full cursor-pointer hover:brightness-90 duration-300"
                >
                    <div class="flex justify-center items-center gap-2">
                        <p class="text-textDark text-lg translate-y-0.5">
                            <i class="fi fi-brands-whatsapp"></i>
                        </p>
                        <p class="text-textDark font-bold">Hubungi Kami</p>
                    </div>
                </button>
            </div>
        </section>
    </div>
</template>

<style scoped></style>
