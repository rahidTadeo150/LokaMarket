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
               class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                      {{ request()->routeIs('cust.landingPage')
                          ? 'sidebar-menu-active'
                          : 'sidebar-menu-default' }}">

                <i class="fa-solid fa-house w-5 text-center"></i>
                <span>Beranda</span>
            </a>
            <a href="{{route('cust.kategori') }}"
               class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                      {{ request()->routeIs('cust.kategori')
                          ? 'sidebar-menu-active'
                          : 'sidebar-menu-default' }}">

                <i class="fa-solid fa-layer-group w-5 text-center"></i>
                <span>Kategori</span>
            </a>
            <a href="{{ route('cust.pilihanProduk') }}"
               class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                      {{ request()->routeIs('cust.pilihanProduk')
                          ? 'sidebar-menu-active'
                          : 'sidebar-menu-default' }}">

                <i class="fa-solid fa-box-open w-5 text-center"></i>
                <span>Pilihan Produk</span>
            </a>
            <a href="{{ route('cust.caraKerja') }}"
               class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                      {{ request()->routeIs('cust.caraKerja')
                          ? 'sidebar-menu-active'
                          : 'sidebar-menu-default' }}">

                <i class="fa-solid fa-circle-question w-5 text-center"></i>

                <span>Cara Kerja</span>
            </a>
            <a href="{{ route('cust.tentangKami') }}"
               class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
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
    <div class="w-full px-3 sm:px-4">
        <div class="flex h-16 items-center justify-between gap-2 sm:h-20 md:h-16">
            <div class="flex items-center">
                {{-- Hamburger --}}
                <button class="flex h-10 w-10 shrink-0 items-center justify-center text-xl md:hidden"
                        onclick="openSidebar()">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <a href=""
                    class="inline-flex">
                    <img src="{{ asset('storage/logo-lokamarket.png') }}" 
                        alt=""
                        class="w-32 sm:w-40 md:w-44">
                </a>
            </div>
            <div class="flex min-w-0 items-center gap-2 sm:gap-5 md:gap-x-10">
                {{-- Menu --}}
                <div class="hidden md:flex items-center gap-5 text-gray-600 font-medium text-sm">
                    <a href="{{ route('cust.landingPage') }}"
                        class="{{ request()->routeIs('cust.landingPage') ? 'state-navbar-user' : 'hover-navbar-user' }}">
                        Beranda
                    </a>
                    <a href="{{ route('cust.kategori') }}"
                        class="{{ request()->routeIs('cust.kategori') ? 'state-navbar-user' : 'hover-navbar-user' }}">
                        Kategori
                    </a>
                    <a href="{{ route('cust.pilihanProduk') }}"
                        class="{{ request()->routeIs('cust.pilihanProduk') ? 'state-navbar-user' : 'hover-navbar-user' }}">
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
                @auth
                <div class="flex items-center gap-2 sm:gap-3">
                    {{-- Keranjang --}}
                    <a href=""
                        class="relative flex h-10 w-10 items-center justify-center rounded-full
                            text-gray-600 transition-all duration-200
                            hover:bg-orange-50 hover:text-orange-600">
                        <i class="fa-solid fa-cart-shopping text-lg"></i>
                        <span class="absolute -right-0.5 -top-0.5 flex h-5 min-w-5
                                    items-center justify-center rounded-full
                                    bg-orange-500 px-1 text-[10px] font-bold text-white">
                            0
                        </span>
                    </a>
                    {{-- Profile --}}
                    <div class="relative">
                        <button type="button"
                                onclick="toggleProfileMenu()"
                                class="flex items-center gap-2 rounded-full px-2 py-1.5 transition-all duration-200 hover:bg-gray-50">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-linear-to-br from-[#F2600C] to-[#FDB813] text-sm font-bold text-white shadow-sm">
                               {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </div>
                            <div class="hidden lg:block text-left">
                                <p class="max-w-28 truncate text-xs font-semibold text-gray-800">
                                    {{ Auth::user()->username }}
                                </p>
                                <p class="text-[10px] text-gray-400">
                                    {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                                </p>
                            </div>
                            <i class="fa-solid fa-chevron-down hidden text-[10px] text-gray-400 lg:block"></i>
                        </button>

                        {{-- Dropdown Profile --}}
                        <div id="profileMenu"
                            class="absolute right-0 top-16 hidden w-52 rounded-2xl border border-gray-100 bg-white p-2 shadow-xl">
                            <a href="{{ route('cust.myProfile') }}"
                            class="flex items-center gap-3 rounded-xl px-3 py-2.5
                                    text-sm text-gray-600 transition hover:bg-orange-50 hover:text-orange-600">

                                <i class="fa-solid fa-user w-5 text-center"></i>

                                <span>Profil Saya</span>
                            </a>
                            <a href=""
                            class="flex items-center gap-3 rounded-xl px-3 py-2.5
                                    text-sm text-gray-600 transition hover:bg-orange-50 hover:text-orange-600">

                                <i class="fa-solid fa-box w-5 text-center"></i>

                                <span>Pesanan Saya</span>
                            </a>
                            <div class="my-1 border-t border-gray-100"></div>
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5
                                            text-sm text-red-500 transition hover:bg-red-50">

                                    <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth
                @guest
                {{-- Tombol Daftar --}}
                <a href="{{ route('cust.login') }}"
                    class="shrink-0 whitespace-nowrap rounded-full bg-linear-to-br from-[#F2600C] to-[#FDB813] px-3 py-2 text-xs font-semibold text-white shadow-sm transition-all duration-200 hover:translate-y-0.5 hover:bg-blue-700 hover:shadow-md sm:px-4 sm:text-sm">
                    Daftar Customer
                </a>
                @endguest
            </div>
        </div>
    </div>
</nav>