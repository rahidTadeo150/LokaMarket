{{-- Sidebar Overlay --}}
<div id="sidebarBackdrop"
     class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300"
     onclick="closeSidebar()">
</div>

{{-- Sidebar --}}
<aside id="sidebarOverlay"
       class="fixed top-0 left-0 z-51 h-screen w-72 bg-white shadow-2xl
              -translate-x-full transition-transform duration-300 ease-in-out
              md:hidden">
    <div class="flex h-20 items-center justify-between px-5">
        <a href="{{ route('cust.landingPage') }}">
            <img src="{{ asset('storage/logo-lokamarket.png') }}"
                 alt="LokaMarket"
                 class="w-36">
        </a>
        <button onclick="closeSidebar()"
                class="flex h-9 w-9 items-center justify-center rounded-full
                       text-gray-500 transition hover:bg-gray-100 hover:text-red-500">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
    </div>

    {{-- Menu Sidebar --}}
    <div class="px-4 py-6">
        <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-gray-400">
            Menu
        </p>
        <div class="space-y-1">
            <a href="{{ route('cust.landingPage') }}"
               class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium
                      transition-all duration-200
                      {{ request()->routeIs('cust.landingPage')
                          ? 'sidebar-menu-active'
                          : 'sidebar-menu-default' }}">

                <i class="fa-solid fa-house w-5 text-center"></i>
                <span>Beranda</span>
            </a>
            <a href="#"
               class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium
                      text-gray-600 transition-all duration-200
                      hover:bg-orange-50 hover:text-orange-600">

                <i class="fa-solid fa-layer-group w-5 text-center"></i>
                <span>Kategori</span>
            </a>
            <a href="#"
               class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium
                      text-gray-600 transition-all duration-200
                      hover:bg-orange-50 hover:text-orange-600">

                <i class="fa-solid fa-box-open w-5 text-center"></i>
                <span>Pilihan Produk</span>
            </a>
            <a href="{{ route('cust.caraKerja') }}"
               class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium
                      transition-all duration-200
                      {{ request()->routeIs('cust.caraKerja')
                          ? 'sidebar-menu-active'
                          : 'sidebar-menu-default' }}">

                <i class="fa-solid fa-circle-question w-5 text-center"></i>

                <span>Cara Kerja</span>
            </a>
            <a href="{{ route('cust.tentangKami') }}"
               class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium
                      transition-all duration-200
                      {{ request()->routeIs('cust.tentangKami')
                          ? 'sidebar-menu-active'
                          : 'sidebar-menu-default' }}">
                <i class="fa-solid fa-circle-info w-5 text-center"></i>
                <span>Tentang Kami</span>
            </a>
        </div>
    </div>
</aside>
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="w-full px-4">
        <div class="flex items-center justify-between h-20 md:h-16">
            <div class="flex items-center">
                {{-- Hamburger --}}
                <button class="text-xl md:hidden"
                        onclick="openSidebar()">
                    <i class="fa-solid fa-bars"></i>
                </button>

                {{-- Logo --}}
                <a href=""
                    class="inline-flex">
                    <img src="{{ asset('storage\logo-lokamarket.png') }}" 
                        alt=""
                        class="w-44">
                </a>
            </div>

            <div class="flex items-center gap-x-10">
                {{-- Menu --}}
                <div class="hidden md:flex items-center gap-5 text-gray-600 font-medium text-sm">
                    <a href="{{ route('cust.landingPage') }}"
                        class="{{ request()->routeIs('cust.landingPage') ? 'state-navbar-user' : 'hover-navbar-user' }}">
                        Beranda
                    </a>
                    <a href=""
                        class="hover-navbar-user">
                        Kategori
                    </a>
                    <a href=""
                        class="hover-navbar-user">
                        Pilihan Produk
                    </a>
                    <a href="{{ route('cust.caraKerja') }}"
                        class="{{ request()->routeIs('cust.caraKerja') ? 'state-navbar-user' : 'hover-navbar-user' }}">
                        Cara Kerja
                    </a>
                    <a href="{{ route('cust.tentangKami') }}"
                        class="{{ request()->routeIs('cust.tentangKami') ? 'state-navbar-user' : 'hover-navbar-user' }}">
                        Tentang Kami
                    </a>
                </div>

                {{-- Tombol Daftar --}}
                <a href="{{ route('cust.login') }}"
                    class="rounded-full bg-linear-to-br from-[#F2600C] to-[#FDB813] px-4 py-2 font-semibold text-sm text-white shadow-sm transition-all duration-200 hover:translate-y-0.5 hover:bg-blue-700 hover:shadow-md">
                    Daftar Customer
                </a>
            </div>

        </div>
    </div>
</nav>