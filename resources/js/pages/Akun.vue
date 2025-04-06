<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { usePage, router, Head } from "@inertiajs/vue3";
import BottomNavbar from "@/components/BottomNavbar.vue";
import { Link } from "@inertiajs/vue3";
const route = { path: usePage().url };
const showModal = ref(false);
const page = usePage();
const user = page.props.auth.user;

// Fungsi untuk menangkap tombol kembali dan arahkan ke halaman home
const handleBackButton = () => {
    // Cek apakah halaman yang sedang dibuka adalah akun
    if (route.path === "/akun") {
        router.visit("/"); // Arahkan ke halaman Home
    }
};

onMounted(() => {
    // Menambahkan entri baru ke history browser saat halaman akun dimuat
    if (route.path === "/akun") {
        window.history.pushState(null, "", window.location.href);
        window.addEventListener("popstate", handleBackButton);
    }
});

onUnmounted(() => {
    // Menghapus event listener ketika komponen di-unmount
    window.removeEventListener("popstate", handleBackButton);
});

// Fungsi untuk menampilkan modal
const openModal = () => {
    showModal.value = true;
};

// Fungsi untuk menutup modal
const closeModal = () => {
    showModal.value = false;
};
</script>

<template>
    <main class="bg-bgGray min-h-screen pt-16 pb-24">
        <Head title="Akun" />
        <div
            class="bg-primary w-full h-[50vh] rounded-b-[100px] absolute -top-[30vh] left-1/2 -translate-x-1/2"
        ></div>
        <section class="max-w-[480px] p-4">
            <div class="flex flex-col justify-center items-center">
                <div class="h-36 w-36 rounded-full overflow-hidden relative">
                    <img src="/assets/images/user.png" alt="user profile" />
                </div>
                <div class="text-center mt-4">
                    <h1
                        class="text-textDark text-xl font-bold"
                        v-text="user.name"
                    />
                    <p class="text-textGrayDark text-sm" v-text="user.email" />
                </div>
            </div>
        </section>
        <section class="p-4">
            <div class="bg-white p-5 rounded-2xl">
                <div class="flex flex-col gap-5">
                    <Link
                        href="/profil"
                        class="flex justify-between items-center group cursor-pointer"
                    >
                        <p
                            class="flex gap-6 text-textDark text-xl group-hover:text-primary duration-300"
                        >
                            <i class="fi fi-rr-user"></i>
                            <span class="text-base">Profil Saya</span>
                        </p>
                        <p
                            class="text-textDark group-hover:text-primary duration-300"
                        >
                            <i class="fi fi-rr-angle-right"></i>
                        </p>
                    </Link>
                    <Link
                        href="/pengaturan-akun"
                        class="flex justify-between items-center group cursor-pointer"
                    >
                        <p
                            class="flex gap-6 text-textDark text-xl group-hover:text-primary duration-300"
                        >
                            <i class="fi fi-rr-settings"></i>
                            <span class="text-base">Pengaturan Akun</span>
                        </p>
                        <p
                            class="text-textDark group-hover:text-primary duration-300"
                        >
                            <i class="fi fi-rr-angle-right"></i>
                        </p>
                    </Link>
                    <Link
                        href="/pusat-bantuan"
                        class="flex justify-between items-center group cursor-pointer"
                    >
                        <p
                            class="flex gap-6 text-textDark text-xl group-hover:text-primary duration-300"
                        >
                            <i class="fi fi-rr-info"></i>
                            <span class="text-base">Pusat Bantuan</span>
                        </p>
                        <p
                            class="text-textDark group-hover:text-primary duration-300"
                        >
                            <i class="fi fi-rr-angle-right"></i>
                        </p>
                    </Link>
                    <button
                        type="button"
                        class="ps-1 cursor-pointer"
                        @click="openModal"
                    >
                        <p
                            class="flex gap-5 text-secondary text-xl hover:text-primary duration-300"
                        >
                            <i class="fi fi-rr-sign-out-alt"></i>
                            <span class="text-base">Keluar</span>
                        </p>
                    </button>
                </div>
            </div>
        </section>

        <div class="mt-4">
            <p class="text-textGrayDark text-center text-sm">Versi 1.0.0</p>
        </div>
    </main>

    <!-- Background Hitam dengan Opacity -->
    <Transition name="fade">
        <div
            v-if="showModal"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-20"
            @click="closeModal"
        ></div>
    </Transition>

    <!-- Modal dengan Scale dan Posisi Tengah -->
    <Transition name="scale">
        <div
            v-if="showModal"
            class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 scale-100 bg-white w-[80%] max-w-[480px] py-8 px-6 rounded-4xl shadow-lg text-center z-30"
        >
            <div class="">
                <p class="text-center text-textDark text-xl font-semibold">
                    Apakah Anda yakin ingin keluar?
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
                    class="w-full bg-primary text-textDark py-3 rounded-full font-medium cursor-pointer hover:brightness-90 duration-300"
                >
                    Keluar
                </button>
            </div>
        </div>
    </Transition>

    <!-- Bottom Navbar -->
    <BottomNavbar />
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
