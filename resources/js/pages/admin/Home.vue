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

        <section class="bg-white mt-4 p-4 rounded-2xl">
            <div>
                <h1 class="text-textDark text-lg font-semibold">Statistik Hari Ini</h1>
                  <!-- Chart -->
                  <div class="col-span-2 md:hidden">
                    <VueApexCharts type="bar" height="320" :options="chartOptions" :series="series" />
                  </div>
                <div class="grid grid-cols-1 md:grid-cols-3 space-y-4 md:space-x-4 mt-4">
                    <div class="col-span-1 bg-primaryThin p-4 rounded-3xl flex justify-between items-center">
                        <div class="space-y-2">
                            <p class="text-textDark">Menu Aktif</p>
                            <h1 class="text-textDark text-3xl font-bold">25</h1>
                        </div>
                        <div>
                            <p class="text-primary text-5xl"><i class="fi fi-sr-hamburger-soda"></i></p>
                        </div>
                    </div>
                    <div class="col-span-1 bg-primaryThin p-4 rounded-3xl flex justify-between items-center">
                        <div class="space-y-2">
                            <p class="text-textDark">Jumlah Pesanan</p>
                            <h1 class="text-textDark text-3xl font-bold">50</h1>
                        </div>
                        <div>
                            <p class="text-primary text-5xl"><i class="fi fi-sr-room-service"></i></p>
                        </div>
                    </div>
                    <div class="col-span-1 bg-primaryThin p-4 rounded-3xl flex justify-between items-center">
                        <div class="space-y-2">
                            <p class="text-textDark">Total Pendapatan</p>
                            <h1 class="text-textDark text-3xl font-bold">Rp250.000</h1>
                        </div>
                        <div>
                            <p class="text-primary text-5xl"><i class="fi fi-sr-sack-dollar"></i></p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 space-y-4 md:space-x-4 mt-4">
                    <!-- Chart -->
                    <div class="col-span-2 hidden md:block">
                        <VueApexCharts type="bar" height="320" :options="chartOptions" :series="series" />
                    </div>
                    <div class="col-span-1 flex flex-col justify-between gap-4 md:gap-0">
                        <div class="bg-primaryThin p-4 rounded-3xl flex justify-between items-center">
                            <div class="space-y-2">
                                <p class="text-textDark">Total Keuntungan</p>
                                <h1 class="text-textDark text-3xl font-bold">Rp50.000</h1>
                            </div>
                            <div>
                                <p class="text-primary text-5xl"><i class="fi fi-sr-hand-holding-usd"></i></p>
                            </div>
                        </div>
                        <div class="bg-primaryThin p-4 rounded-3xl flex justify-between items-center">
                            <div class="space-y-2">
                                <p class="text-textDark">Jumlah Supplier</p>
                                <h1 class="text-textDark text-3xl font-bold">32</h1>
                            </div>
                            <div>
                                <p class="text-primary text-5xl"><i class="fi fi-ss-supplier"></i></p>
                            </div>
                        </div>
                        <div class="bg-primaryThin p-4 rounded-3xl flex justify-between items-center">
                            <div class="space-y-2">
                                <p class="text-textDark">Pengguna Terdaftar</p>
                                <h1 class="text-textDark text-3xl font-bold">1675</h1>
                            </div>
                            <div>
                                <p class="text-primary text-5xl"><i class="fi fi-sr-users"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
    </div>

    <!-- Sidebar -->
    <Sidebar />
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import Sidebar from './components/Sidebar.vue'
import VueApexCharts from 'vue3-apexcharts'

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

// Modal Konfirmasi Keluar
const showModalKeluar = ref(false);
const openModalKeluar = () => {
    showModalKeluar.value = true;
};
const closeModalKeluar = () => {
    showModalKeluar.value = false;
};

// Grafik Pesanan Tahunan
const series = ref([
  {
    name: 'Pesanan',
    data: [23, 31, 40, 101, 40, 36, 32, 23, 14, 8, 5, 2],
  },
])

const chartOptions = ref({
  chart: {
    height: 320,
    type: 'bar',
  },
  colors: ['#F1BD2C'],
  plotOptions: {
    bar: {
      borderRadius: 10,
      dataLabels: {
        position: 'top',
      },
    },
  },
  dataLabels: {
    enabled: true,
    // formatter: (val) => val + '%',
    offsetY: -20,
    style: {
      fontSize: '12px',
      colors: ['#2D3134'],
    },
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    position: 'top',
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
    tooltip: {
      enabled: true,
    },
  },
  yaxis: {
    labels: {
      show: false,
    //   formatter: (val) => val + '%',
    },
  },
  title: {
    text: 'Grafik Pesanan Tahun 2025',
    floating: true,
    offsetY: 300,
    align: 'center',
    style: {
      color: '#2D3134',
    },
  },
})
</script>

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