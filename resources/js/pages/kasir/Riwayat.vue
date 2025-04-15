<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import Sidebar from "./components/Sidebar.vue";
import { konversiStatus } from "../../lib/utils";

const previewImage = ref(false);
// Header
const isDropdownOpen = ref(false);
const dropdownRef = ref(null);
const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};
const handleClickOutside = (event) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        isDropdownOpen.value = false;
    }
};
onMounted(() => {
    document.addEventListener("click", handleClickOutside);
});
onBeforeUnmount(() => {
    document.removeEventListener("click", handleClickOutside);
});
const ORDER = ref({});
// Modal Detail Riwayat Pesanan
const showModalDetail = ref(false);
const openModalDetail = (order) => {
    showModalDetail.value = true;
    ORDER.value = order;
};
const closeModalDetail = () => {
    showModalDetail.value = false;
};

// Modal Konfirmasi Keluar
const showModalKeluar = ref(false);
const openModalKeluar = () => {
    showModalKeluar.value = true;
};
const closeModalKeluar = () => {
    showModalKeluar.value = false;
};
</script>

<template>
    <div
        class="bg-bgGray min-h-screen md:ps-[150px] p-4 md:pe-4 pt-[18px] pb-24 md:pb-0"
    >
        <div class="bg-white p-4 rounded-2xl flex justify-between items-center">
            <div>
                <h1 class="text-lg font-semibold">SPW Gridas</h1>
            </div>
            <!-- Dropdown -->
            <div class="relative" ref="dropdownRef">
                <button
                    @click="toggleDropdown"
                    class="flex items-center gap-4 cursor-pointer"
                >
                    <div class="h-12 w-12 rounded-full overflow-hidden">
                        <img src="/assets/images/user.webp" alt="user" />
                    </div>
                    <div class="hidden md:inline-flex flex-col text-left">
                        <h2 class="text-textDark font-semibold">Kasir</h2>
                        <p class="text-textDark text-sm">kasir@gmail.com</p>
                    </div>
                    <div>
                        <p
                            class="hidden md:block text-textDark transition-transform duration-200"
                            :class="isDropdownOpen ? 'rotate-180' : ''"
                        >
                            <i class="fi fi-sr-angle-down"></i>
                        </p>
                    </div>
                </button>

                <Transition name="fade">
                    <div
                        v-if="isDropdownOpen"
                        class="absolute right-0 z-20 mt-2 w-56 bg-white rounded-2xl shadow-lg"
                    >
                        <button
                            @click="openModalKeluar"
                            class="flex items-center p-4 gap-4 w-full hover:bg-bgGray duration-300 cursor-pointer"
                        >
                            <p class="text-secondary text-lg">
                                <i class="fi fi-rr-sign-out-alt"></i>
                            </p>
                            <p class="text-secondary">Keluar</p>
                        </button>
                    </div>
                </Transition>
            </div>
        </div>

        <section class="mt-6">
            <div>
                <div class="md:flex justify-between items-center">
                    <h1 class="text-textDark text-lg font-semibold">
                        Riwayat Pesanan
                    </h1>
                    <div class="mt-4 md:mt-0">
                        <div class="w-full md:w-96 relative">
                            <input
                                type="search"
                                class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                placeholder="Cari pesanan"
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
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <button
                        v-for="order in $page.props.orders"
                        @click="openModalDetail(order)"
                        class="relative block bg-white p-4 space-y-5 rounded-2xl hover:bg-primaryThin duration-300 cursor-pointer"
                    >
                        <!-- Badge -->
                        <div
                            class="absolute top-0 right-0 bg-primaryThin py-1.5 px-4 rounded-tr-2xl rounded-bl-2xl"
                        >
                            <p class="text-sm text-primary font-medium">
                                {{ order.consumer_name }}
                            </p>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-start">
                                <h2 class="text-textDark font-semibold">
                                    {{ order.transaction_code }}
                                </h2>
                                <p class="text-textDark text-sm">
                                    {{
                                        new Date(
                                            order.created_at,
                                        ).toLocaleString("id-ID")
                                    }}
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <h2 class="text-start text-textDark line-clamp-2">
                                    {{
                                        order.items
                                            .map((item) => item.item.name)
                                            .join(", ")
                                    }}
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
                                <p class="text-textDark text-sm">
                                    {{
                                        order.items.reduce(
                                            (sum, item) => sum + item.quantity,
                                            0,
                                        )
                                    }}
                                    Item
                                </p>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </section>

        <!-- Modal Detail Riwayat Pesanan -->
        <Transition name="fade">
            <div
                v-if="showModalDetail"
                class="fixed inset-0 bg-black/50 z-20"
                @click="closeModalDetail"
            ></div>
        </Transition>

        <Transition name="scale">
            <div
                v-if="showModalDetail"
                class="fixed inset-0 z-30 flex items-center justify-center px-4"
            >
                <div
                    class="bg-bgGray w-full md:w-[60%] max-h-[90vh] md:max-h-screen overflow-y-auto rounded-4xl shadow-lg p-6"
                    @click.stop
                >
                    <div class="flex justify-between">
                        <h1 class="text-textDark text-lg font-semibold">
                            Detail Pesanan
                        </h1>
                        <p
                            class="text-textDark text-2xl cursor-pointer"
                            @click="closeModalDetail"
                        >
                            <i class="fi fi-rr-cross-small"></i>
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <!-- Kolom Kiri -->
                        <div class="col-span-1">
                            <h1 class="text-textDark font-semibold">
                                Data Pemesan
                            </h1>
                            <div class="space-y-4 mt-4">
                                <div>
                                    <label class="text-textDark"
                                        >Nama Pemesan</label
                                    >
                                    <div class="relative mt-2">
                                        <div
                                            class="py-3 px-4 ps-12 bg-white rounded-full"
                                        >
                                            <p class="text-textDark">
                                                {{
                                                    ORDER.consumer_name || "N/A"
                                                }}
                                            </p>
                                        </div>
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                        >
                                            <p class="text-textDark text-xl">
                                                <i class="fi fi-rr-user"></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-textDark"
                                        >Nomor WhatsApp</label
                                    >
                                    <div class="relative mt-2">
                                        <div
                                            class="py-3 px-4 ps-12 bg-white rounded-full"
                                        >
                                            <p class="text-textDark">
                                                {{
                                                    ORDER.whatsapp_number ||
                                                    "N/A"
                                                }}
                                            </p>
                                        </div>
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                        >
                                            <p class="text-textDark text-xl">
                                                <i
                                                    class="fi fi-brands-whatsapp"
                                                ></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div
                                    class="bg-white mt-4 p-4 rounded-2xl space-y-2"
                                >
                                    <div class="flex justify-between">
                                        <p class="text-textDark">
                                            Kode Transaksi
                                        </p>
                                        <p class="text-textDark font-semibold">
                                            {{ ORDER.transaction_code }}
                                        </p>
                                    </div>
                                    <div class="flex justify-between">
                                        <p class="text-textDark">
                                            Waktu Pemesanan
                                        </p>
                                        <p class="text-textDark">
                                            {{
                                                new Date(
                                                    ORDER.created_at,
                                                ).toLocaleString("id-ID")
                                            }}
                                        </p>
                                    </div>
                                    <div class="flex justify-between">
                                        <p class="text-textDark">Status</p>
                                        <p class="text-green">
                                            {{ konversiStatus(ORDER.status) }}
                                        </p>
                                    </div>
                                    <div class="flex justify-between">
                                        <p class="text-textDark">
                                            Metode Pembayaran
                                        </p>
                                        <p class="text-textDark uppercase">
                                            {{ ORDER.payment_method }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between mt-6">
                                <p class="text-textDark">
                                    Total:
                                    <span class="font-bold"
                                        >Rp{{
                                            Number(
                                                ORDER.total_amount,
                                            ).toLocaleString("id-ID")
                                        }}</span
                                    >
                                </p>
                            </div>

                            <button
                                v-if="ORDER.payment?.proof"
                                @click="previewImage = true"
                                class="bg-primary py-3 mt-4 w-full rounded-full cursor-pointer hover:brightness-90 duration-300"
                            >
                                <p class="font-semibold">
                                    Lihat Bukti Pembayaran
                                </p>
                            </button>
                        </div>

                        <!-- Bukti pembayaran modal -->
                        <Transition name="scale">
                            <div
                                class="absolute top-0 left-0 w-full h-full bg-black/25 z-10 flex items-center justify-center"
                                v-if="previewImage && ORDER.payment?.proof"
                                @click="previewImage = false"
                            >
                                <img
                                    :src="`/storage/${ORDER.payment.proof}`"
                                    class="w-[80vh]"
                                    alt="Bukti pembayaran"
                                    @click.stop
                                />
                            </div>
                        </Transition>
                        <!-- Kolom Kanan -->
                        <div class="col-span-1 flex flex-col h-full">
                            <h1 class="text-textDark font-semibold">
                                Detail Pesanan
                            </h1>
                            <div
                                class="flex flex-col gap-4 mt-4 bg-white p-4 rounded-2xl max-h-[274px] overflow-y-auto"
                            >
                                <div
                                    v-for="i in ORDER.items"
                                    class="flex justify-between items-center"
                                >
                                    <div>
                                        <h1 class="line-clamp-1">
                                            {{ i.item.name }}
                                        </h1>
                                        <h2 class="font-bold">
                                            Rp{{
                                                Number(
                                                    i.item.price,
                                                ).toLocaleString("id-ID")
                                            }}
                                        </h2>
                                    </div>
                                    <p class="text-xs text-textDark mt-1">
                                        x{{ i.quantity }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="text-textDark">Catatan</label>
                                <div class="relative mt-2">
                                    <div
                                        class="py-3 px-4 ps-12 bg-white rounded-full"
                                    >
                                        <p class="text-textDark">
                                            {{ ORDER.notes || "N/A" }}
                                        </p>
                                    </div>
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                    >
                                        <p class="text-textDark text-xl">
                                            <i class="fi fi-rr-edit"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <button
                                class="bg-primaryThin py-3 mt-4 md:mt-auto w-full rounded-full cursor-pointer hover:brightness-90 duration-300"
                            >
                                <p class="font-semibold">
                                    Cetak Struk Pembelian
                                </p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Backdrop Modal Konfirmasi Keluar -->
        <Transition name="fade">
            <div
                v-if="showModalKeluar"
                class="fixed inset-0 bg-black/50 flex items-center justify-center z-20"
                @click="closeModalKeluar"
            ></div>
        </Transition>

        <!-- Modal Konfirmasi Keluar -->
        <Transition name="scale">
            <div
                v-if="showModalKeluar"
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 scale-100 bg-white w-[80%] max-w-[480px] py-8 px-6 rounded-4xl shadow-lg text-center z-30"
            >
                <div class="">
                    <p class="text-center text-textDark text-xl font-semibold">
                        Apakah Anda yakin ingin keluar?
                    </p>
                </div>
                <div class="flex justify-between mt-4 gap-2">
                    <button
                        @click="closeModalKeluar"
                        class="w-full text-secondary py-3 rounded-full font-medium cursor-pointer"
                    >
                        Batal
                    </button>
                    <button
                        class="w-full bg-primary text-textDark py-3 rounded-full font-medium cursor-pointer hover:brightness-90 duration-300"
                        @click="$inertia.post('/logout')"
                    >
                        Keluar
                    </button>
                </div>
            </div>
        </Transition>
    </div>

    <!-- Sidebar -->
    <Sidebar />
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
