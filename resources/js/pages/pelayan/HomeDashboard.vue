<script setup>
import { ref, onMounted, onBeforeUnmount, computed } from "vue";
import Sidebar from "./components/Sidebar.vue";

// Dropdown Profil
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

// Modal Detail Menu
const showModalDetail = ref(false);
const openModalDetail = () => {
    showModalDetail.value = true;
};
const closeModalDetail = () => {
    showModalDetail.value = false;
};

// Toggle Aktif/Non Aktif Menu
const isActive = ref(false);
const statusText = computed(() => (isActive.value ? "Aktif" : "Nonaktif"));
function toggle() {
    isActive.value = !isActive.value;
}

// Modal Tambah Menu
const showModalTambah = ref(false);
const openModalTambah = () => {
    showModalTambah.value = true;
};
const closeModalTambah = () => {
    showModalTambah.value = false;
};

// Modal Ubah Menu
const showModalUbah = ref(false);
const openModalUbah = () => {
    showModalUbah.value = true;
};
const closeModalUbah = () => {
    showModalUbah.value = false;
};

// Modal Konfirmasi Hapus Menu
const showModalHapus = ref(false);
const openModalHapus = () => {
    showModalHapus.value = true;
};
const closeModalHapus = () => {
    showModalHapus.value = false;
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
                        <h2 class="text-textDark font-semibold">Pelayan</h2>
                        <p class="text-textDark text-sm">pelayan@gmail.com</p>
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
                        class="absolute right-0 z-10 mt-2 w-56 bg-white rounded-2xl shadow-lg"
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

        <section class="mt-4 w-full">
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
                <div class="flex gap-2 mt-4 md:mt-0">
                    <button
                        class="bg-primaryThin py-3 md:px-8 w-full md:w-auto rounded-full flex justify-center items-center gap-2 cursor-pointer hover:bg-primary duration-300"
                    >
                        <p class="text-textDark"><i class="fi fi-rr-qr"></i></p>
                        <p class="text-textDark font-medium">QR Code</p>
                    </button>
                    <button
                        @click="openModalTambah"
                        class="bg-primary py-3 md:px-8 w-full md:w-auto rounded-full flex justify-center items-center gap-2 cursor-pointer hover:brightness-90 duration-300"
                    >
                        <p class="text-textDark text-sm translate-y-0.5">
                            <i class="fi fi-rr-plus"></i>
                        </p>
                        <p class="text-textDark font-medium">Tambah Menu</p>
                    </button>
                </div>
            </div>
        </section>

        <section class="mt-6">
            <div>
                <h1 class="text-textDark text-lg font-semibold">
                    Daftar Menu Hari Ini
                </h1>
                <div class="grid grid-cols-1 md:grid-cols-3 md:gap-x-4">
                    <button
                        @click="openModalDetail"
                        type="button"
                        class="col-span-1 bg-primaryThin p-4 mt-4 rounded-3xl flex gap-4 text-start cursor-pointer"
                    >
                        <div
                            class="w-[calc(50%-56px)] h-[12vh] sm:w-[8vw] rounded-2xl overflow-hidden relative"
                        >
                            <img
                                src="/assets/images/Risol.jpeg"
                                class="absolute top-0 left-0 w-full h-full object-cover"
                                alt=""
                            />
                        </div>
                        <div class="my-auto">
                            <h1 class="line-clamp-1">Risol Ayam Pro Max</h1>
                            <h2 class="font-bold">Rp2.000</h2>
                            <p class="text-xs text-textDark mt-1">Stok: 24</p>
                        </div>
                        <div class="flex items-center ml-auto my-auto">
                            <p class="text-textDark">
                                <i class="fi fi-rr-angle-right"></i>
                            </p>
                        </div>
                    </button>
                    <button
                        @click="openModalDetail"
                        type="button"
                        class="col-span-1 bg-primaryThin p-4 mt-4 rounded-3xl flex gap-4 text-start cursor-pointer"
                    >
                        <div
                            class="w-[calc(50%-56px)] h-[12vh] sm:w-[8vw] rounded-2xl overflow-hidden relative"
                        >
                            <img
                                src="/assets/images/Risol.jpeg"
                                class="absolute top-0 left-0 w-full h-full object-cover"
                                alt=""
                            />
                        </div>
                        <div class="my-auto">
                            <h1 class="line-clamp-1">Risol Ayam Pro Max</h1>
                            <h2 class="font-bold">Rp2.000</h2>
                            <p class="text-xs text-textDark mt-1">Stok: 24</p>
                        </div>
                        <div class="flex items-center ml-auto my-auto">
                            <p class="text-textDark">
                                <i class="fi fi-rr-angle-right"></i>
                            </p>
                        </div>
                    </button>
                    <button
                        @click="openModalDetail"
                        type="button"
                        class="col-span-1 bg-primaryThin p-4 mt-4 rounded-3xl flex gap-4 text-start cursor-pointer"
                    >
                        <div
                            class="w-[calc(50%-56px)] h-[12vh] sm:w-[8vw] rounded-2xl overflow-hidden relative"
                        >
                            <img
                                src="/assets/images/Risol.jpeg"
                                class="absolute top-0 left-0 w-full h-full object-cover"
                                alt=""
                            />
                        </div>
                        <div class="my-auto">
                            <h1 class="line-clamp-1">Risol Ayam Pro Max</h1>
                            <h2 class="font-bold">Rp2.000</h2>
                            <p class="text-xs text-textDark mt-1">Stok: 24</p>
                        </div>
                        <div class="flex items-center ml-auto my-auto">
                            <p class="text-textDark">
                                <i class="fi fi-rr-angle-right"></i>
                            </p>
                        </div>
                    </button>
                    <button
                        @click="openModalDetail"
                        type="button"
                        class="col-span-1 bg-primaryThin p-4 mt-4 rounded-3xl flex gap-4 text-start cursor-pointer"
                    >
                        <div
                            class="w-[calc(50%-56px)] h-[12vh] sm:w-[8vw] rounded-2xl overflow-hidden relative"
                        >
                            <img
                                src="/assets/images/Risol.jpeg"
                                class="absolute top-0 left-0 w-full h-full object-cover"
                                alt=""
                            />
                        </div>
                        <div class="my-auto">
                            <h1 class="line-clamp-1">Risol Ayam Pro Max</h1>
                            <h2 class="font-bold">Rp2.000</h2>
                            <p class="text-xs text-textDark mt-1">Stok: 24</p>
                        </div>
                        <div class="flex items-center ml-auto my-auto">
                            <p class="text-textDark">
                                <i class="fi fi-rr-angle-right"></i>
                            </p>
                        </div>
                    </button>
                </div>
            </div>
        </section>

        <!-- Modal Detail Menu -->
        <Transition name="fade">
            <div
                v-if="showModalDetail"
                class="fixed inset-0 bg-black/50 flex items-center justify-center z-20"
                @click="closeModalDetail"
            ></div>
        </Transition>

        <Transition name="scale">
            <div
                v-if="showModalDetail"
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 scale-100 bg-white w-[90%] md:w-[40%] py-8 px-6 rounded-4xl shadow-lg text-center z-30"
            >
                <div class="flex justify-between">
                    <h1 class="text-textDark text-lg font-semibold">
                        Detail Menu
                    </h1>
                    <p
                        class="text-textDark text-2xl cursor-pointer"
                        @click="closeModalDetail"
                    >
                        <i class="fi fi-rr-cross-small"></i>
                    </p>
                </div>
                <div class="md:flex gap-4 mt-4">
                    <div
                        class="relative w-36 h-36 md:w-[calc(50%-56px)] md:h-auto rounded-full md:rounded-3xl mx-auto overflow-hidden"
                    >
                        <img
                            src="/assets/images/Risol.jpeg"
                            class="absolute top-0 left-0 w-full h-full object-cover"
                            alt=""
                        />
                    </div>
                    <div class="w-[56%] text-start mt-4 md:mt-0">
                        <h1 class="line-clamp-1">Risol Ayam Pro Max</h1>
                        <div class="mt-2">
                            <p class="text-textGrayDark text-xs">Harga</p>
                            <h2 class="text-textDark font-bold">Rp2.000</h2>
                        </div>
                        <div class="mt-2">
                            <p class="text-textGrayDark text-xs">Stok</p>
                            <h2 class="text-textDark">24</h2>
                        </div>
                        <div class="mt-2">
                            <p class="text-textGrayDark text-xs">Status</p>
                            <div class="flex items-center gap-3 mt-1">
                                <button
                                    @click="toggle"
                                    :class="[
                                        'w-[52px] h-7 rounded-full flex items-center transition-colors duration-300 p-1 cursor-pointer',
                                        isActive ? 'bg-green' : 'bg-textGray',
                                    ]"
                                >
                                    <div
                                        class="w-5 h-5 bg-white rounded-full shadow-md transform transition-transform duration-300 text-sm"
                                        :class="
                                            isActive
                                                ? 'translate-x-6'
                                                : 'translate-x-0'
                                        "
                                    >
                                        <i
                                            :class="[
                                                'text-xs transition-opacity duration-200',
                                                isActive
                                                    ? 'fi fi-rr-check text-green'
                                                    : 'fi fi-rr-cross text-secondary',
                                            ]"
                                        ></i>
                                    </div>
                                </button>

                                <p
                                    :class="
                                        isActive
                                            ? 'text-green'
                                            : 'text-textGrayDark'
                                    "
                                >
                                    {{ statusText }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-4 gap-2">
                    <button
                        @click="openModalUbah"
                        class="w-full bg-primary text-textDark py-3 rounded-full font-medium cursor-pointer hover:brightness-90 duration-300"
                    >
                        <div class="flex justify-center items-center gap-2">
                            <p class="text-lg translate-y-0.5">
                                <i class="fi fi-rr-edit"></i>
                            </p>
                            <p>Ubah</p>
                        </div>
                    </button>
                    <button
                        @click="openModalHapus"
                        class="w-full text-secondary py-3 rounded-full font-medium cursor-pointer"
                    >
                        <div class="flex justify-center items-center gap-2">
                            <p class="text-lg translate-y-0.5">
                                <i class="fi fi-rr-trash"></i>
                            </p>
                            <p>Hapus</p>
                        </div>
                    </button>
                </div>
            </div>
        </Transition>

        <!-- Overlay Gelap -->
        <Transition name="fade">
            <div
                v-if="showModalTambah"
                class="fixed inset-0 bg-black/50 z-20"
                @click="closeModalTambah"
            ></div>
        </Transition>

        <!-- Modal Tambah Menu -->
        <Transition name="scale">
            <div
                v-if="showModalTambah"
                class="fixed inset-0 z-30 overflow-y-auto flex justify-center items-start"
            >
                <div
                    class="bg-bgGray w-[90%] md:w-[60%] p-4 md:py-8 md:px-6 rounded-4xl shadow-lg mt-10 mb-10"
                >
                    <div class="flex justify-between">
                        <h1 class="text-textDark text-lg font-semibold">
                            Tambah Menu
                        </h1>
                        <p
                            class="text-textDark text-2xl cursor-pointer"
                            @click="closeModalTambah"
                        >
                            <i class="fi fi-rr-cross-small"></i>
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <!-- Upload Foto -->
                        <div class="col-span-1">
                            <label for="uploadFotoMenu" class="text-textDark">
                                <p>Foto Menu</p>
                            </label>
                            <div class="relative mt-2">
                                <input
                                    type="file"
                                    id="uploadFotoMenu"
                                    class="hidden"
                                    @change="updateFileName"
                                    ref="fileInput"
                                />
                                <label
                                    for="uploadFotoMenu"
                                    class="flex items-center gap-2 w-full bg-white rounded-full cursor-pointer shadow-sm"
                                >
                                    <span
                                        class="bg-bgGray py-3 px-4 rounded-l-full text-textDark text-sm w-[50%]"
                                        >Choose File</span
                                    >
                                    <span
                                        class="text-textGrayDark pr-4 line-clamp-1 w-full"
                                    >
                                        {{ fileName || "No file chosen" }}
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Nama Menu -->
                        <div class="col-span-1">
                            <label for="nama-menu" class="text-textDark"
                                >Nama Menu</label
                            >
                            <div class="relative mt-2">
                                <input
                                    type="text"
                                    id="nama-menu"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                    placeholder="Masukkan Nama Menu"
                                    required
                                />
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                >
                                    <p class="text-textDark text-xl">
                                        <i class="fi fi-rr-hamburger-soda"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Harga Supplier -->
                        <div class="col-span-1">
                            <label for="harga-supplier" class="text-textDark"
                                >Harga Supplier</label
                            >
                            <div class="relative mt-2">
                                <input
                                    type="number"
                                    id="harga-supplier"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                    placeholder="Masukkan Harga Supplier"
                                    required
                                />
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                >
                                    <p class="text-textDark text-xl">
                                        <i class="fi fi-rr-user-salary"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Harga Jual -->
                        <div class="col-span-1">
                            <label for="harga-jual" class="text-textDark"
                                >Harga Jual</label
                            >
                            <div class="relative mt-2">
                                <input
                                    type="number"
                                    id="harga-jual"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                    placeholder="Masukkan Harga Jual"
                                    required
                                />
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                >
                                    <p class="text-textDark text-xl">
                                        <i class="fi fi-rr-usd-circle"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Stok -->
                        <div class="col-span-1">
                            <label for="stok" class="text-textDark">Stok</label>
                            <div class="relative mt-2">
                                <input
                                    type="number"
                                    id="stok"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                    placeholder="Masukkan Stok"
                                    required
                                />
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                >
                                    <p class="text-textDark text-xl">
                                        <i class="fi fi-rr-box-open-full"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier -->
                        <div class="col-span-1">
                            <label for="supplier" class="text-textDark"
                                >Supplier</label
                            >
                            <div class="relative mt-2">
                                <select
                                    id="supplier"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none appearance-none cursor-pointer"
                                    required
                                >
                                    <option value="" disabled selected>
                                        Pilih Supplier
                                    </option>
                                    <option value="supplier1">
                                        Supplier 1
                                    </option>
                                    <option value="supplier2">
                                        Supplier 2
                                    </option>
                                </select>
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                                >
                                    <i
                                        class="fi fi-rr-supplier text-textDark text-xl"
                                    ></i>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-span-1">
                            <label for="status" class="text-textDark"
                                >Status</label
                            >
                            <div class="relative mt-2">
                                <select
                                    id="status"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none appearance-none cursor-pointer"
                                    required
                                >
                                    <option value="" disabled selected>
                                        Pilih Status
                                    </option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                                >
                                    <i
                                        class="fi fi-rr-power text-textDark text-xl"
                                    ></i>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="md:col-span-2 flex justify-end">
                            <button
                                type="submit"
                                class="bg-primary px-12 py-3 rounded-full cursor-pointer translate-x-1.5 hover:brightness-90 duration-300"
                            >
                                <div
                                    class="flex justify-center items-center gap-2"
                                >
                                    <p
                                        class="text-textDark text-lg translate-y-0.5"
                                    >
                                        <i class="fi fi-rr-disk"></i>
                                    </p>
                                    <p class="font-semibold">Simpan</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Overlay Gelap -->
        <Transition name="fade">
            <div
                v-if="showModalTambah"
                class="fixed inset-0 bg-black/50 z-20"
                @click="closeModalTambah"
            ></div>
        </Transition>

        <!-- Modal Ubah Menu -->
        <Transition name="scale">
            <div
                v-if="showModalUbah"
                class="fixed inset-0 z-30 overflow-y-auto flex justify-center items-start"
            >
                <div
                    class="bg-bgGray w-[90%] md:w-[60%] p-4 md:py-8 md:px-6 rounded-4xl shadow-lg mt-10 mb-10"
                >
                    <div class="flex justify-between">
                        <h1 class="text-textDark text-lg font-semibold">
                            Ubah Menu
                        </h1>
                        <p
                            class="text-textDark text-2xl cursor-pointer"
                            @click="closeModalUbah"
                        >
                            <i class="fi fi-rr-cross-small"></i>
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <!-- Upload Foto -->
                        <div class="col-span-1">
                            <label for="uploadFotoMenu" class="text-textDark">
                                <p>Foto Menu</p>
                            </label>
                            <div class="relative mt-2">
                                <input
                                    type="file"
                                    id="uploadFotoMenu"
                                    class="hidden"
                                    @change="updateFileName"
                                    ref="fileInput"
                                />
                                <label
                                    for="uploadFotoMenu"
                                    class="flex items-center gap-2 w-full bg-white rounded-full cursor-pointer shadow-sm"
                                >
                                    <span
                                        class="bg-bgGray py-3 px-4 rounded-l-full text-textDark text-sm md:text-base w-[50%]"
                                        >Choose File</span
                                    >
                                    <span
                                        class="text-textGrayDark pr-4 line-clamp-1 w-full"
                                    >
                                        {{ fileName || "No file chosen" }}
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Nama Menu -->
                        <div class="col-span-1">
                            <label for="nama-menu" class="text-textDark"
                                >Nama Menu</label
                            >
                            <div class="relative mt-2">
                                <input
                                    type="text"
                                    id="nama-menu"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                    placeholder="Masukkan Nama Menu"
                                    required
                                />
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                >
                                    <p class="text-textDark text-xl">
                                        <i class="fi fi-rr-hamburger-soda"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Harga Supplier -->
                        <div class="col-span-1">
                            <label for="harga-supplier" class="text-textDark"
                                >Harga Supplier</label
                            >
                            <div class="relative mt-2">
                                <input
                                    type="number"
                                    id="harga-supplier"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                    placeholder="Masukkan Harga Supplier"
                                    required
                                />
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                >
                                    <p class="text-textDark text-xl">
                                        <i class="fi fi-rr-user-salary"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Harga Jual -->
                        <div class="col-span-1">
                            <label for="harga-jual" class="text-textDark"
                                >Harga Jual</label
                            >
                            <div class="relative mt-2">
                                <input
                                    type="number"
                                    id="harga-jual"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                    placeholder="Masukkan Harga Jual"
                                    required
                                />
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                >
                                    <p class="text-textDark text-xl">
                                        <i class="fi fi-rr-usd-circle"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Stok -->
                        <div class="col-span-1">
                            <label for="stok" class="text-textDark">Stok</label>
                            <div class="relative mt-2">
                                <input
                                    type="number"
                                    id="stok"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                                    placeholder="Masukkan Stok"
                                    required
                                />
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                                >
                                    <p class="text-textDark text-xl">
                                        <i class="fi fi-rr-box-open-full"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier -->
                        <div class="col-span-1">
                            <label for="supplier" class="text-textDark"
                                >Supplier</label
                            >
                            <div class="relative mt-2">
                                <select
                                    id="supplier"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none appearance-none cursor-pointer"
                                    required
                                >
                                    <option value="" disabled selected>
                                        Pilih Supplier
                                    </option>
                                    <option value="supplier1">
                                        Supplier 1
                                    </option>
                                    <option value="supplier2">
                                        Supplier 2
                                    </option>
                                </select>
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                                >
                                    <i
                                        class="fi fi-rr-supplier text-textDark text-xl"
                                    ></i>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-span-1">
                            <label for="status" class="text-textDark"
                                >Status</label
                            >
                            <div class="relative mt-2">
                                <select
                                    id="status"
                                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none appearance-none cursor-pointer"
                                    required
                                >
                                    <option value="" disabled selected>
                                        Pilih Status
                                    </option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                                >
                                    <i
                                        class="fi fi-rr-power text-textDark text-xl"
                                    ></i>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="md:col-span-2 flex justify-end">
                            <button
                                type="submit"
                                class="bg-primary px-12 py-3 rounded-full cursor-pointer translate-x-1.5 hover:brightness-90 duration-300"
                            >
                                <div
                                    class="flex justify-center items-center gap-2"
                                >
                                    <p
                                        class="text-textDark text-lg translate-y-0.5"
                                    >
                                        <i class="fi fi-rr-disk"></i>
                                    </p>
                                    <p class="font-semibold">Simpan</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Modal Konfirmasi Hapus Menu -->
        <Transition name="fade">
            <div
                v-if="showModalHapus"
                class="fixed inset-0 bg-black/50 flex items-center justify-center z-40"
                @click="closeModalHapus"
            ></div>
        </Transition>

        <Transition name="scale">
            <div
                v-if="showModalHapus"
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 scale-100 bg-white w-[80%] max-w-[480px] py-8 px-6 rounded-4xl shadow-lg text-center z-50"
            >
                <div class="">
                    <p class="text-center text-textDark text-xl font-semibold">
                        Apakah Anda yakin ingin menghapus menu ini?
                    </p>
                </div>
                <div class="flex justify-between mt-4 gap-2">
                    <button
                        @click="closeModalHapus"
                        class="w-full text-secondary py-3 rounded-full font-medium cursor-pointer"
                    >
                        Batal
                    </button>
                    <button
                        class="w-full bg-primary text-textDark py-3 rounded-full font-medium cursor-pointer hover:brightness-90 duration-300"
                    >
                        Ya, Hapus
                    </button>
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
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
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
