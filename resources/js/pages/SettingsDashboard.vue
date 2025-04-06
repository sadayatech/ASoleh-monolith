<template>
    <RootLayout>
        <div class="min-h-screen bg-gray-100 p-4">
            <div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg p-6">
                <!-- Pengaturan Restoran -->
                <h2 class="text-lg font-bold mb-2">Pengaturan Restoran</h2>
                <p class="text-sm text-gray-600 mb-4">
                    Ubah informasi restoran kamu disini
                </p>

                <div class="mb-4">
                    <div
                        class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-2"
                    >
                        📷
                    </div>
                    <button
                        class="bg-gray-300 text-gray-700 text-sm px-3 py-1 rounded-lg"
                    >
                        Pilih Gambar
                    </button>
                    <p class="text-xs text-gray-500 mt-1">
                        JPG, JPEG or PNG. 2MB max.
                    </p>
                </div>

                <div class="space-y-3">
                    <InputField
                        label="Nama Restoran"
                        v-model="restaurant.name"
                        required
                    />
                    <InputField
                        label="Negara"
                        v-model="restaurant.country"
                        required
                    />
                    <InputField
                        label="Alamat Restoran"
                        v-model="restaurant.address"
                        required
                        textarea
                    />
                    <InputField
                        label="Nomor Whatsapp Restoran"
                        v-model="restaurant.whatsapp"
                        required
                    />
                    <InputField
                        label="Mata Uang"
                        v-model="restaurant.currency"
                        required
                    />
                    <button
                        class="w-full bg-green-500 text-white font-medium py-2 rounded-xl"
                    >
                        Simpan Perubahan
                    </button>
                </div>

                <!-- Pengaturan Pemilik -->
                <div class="border-t my-6"></div>
                <h2 class="text-lg font-bold mb-2">Pengaturan Pemilik</h2>
                <InputField
                    label="Nama Pemilik"
                    v-model="owner.name"
                    required
                />
                <InputField label="Email" v-model="owner.email" required />
                <InputField
                    label="Kata Sandi Lama"
                    v-model="owner.oldPassword"
                    type="password"
                />
                <InputField
                    label="Kata Sandi Baru"
                    v-model="owner.newPassword"
                    type="password"
                />
                <InputField
                    label="Konfirmasi Kata Sandi"
                    v-model="owner.confirmPassword"
                    type="password"
                />
                <button
                    class="w-full bg-green-500 text-white font-medium py-2 rounded-xl"
                >
                    Simpan Perubahan
                </button>
            </div>
        </div>
        <DashboardNav />
    </RootLayout>
</template>

<script setup>
import { ref } from "vue";
import RootLayout from "@/layouts/RootLayout.vue";
import DashboardNav from "@/components/DashboardNav.vue";
import InputField from "@/components/InputField.vue";

const restaurant = ref({
    name: "Hexatea",
    country: "Indonesia",
    address:
        "Jl. Prabu Geusan Ulun, RT02/RW10 Lingkungan Kaum, Regol Wetan, Sumedang Selatan.",
    whatsapp: "6285156105763",
    currency: "Indonesian Rupiah (Rp)",
});

const owner = ref({
    name: "Muhammad Azfa",
    email: "azfasa15@gmail.com",
    oldPassword: "",
    newPassword: "",
    confirmPassword: "",
});
</script>

<style scoped></style>
