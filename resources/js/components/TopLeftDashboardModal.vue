<template>
    <div
        role="menu"
        tabindex="0"
        class="absolute right-0 z-10 py-1 mt-2 origin-top-right bg-white rounded-xl shadow-lg w-72 ring-1 ring-black ring-opacity-5 focus:outline-hidden"
    >
        <div
            class="shrink-0 block px-4 py-4 -mt-1 border-b bg-primary-800 border-gray-50 rounded-t-xl group"
            role="none"
        >
            <div class="flex flex-row justify-between space-x-3" role="none">
                <div
                    class="w-12 h-12 overflow-hidden object-square"
                    role="none"
                >
                    <img
                        class="object-cover w-full h-full rounded-full"
                        src="https://api.daftarmenu.com/dashboard/assets/images/icon/default-image-profile.svg"
                        alt=""
                        role="none"
                    />
                </div>
                <div class="flex-1" role="none">
                    <p
                        class="text-base font-medium text-white group-hover:text-primary-50"
                        role="none"
                    >
                        Muhammad Azfa
                    </p>
                    <p
                        class="text-xs font-normal text-white group-hover:text-primary-50"
                        role="none"
                    >
                        Super Admin
                    </p>
                </div>
            </div>
        </div>
        <a
            aria-current="page"
            href="/settings"
            class="active router-link-exact-active w-full text-left block px-4 py-2 text-sm text-dark"
            role="menuitem"
            tabindex="-1"
            >Pengaturan</a
        ><a
            href="https://daftarmenu.com/help"
            target="_blank"
            rel="noopener noreferrer"
            class="w-full text-left block px-4 py-2 text-sm text-dark"
            role="menuitem"
            tabindex="-1"
            >Bantuan</a
        ><button
            class="w-full text-left block px-4 py-2 text-sm text-dark"
            role="menuitem"
            tabindex="-1"
        >
            Keluar
        </button>
        <div
            class="shrink-0 block px-4 py-2 mt-2 border-t-2 border-gray-100 border-dotted group"
            role="none"
        >
            <div
                class="flex flex-row items-center justify-center space-x-4"
                role="none"
            >
                <h1
                    class="bg-white text-sm font-medium text-dark rounded-lg px-2 py-1 cursor-pointer flex flex-row items-center"
                    role="none"
                >
                    <img
                        src="/assets/flagpack_us-79943abf.svg"
                        class="w-5 h-auto mr-2"
                        role="none"
                    />
                    <span role="none">English</span>
                </h1>
                <h1
                    class="bg-primary-50 text-sm font-medium text-dark rounded-lg px-2 py-1 cursor-pointer flex flex-row items-center"
                    role="none"
                >
                    <img
                        src="/assets/flagpack_id-47da45f2.svg"
                        class="w-5 h-auto mr-2"
                        role="none"
                    />
                    <span role="none">Indonesia</span>
                </h1>
            </div>
        </div>
    </div>
</template>
