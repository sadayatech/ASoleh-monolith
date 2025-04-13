<script setup>
import { ref, onMounted, onBeforeUnmount, computed } from "vue";
import Sidebar from "./components/Sidebar.vue";
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import { push } from "notivue";
const qty = ref(1);

const page = usePage();
const carts = ref([]);
const menus = ref([...page.props.items]);
const total = computed(() => {
    return carts.value.reduce((acc, cart) => {
        return acc + cart.item.price * cart.amount;
    }, 0);
});
const addTocart = (item) => {
    carts.value.push({
        amount: 1,
        item: item,
    });
    menus.value.splice(menus.value.indexOf(item), 1);
};
const updateCart = (cart, newAmount) => {
    const index = carts.value.indexOf(cart);
    if (index === -1) return;
    if (newAmount <= 0) {
        deleteCart(cart);
        return;
    }
    if (newAmount > cart.item.stock) {
        push.error("Jumlah yang diminta melebihi stok yang tersedia.");
        return;
    }
    carts.value[index].amount = newAmount;
};
const deleteCart = (cart) => {
    const index = carts.value.indexOf(cart);
    if (index !== -1) {
        carts.value.splice(index, 1);
    }
    menus.value = page.props.items.filter((item) => {
        return !carts.value.some((cart) => cart.item.id === item.id);
    });
};

// const updateCart = (cart, newAmount) => router.patch(`/cart/${cart.id}`, { amount: newAmount });
// const deleteCart = (cart) => router.delete(`/cart/${cart.id}`);
// const addTocart = (item) => {
//     router.post("/kasir/cart/add", { item_id: item.id, amount: 1 }, {
//         onSuccess: () => router.reload()
//     });
// };
const checkoutForm = useForm({
    consumer_name: page.props.auth.user?.name,
    email: page.props.auth.user?.email,
    whatsapp_number: page.props.auth.user?.whatsapp_number,
    notes: "",
    payment_method: "cash",
    carts: carts.value,
    source: "cashier",
});

const submit = () => {
    checkoutForm.carts = carts.value.map((cart) => {
        return {
            item_id: cart.item.id,
            amount: cart.amount,
        };
    });
    checkoutForm.post("/checkout", {
        onError: (errors) => {
            console.error(errors);
            push.error(
                "Gagal Membuat Pesanan, Silahkan Periksa Kembali Data Anda",
            );
        },
    });
};
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

// Modal Checkout
const showModalCheckout = ref(false);
const openModalCheckout = () => {
    showModalCheckout.value = true;
};
const closeModalCheckout = () => {
    showModalCheckout.value = false;
};

// Metode Pembayaran
const selectedMethod = ref(null);
const selectPayment = (method) => {
    selectedMethod.value = method;
    checkoutForm.payment_method = method;
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
                        <img src="/assets/images/user.png" alt="user" />
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

        <section class="mt-4 md:me-[30vw]">
            <div class="md:flex justify-between">
                <div class="">
                    <div class="w-full md:w-96 relative">
                        <input
                            type="search"
                            class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                            placeholder="Cari menu"
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
                <div class="mt-4 md:mt-0">
                    <button
                        class="bg-primary py-3 md:px-8 w-full md:w-auto rounded-full flex justify-center items-center gap-2 cursor-pointer hover:brightness-90 duration-300"
                    >
                        <p class="text-textDark font-medium">QR Code</p>
                    </button>
                </div>
            </div>
        </section>

        <section class="mt-6 md:me-[30vw]">
            <div>
                <h1 class="text-textDark text-lg font-semibold">
                    Daftar Menu Hari Ini
                </h1>
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-4">
                    <button
                        v-for="item in menus"
                        :key="item.id"
                        @click="addTocart(item)"
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
                                Rp{{
                                    Number(item.price).toLocaleString("id-ID")
                                }}
                            </h2>
                            <p class="text-xs text-textDark mt-1">
                                Stok: {{ item.stock }}
                            </p>
                        </div>
                        <div class="flex items-center ml-auto my-auto">
                            <p class="text-textDark">
                                <i class="fi fi-rr-plus"></i>
                            </p>
                        </div>
                    </button>
                </div>
            </div>
        </section>

        <!-- Keranjang -->
        <section
            class="hidden md:flex fixed z-10 right-0 top-28 -translate-x-4 h-[calc(100vh-128px)] w-[28vw] bg-white rounded-3xl p-4 flex-col"
        >
            <div class="w-full h-full flex flex-col relative">
                <h1 class="text-textDark text-lg font-semibold">Keranjang</h1>

                <!-- Konten scrollable -->
                <div
                    class="flex flex-col gap-4 mt-6 overflow-y-auto pr-1 max-h-[calc(100vh-330px)]"
                >
                    <!-- Item Keranjang -->
                    <div v-for="cart in carts" class="flex gap-4">
                        <div
                            class="w-[calc(50%-56px)] rounded-2xl overflow-hidden relative"
                        >
                            <img
                                :src="cart.item.image"
                                class="absolute top-0 left-0 w-full h-full object-cover"
                                alt=""
                            />
                        </div>
                        <div class="w-[56%]">
                            <h1 class="line-clamp-1">{{ cart.item.name }}</h1>
                            <h2 class="font-bold">
                                Rp{{
                                    Number(cart.item.price).toLocaleString(
                                        "id-ID",
                                    )
                                }}
                            </h2>
                            <div
                                class="flex justify-between items-center w-32 mt-3 bg-bgGray px-4 rounded-full"
                            >
                                <button
                                    @click="updateCart(cart, cart.amount - 1)"
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
                                    @click="updateCart(cart, cart.amount + 1)"
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
                            @click="deleteCart(cart)"
                        >
                            <p class="text-secondary text-xl cursor-pointer">
                                <i class="fi fi-rr-trash"></i>
                            </p>
                        </button>
                    </div>
                </div>

                <!-- Bagian checkout -->
                <div class="absolute bottom-0 left-0 w-full">
                    <div class="border-t border-textGray mt-1 mb-4"></div>
                    <div class="flex justify-between">
                        <p class="text-textDark">Total</p>
                        <p class="text-textDark font-bold">
                            Rp{{ Number(total).toLocaleString("id-ID") }}
                        </p>
                    </div>
                    <button
                        @click="openModalCheckout"
                        class="bg-primary py-3 mt-4 w-full rounded-full cursor-pointer hover:brightness-90 duration-300"
                    >
                        <p class="font-semibold">Checkout</p>
                    </button>
                </div>
            </div>
        </section>

        <!-- Modal Checkout -->
        <Transition name="fade">
            <div
                v-if="showModalCheckout"
                class="fixed inset-0 bg-black/50 flex items-center justify-center z-20"
                @click="closeModalCheckout"
            ></div>
        </Transition>

        <Transition name="scale">
            <div
                v-if="showModalCheckout"
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 scale-100 bg-bgGray w-[90%] md:w-[60%] py-8 px-6 rounded-4xl shadow-lg z-30"
            >
                <div class="flex justify-between">
                    <h1 class="text-textDark text-lg font-semibold">
                        Checkout
                    </h1>
                    <p
                        class="text-textDark text-2xl cursor-pointer"
                        @click="closeModalCheckout"
                    >
                        <i class="fi fi-rr-cross-small"></i>
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="col-span-1">
                        <h1 class="text-textDark font-semibold">
                            Data Pemesan
                        </h1>
                        <div class="space-y-4 mt-4">
                            <div class="col-span-1">
                                <label for="nama-pemesan" class="text-textDark"
                                    >Nama Pemesan</label
                                >
                                <div class="relative mt-2">
                                    <input
                                        type="name"
                                        id="nama-pemesan"
                                        class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                        placeholder="Masukkan Nama Pemesan"
                                        required
                                        v-model="checkoutForm.consumer_name"
                                    />
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                    >
                                        <p class="text-textDark text-xl">
                                            <i class="fi fi-rr-user"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label
                                    for="nomor-whatsapp"
                                    class="text-textDark"
                                    >Nomor WhatsApp</label
                                >
                                <div class="relative mt-2">
                                    <input
                                        type="number"
                                        id="nomor-whatsapp"
                                        v-model="checkoutForm.whatsapp_number"
                                        class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                        placeholder="Masukkan Nomor WhatsApp"
                                        required
                                    />
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
                        <h1 class="text-textDark font-semibold mt-6">
                            Data Pembayaran
                        </h1>
                        <div class="mt-4">
                            <p class="text-textDark">Metode Pembayaran</p>
                            <div class="flex justify-between gap-4 mt-2 w-full">
                                <div
                                    @click="selectPayment('cash')"
                                    class="w-full py-3 rounded-full border-[1.5px] text-center font-semibold cursor-pointer transition"
                                    :class="
                                        selectedMethod === 'cash'
                                            ? 'bg-white border-secondary text-secondary'
                                            : 'bg-white border-none'
                                    "
                                >
                                    CASH
                                </div>
                                <div
                                    @click="selectPayment('qris')"
                                    class="w-full py-3 rounded-full border-[1.5px] text-center font-semibold cursor-pointer transition"
                                    :class="
                                        selectedMethod === 'qris'
                                            ? 'bg-white border-secondary text-secondary'
                                            : 'bg-white border-none'
                                    "
                                >
                                    QRIS
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between mt-6">
                            <p class="text-textDark">
                                Total:
                                <span class="font-bold"
                                    >Rp
                                    {{
                                        Number(total).toLocaleString("id-ID")
                                    }}</span
                                >
                            </p>
                        </div>
                        <button
                            @click="submit"
                            class="bg-primary py-3 mt-4 w-full rounded-full cursor-pointer hover:brightness-90 duration-300"
                        >
                            <p class="font-semibold">Checkout</p>
                        </button>
                    </div>
                    <div class="col-span-1">
                        <h1 class="text-textDark font-semibold">
                            Detail Pesanan
                        </h1>
                        <div
                            class="flex flex-col gap-4 mt-4 bg-white p-4 rounded-2xl max-h-[274px] overflow-y-auto"
                        >
                            <div
                                class="flex justify-between items-center"
                                v-for="cart in carts"
                                :key="cart.id"
                            >
                                <div class="">
                                    <h1 class="line-clamp-1">
                                        {{ cart.item.name }}
                                    </h1>
                                    <h2 class="font-bold">
                                        Rp{{
                                            Number(
                                                cart.item.price,
                                            ).toLocaleString("id-ID")
                                        }}
                                    </h2>
                                </div>
                                <div>
                                    <p class="text-xs text-textDark mt-1">
                                        x{{ cart.amount }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="catatan" class="text-textDark"
                                >Catatan</label
                            >
                            <div class="relative mt-2">
                                <input
                                    type="text"
                                    id="catatan"
                                    v-model="checkoutForm.notes"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                    placeholder="Masukkan catatan (opsional)"
                                />
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                >
                                    <p class="text-textDark text-xl">
                                        <i class="fi fi-rr-edit"></i>
                                    </p>
                                </div>
                            </div>
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
