<script setup>
import { ref, onMounted, onUnmounted, watch } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import BottomOffcanvas from '@/components/BottomOffcanvas.vue';
import BottomNavbar from '@/components/BottomNavbar.vue';
import { Head, Link } from '@inertiajs/vue3';

const { props, url } = usePage();
const initialSearch = props.filters?.search ?? '';
const initialCategory = props.filters?.category ?? '';
let debounceTimeout = null;

// Refs
const search = ref(initialSearch);
const displayedSearch = ref(initialSearch);
const selectedCategory = ref(initialCategory);
const products = ref(props.items);
const offcanvasRef = ref(null);

// Handler
const showOffcanvas = (product) => {
  offcanvasRef.value?.openOffcanvas(product);
};
const blockBackButton = () => {
  if (url === '/') {
    window.history.pushState(null, '', window.location.href);
  }
};
const changeCategory = (id) => {
  router.get('/', { category: id }, { preserveState: false, replace: true });
};


// Hooks
watch(search, (value) => {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(() => {
    router.get('/', { search: value, category: selectedCategory.value }, { preserveState: false, replace: true });
    displayedSearch.value = value;
  }, 500);
});

onMounted(() => {
  if (url === '/') {
    window.history.pushState(null, '', window.location.href);
    window.addEventListener('popstate', blockBackButton);
  }
});
onUnmounted(() => {
  window.removeEventListener('popstate', blockBackButton);
  clearTimeout(debounceTimeout);
});
</script>

<template>
  <main class="bg-bgGray min-h-screen">

    <Head title="Beranda" />

    <!-- Hero Section -->
    <section class="py-6 px-4 space-y-5">
      <div class="flex justify-between items-center">
        <!-- <h1 class="text-lg font-semibold">Selamat Datang</h1> -->
        <img src="/assets/images/logo.png" alt="Logo ASoleh" class="w-18 h-18">
        <Link href="/keranjang" class="text-textDark bg-primaryThin px-3 py-2.5 rounded-xl text-2xl">
        <p class="translate-y-0.5"><i class="fi fi-rr-shopping-cart"></i></p>
        </Link>
      </div>
    </section>

    <!-- Banner -->
    <section class="px-4">
      <img src="/assets/images/BANNER ASOLEH.jpg" alt="BANNER ASOLEH" class="rounded-2xl" />
    </section>

    <div class="relative mt-4 px-4">
      <input v-model="search" type="search"
        class="peer py-3 px-4 ps-14 block w-full bg-white rounded-2xl focus:outline-none shadow-lg"
        placeholder="Cari produk" />
      <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-8 pt-1">
        <i class="fi fi-rr-search text-textDark text-xl"></i>
      </div>
    </div>

    <!-- Product List -->
    <section class="bg-bgGray py-5 px-4 space-y-4">
      <h1 class="text-textDark text-lg font-bold">
        {{
          !displayedSearch
            ? 'Kategori Produk'
            : `Hasil pencarian untuk \"${displayedSearch}\"`
        }}
      </h1>

      <div class="flex justify-start gap-5 overflow-x-auto scrollbar-hide">
        <button class="flex flex-col justify-start items-center gap-2 cursor-pointer" @click="changeCategory('')">
          <div
          :class="(!selectedCategory || selectedCategory == '') && 'bg-primary'"
          class="bg-primaryThin hover:bg-primary p-3 rounded-full h-14 w-14 flex items-center justify-center duration-300">
            <img src="/assets/images/semua.png" alt="Kategori Semua" class="h-full w-full">
          </div>
          <div>
            <p class="text-textDark text-xs">Semua</p>
          </div>
        </button>
        <button v-for="category in $page.props?.categories" @click="changeCategory(category.id)"
          class="flex flex-col cursor-pointer justify-start items-center gap-2" 
          >
          <div class="bg-primaryThin hover:bg-primary p-3 rounded-full h-14 w-14 flex items-center justify-center duration-300"
          :class="selectedCategory == category.id && 'bg-primary'"
          >
            <img :src="category.image" :alt="category.name" class="h-full w-full">
          </div>
          <div>
            <p class="text-textDark text-xs text-center line-clamp-2">{{ category.name }}</p>
          </div>
        </button>
        <!-- <div class="flex flex-col justify-center items-center gap-2">
          <div class="bg-primaryThin p-3 rounded-full h-14 w-14 flex items-center justify-center">
            <img src="/assets/images/makanan.png" alt="Kategori Makanan" class="h-full w-full">
          </div>
          <div>
            <p class="text-textDark text-xs">Makanan</p>
          </div>
        </div>
        <div class="flex flex-col justify-center items-center gap-2">
          <div class="bg-primaryThin p-3 rounded-full h-14 w-14 flex items-center justify-center">
            <img src="/assets/images/kriya.png" alt="Kategori Kriya" class="h-full w-full">
          </div>
          <div>
            <p class="text-textDark text-xs">Kriya</p>
          </div>
        </div>
        <div class="flex flex-col justify-center items-center gap-2">
          <div class="bg-primaryThin p-3 rounded-full h-14 w-14 flex items-center justify-center">
            <img src="/assets/images/fashion.png" alt="Kategori fashion" class="h-full w-full">
          </div>
          <div>
            <p class="text-textDark text-xs">Fashion</p>
          </div>
        </div> -->
      </div>

      <div class="grid grid-cols-2 gap-4 pb-20">
        <div v-for="product in products" :key="product.id"
          class="flex flex-col bg-white p-3 rounded-2xl w-full max-w-[480px] h-[315px]">
          <div class="h-[50%] w-full rounded-2xl overflow-hidden relative">
            <img :src="product.image" class="absolute top-0 left-0 w-full h-full object-cover" alt="" />
          </div>
          <div class="flex flex-col justify-between flex-1">
            <div class="my-2">
              <h1 class="line-clamp-2">{{ product.name }}</h1>
              <h2 class="font-bold">
                Rp{{ product.price.toLocaleString('id-ID') }}
              </h2>
              <p class="text-xs text-secondary mt-1">
                Sisa {{ product.stock }}
              </p>
            </div>
            <button @click="showOffcanvas(product)"
              class="bg-primary w-full py-2 rounded-2xl cursor-pointer hover:brightness-90 duration-300">
              Beli
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Bottom Components -->
    <BottomNavbar />
    <BottomOffcanvas ref="offcanvasRef" />
  </main>
</template>
