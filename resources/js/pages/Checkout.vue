<script setup>
import { computed, ref } from 'vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { push } from 'notivue';

const page = usePage();
const carts = page.props.carts;
const total = page.props.total;
const form = useForm({
  customer_name: page.props.auth.user?.name,
  email: page.props.auth.user?.email,
  whatsapp_number: page.props.auth.user?.whatsapp_number,
  notes: '',
  payment_method: 'cash',
});

const submit = () => {
  form.post('/checkout', {
    onSuccess: () => {
      form.reset();
      push.success('Pesanan Berhasil Dibuat, Terima Kasih Telah Memesan!');
    },
    onError: (errors) => {
      console.error(errors);
      push.error('Gagal Checkout, Silahkan Periksa Kembali Data Anda');
    },
  });
};
const selectPayment = (method) => {
  form.payment_method = method;
};
const goBack = () => {
  const ref = document.referrer;
  if (ref && ref.includes(window.location.hostname)) {
    window.history.back();
    window.history.back();
  } else {
    router.visit('/');
  }
};
</script>

<template>
  <main class="bg-bgGray min-h-screen pb-20">
    <Head title="Checkout" />
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
          Checkout
        </h1>
      </div>
    </section>
    <section class="mt-2 p-4">
      <h1 class="text-textDark text-lg font-semibold">Data Pemesan</h1>
      <div class="mt-4">
        <label for="nama-pemesan" class="text-textDark"
          >Nama Pemesan <span class="text-secondary">*</span></label
        >
        <div class="relative mt-2">
          <input
            type="name"
            v-model="form.customer_name"
            id="nama-pemesan"
            class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
            placeholder="Masukkan nama pemesan"
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
      <div class="mt-4">
        <label for="email-pemesan" class="text-textDark"
          >Email Pemesan <span class="text-secondary">*</span></label
        >
        <div class="relative mt-2">
          <input
            type="email"
            v-model="form.email"
            id="email-pemesan"
            class="peer py-3 px-4 ps-12 block w-full bg-white rounded-full focus:outline-none"
            placeholder="Masukkan email pemesan"
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
      <div class="mt-4">
        <label for="nomor-whatsapp" class="text-textDark"
          >Nomor WhatsApp <span class="text-secondary">*</span></label
        >
        <div class="relative mt-2">
          <input
            type="tel"
            id="nomor-whatsapp"
            v-model="form.whatsapp_number"
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
    </section>
    <section class="mt-2 p-4">
      <h1 class="text-textDark text-lg font-semibold">Detail Pesanan</h1>
      <section class="flex flex-col gap-4 mt-4">
        <div v-for="cart in carts" class="flex items-center gap-4">
          <div
            class="w-[calc(50%-56px)] h-[12vh] sm:w-[8vw] rounded-2xl overflow-hidden relative"
          >
            <img
              :src="cart.item.image"
              class="absolute top-0 left-0 w-full h-full object-cover"
              alt=""
            />
          </div>
          <div class="max-w-[480px]">
            <h1 class="line-clamp-1">{{ cart.item.name }}</h1>
            <h2 class="font-bold">
              Rp{{ Number(cart.item.price).toLocaleString('id-ID') }}
            </h2>
            <p class="text-xs text-textDark mt-1">x{{ cart.amount }}</p>
          </div>
        </div>
      </section>

      <div class="mt-4">
        <label for="catatan" class="text-textDark">Catatan</label>
        <div class="relative mt-2">
          <input
            type="text"
            v-model="form.notes"
            id="catatan"
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
      <div class="mt-4">
        <p class="text-textDark">Metode Pembayaran</p>
        <div class="flex justify-between gap-4 mt-2 w-full">
          <div
            @click="selectPayment('cash')"
            class="w-full py-3 rounded-full border-[1.5px] text-center font-semibold cursor-pointer transition"
            :class="
              form.payment_method === 'cash'
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
              form.payment_method === 'qris'
                ? 'bg-white border-secondary text-secondary'
                : 'bg-white border-none'
            "
          >
            QRIS
          </div>
        </div>
      </div>
    </section>

    <div
      class="fixed z-10 bottom-0 left-1/2 -translate-y-4 -translate-x-1/2 w-[calc(100%-32px)] max-w-[448px] bg-white shadow-sm rounded-full flex justify-around py-2"
    >
      <div class="flex justify-between items-center w-full px-4">
        <div class="flex flex-col -space-y-0.5">
          <span class="text-textGrayDark text-xs">Total</span>
          <p class="text-textDark font-bold">
            Rp{{ Number(total).toLocaleString('id-ID') }}
          </p>
        </div>
        <button
          @click.prevent="submit"
          class="bg-primary px-6 py-3 rounded-full cursor-pointer translate-x-1.5 hover:brightness-90 duration-300"
        >
          <p class="font-semibold">Buat Pesanan</p>
        </button>
      </div>
    </div>
  </main>
</template>
