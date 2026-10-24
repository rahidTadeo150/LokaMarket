<div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-[#3B2115]/40 backdrop-blur-sm lg:hidden"></div>

{{-- SIDEBAR --}}
<aside id="adminSidebar"
    class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col border-r border-orange-100 bg-white transition-transform duration-300 lg:translate-x-0">

    <div class="flex h-20 items-center border-b border-orange-100 px-5">

        <div>
            <h1 class="text-lg font-extrabold leading-none text-[#3B2115]">
                Loka<span class="text-orange-500">Market</span>
            </h1>
            <p class="mt-1 text-[9px] font-semibold uppercase tracking-[0.18em] text-[#A58E81]">
                Admin Panel
            </p>
        </div>

        <button id="closeSidebar"
            type="button"
            class="ml-auto flex h-9 w-9 items-center justify-center rounded-lg text-[#8D776A] hover:bg-orange-50 hover:text-orange-500 lg:hidden">
            <i class="fa-solid fa-xmark"></i>
        </button>

    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-4 py-5">

        <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.16em] text-[#A58E81]">
            Menu Utama
        </p>

        <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-admin-active' : 'sidebar-admin-default' }}">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/15' : 'bg-orange-50 text-orange-500' }}">
                <i class="fa-solid fa-chart-pie text-xs"></i>
            </span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.pengguna') }}"
            class="{{ request()->routeIs('admin.pengguna') ? 'sidebar-admin-active' : 'sidebar-admin-default' }}">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.pengguna') ? 'bg-white/15' : 'bg-orange-50 text-orange-500 group-hover:bg-white' }}">
                <i class="fa-solid fa-users text-xs"></i>
            </span>
            <span>Pengguna</span>
        </a>    

        <a href="{{ route('admin.withdraw') }}"
            class="{{ request()->routeIs('admin.withdraw') ? 'sidebar-admin-active' : 'sidebar-admin-default' }}">
            <div class="flex items-center gap-3">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.withdraw') ? 'bg-white/15' : 'bg-orange-50 text-orange-500 group-hover:bg-white' }}">
                    <i class="fa-solid fa-file-circle-check text-xs"></i>
                </span>
                <span>Withdraw</span>
            </div>
            <span class="flex h-5 min-w-5 items-center justify-center rounded-full {{ request()->routeIs('admin.withdraw') ? 'bg-white/20 text-white' : 'bg-orange-100 text-orange-600' }} px-1.5 text-[9px] font-bold">
                12
            </span>
        </a>

        <a href="{{ route('admin.pengajuanToko') }}"
            class="{{ request()->routeIs('admin.pengajuanToko*') ? 'sidebar-admin-active' : 'sidebar-admin-default' }}">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.pengajuanToko*') ? 'bg-white/15' : 'bg-orange-50 text-orange-500 group-hover:bg-white' }}">
                <i class="fa-solid fa-chart-pie text-xs"></i>
            </span>
            <span>Pengajuan Toko</span>
        </a>

        <a href="{{ route('admin.pengajuanReturn') }}"
            class="{{ request()->routeIs('admin.pengajuanReturn*') ? 'sidebar-admin-active' : 'sidebar-admin-default' }}">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.pengajuanReturn*') ? 'bg-white/15' : 'bg-orange-50 text-orange-500 group-hover:bg-white' }}">
                <i class="fa-solid fa-chart-pie text-xs"></i>
            </span>
            <span>Pengajuan Return</span>
        </a>

        <div class="my-5 border-t border-orange-100"></div>

        <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.16em] text-[#A58E81]">
            Sistem
        </p>

        <a href="#"
            class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-admin-active' : 'sidebar-admin-default' }}">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/15' : 'bg-orange-50 text-orange-500 group-hover:bg-white' }}">
                <i class="fa-solid fa-gear text-xs"></i>
            </span>
            <span>Pengaturan</span>
        </a>

        <a href="#"
            class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-admin-active' : 'sidebar-admin-default' }}">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/15' : 'bg-orange-50 text-orange-500 group-hover:bg-white' }}">
                <i class="fa-solid fa-circle-question text-xs"></i>
            </span>
            <span>Bantuan</span>
        </a>

    </nav>

    <div class="shrink-0 border-t border-orange-100 p-4">

        <div class="flex items-center gap-3 rounded-2xl bg-[#FFF9F2] p-3">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-500 text-sm font-bold text-white">
                A
            </div>

            <div class="min-w-0 flex-1">
                <p class="truncate text-xs font-bold text-[#3B2115]">
                    Admin LokaMarket
                </p>
                <p class="truncate text-[10px] text-[#A58E81]">
                    admin@lokamarket.id
                </p>
            </div>

            <button type="button"
                class="flex h-8 w-8 items-center justify-center rounded-lg text-[#8D776A] hover:bg-white hover:text-orange-500">
                <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
            </button>

        </div>

    </div>

</aside>