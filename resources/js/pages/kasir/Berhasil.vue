<script setup>
import Sidebar from './components/Sidebar.vue'
</script>

<template>
    <div class="flex justify-center items-center bg-bgGray min-h-screen">
        <section class="p-4">
            <div class="flex flex-col justify-center items-center">
                <div class="w-[40%] overflow-hidden relative">
                    <img src="/src/assets/images/check.png" alt="berhasil">
                </div>
                <div class="text-center mt-8 px-8">
                    <h1 class="text-primary text-xl font-bold">Pesanan Berhasil Dibuat</h1>
                    <p class="text-textDark text-sm">Silahkan cetak struk pembelian dan berikan pesanan kepada pelanggan</p>
                </div>
                <div class="w-full mt-4">
                    <button type="button" class="bg-primary w-full py-3 mt-4 rounded-full cursor-pointer hover:brightness-90 duration-300">
                        <p class="font-bold">Cetak Struk Pembelian</p>
                    </button>
                </div>
            </div>
        </section>
    </div>

    <!-- Sidebar -->
    <Sidebar />
</template>

<style scoped>
</style>