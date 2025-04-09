<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import Sidebar from './components/Sidebar.vue'

// Dropdown Profil
const isDropdownOpen = ref(false)
const dropdownRef = ref(null)
const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value
}
const handleClickOutside = (event) => {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
    isDropdownOpen.value = false
  }
}
onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})
onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside)
})

// Modal Detail Pengguna
const showModalDetail = ref(false);
const openModalDetail = () => {
    showModalDetail.value = true;
};
const closeModalDetail = () => {
    showModalDetail.value = false;
};

// Modal Tambah Pengguna
const showModalTambah = ref(false);
const openModalTambah = () => {
    showModalTambah.value = true;
};
const closeModalTambah = () => {
    showModalTambah.value = false;
};

// Modal Ubah Pengguna
const showModalUbah = ref(false);
const openModalUbah = () => {
    showModalUbah.value = true;
};
const closeModalUbah = () => {
    showModalUbah.value = false;
};

// Modal Hapus Pengguna
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
    <div class="bg-bgGray min-h-screen md:ps-[150px] p-4 md:pe-4 pt-[18px] pb-24 md:pb-0">
        <div class="bg-white p-4 rounded-2xl flex justify-between items-center">
            <div>
                <h1 class="text-lg font-semibold">SPW Gridas</h1>
            </div>
            <!-- Dropdown -->
            <div class="relative" ref="dropdownRef">
                <button @click="toggleDropdown" class="flex items-center gap-4 cursor-pointer">
                    <div class="h-12 w-12 rounded-full overflow-hidden">
                        <img :src="$page.props.auth.user.image" :alt="$page.props.auth.user.name + ' profile picture'">
                    </div>
                    <div class="hidden md:inline-flex flex-col text-left">
                        <h2 class="text-textDark font-semibold">{{ $page.props.auth.user.name }}</h2>
                        <p class="text-textDark text-sm">{{ $page.props.auth.user.email }}</p>
                    </div>
                    <div>
                        <p class="hidden md:block text-textDark transition-transform duration-200" :class="isDropdownOpen ? 'rotate-180' : ''">
                        <i class="fi fi-sr-angle-down"></i>
                        </p>
                    </div>
                </button>

                <Transition name="fade">
                    <div
                        v-if="isDropdownOpen"
                        class="absolute right-0 z-10 mt-2 w-56 bg-white rounded-2xl shadow-lg"
                        >
                        <router-link to="/admin/pengguna" class="flex md:hidden items-center py-2.5 px-4 gap-4 hover:bg-bgGray duration-300 cursor-pointer">
                            <p class="text-textDark text-lg"><i class="fi fi-rr-users"></i></p>
                            <p class="text-textDark">Pengguna</p>
                        </router-link>
                        <router-link to="/admin/pengaturan" class="flex md:hidden items-center py-2.5 px-4 gap-4 hover:bg-bgGray duration-300 cursor-pointer">
                            <p class="text-textDark text-lg"><i class="fi fi-rr-settings"></i></p>
                            <p class="text-textDark">Pengaturan</p>
                        </router-link>
                        <!-- Garis Pemisah -->
                        <div class="border-t md:border-none border-textGray mt-1"></div>
                        <button @click="openModalKeluar" class="flex items-center p-4 gap-4 w-full hover:bg-bgGray duration-300 cursor-pointer">
                            <p class="text-secondary text-lg"><i class="fi fi-rr-sign-out-alt"></i></p>
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
                        <input type="search" class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                            placeholder="Cari pengguna" />
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1">
                            <p class="text-textDark text-xl"><i class="fi fi-rr-search"></i></p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 md:mt-0">
                    <button @click="openModalTambah" class="bg-primary py-3 md:px-8 w-full md:w-auto rounded-full flex justify-center items-center gap-2 cursor-pointer hover:brightness-90 duration-300">
                        <p class="text-textDark text-sm translate-y-0.5"><i class="fi fi-rr-plus"></i></p>
                        <p class="text-textDark font-medium">Tambah Pengguna</p>
                    </button>
                </div>
            </div>
        </section>

        <section class="mt-6">
            <div>
                <h1 class="text-textDark text-lg font-semibold">Daftar Pengguna</h1>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-4">
                    <button @click="openModalDetail" type="button" class="relative col-span-1 bg-white p-6 mt-4 rounded-3xl flex items-center gap-4 text-start cursor-pointer">
                        <!-- Badge -->
                        <div class="absolute top-0 right-0 bg-primaryThin py-1.5 px-4 rounded-tr-3xl rounded-bl-3xl">
                            <p class="text-sm text-primary font-medium">Customer</p>
                        </div>
                        <div class="h-14 w-14 rounded-full overflow-hidden">
                            <img :src="$page.props.auth.user.image" :alt="$page.props.auth.user.name + ' profile picture'">
                        </div>
                        <div>
                            <h1 class="line-clamp-1 text-textDark font-semibold">Nama Pengguna</h1>
                            <h2 class="text-textDark">emailpengguna@gmail.com</h2>
                        </div>
                        <div class="flex items-center ml-auto">
                            <p class="text-textDark"><i class="fi fi-rr-angle-right"></i></p>
                        </div>
                    </button>
                    <button @click="openModalDetail" type="button" class="relative col-span-1 bg-white p-6 mt-4 rounded-3xl flex items-center gap-4 text-start cursor-pointer">
                        <!-- Badge -->
                        <div class="absolute top-0 right-0 bg-primaryThin py-1.5 px-4 rounded-tr-3xl rounded-bl-3xl">
                            <p class="text-sm text-primary font-medium">Customer</p>
                        </div>
                        <div class="h-14 w-14 rounded-full overflow-hidden">
                            <img :src="$page.props.auth.user.image" :alt="$page.props.auth.user.name + ' profile picture'">
                        </div>
                        <div>
                            <h1 class="line-clamp-1 text-textDark font-semibold">Nama Pengguna</h1>
                            <h2 class="text-textDark">emailpengguna@gmail.com</h2>
                        </div>
                        <div class="flex items-center ml-auto">
                            <p class="text-textDark"><i class="fi fi-rr-angle-right"></i></p>
                        </div>
                    </button>
                    <button @click="openModalDetail" type="button" class="relative col-span-1 bg-white p-6 mt-4 rounded-3xl flex items-center gap-4 text-start cursor-pointer">
                        <!-- Badge -->
                        <div class="absolute top-0 right-0 bg-primaryThin py-1.5 px-4 rounded-tr-3xl rounded-bl-3xl">
                            <p class="text-sm text-primary font-medium">Customer</p>
                        </div>
                        <div class="h-14 w-14 rounded-full overflow-hidden">
                            <img :src="$page.props.auth.user.image" :alt="$page.props.auth.user.name + ' profile picture'">
                        </div>
                        <div>
                            <h1 class="line-clamp-1 text-textDark font-semibold">Nama Pengguna</h1>
                            <h2 class="text-textDark">emailpengguna@gmail.com</h2>
                        </div>
                        <div class="flex items-center ml-auto">
                            <p class="text-textDark"><i class="fi fi-rr-angle-right"></i></p>
                        </div>
                    </button>
                    <button @click="openModalDetail" type="button" class="relative col-span-1 bg-white p-6 mt-4 rounded-3xl flex items-center gap-4 text-start cursor-pointer">
                        <!-- Badge -->
                        <div class="absolute top-0 right-0 bg-primaryThin py-1.5 px-4 rounded-tr-3xl rounded-bl-3xl">
                            <p class="text-sm text-primary font-medium">Customer</p>
                        </div>
                        <div class="h-14 w-14 rounded-full overflow-hidden">
                            <img :src="$page.props.auth.user.image" :alt="$page.props.auth.user.name + ' profile picture'">
                        </div>
                        <div>
                            <h1 class="line-clamp-1 text-textDark font-semibold">Nama Pengguna</h1>
                            <h2 class="text-textDark">emailpengguna@gmail.com</h2>
                        </div>
                        <div class="flex items-center ml-auto">
                            <p class="text-textDark"><i class="fi fi-rr-angle-right"></i></p>
                        </div>
                    </button>
                </div>
            </div>
        </section>

        <!-- Modal Detail Pengguna -->
        <Transition name="fade">
            <div v-if="showModalDetail" class="fixed inset-0 bg-black/50 flex items-center justify-center z-20"
                @click="closeModalDetail">
            </div>
        </Transition>

        <Transition name="scale">
            <div v-if="showModalDetail" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 scale-100 bg-white w-[90%] md:w-[40%] py-8 px-6 rounded-4xl shadow-lg text-center z-30">
                <div class="flex justify-between">
                    <h1 class="text-textDark text-lg font-semibold">Detail Pengguna</h1>
                    <p class="text-textDark text-2xl cursor-pointer"
                        @click="closeModalDetail">
                        <i class="fi fi-rr-cross-small"></i>
                    </p>
                </div>
                <div class="flex gap-4 mt-4">
                    <div class="text-start w-full">
                        <div class="flex flex-col justify-center items-center">
                            <div class="h-32 w-32 rounded-full overflow-hidden relative">
                                <img src="/src/assets/images/user.png" alt="user profile">
                            </div>
                            <div class="text-center mt-2 space-y-1">
                                <h1 class="text-textDark text-xl font-bold">Nama Customer</h1>
                                <p class="bg-primaryThin text-primary text-sm py-1 px-4 rounded-full mx-auto w-fit">Customer</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 mt-6 gap-y-4">
                            <div class="">
                                <p class="text-textGrayDark text-xs">Nomor WhatsApp</p>
                                <h2 class="text-textDark">0812345678910</h2>
                            </div>
                            <div class="">
                                <p class="text-textGrayDark text-xs">Alamat Email</p>
                                <h2 class="text-textDark break-words">emailpengguna@gmail.com</h2>
                            </div>
                            <div class="">
                                <p class="text-textGrayDark text-xs">Tanggal Lahir</p>
                                <h2 class="text-textDark">09-04-2025</h2>
                            </div>
                            <div class="">
                                <p class="text-textGrayDark text-xs">Jenis Kelamin</p>
                                <h2 class="text-textDark">Laki-Laki</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-4 gap-2">
                    <button @click="openModalUbah" class="w-full bg-primary text-textDark py-3 rounded-full font-medium cursor-pointer hover:brightness-90 duration-300">
                        <div class="flex justify-center items-center gap-2">
                            <p class="text-lg translate-y-0.5"><i class="fi fi-rr-edit"></i></p>
                            <p>Ubah</p>
                        </div>
                    </button>
                    <button @click="openModalHapus" class="w-full text-secondary py-3 rounded-full font-medium cursor-pointer">
                        <div class="flex justify-center items-center gap-2">
                            <p class="text-lg translate-y-0.5"><i class="fi fi-rr-trash"></i></p>
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

        <!-- Modal Tambah Pengguna -->
        <Transition name="scale">
        <div
            v-if="showModalTambah"
            class="fixed inset-0 z-30 overflow-y-auto flex justify-center items-start"
        >
            <div
            class="bg-bgGray w-[90%] md:w-[60%] p-4 md:py-8 md:px-6 rounded-4xl shadow-lg mt-10 mb-10"
            >
            <div class="flex justify-between">
                <h1 class="text-textDark text-lg font-semibold">Tambah Pengguna</h1>
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
                <label for="uploadFotoProfil" class="text-textDark">
                    <p>Foto Profil</p>
                </label>
                <div class="relative mt-2">
                    <input
                    type="file"
                    id="uploadFotoProfil"
                    class="hidden"
                    @change="updateFileName"
                    ref="fileInput"
                    />
                    <label
                    for="uploadFotoProfil"
                    class="flex items-center gap-2 w-full bg-white rounded-full cursor-pointer shadow-sm"
                    >
                    <span
                        class="bg-bgGray py-3 px-4 rounded-l-full text-textDark text-sm md:text-base w-[50%]"
                    >
                        Choose File
                    </span>
                    <span class="text-textGrayDark pr-4 line-clamp-1 w-full">{{
                        fileName || "No file chosen"
                    }}</span>
                    </label>
                </div>
                </div>

                <!-- Nama Pengguna -->
                <div class="col-span-1">
                <label for="nama-pengguna" class="text-textDark">Nama Pengguna</label>
                <div class="relative mt-2">
                    <input
                    type="text"
                    id="nama-pengguna"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                    placeholder="Masukkan Nama Pengguna"
                    required
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

                <!-- Email -->
                <div class="col-span-1">
                <label for="email" class="text-textDark">Alamat Email</label>
                <div class="relative mt-2">
                    <input
                    type="email"
                    id="email"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                    placeholder="Masukkan Email Pengguna"
                    required
                    />
                    <div
                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                    >
                    <p class="text-textDark text-xl">
                        <i class="fi fi-rr-envelope"></i>
                    </p>
                    </div>
                </div>
                </div>

                <!-- Nomor WhatsApp -->
                <div class="col-span-1">
                <label for="nomor-whatsapp" class="text-textDark"
                    >Nomor WhatsApp</label
                >
                <div class="relative mt-2">
                    <input
                    type="number"
                    id="nomor-whatsapp"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                    placeholder="Masukkan Nomor WhatsApp"
                    required
                    />
                    <div
                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                    >
                    <p class="text-textDark text-xl">
                        <i class="fi fi-brands-whatsapp"></i>
                    </p>
                    </div>
                </div>
                </div>

                <!-- Peran -->
                <div class="col-span-1">
                <label for="peran-pengguna" class="text-textDark">Peran Pengguna</label>
                <div class="relative mt-2">
                    <select
                    id="peran-pengguna"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none appearance-none cursor-pointer"
                    required
                    >
                    <option value="" disabled selected>Pilih Peran Pengguna</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="pelayan">Pelayan</option>
                    <option value="customer">Customer</option>
                    </select>
                    <div
                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                    >
                    <i class="fi fi-rr-user-gear text-textDark text-xl"></i>
                    </div>
                </div>
                </div>

                <!-- Tanggal Lahir -->
                <div class="col-span-1">
                <label for="tanggal-lahir" class="text-textDark">Tanggal Lahir</label>
                <div class="relative mt-2">
                    <input
                    type="date"
                    id="tanggal-lahir"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none appearance-none"
                    required
                    />
                    <div
                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                    >
                    <i class="fi fi-rr-calendar text-textDark text-xl"></i>
                    </div>
                </div>
                </div>

                <!-- Jenis Kelamin -->
                <div class="col-span-1">
                <label for="jenis-kelamin" class="text-textDark">Jenis Kelamin</label>
                <div class="relative mt-2">
                    <select
                    id="jenis-kelamin"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none appearance-none cursor-pointer"
                    required
                    >
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                    </select>
                    <div
                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                    >
                    <i class="fi fi-rr-mars text-textDark text-xl"></i>
                    </div>
                </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="md:col-span-2 flex justify-end">
                <button
                    type="submit"
                    class="bg-primary px-12 py-3 rounded-full cursor-pointer translate-x-1.5 hover:brightness-90 duration-300"
                >
                    <div class="flex justify-center items-center gap-2">
                    <p class="text-textDark text-lg translate-y-0.5">
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

        <!-- Modal Ubah Pengguna -->
        <Transition name="scale">
        <div
            v-if="showModalUbah"
            class="fixed inset-0 z-30 overflow-y-auto flex justify-center items-start"
        >
            <div
            class="bg-bgGray w-[90%] md:w-[60%] p-4 md:py-8 md:px-6 rounded-4xl shadow-lg mt-10 mb-10"
            >
            <div class="flex justify-between">
                <h1 class="text-textDark text-lg font-semibold">Ubah Pengguna</h1>
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
                <label for="uploadFotoProfil" class="text-textDark">
                    <p>Foto Profil</p>
                </label>
                <div class="relative mt-2">
                    <input
                    type="file"
                    id="uploadFotoProfil"
                    class="hidden"
                    @change="updateFileName"
                    ref="fileInput"
                    />
                    <label
                    for="uploadFotoProfil"
                    class="flex items-center gap-2 w-full bg-white rounded-full cursor-pointer shadow-sm"
                    >
                    <span
                        class="bg-bgGray py-3 px-4 rounded-l-full text-textDark text-sm md:text-base w-[50%]"
                    >
                        Choose File
                    </span>
                    <span class="text-textGrayDark pr-4 line-clamp-1 w-full">{{
                        fileName || "No file chosen"
                    }}</span>
                    </label>
                </div>
                </div>

                <!-- Nama Pengguna -->
                <div class="col-span-1">
                <label for="nama-pengguna" class="text-textDark">Nama Pengguna</label>
                <div class="relative mt-2">
                    <input
                    type="text"
                    id="nama-pengguna"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                    placeholder="Masukkan Nama Pengguna"
                    required
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

                <!-- Email -->
                <div class="col-span-1">
                <label for="email" class="text-textDark">Alamat Email</label>
                <div class="relative mt-2">
                    <input
                    type="email"
                    id="email"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                    placeholder="Masukkan Email Pengguna"
                    required
                    />
                    <div
                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                    >
                    <p class="text-textDark text-xl">
                        <i class="fi fi-rr-envelope"></i>
                    </p>
                    </div>
                </div>
                </div>

                <!-- Nomor WhatsApp -->
                <div class="col-span-1">
                <label for="nomor-whatsapp" class="text-textDark"
                    >Nomor WhatsApp</label
                >
                <div class="relative mt-2">
                    <input
                    type="number"
                    id="nomor-whatsapp"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                    placeholder="Masukkan Nomor WhatsApp"
                    required
                    />
                    <div
                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 pt-1"
                    >
                    <p class="text-textDark text-xl">
                        <i class="fi fi-brands-whatsapp"></i>
                    </p>
                    </div>
                </div>
                </div>

                <!-- Peran -->
                <div class="col-span-1">
                <label for="peran-pengguna" class="text-textDark">Peran Pengguna</label>
                <div class="relative mt-2">
                    <select
                    id="peran-pengguna"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none appearance-none cursor-pointer"
                    required
                    >
                    <option value="" disabled selected>Pilih Peran Pengguna</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="pelayan">Pelayan</option>
                    <option value="customer">Customer</option>
                    </select>
                    <div
                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                    >
                    <i class="fi fi-rr-user-gear text-textDark text-xl"></i>
                    </div>
                </div>
                </div>

                <!-- Tanggal Lahir -->
                <div class="col-span-1">
                <label for="tanggal-lahir" class="text-textDark">Tanggal Lahir</label>
                <div class="relative mt-2">
                    <input
                    type="date"
                    id="tanggal-lahir"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none appearance-none"
                    required
                    />
                    <div
                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                    >
                    <i class="fi fi-rr-calendar text-textDark text-xl"></i>
                    </div>
                </div>
                </div>

                <!-- Jenis Kelamin -->
                <div class="col-span-1">
                <label for="jenis-kelamin" class="text-textDark">Jenis Kelamin</label>
                <div class="relative mt-2">
                    <select
                    id="jenis-kelamin"
                    class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none appearance-none cursor-pointer"
                    required
                    >
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                    </select>
                    <div
                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                    >
                    <i class="fi fi-rr-mars text-textDark text-xl"></i>
                    </div>
                </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="md:col-span-2 flex justify-end">
                <button
                    type="submit"
                    class="bg-primary px-12 py-3 rounded-full cursor-pointer translate-x-1.5 hover:brightness-90 duration-300"
                >
                    <div class="flex justify-center items-center gap-2">
                    <p class="text-textDark text-lg translate-y-0.5">
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

        <!-- Modal Konfirmasi Hapus Pengguna -->
        <Transition name="fade">
            <div v-if="showModalHapus" class="fixed inset-0 bg-black/50 flex items-center justify-center z-40"
                @click="closeModalHapus">
            </div>
        </Transition>

        <Transition name="scale">
            <div v-if="showModalHapus" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 scale-100 bg-white w-[80%] max-w-[480px] py-8 px-6 rounded-4xl shadow-lg text-center z-50">
                <div class="">
                    <p class="text-center text-textDark text-xl font-semibold">Apakah Anda yakin ingin menghapus pengguna ini?</p>
                </div>
                <div class="flex justify-between mt-4 gap-2">
                    <button @click="closeModalHapus" class="w-full text-secondary py-3 rounded-full font-medium cursor-pointer">Batal</button>
                    <button class="w-full bg-primary text-textDark py-3 rounded-full font-medium cursor-pointer hover:brightness-90 duration-300">Ya, Hapus</button>
                </div>
            </div>
        </Transition>

        <!-- Backdrop Modal Konfirmasi Keluar -->
        <Transition name="fade">
            <div v-if="showModalKeluar" class="fixed inset-0 bg-black/50 flex items-center justify-center z-20"
                @click="closeModalKeluar">
            </div>
        </Transition>

        <!-- Modal Konfirmasi Keluar -->
        <Transition name="scale">
            <div v-if="showModalKeluar" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 scale-100 bg-white w-[80%] max-w-[480px] py-8 px-6 rounded-4xl shadow-lg text-center z-30">
                <div class="">
                    <p class="text-center text-textDark text-xl font-semibold">Apakah Anda yakin ingin keluar?</p>
                </div>
                <div class="flex justify-between mt-4 gap-2">
                    <button @click="closeModalKeluar" class="w-full text-secondary py-3 rounded-full font-medium cursor-pointer">Batal</button>
                    <button class="w-full bg-primary text-textDark py-3 rounded-full font-medium cursor-pointer hover:brightness-90 duration-300">Keluar</button>
                </div>
            </div>
        </Transition>

        <!-- Sidebar -->
        <Sidebar />
    </div>
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
  transition: transform 0.2s ease-out, opacity 0.2s ease-out;
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