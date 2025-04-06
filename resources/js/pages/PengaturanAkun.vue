<script setup>
import { ref } from "vue";
import { Head, router } from "@inertiajs/vue3";

const showPasswordOld = ref(false);
const showPasswordNew = ref(false);
const showPasswordConfirm = ref(false);
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
    <div class="bg-bgGray min-h-screen pb-4">
        <Head title="Pengaturan akun" />

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
                    Pengaturan Akun
                </h1>
            </div>
        </section>

        <section class="mt-4 p-4">
            <div class="flex justify-center items-center gap-2">
                <p class="text-textDark text-lg translate-y-0.5">
                    <i class="fi fi-br-user-pen"></i>
                </p>
                <h1 class="text-textDark text-lg font-semibold">
                    Ubah Kata Sandi
                </h1>
            </div>

            <!-- Kata Sandi Saat Ini -->
            <div class="mt-4">
                <label for="kata-sandi-saat-ini" class="text-textDark"
                    >Kata Sandi Saat Ini</label
                >
                <div class="relative mt-2">
                    <input
                        :type="showPasswordOld ? 'text' : 'password'"
                        id="kata-sandi-saat-ini"
                        class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                        placeholder="Masukkan Kata Sandi Saat Ini"
                        required
                    />
                    <div
                        class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                    >
                        <i class="fi fi-rr-lock text-textDark text-xl"></i>
                    </div>
                    <button
                        type="button"
                        @click="showPasswordOld = !showPasswordOld"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-textDark"
                    >
                        <i
                            :class="
                                showPasswordOld
                                    ? 'fi fi-rr-eye text-xl'
                                    : 'fi fi-rr-eye-crossed text-xl'
                            "
                        ></i>
                    </button>
                </div>
            </div>

            <!-- Kata Sandi Baru -->
            <div class="mt-4">
                <label for="kata-sandi-baru" class="text-textDark"
                    >Kata Sandi Baru</label
                >
                <div class="relative mt-2">
                    <input
                        :type="showPasswordNew ? 'text' : 'password'"
                        id="kata-sandi-baru"
                        class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                        placeholder="Masukkan Kata Sandi Baru"
                        required
                    />
                    <div
                        class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                    >
                        <i class="fi fi-rr-lock text-textDark text-xl"></i>
                    </div>
                    <button
                        type="button"
                        @click="showPasswordNew = !showPasswordNew"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-textDark"
                    >
                        <i
                            :class="
                                showPasswordNew
                                    ? 'fi fi-rr-eye text-xl'
                                    : 'fi fi-rr-eye-crossed text-xl'
                            "
                        ></i>
                    </button>
                </div>
            </div>

            <!-- Konfirmasi Kata Sandi Baru -->
            <div class="mt-4">
                <label for="konfirmasi-kata-sandi-baru" class="text-textDark"
                    >Konfirmasi Kata Sandi Baru</label
                >
                <div class="relative mt-2">
                    <input
                        :type="showPasswordConfirm ? 'text' : 'password'"
                        id="konfirmasi-kata-sandi-baru"
                        class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
                        placeholder="Ketik Ulang Kata Sandi Baru"
                        required
                    />
                    <div
                        class="absolute inset-y-0 left-0 flex items-center pointer-events-none ps-4"
                    >
                        <i class="fi fi-rr-lock text-textDark text-xl"></i>
                    </div>
                    <button
                        type="button"
                        @click="showPasswordConfirm = !showPasswordConfirm"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-textDark"
                    >
                        <i
                            :class="
                                showPasswordConfirm
                                    ? 'fi fi-rr-eye text-xl'
                                    : 'fi fi-rr-eye-crossed text-xl'
                            "
                        ></i>
                    </button>
                </div>
            </div>

            <p class="text-textDark text-sm mt-4">
                <span class="text-secondary">Catatan:</span>
                Kata sandi minimal 6 karakter
            </p>

            <div class="mt-4">
                <button
                    type="submit"
                    class="bg-primary w-full py-3 mt-4 rounded-full cursor-pointer hover:brightness-90 duration-300"
                >
                    <p class="text-textDark font-bold">Simpan Perubahan</p>
                </button>
            </div>
        </section>
    </div>
</template>
