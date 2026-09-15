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
                <h2 class="text-base font-bold text-[#3B2115] sm:text-lg">
                    @yield('page-heading', 'Dashboard')
                </h2>
            </div>

        </div>


        <div class="flex items-center gap-2">

            <button type="button"
                    class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 text-[#72594B] transition hover:bg-orange-50 hover:text-orange-500">
                <i class="fa-regular fa-bell text-sm"></i>
                <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
            </button>

            <div class="mx-1 hidden h-8 w-px bg-orange-100 sm:block"></div>

            <button type="button"
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

                <i class="fa-solid fa-chevron-down ml-1 hidden text-[9px] text-[#A58E81] md:block"></i>

            </button>

        </div>

    </div>

</header>