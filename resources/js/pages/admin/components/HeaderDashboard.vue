<script setup>
import { onBeforeUnmount, onMounted, ref } from "vue";

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
</script>

<template>
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
                    <img
                        :src="$page.props.auth.user.image"
                        :alt="$page.props.auth.user.name + ' profile picture'"
                    />
                </div>
                <div class="hidden md:inline-flex flex-col text-left">
                    <h2 class="text-textDark font-semibold">
                        {{ $page.props.auth.user.name }}
                    </h2>
                    <p class="text-textDark text-sm">
                        {{ $page.props.auth.user.email }}
                    </p>
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
                    class="absolute right-0 z-50 mt-2 w-56 bg-white rounded-2xl shadow-lg"
                >
                    <Link
                        href="/admin/pengguna"
                        class="flex md:hidden items-center py-2.5 px-4 gap-4 hover:bg-bgGray duration-300 cursor-pointer"
                    >
                        <p class="text-textDark text-lg">
                            <i class="fi fi-rr-users"></i>
                        </p>
                        <p class="text-textDark">Pengguna</p>
                    </Link>
                    <Link
                        href="/admin/pengaturan"
                        class="flex md:hidden items-center py-2.5 px-4 gap-4 hover:bg-bgGray duration-300 cursor-pointer"
                    >
                        <p class="text-textDark text-lg">
                            <i class="fi fi-rr-settings"></i>
                        </p>
                        <p class="text-textDark">Pengaturan</p>
                    </Link>
                    <!-- Garis Pemisah -->
                    <div
                        class="border-t md:border-none border-textGray mt-1"
                    ></div>
                    <button
                        @click="$emit('openModalKeluar')"
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
</template>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.1s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
