<template>
    <RootLayout>
        <div class="flex flex-col flex-1 md:pl-[120px] pb-[80px] md:pb-[0px]">
            <div class="w-full min-h-[calc(100vh-144px)]">
                <div
                    class="flex flex-col items-center w-full px-4 py-4 lg:flex-col"
                >
                    <div
                        class="flex flex-col w-full p-4 bg-white rounded-2xl lg:p-6 h-fit min-h-[calc(100vh-180px)]"
                    >
                        <div class="mb-4 border-b-2 border-gray-50 relative">
                            <nav
                                class="flex justify-between w-full sm:justify-start space-x-6 sm:w-fit -mb-[2px]"
                                aria-label="Tabs"
                            >
                                <p
                                    :class="tabClass('menu')"
                                    @click="activeTab = 'menu'"
                                    aria-current="page"
                                >
                                    Menu Restoran
                                </p>
                                <p
                                    @click="activeTab = 'category'"
                                    :class="tabClass('category')"
                                >
                                    Kategori Menu
                                </p>
                            </nav>
                        </div>
                        <div v-show="activeTab === 'menu'">
                            <div class="flex flex-col">
                                <div
                                    class="flex flex-col justify-between order-1 mt-4 mb-4 md:items-center md:flex-row md:order-0"
                                >
                                    <form
                                        class="flex-1 hidden mb-2 md:flex md:mb-0 md:mr-4"
                                    >
                                        <div
                                            class="flex w-full md:max-w-[500px] rounded-lg bg-gray-100 px-4 py-3 justify-between items-center"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                fill="currentColor"
                                                aria-hidden="true"
                                                class="w-5 h-5 mr-4 text-gray-500"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z"
                                                    clip-rule="evenodd"
                                                ></path></svg
                                            ><input
                                                placeholder="Cari menu..."
                                                type="search"
                                                inputmode="search"
                                                class="flex flex-1 p-0 m-0 text-sm bg-gray-100 focus:border-gray-50 focus:ring-gray-50 border-gray-50 ring-gray-50 outline-0 focus:outline-0"
                                            />
                                        </div>
                                        <button type="submit" class="hidden">
                                            Search
                                        </button>
                                    </form>
                                    <div
                                        class="flex justify-between md:space-x-4 md:justify-normal min-w-[300px]"
                                    >
                                        <button
                                            class="flex-row items-center justify-center flex-1 hidden py-2 pl-2 text-sm font-bold text-center rounded-lg shadow md:flex md:shrink-0 bg-primary-50 text-primary-500"
                                        >
                                            <svg
                                                width="25"
                                                height="24"
                                                viewBox="0 0 25 24"
                                                class="w-6 h-6 mr-2 fill-primary-500"
                                            >
                                                <path
                                                    opacity="0.5"
                                                    d="M11.053 13.447C10.629 13.023 10.103 12.851 9.518 12.772C8.965 12.698 8.268 12.698 7.432 12.698H6.327C5.747 12.698 5.262 12.698 4.868 12.735C4.457 12.775 4.073 12.859 3.722 13.075C3.377 13.285 3.088 13.575 2.877 13.919C2.661 14.271 2.577 14.654 2.537 15.066C2.5 15.459 2.5 15.944 2.5 16.525V16.593C2.5 17.477 2.5 18.19 2.555 18.763C2.611 19.355 2.73 19.871 3.014 20.334C3.302 20.804 3.696 21.198 4.166 21.486C4.629 21.77 5.145 21.889 5.736 21.946C6.31 22 7.024 22 7.907 22H7.977C8.557 22 9.041 22 9.435 21.963C9.847 21.923 10.23 21.839 10.582 21.623C10.926 21.413 11.215 21.123 11.426 20.778C11.642 20.427 11.726 20.043 11.766 19.632C11.803 19.238 11.803 18.753 11.803 18.172V17.068C11.803 16.232 11.803 15.535 11.729 14.982C11.65 14.398 11.477 13.871 11.053 13.447ZM9.434 2.037C9.846 2.077 10.229 2.161 10.581 2.377C10.925 2.587 11.214 2.877 11.425 3.222C11.641 3.573 11.725 3.957 11.765 4.368C11.802 4.762 11.802 5.247 11.802 5.828V6.932C11.802 7.768 11.802 8.465 11.728 9.018C11.649 9.602 11.477 10.129 11.053 10.553C10.629 10.977 10.103 11.149 9.518 11.228C8.965 11.302 8.268 11.302 7.432 11.302H6.327C5.747 11.302 5.262 11.302 4.868 11.265C4.457 11.225 4.073 11.141 3.722 10.925C3.37771 10.7143 3.08816 10.425 2.877 10.081C2.661 9.729 2.577 9.346 2.537 8.934C2.5 8.54 2.5 8.056 2.5 7.475V7.407C2.5 6.523 2.5 5.81 2.555 5.237C2.611 4.645 2.73 4.129 3.014 3.666C3.302 3.196 3.696 2.802 4.166 2.514C4.629 2.23 5.145 2.111 5.736 2.054C6.31 2 7.024 2 7.907 2H7.977C8.557 2 9.041 2 9.435 2.037H9.434ZM17.093 2H17.025C16.445 2 15.96 2 15.565 2.037C15.155 2.077 14.771 2.161 14.419 2.377C14.075 2.587 13.786 2.877 13.575 3.222C13.359 3.573 13.275 3.957 13.235 4.368C13.198 4.762 13.198 5.247 13.198 5.828V6.932C13.198 7.768 13.198 8.465 13.272 9.018C13.351 9.602 13.523 10.129 13.947 10.553C14.371 10.977 14.897 11.149 15.482 11.228C16.035 11.302 16.732 11.302 17.568 11.302H18.673C19.253 11.302 19.738 11.302 20.132 11.265C20.543 11.225 20.927 11.141 21.278 10.925C21.623 10.715 21.912 10.425 22.123 10.081C22.339 9.729 22.423 9.346 22.463 8.934C22.5 8.54 22.5 8.056 22.5 7.475V7.407C22.5 6.523 22.5 5.81 22.445 5.237C22.389 4.645 22.27 4.129 21.986 3.666C21.6983 3.19647 21.3035 2.80171 20.834 2.514C20.371 2.23 19.855 2.111 19.264 2.054C18.69 2 17.977 2 17.093 2Z"
                                                ></path>
                                                <path
                                                    opacity="0.4"
                                                    d="M14.593 21.302C14.593 21.4871 14.5195 21.6646 14.3886 21.7955C14.2577 21.9264 14.0801 22 13.895 22C13.7099 22 13.5324 21.9264 13.4015 21.7955C13.2706 21.6646 13.197 21.4871 13.197 21.302V18.512H14.593V21.302Z"
                                                ></path>
                                                <path
                                                    opacity="0.5"
                                                    d="M21.802 12.698C21.6172 12.6983 21.4401 12.7718 21.3094 12.9024C21.1788 13.0331 21.1052 13.2102 21.105 13.395V16.651H22.5V13.395C22.4997 13.2101 22.4261 13.0328 22.2952 12.9021C22.1643 12.7714 21.9869 12.698 21.802 12.698Z"
                                                ></path>
                                                <path
                                                    d="M16.576 16.617C16.5 16.801 16.5 17.034 16.5 17.5C16.5 17.966 16.5 18.199 16.576 18.383C16.6777 18.6275 16.8723 18.8217 17.117 18.923C17.301 19 17.534 19 18 19C18.466 19 18.699 19 18.883 18.924C19.1275 18.8223 19.3217 18.6277 19.423 18.383C19.5 18.199 19.5 17.966 19.5 17.5C19.5 17.034 19.5 16.801 19.424 16.617C19.3223 16.3725 19.1277 16.1783 18.883 16.077C18.699 16 18.466 16 18 16C17.534 16 17.301 16 17.117 16.076C16.8725 16.1777 16.6773 16.3723 16.576 16.617Z"
                                                ></path>
                                                <path
                                                    opacity="0.7"
                                                    d="M22.4999 18.535V18.512H21.1039C21.1039 18.955 21.1039 19.252 21.0879 19.482C21.0729 19.706 21.0449 19.815 21.0149 19.887C20.9565 20.0281 20.871 20.1564 20.763 20.2645C20.6551 20.3726 20.527 20.4584 20.3859 20.517C20.3139 20.546 20.2059 20.573 19.9809 20.589C19.7509 20.604 19.4539 20.605 19.0109 20.605H17.1509V22H19.0339C19.4479 22 19.7929 22 20.0759 21.98C20.3649 21.9686 20.6501 21.9095 20.9199 21.805C21.5464 21.5453 22.0443 21.0475 22.3039 20.421C22.4159 20.151 22.4599 19.872 22.4799 19.577C22.4999 19.294 22.4999 18.949 22.4999 18.535Z"
                                                ></path>
                                                <path
                                                    opacity="0.6"
                                                    d="M13.197 16.616V16.651H14.593C14.593 15.983 14.593 15.535 14.628 15.193C14.662 14.863 14.721 14.711 14.788 14.61C14.8729 14.4833 14.982 14.3745 15.109 14.29C15.21 14.222 15.363 14.162 15.693 14.129C16.035 14.094 16.483 14.093 17.151 14.093H19.011V12.698H17.115C16.492 12.698 15.973 12.698 15.552 12.741C15.112 12.785 14.702 12.883 14.334 13.129C14.054 13.316 13.815 13.555 13.628 13.835C13.382 14.203 13.285 14.612 13.24 15.052C13.197 15.473 13.197 15.992 13.197 16.616Z"
                                                ></path>
                                                <path
                                                    d="M6.00805 18.69C6.22705 18.845 6.53605 18.845 7.15405 18.845C7.77305 18.845 8.08205 18.845 8.30005 18.69C8.37744 18.6354 8.44505 18.5681 8.50005 18.491C8.65405 18.273 8.65405 17.964 8.65405 17.345C8.65405 16.727 8.65405 16.418 8.49905 16.199C8.44435 16.122 8.37708 16.0547 8.30005 16C8.08205 15.845 7.77305 15.845 7.15405 15.845C6.53605 15.845 6.22705 15.845 6.00805 16C5.93093 16.055 5.86365 16.1226 5.80905 16.2C5.65405 16.418 5.65405 16.727 5.65405 17.345C5.65405 17.964 5.65405 18.273 5.80905 18.491C5.86395 18.5685 5.93157 18.6361 6.00905 18.691L6.00805 18.69ZM7.15405 8.15503C6.53605 8.15503 6.22705 8.15503 6.00805 8.00003C5.93092 7.94506 5.86364 7.87744 5.80905 7.80003C5.65405 7.58303 5.65405 7.27303 5.65405 6.65503C5.65405 6.03603 5.65405 5.72703 5.80905 5.50903C5.86394 5.43154 5.93156 5.36391 6.00905 5.30903C6.22705 5.15503 6.53605 5.15503 7.15405 5.15503C7.77305 5.15503 8.08205 5.15503 8.30005 5.31003C8.37746 5.36461 8.44508 5.43189 8.50005 5.50903C8.65405 5.72703 8.65405 6.03603 8.65405 6.65503C8.65405 7.27303 8.65405 7.58303 8.49905 7.80103C8.44438 7.87808 8.37711 7.94536 8.30005 8.00003C8.08205 8.15503 7.77305 8.15503 7.15405 8.15503ZM16.7001 8.00003C16.9181 8.15503 17.2271 8.15503 17.8461 8.15503C18.4641 8.15503 18.7731 8.15503 18.9921 8.00003C19.0691 7.94533 19.1364 7.87806 19.1911 7.80103C19.3461 7.58303 19.3461 7.27303 19.3461 6.65503C19.3461 6.03603 19.3461 5.72703 19.1911 5.50903C19.1361 5.43156 19.0685 5.36394 18.9911 5.30903C18.7731 5.15503 18.4641 5.15503 17.8461 5.15503C17.2271 5.15503 16.9181 5.15503 16.7001 5.31003C16.6227 5.36464 16.5551 5.43192 16.5001 5.50903C16.3461 5.72703 16.3461 6.03603 16.3461 6.65503C16.3461 7.27303 16.3461 7.58303 16.5011 7.80103C16.5558 7.87806 16.623 7.94533 16.7001 8.00003Z"
                                                ></path>
                                            </svg>
                                            Kode QR</button
                                        ><a
                                            href="/menu/add"
                                            class="flex flex-row items-center justify-center py-2 pl-2 pr-4 text-sm font-bold text-center text-white rounded-lg shadow md:flex-1 w-fit md:shrink-0 bg-primary-500"
                                            ><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                fill="currentColor"
                                                aria-hidden="true"
                                                class="w-6 h-6 mr-2 fill-white"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                            Tambah Menu</a
                                        ><button
                                            class="flex items-center justify-center px-4 py-3 rounded-lg md:hidden bg-gray-100 w-fit"
                                        >
                                            <span class="hidden">Search</span
                                            ><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                fill="currentColor"
                                                aria-hidden="true"
                                                class="w-5 h-5 text-gray-500"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-row justify-between w-full md:space-y-0 order-0 md:order-1"
                                >
                                    <div class="flex flex-col">
                                        <h1
                                            class="text-xl font-medium md:mb-0 text-dart"
                                        >
                                            Daftar Menu
                                        </h1>
                                        <p class="text-sm text-gray-500">
                                            Menampilkan 1 dari 1 menu
                                        </p>
                                    </div>
                                    <select
                                        id="filter"
                                        name="filter"
                                        title="filter"
                                        class="px-4 py-2 text-xs font-normal bg-white border border-gray-100 h-fit rounded-lg w-[100px] lg:w-[150px] ring-0 focus:ring-0 outline-0 focus:outline-0 text-dark"
                                    >
                                        <option value="true">Aktif</option>
                                        <option value="false">
                                            Tidak Aktif
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div
                                class="grid w-full grid-cols-1 gap-4 mt-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 3xl:grid-cols-5"
                            >
                                <!---->
                                <div
                                    class="overflow-hidden flex items-center justify-between p-2 bg-white shadow-[1px_1px_8px_0px_rgba(180,180,180,0.39)] cursor-pointer rounded-xl"
                                >
                                    <img
                                        src="https://api.daftarmenu.com/dashboard/file/img_products/54fa628c510d8f4a938e9751e01a1f66.jpg"
                                        class="mr-4 bg-gray-100 rounded-lg object-cover h-[68px] w-[68px]"
                                    />
                                    <div class="flex items-center flex-1">
                                        <div class="flex flex-col flex-1">
                                            <div
                                                class="flex flex-wrap space-x-2"
                                            >
                                                <h1
                                                    class="px-2 py-1 text-xs font-medium rounded-full text-primary-800 bg-primary-50 w-fit"
                                                >
                                                    Drink
                                                </h1>
                                                <h1
                                                    class="px-0 py-1 text-[10px] font-medium bg-white rounded-full text-amber-500 w-fit"
                                                >
                                                    Recommended
                                                </h1>
                                            </div>
                                            <h1
                                                class="text-base font-medium text-dark line-clamp-1"
                                            >
                                                Vanilla Tea
                                            </h1>
                                            <h1
                                                class="mt-[6px] text-sm font-medium text-dark"
                                            >
                                                Rp&nbsp;5.000
                                            </h1>
                                        </div>
                                        <div class="flex flex-col">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                fill="currentColor"
                                                aria-hidden="true"
                                                class="w-6 h-6 text-dark"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <!---->
                            </div>
                        </div>
                        <div
                            v-show="activeTab === 'category'"
                            class="flex flex-col items-center justify-center md:mt-4"
                        >
                            <div
                                class="flex flex-col justify-between w-full mb-4 md:items-center md:flex-row"
                            >
                                <form class="flex-1 mb-2 md:mb-0 md:mr-4">
                                    <div
                                        class="flex w-full md:max-w-[500px] rounded-lg bg-gray-100 px-4 py-3 justify-between items-center"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            aria-hidden="true"
                                            class="w-5 h-5 mr-4 text-gray-500"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z"
                                                clip-rule="evenodd"
                                            ></path></svg
                                        ><input
                                            placeholder="Cari kategori..."
                                            type="search"
                                            inputmode="search"
                                            class="flex flex-1 p-0 m-0 text-sm bg-gray-100 focus:border-gray-50 focus:ring-gray-50 border-gray-50 ring-gray-50 outline-0 focus:outline-0"
                                        />
                                    </div>
                                    <button type="submit" class="hidden">
                                        Search
                                    </button>
                                </form>
                                <div
                                    class="flex justify-between space-x-4 md:justify-normal min-w-[150px]"
                                >
                                    <button
                                        class="flex flex-row items-center justify-center flex-1 py-2 pl-2 pr-4 text-sm font-bold text-center text-white rounded-lg shadow w-fit md:shrink-0 bg-primary-500"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            aria-hidden="true"
                                            class="w-6 h-6 mr-2 fill-white"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                        Tambah Kategori
                                    </button>
                                </div>
                            </div>
                            <h1
                                class="w-full mt-4 text-xl font-medium text-dart"
                            >
                                Daftar Kategori
                            </h1>
                            <div
                                class="grid w-full grid-cols-1 gap-4 mt-4 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3"
                            >
                                <div
                                    class="bg-white px-4 md:px-6 py-4 flex justify-between shadow-[1px_1px_8px_0px_rgba(180,180,180,0.39)] rounded-xl items-center"
                                >
                                    <img
                                        src="/assets/Chiken-05fd3904.svg"
                                        class="w-6 h-6 mr-4"
                                    />
                                    <h1
                                        class="flex-1 p-0 m-0 text-sm font-medium text-black bg-transparent md:text-base"
                                    >
                                        Main Course
                                    </h1>
                                    <img
                                        src="/assets/category-edit-5927e797.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><img
                                        src="/assets/category-delete-4ee429bf.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><!---->
                                </div>
                                <div
                                    class="bg-white px-4 md:px-6 py-4 flex justify-between shadow-[1px_1px_8px_0px_rgba(180,180,180,0.39)] rounded-xl items-center"
                                >
                                    <img
                                        src="/assets/appetizer-0775f31d.svg"
                                        class="w-6 h-6 mr-4"
                                    />
                                    <h1
                                        class="flex-1 p-0 m-0 text-sm font-medium text-black bg-transparent md:text-base"
                                    >
                                        Appetizer
                                    </h1>
                                    <img
                                        src="/assets/category-edit-5927e797.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><img
                                        src="/assets/category-delete-4ee429bf.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><!---->
                                </div>
                                <div
                                    class="bg-white px-4 md:px-6 py-4 flex justify-between shadow-[1px_1px_8px_0px_rgba(180,180,180,0.39)] rounded-xl items-center"
                                >
                                    <img
                                        src="/assets/soup-e96c11b0.svg"
                                        class="w-6 h-6 mr-4"
                                    />
                                    <h1
                                        class="flex-1 p-0 m-0 text-sm font-medium text-black bg-transparent md:text-base"
                                    >
                                        Soup
                                    </h1>
                                    <img
                                        src="/assets/category-edit-5927e797.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><img
                                        src="/assets/category-delete-4ee429bf.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><!---->
                                </div>
                                <div
                                    class="bg-white px-4 md:px-6 py-4 flex justify-between shadow-[1px_1px_8px_0px_rgba(180,180,180,0.39)] rounded-xl items-center"
                                >
                                    <img
                                        src="/assets/dessert-0679d2fd.svg"
                                        class="w-6 h-6 mr-4"
                                    />
                                    <h1
                                        class="flex-1 p-0 m-0 text-sm font-medium text-black bg-transparent md:text-base"
                                    >
                                        Dessert
                                    </h1>
                                    <img
                                        src="/assets/category-edit-5927e797.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><img
                                        src="/assets/category-delete-4ee429bf.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><!---->
                                </div>
                                <div
                                    class="bg-white px-4 md:px-6 py-4 flex justify-between shadow-[1px_1px_8px_0px_rgba(180,180,180,0.39)] rounded-xl items-center"
                                >
                                    <img
                                        src="/assets/drink-c9d09004.svg"
                                        class="w-6 h-6 mr-4"
                                    />
                                    <h1
                                        class="flex-1 p-0 m-0 text-sm font-medium text-black bg-transparent md:text-base"
                                    >
                                        Drink
                                    </h1>
                                    <img
                                        src="/assets/category-edit-5927e797.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><img
                                        src="/assets/category-delete-4ee429bf.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><!---->
                                </div>
                                <div
                                    class="bg-white px-4 md:px-6 py-4 flex justify-between shadow-[1px_1px_8px_0px_rgba(180,180,180,0.39)] rounded-xl items-center"
                                >
                                    <img
                                        src="/assets/snack-e5cb4864.svg"
                                        class="w-6 h-6 mr-4"
                                    />
                                    <h1
                                        class="flex-1 p-0 m-0 text-sm font-medium text-black bg-transparent md:text-base"
                                    >
                                        Snack
                                    </h1>
                                    <img
                                        src="/assets/category-edit-5927e797.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><img
                                        src="/assets/category-delete-4ee429bf.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><!---->
                                </div>
                                <div
                                    class="bg-white px-4 md:px-6 py-4 flex justify-between shadow-[1px_1px_8px_0px_rgba(180,180,180,0.39)] rounded-xl items-center"
                                >
                                    <img
                                        src="/assets/juice-46fb6992.svg"
                                        class="w-6 h-6 mr-4"
                                    />
                                    <h1
                                        class="flex-1 p-0 m-0 text-sm font-medium text-black bg-transparent md:text-base"
                                    >
                                        Juice
                                    </h1>
                                    <img
                                        src="/assets/category-edit-5927e797.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><img
                                        src="/assets/category-delete-4ee429bf.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><!---->
                                </div>
                                <div
                                    class="bg-white px-4 md:px-6 py-4 flex justify-between shadow-[1px_1px_8px_0px_rgba(180,180,180,0.39)] rounded-xl items-center"
                                >
                                    <img
                                        src="/assets/milkshake-88432010.svg"
                                        class="w-6 h-6 mr-4"
                                    />
                                    <h1
                                        class="flex-1 p-0 m-0 text-sm font-medium text-black bg-transparent md:text-base"
                                    >
                                        Milk Shake
                                    </h1>
                                    <img
                                        src="/assets/category-edit-5927e797.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><img
                                        src="/assets/category-delete-4ee429bf.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><!---->
                                </div>
                                <div
                                    class="bg-white px-4 md:px-6 py-4 flex justify-between shadow-[1px_1px_8px_0px_rgba(180,180,180,0.39)] rounded-xl items-center"
                                >
                                    <img
                                        src="/assets/Coffe-c5ec2363.svg"
                                        class="w-6 h-6 mr-4"
                                    />
                                    <h1
                                        class="flex-1 p-0 m-0 text-sm font-medium text-black bg-transparent md:text-base"
                                    >
                                        Coffee
                                    </h1>
                                    <img
                                        src="/assets/category-edit-5927e797.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><img
                                        src="/assets/category-delete-4ee429bf.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><!---->
                                </div>
                                <div
                                    class="bg-white px-4 md:px-6 py-4 flex justify-between shadow-[1px_1px_8px_0px_rgba(180,180,180,0.39)] rounded-xl items-center"
                                >
                                    <img
                                        src="/assets/salad-32da3cfc.svg"
                                        class="w-6 h-6 mr-4"
                                    />
                                    <h1
                                        class="flex-1 p-0 m-0 text-sm font-medium text-black bg-transparent md:text-base"
                                    >
                                        Salad
                                    </h1>
                                    <img
                                        src="/assets/category-edit-5927e797.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><img
                                        src="/assets/category-delete-4ee429bf.svg"
                                        class="w-6 h-6 ml-4 cursor-pointer"
                                    /><!---->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-col items-center justify-center py-4 bg-gray-100 print:hidden"
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
import { ref } from "vue";

const activeTab = ref("menu");
const upTopModalOpen = ref(false);
const categories = ref([
    "Main Course",
    "Appetizer",
    "Soup",
    "Dessert",
    "Drink",
    "Snack",
    "Juice",
    "Milk Shake",
    "Coffee",
    "Salad",
]);

const tabClass = (tab) =>
    `py-2 sm:flex-none flex-1 text-center sm:text-start font-medium text-sm cursor-pointer ${activeTab.value === tab ? "font-bold border-b-2 text-primary-500 border-primary-500" : "border-transparent text-gray-500"}`;
</script>

<style>
button {
    transition: all 0.2s ease-in-out;
}
</style>
