<script setup>
import { computed, ref } from 'vue';
import { Head, router, useForm, usePage } from '@inertiajs/vue3';
import { konversiStatus } from '@/lib/utils';
import { push } from 'notivue';
import { useClipboard } from '@vueuse/core';
const { props } = usePage();
const order = props.order;
const OrderStatus = computed(() => konversiStatus(order.status));
const goBack = () => {
  const referrer = document.referrer;
  if (referrer && referrer.includes(window.location.hostname)) {
    window.history.back();
  } else {
    router.visit('/transaksi');
  }
};

const form = useForm({
  bukti_pembayaran: null,
});

const submitBukti = () => {
  form.post(`/upload-bukti/${order.id}`, {
    preserveScroll: true,
    onSuccess: () => {
      push.success('Berhasil upload!');
      fileName.value = '';
      form.bukti_pembayaran = null;
      router.visit(usePage().url);
    },
  });
};

const fileName = ref('');
const showModal = ref(false);
const updateFileName = (event) => {
  form.bukti_pembayaran = event.target.files[0];
  const file = event.target.files[0];
  fileName.value = file ? file.name : '';
};
const openModal = () => {
  showModal.value = true;
};
const closeModal = () => {
  showModal.value = false;
};

// Copy To Clipboard
const copied = ref(false);
const { copy } = useClipboard();
const copyToClipboard = (text) => {
  if (!copied.value && copy(text)) {
    copied.value = true;
    push.success({
      title: 'Sistem',
      message: 'Kode transaksi tersalin!',
      duration: 1500,
    });
    setTimeout(() => {
      copied.value = false;
    }, 1500);
  }
};
</script>

<template>
  <div class="bg-bgGray min-h-screen pb-4">
    <Head title="Detail Transaksi" />
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
          Detail Transaksi
        </h1>
      </div>
    </section>
    <section class="mt-2 p-4">
      <h1 class="text-textDark text-lg font-semibold">Informasi Pesanan</h1>
      <div class="bg-white mt-4 p-4 rounded-2xl">
        <div class="flex flex-col gap-4">
          <div
            v-for="orderItem in order.items"
            :key="orderItem.id"
            class="flex items-center gap-4"
          >
            <div
              class="w-[calc(50%-56px)] h-[12vh] sm:w-[8vw] rounded-2xl overflow-hidden relative"
            >
              <img
                :src="orderItem.item.image"
                class="absolute top-0 left-0 w-full h-full object-cover"
                alt=""
              />
            </div>
            <div class="max-w-[480px]">
              <h1 class="line-clamp-1">
                {{ orderItem.item.name }}
              </h1>
              <h2 class="font-bold">
                Rp{{ Number(orderItem.price).toLocaleString('id-ID') }}
              </h2>
              <p class="text-xs text-textDark mt-1">
                x{{ orderItem.quantity }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="px-4">
      <div v-if="order.notes">
        <label class="text-textDark">Catatan</label>
        <div
          class="relative mt-2 py-3 px-4 ps-12 block w-full bg-white rounded-full"
        >
          <span class="text-textGrayDark">{{ order?.notes }}</span>
          <div
            class="absolute inset-y-0 start-0 flex items-center ps-4 translate-y-1"
          >
            <p class="text-textDark text-xl">
              <i class="fi fi-rr-edit"></i>
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="p-4">
      <div class="bg-white p-4 rounded-2xl">
        <div class="">
          <p class="text-textDark font-semibold">Kode Transaksi</p>
          <div
            class="flex justify-between bg-bgGray pt-3 pb-1.5 px-4 mt-2 rounded-2xl"
          >
            <p class="text-textDark font-bold">
              {{ order.transaction_code }}
            </p>
            <button
              @click="() => copyToClipboard(order.transaction_code)"
              class="text-textDark text-2xl cursor-pointer"
            >
              <i :class="copied ? 'fi fi-rr-check' : 'fi fi-rr-duplicate'"></i>
            </button>
          </div>
        </div>
        <div class="flex justify-between mt-2">
          <p class="text-textDark">Waktu Pemesanan</p>
          <p class="text-textDark">
            {{ new Date(order.created_at).toLocaleString('id-ID') }}
          </p>
        </div>
        <div class="flex justify-between">
          <p class="text-textDark">Status</p>
          <p class="text-primary">{{ OrderStatus }}</p>
        </div>
        <div class="flex justify-between">
          <p class="text-textDark">Metode Pembayaran</p>
          <p class="text-textDark">
            {{ order.payment_method.toLocaleUpperCase() }}
          </p>
        </div>
      </div>
    </section>
    <section class="px-4">
      <div
        class="flex justify-between bg-white w-full mt-2 py-3 px-4 rounded-full"
      >
        <p class="text-textDark font-bold">Total</p>
        <p class="text-textDark font-bold">
          Rp{{ Number(order.total_amount).toLocaleString('id-ID') }}
        </p>
      </div>
    </section>
    <template
      v-if="
        (order.status === 'unpaid' || order.status === 'rejected') &&
        order.payment_method === 'qris'
      "
    >
      <section class="px-4">
        <button
          type="button"
          class="bg-primary w-full py-3 mt-4 rounded-full cursor-pointer hover:brightness-90 duration-300"
          @click="openModal"
        >
          <p class="text-textDark font-bold">Bayar Sekarang</p>
        </button>
      </section>
      <section class="mt-4 px-4">
        <div>
          <label for="uploadBuktiPembayaran" class="text-textDark">
            <p><span class="text-secondary">*</span> Upload Bukti Pembayaran</p>
          </label>
          <div class="relative mt-2">
            <input
              type="file"
              id="uploadBuktiPembayaran"
              class="hidden"
              @change="updateFileName($event)"
            />
            <label
              for="uploadBuktiPembayaran"
              class="flex items-center gap-2 w-full bg-white rounded-full cursor-pointer shadow-sm"
            >
              <span
                class="bg-bgGray py-3 px-4 rounded-l-full text-textDark w-[50%]"
                >Choose File</span
              >
              <span class="text-textGrayDark pr-4 line-clamp-1 w-full">{{
                fileName || 'or drag file here'
              }}</span>
            </label>
            <div class="flex justify-end">
              <button
                type="submit"
                @click="submitBukti"
                class="bg-primary py-3 px-8 mt-4 rounded-full cursor-pointer hover:brightness-90 duration-300"
              >
                <p class="text-textDark font-bold">Submit</p>
              </button>
            </div>
          </div>
        </div>
      </section>
    </template>

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
        class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 scale-100 sm:scale-75 bg-white w-[80%] max-w-[480px] py-8 px-6 rounded-4xl shadow-lg text-center z-30"
      >
        <div class="flex justify-between">
          <img src="/assets/images/qris.svg" class="h-6" alt="qris" />
          <p class="text-textDark text-2xl cursor-pointer" @click="closeModal">
            <i class="fi fi-rr-cross-small"></i>
          </p>
        </div>
        <div class="mt-8">
          <img src="/assets/images/qris.webp" alt="QRIS SPW PPLG" />
          <p class="text-start text-textDark font-bold mt-4">
            Total Bayar: Rp{{
              Number(order.total_amount).toLocaleString('id-ID')
            }}
          </p>
        </div>
        <div class="mt-4">
          <a
            href="/assets/images/qris.webp"
            download="QRIS SPW PPLG.png"
            class="flex justify-center gap-2 bg-primary w-full py-3 rounded-full cursor-pointer hover:brightness-90 duration-300"
          >
            <i class="fi fi-br-download"></i>
            <span class="text-textDark font-bold">Download QR</span>
          </a>
        </div>
      </div>
    </Transition>
  </div>
</template>
