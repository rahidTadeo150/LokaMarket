<header class="sticky top-0 z-30 h-20 border-b border-orange-100 bg-white/95 backdrop-blur">

    <div class="flex h-full items-center justify-between px-4 sm:px-6 lg:px-8">

        <div class="flex items-center gap-3">
            <button id="openSidebar"
                    type="button"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 bg-white text-[#72594B] transition hover:bg-orange-50 hover:text-orange-500 lg:hidden">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div>
                <p class="hidden text-[10px] font-medium text-[#A58E81] sm:block">
                    LokaMarket Admin
                </p>
                <p class="text-base font-bold text-[#3B2115] sm:text-lg">
                    @yield('page-heading', 'Dashboard')
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            
            <button type="button"
                    class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 text-[#72594B] transition hover:bg-orange-50 hover:text-orange-500">
                <i class="fa-regular fa-bell text-sm"></i>
                <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
            </button>

            <div class="mx-1 hidden h-8 w-px bg-orange-100 sm:block"></div>

            <div id="adminProfileWrapper"
                class="relative">

                <button id="adminProfileButton"
                        type="button"
                        aria-expanded="false"
                        aria-controls="adminProfileDropdown"
                        class="flex items-center gap-2 rounded-xl p-1.5 transition hover:bg-orange-50 sm:px-2">

                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-orange-100 text-xs font-bold text-orange-600">
                        A
                    </div>

                    <div class="hidden text-left md:block">
                        <p class="text-xs font-bold text-[#3B2115]">
                            Admin
                        </p>
                        <p class="text-[10px] text-[#A58E81]">
                            Administrator
                        </p>
                    </div>

                    <i id="adminProfileChevron" class="fa-solid fa-chevron-down ml-1 hidden text-[9px] text-[#A58E81] transition-transform duration-200 md:block"></i>

                </button>

                <div id="adminProfileDropdown"
                    class="absolute right-0 top-15 shadow-lg z-50 hidden w-64 origin-top-right">

                    <div class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-[0_15px_45px_rgba(59,33,21,0.12)]">

                        <div class="border-b border-orange-50 bg-linear-to-br from-[#FFF9F4] to-white p-4">
                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-[#D9490B] text-sm font-bold text-white shadow-sm">
                                    A
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-extrabold text-[#3B2115]">
                                        Admin
                                    </p>
                                    <p class="truncate text-[10px] text-[#A58E81]">
                                        admin@lokamarket.test
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-2">

                            <a href="#"
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 transition hover:bg-orange-50">

                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-50 text-orange-500 transition group-hover:bg-white">
                                    <i class="fa-regular fa-user text-xs"></i>
                                </span>

                                <span class="flex-1">
                                    <span class="block text-xs font-bold text-[#3B2115]">
                                        Profil Saya
                                    </span>
                                    <span class="block text-[9px] text-[#A58E81]">
                                        Kelola informasi akun
                                    </span>
                                </span>

                                <i class="fa-solid fa-chevron-right text-[8px] text-[#C7B5AA]"></i>

                            </a>

                            <a href="#"
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 transition hover:bg-orange-50">

                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-50 text-orange-500 transition group-hover:bg-white">
                                    <i class="fa-solid fa-gear text-xs"></i>
                                </span>

                                <span class="flex-1">
                                    <span class="block text-xs font-bold text-[#3B2115]">
                                        Pengaturan
                                    </span>
                                    <span class="block text-[9px] text-[#A58E81]">
                                        Pengaturan administrator
                                    </span>
                                </span>

                                <i class="fa-solid fa-chevron-right text-[8px] text-[#C7B5AA]"></i>

                            </a>

                        </div>

                        <div class="border-t border-orange-50 p-2">

                            <form action="{{ route('auth.logout') }}"
                                id="logoutForm"
                                method="POST">

                                @csrf

                                <button type="button"
                                        class="openLogoutModal group flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left transition hover:bg-red-50">

                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-500 transition group-hover:bg-white">
                                        <i class="fa-solid fa-right-from-bracket text-xs"></i>
                                    </span>

                                    <span class="flex-1">
                                        <span class="block text-xs font-bold text-red-600">
                                            Keluar
                                        </span>
                                        <span class="block text-[9px] text-red-400">
                                            Keluar dari akun admin
                                        </span>
                                    </span>

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</header>

<x-alert-logout/>