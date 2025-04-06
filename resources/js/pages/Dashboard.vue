<template>
    <RootLayout>
        <Head title="Dasbor" />

        <div class="flex flex-col flex-1 md:pl-[120px] pb-[80px] md:pb-[0px]">
            <div class="w-full min-h-[calc(100vh-144px)]">
                <div class="flex flex-col w-full px-4 py-4 lg:flex-row">
                    <div class="flex flex-col w-full py-2 lg:w-7/12 z-[2]">
                        <!---->
                        <div
                            class="relative flex flex-col items-center w-full p-4 mb-4 md:flex-row md:p-8 bg-primary-800 rounded-xl"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                aria-hidden="true"
                                class="absolute top-0 right-0 w-6 h-6 m-4 text-white cursor-pointer"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            <div class="w-full md:w-3/5">
                                <h1
                                    class="flex flex-row items-center text-xl font-medium title"
                                >
                                    <svg
                                        class="w-6 h-6 mr-2"
                                        width="32"
                                        height="32"
                                        viewBox="0 0 32 32"
                                        fill="none"
                                    >
                                        <path
                                            opacity="0.5"
                                            d="M29.1174 14.8345L28.812 18.0825C28.308 23.4318 28.056 26.1078 26.4787 27.7198C24.904 29.3332 22.5414 29.3332 17.8134 29.3332H14.1867C9.46002 29.3332 7.09735 29.3332 5.52002 27.7198C3.94269 26.1065 3.69202 23.4318 3.18802 18.0825L2.88136 14.8345C2.64136 12.2852 2.52136 11.0092 2.95869 10.4825C3.06863 10.3452 3.20485 10.2312 3.35939 10.1472C3.51393 10.0631 3.68367 10.0108 3.85869 9.99317C4.49336 9.93717 5.28936 10.8438 6.88269 12.6572C7.70669 13.5958 8.11869 14.0638 8.57736 14.1372C8.83354 14.1771 9.09579 14.1351 9.32669 14.0172C9.75202 13.8038 10.0334 13.2238 10.6 12.0652L13.5827 5.95317C14.652 3.7625 15.1867 2.6665 16 2.6665C16.8134 2.6665 17.348 3.7625 18.4174 5.95317L21.4 12.0652C21.9654 13.2252 22.248 13.8038 22.6734 14.0172C22.908 14.1358 23.1667 14.1772 23.4227 14.1372C23.8814 14.0638 24.2934 13.5958 25.1174 12.6572C26.7107 10.8438 27.5067 9.93717 28.1414 9.99317C28.3164 10.0108 28.4861 10.0631 28.6407 10.1472C28.7952 10.2312 28.9314 10.3452 29.0414 10.4825C29.4774 11.0092 29.3574 12.2852 29.1174 14.8345Z"
                                            fill="url(#paint0_linear_737_15807)"
                                        ></path>
                                        <path
                                            d="M17.2693 16.9317L17.1387 16.697C16.632 15.7877 16.3787 15.333 16 15.333C15.6213 15.333 15.368 15.7863 14.8613 16.697L14.7307 16.9317C14.5867 17.1903 14.5147 17.3183 14.4027 17.4037C14.2893 17.489 14.1493 17.521 13.8693 17.5837L13.616 17.6423C12.632 17.865 12.14 17.9757 12.0227 18.3517C11.9053 18.729 12.2413 19.121 12.912 19.905L13.0853 20.1077C13.276 20.3303 13.372 20.441 13.4147 20.5797C13.4573 20.7183 13.4427 20.8663 13.4147 21.1637L13.388 21.4343C13.2867 22.481 13.236 23.005 13.5413 23.237C13.848 23.469 14.3093 23.257 15.2307 22.833L15.468 22.7237C15.7307 22.6037 15.8613 22.5423 16 22.5423C16.1387 22.5423 16.2693 22.6037 16.532 22.7237L16.7693 22.833C17.6907 23.2583 18.152 23.469 18.4587 23.237C18.7653 23.005 18.7133 22.481 18.612 21.4343L18.5853 21.1637C18.5573 20.8663 18.5427 20.7183 18.5853 20.5797C18.628 20.4423 18.724 20.3303 18.9147 20.1077L19.088 19.905C19.7587 19.121 20.0947 18.729 19.9773 18.3517C19.86 17.9757 19.368 17.865 18.384 17.6423L18.1307 17.5837C17.8507 17.521 17.7107 17.4903 17.5973 17.4037C17.4853 17.3183 17.4133 17.1903 17.2693 16.9317Z"
                                            fill="url(#paint1_linear_737_15807)"
                                        ></path>
                                        <defs>
                                            <linearGradient
                                                id="paint0_linear_737_15807"
                                                x1="2.86805"
                                                y1="2.35119"
                                                x2="33.2809"
                                                y2="6.8565"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop
                                                    stop-color="#E3FFD3"
                                                ></stop>
                                                <stop
                                                    offset="1"
                                                    stop-color="#FFF59C"
                                                ></stop>
                                            </linearGradient>
                                            <linearGradient
                                                id="paint1_linear_737_15807"
                                                x1="12.0603"
                                                y1="15.2384"
                                                x2="21.1847"
                                                y2="16.5902"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop
                                                    stop-color="#E3FFD3"
                                                ></stop>
                                                <stop
                                                    offset="1"
                                                    stop-color="#FFF59C"
                                                ></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    #Premium Member
                                </h1>
                                <p
                                    class="mt-2 text-xs font-bold text-primary-800 bg-gradient-to-r from-[#E3FFD3] to-[#FFF59C] px-2 py-1 rounded-full w-fit"
                                >
                                    EXPIRED
                                </p>
                                <p class="mt-2 text-sm text-white">
                                    Masa aktif premium kamu sudah habis nih,
                                    silahkan beli lagi biar tetep bisa pake
                                    fitur premiumnya.
                                </p>
                                <button
                                    class="px-4 py-2 mt-4 text-sm font-bold bg-white text-primary-800 rounded-xl"
                                >
                                    Beli Lagi
                                </button>
                            </div>
                            <div
                                class="hidden w-full p-0 mt-4 h-fill md:w-2/5 md:pl-4 md:block md:mt-0 justify-right"
                            >
                                <img
                                    src="/assets/menus-b8ecccc3.png"
                                    class="object-cover w-auto h-fill max-h-[160px] ml-auto"
                                />
                            </div>
                        </div>
                        <div
                            class="flex flex-col w-full p-4 bg-white rounded-2xl lg:p-6 h-fit"
                        >
                            <h1 class="w-full text-xl font-medium text-dart">
                                Statistik
                            </h1>
                            <div
                                class="grid w-full grid-cols-1 gap-4 mt-4 md:grid-cols-2"
                            >
                                <div
                                    class="px-4 py-4 md:col-span-2 w-100 bg-primary-100 rounded-2xl text-primary-900"
                                >
                                    <span class="flex flex-row font-medium"
                                        ><img
                                            src="/assets/chef-hat-5fdf9b93.svg"
                                            alt="ChefHat"
                                            class="w-6 h-6 mr-2"
                                        />
                                        Menu Saat Ini
                                        <!----></span
                                    >
                                    <h1 class="mt-2 text-2xl font-medium">
                                        1 / 50
                                    </h1>
                                </div>
                                <div
                                    class="px-4 py-4 bg-primary-50 rounded-2xl text-primary-900"
                                >
                                    <span class="flex flex-row font-medium"
                                        ><img
                                            src="/assets/scanner-bc81d85d.svg"
                                            alt="scanner"
                                            class="w-6 h-6 mr-2"
                                        />
                                        Pengunjung Hari Ini</span
                                    >
                                    <h1 class="mt-2 text-2xl font-medium">1</h1>
                                </div>
                                <div
                                    class="px-4 py-4 bg-primary-50 rounded-2xl text-primary-900"
                                >
                                    <span class="flex flex-row font-medium"
                                        ><img
                                            src="/assets/money-b4ffc8e5.svg"
                                            alt="scanner"
                                            class="w-6 h-6 mr-2"
                                        />
                                        Pendapatan</span
                                    >
                                    <h1 class="mt-2 text-2xl font-medium">
                                        Rp&nbsp;0
                                    </h1>
                                </div>
                            </div>
                            <h1
                                class="w-full mt-8 text-xl font-medium text-dart"
                            >
                                Link
                            </h1>
                            <div
                                class="grid w-full grid-cols-1 gap-4 mt-4 md:grid-cols-2"
                            >
                                <a
                                    class="px-4 py-4 bg-primary-100 rounded-2xl"
                                    href="https://cashier.daftarmenu.com/"
                                    target="_blank"
                                >
                                    <div
                                        class="flex flex-row justify-between w-full"
                                    >
                                        <h1
                                            class="flex-1 text-lg font-medium text-primary-800"
                                        >
                                            Kasir
                                        </h1>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            aria-hidden="true"
                                            class="w-6 h-6 text-primary-800"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M8.25 3.75H19.5a.75.75 0 01.75.75v11.25a.75.75 0 01-1.5 0V6.31L5.03 20.03a.75.75 0 01-1.06-1.06L17.69 5.25H8.25a.75.75 0 010-1.5z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </div>
                                    <p class="mt-1 text-sm text-primary-800">
                                        https://cashier.daftarmenu.com/
                                    </p> </a
                                ><a
                                    class="px-4 py-4 bg-primary-50 rounded-2xl text-primary-900"
                                    href="https://waiter.daftarmenu.com/"
                                    target="_blank"
                                >
                                    <div
                                        class="flex flex-row justify-between w-full"
                                    >
                                        <h1
                                            class="flex-1 text-lg font-medium text-primary-800"
                                        >
                                            Pelayan
                                        </h1>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            aria-hidden="true"
                                            class="w-6 h-6 text-primary-800"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M8.25 3.75H19.5a.75.75 0 01.75.75v11.25a.75.75 0 01-1.5 0V6.31L5.03 20.03a.75.75 0 01-1.06-1.06L17.69 5.25H8.25a.75.75 0 010-1.5z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </div>
                                    <p class="mt-1 text-sm text-primary-800">
                                        https://waiter.daftarmenu.com/
                                    </p>
                                </a>
                            </div>
                            <h1
                                class="w-full mt-8 text-xl font-medium text-dart"
                            >
                                Grafik Pengunjung
                            </h1>
                            <canvas
                                style="
                                    display: block;
                                    box-sizing: border-box;
                                    height: 379px;
                                    width: 759px;
                                "
                                width="949"
                                height="474"
                            ></canvas>
                        </div>
                    </div>
                    <div
                        class="flex flex-col items-center w-full py-2 lg:w-5/12 lg:pl-4 lg:fixed lg:top-0 lg:right-0 lg:mt-20"
                    >
                        <div
                            class="flex items-center justify-between px-4 py-2 space-x-4 bg-white max-h-14 rounded-2xl grow lg:mx-16 h-fit"
                        >
                            <a
                                id="targetCopy"
                                class="flex-1 text-xs font-medium underline text-primary-800 decoration-solid"
                                href="https://catalog.daftarmenu.com/hexatea"
                                target="_blank"
                                rel="noopener noreferrer"
                                >catalog.daftarmenu.com/hexatea</a
                            ><img
                                src="/assets/copy-08153016.svg"
                                class="w-6 h-6 cursor-pointer"
                            /><img
                                src="/assets/qr-aeccd806.svg"
                                class="w-6 h-6 cursor-pointer"
                            />
                        </div>
                        <div
                            class="relative mt-4 h-fit w-fit lg:mx-16 bg-gray-50"
                        >
                            <img
                                src="/assets/device-646b3de2.png"
                                class="xl:max-h-[700px] 2xl:max-h-[800px] relative z-[2] aspect-[128/261]"
                                title="device-preview"
                            /><iframe
                                id="preview"
                                scrolling="no"
                                class="absolute bottom-0 mx-4 z-[1] border-0 outline-0 overflow-hidden h-[calc(100%-70px)] mb-3 w-[calc(100%-32px)] flex flex-col bg-gray-100"
                                src="https://catalog.daftarmenu.com/hexatea"
                            ></iframe>
                            <div
                                class="bg-[#213f12] h-full w-full absolute top-0 scale-x-[0.9] scale-y-[0.98]"
                            ></div>
                        </div>
                    </div>
                    <!---->
                </div>
            </div>
            <div
                class="flex flex-col items-center justify-center py-4 bg-gray-50 print:hidden"
            >
                <p class="mt-1 mt-2 text-xs font-medium text-primary-800">
                    ©2023 - PT.Sawarga Digital Indonesia
                </p>
                <p class="mt-1 mt-2 text-xs font-semibold text-primary-800">
                    v2.2.5
                </p>
            </div>
            <!----><!----><!---->
        </div>
        <DashboardNav />
    </RootLayout>
</template>

<script setup>
import DashboardNav from "@/components/DashboardNav.vue";
import RootLayout from "@/layouts/RootLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>
