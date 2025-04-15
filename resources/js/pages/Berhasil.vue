<script setup>
import { onMounted, onUnmounted } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';

const confirmGoHome = () => {
  const confirmExit = window.confirm(
    'Apakah Anda yakin ingin kembali ke Home?'
  );
  if (confirmExit) {
    router.visit('/');
  } else {
    // Mencegah navigasi dengan menambahkan ulang pushState
    window.history.pushState(null, '', window.location.href);
  }
};

onMounted(() => {
  // Tambahkan langkah ke history agar event popstate bisa dipicu
  window.history.pushState(null, '', window.location.href);
  window.addEventListener('popstate', confirmGoHome);
});

onUnmounted(() => {
  window.removeEventListener('popstate', confirmGoHome);
});
</script>

<template>
  <main class="bg-white min-h-screen">
    <Head title="Transaksi berhasil" />

    <section class="max-w-[480px] p-4">
      <div class="flex flex-col justify-center items-center translate-y-[20vh]">
        <div class="w-[40%] overflow-hidden relative">
          <img src="/assets/images/check.webp" alt="berhasil" />
        </div>
        <div class="text-center mt-8 px-8">
          <h1 class="text-primary text-xl font-bold">
            Pesanan Berhasil Dibuat
          </h1>
          <p class="text-textDark text-sm">
            Silahkan lakukan pembayaran dan ambil pesananmu ditempat
          </p>
        </div>
        <div class="w-full mt-4">
          <button
            @click="
              $inertia.visit(
                '/detail-transaksi/' + $page.props.order.transaction_code
              )
            "
            class="bg-primary w-full py-3 mt-4 rounded-full cursor-pointer hover:brightness-90 duration-300"
          >
            <p class="font-bold">Lihat Detail Transaksi</p>
          </button>
          <p class="text-textDark text-sm text-center mt-4">
            Ada pertanyaan?
            <Link
              href="/pusat-bantuan"
              class="text-primary hover:underline cursor-pointer"
            >
              Hubungi Penjual
            </Link>
          </p>
        </div>
      </div>
    </section>
  </main>
</template>
