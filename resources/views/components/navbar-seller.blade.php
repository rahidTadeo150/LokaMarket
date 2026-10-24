<nav class="sticky top-0 z-50 border-b border-orange-100 bg-white">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-5 lg:px-8">

        <a href="{{ route('seller.dashboard') }}">
            <img src="{{ asset('storage/logo-lokamarket.png') }}"
                alt="LokaMarket"
                class="w-36">
        </a>

        <div class="hidden items-center gap-1 md:flex">

            <a href="{{ route('seller.dashboard') }}"
            class="flex items-center gap-2 rounded-xl px-4 py-2 text-xs transition duration-200 {{ request()->routeIs('seller.dashboard') ? 'bg-[#E85D04] text-white font-bold shadow-sm shadow-orange-200' : 'font-semibold text-[#72594B] hover:bg-[#FFF3E5] hover:text-[#E85D04]' }}">
                <i class="fa-solid fa-chart-line text-[11px]"></i>
                Dashboard
            </a>

            <a href="{{ route('seller.pesanan') }}"
            class="flex items-center gap-2 rounded-xl px-4 py-2 text-xs transition duration-200 {{ request()->routeIs('seller.pesanan*') ? 'bg-[#E85D04] text-white font-bold shadow-sm shadow-orange-200' : 'font-semibold text-[#72594B] hover:bg-[#FFF3E5] hover:text-[#E85D04]' }}">
                <i class="fa-solid fa-cart-shopping text-[11px]"></i>
                Pesanan
                @if ($jumlahPesananSeller > 0)
                    <span class="flex h-4 min-w-4 items-center justify-center rounded-full px-1 text-[8px] font-bold {{ request()->routeIs('seller.pesanan*') ? 'bg-white text-[#E85D04]' : 'bg-[#E85D04] text-white' }}">
                        {{ $jumlahPesananSeller > 99 ? '99+' : $jumlahPesananSeller }}
                    </span>
                @endif
            </a>

            <a href="{{ route('seller.produk') }}"
                class="flex items-center gap-2 rounded-xl px-4 py-2 text-xs transition duration-200 {{ request()->routeIs('seller.produk*') ? 'bg-[#E85D04] text-white font-bold shadow-sm shadow-orange-200' : 'font-semibold text-[#72594B] hover:bg-[#FFF3E5] hover:text-[#E85D04]' }}">
                <i class="fa-solid fa-box text-[11px]"></i>
                Produk
            </a>

            <a href="{{ route('seller.balance') }}"
                class="flex items-center gap-2 rounded-xl px-4 py-2 text-xs transition duration-200 {{ request()->routeIs('seller.balance*') ? 'bg-[#E85D04] text-white font-bold shadow-sm shadow-orange-200' : 'font-semibold text-[#72594B] hover:bg-[#FFF3E5] hover:text-[#E85D04]' }}">
                <i class="fa-solid fa-wallet text-[11px]"></i>
                My Balance
            </a>

            <a href="{{ route('seller.laporan') }}"
                class="flex items-center gap-2 rounded-xl px-4 py-2 text-xs transition duration-200 {{ request()->routeIs('seller.laporan*') ? 'bg-[#E85D04] text-white font-bold shadow-sm shadow-orange-200' : 'font-semibold text-[#72594B] hover:bg-[#FFF3E5] hover:text-[#E85D04]' }}">
                <i class="fa-solid fa-chart-column text-[11px]"></i>
                Laporan
            </a>

        </div>

        <div class="flex items-center gap-3">

            <button type="button"
                class="relative flex h-9 w-9 items-center justify-center rounded-full text-[#72594B] transition hover:bg-[#FFF3E5] hover:text-[#E85D04]">
                <i class="fa-regular fa-bell text-sm"></i>
                <span class="absolute right-1.5 top-1.5 h-1.5 w-1.5 rounded-full bg-[#E85D04]"></span>
            </button>

            <div class="hidden h-7 w-px bg-orange-100 sm:block"></div>

            @auth
                <div id="sellerProfileWrapper" class="relative">

                    <button id="sellerProfileButton"
                            type="button"
                            aria-expanded="false"
                            aria-controls="sellerProfileDropdown"
                            class="flex items-center gap-2 rounded-full p-1 transition hover:bg-[#FFF9F4]">

                        <div class="hidden text-right sm:block">
                            <p class="max-w-32 truncate text-[11px] font-bold text-[#3B2115]">
                                {{ Auth::user()->toko?->nama_toko ?? Auth::user()->username }}
                            </p>

                            <p class="text-[9px] text-[#A58C7D]">
                                {{ Auth::user()->role === 'pemilik_toko'
                                    ? 'Pemilik Toko'
                                    : ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                            </p>
                        </div>

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-orange-100 bg-gradient-to-br from-[#FFF3E5] to-[#FFD5AD]">

                            @if (Auth::user()->toko?->foto_profil)
                                <img
                                    src="{{ asset('storage/' . Auth::user()->toko->foto_profil) }}"
                                    alt="Foto Toko"
                                    class="h-full w-full object-cover"
                                    onerror="this.style.display='none'">
                            @elseif (Auth::user()->foto_profil)
                                <img
                                    src="{{ asset('storage/' . Auth::user()->foto_profil) }}"
                                    alt="Foto Profil"
                                    class="h-full w-full object-cover"
                                    onerror="this.style.display='none'">
                            @else
                                <span class="text-sm font-bold text-[#E85D04]">
                                    {{ strtoupper(substr(Auth::user()->username ?? 'U', 0, 1)) }}
                                </span>
                            @endif
                        </div>

                        <i
                            id="sellerProfileChevron"
                            class="fa-solid fa-chevron-down hidden text-[9px] text-[#A58C7D] transition-transform duration-200 sm:block">
                        </i>
                    </button>

                    <div id="sellerProfileDropdown"
                        class="absolute right-0 top-12 z-50 hidden w-72 overflow-hidden rounded-2xl border border-orange-100 bg-white p-2 shadow-xl">

                        <div class="relative overflow-hidden border-b border-orange-100 px-3 py-4">
                            
                            <div class="pointer-events-none absolute -right-6 -top-8 h-20 w-20 rounded-full bg-orange-100/70 blur-2xl"></div>

                            <div class="relative flex items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-linear-to-br from-[#FF9A3D] to-[#E85D04] text-base font-bold uppercase text-white shadow-sm shadow-orange-200">
                                    {{ strtoupper(substr(Auth::user()->username ?? 'U', 0, 1)) }}
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-bold text-[#3B2115]">
                                        {{ Auth::user()->username }}
                                    </p>

                                    <p class="mt-0.5 truncate text-[11px] text-[#8A7467]">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>

                            </div>

                            <div class="mt-3 flex items-center gap-2 rounded-xl border border-orange-100 bg-[#FFF8F1] px-3 py-2.5">
                                
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-[#E85D04] shadow-sm">
                                    <i class="fa-solid fa-store text-xs"></i>
                                </div>

                                <div class="min-w-0 flex-1">

                                    <p class="text-[9px] font-medium uppercase tracking-wider text-[#A58C7D]">
                                        Toko Anda
                                    </p>

                                    <p class="truncate text-xs font-bold text-[#3B2115]">
                                        {{ Auth::user()->toko?->nama_toko ?? 'Belum memiliki toko' }}
                                    </p>

                                </div>

                                @if (Auth::user()->toko)
                                    <span class="shrink-0 rounded-full bg-green-50 px-2 py-1 text-[9px] font-semibold text-green-700">
                                        Terdaftar
                                    </span>
                                @else
                                    <span class="shrink-0 rounded-full bg-orange-100 px-2 py-1 text-[9px] font-semibold text-orange-700">
                                        Belum ada
                                    </span>
                                @endif
                            </div>

                            <div class="mt-3 flex items-center gap-1.5">
                                <i class="fa-solid fa-shield-halved text-[10px] text-[#E85D04]"></i>
                                <span class="text-[10px] font-medium text-[#72594B]">
                                    {{ Auth::user()->role === 'pemilik_toko' ? 'Akun Pemilik Toko' : ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                                </span>
                            </div>
                        </div>

                        <a href="{{ route('seller.editToko') }}"
                        class="mt-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-[#72594B] transition hover:bg-orange-50 hover:text-[#E85D04]">
                            <i class="fa-solid fa-store w-5 text-center"></i>
                            <span>Kelola Toko</span>
                            <i class="fa-solid fa-chevron-right ml-auto text-[10px]"></i>
                        </a>

                        <div class="my-1 border-t border-gray-100"></div>

                        <form id="logoutForm"
                            action="{{ route('seller.logoutToko') }}"
                            method="POST"
                            class="px-1">

                            @csrf

                            <button type="button"
                                    data-confirm
                                    data-form="logoutForm"
                                    data-theme="red"
                                    data-title="Logout Toko?"
                                    data-message="Apakah kamu yakin ingin log out dari toko anda?"
                                    data-confirm-text="Ya, Logout"
                                    data-icon="fa-solid fa-right-from-bracket"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm text-gray-600 transition hover:bg-red-50 hover:text-red-600">
                                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                                <span>Keluar</span>
                            </button>

                        </form>
                    </div>
                </div>
            @endauth

            <button id="sellerMobileMenuButton"
                type="button"
                aria-expanded="false"
                aria-controls="mobileMenu"
                class="flex h-9 w-9 items-center justify-center rounded-lg text-[#3B2115] transition hover:bg-[#FFF3E5] md:hidden">
                <i class="fa-solid fa-bars text-sm"></i>
            </button>

        </div>

    </div>

    <div id="mobileMenu"
        class="hidden border-t border-orange-100 bg-white px-5 py-3 md:hidden">

        <div class="space-y-1">

            <a href="{{ route('seller.dashboard') }}"
            class="flex items-center gap-3 rounded-xl px-4 py-3 text-xs transition duration-200 {{ request()->routeIs('seller.dashboard') ? 'bg-[#E85D04] text-white font-bold shadow-sm' : 'font-semibold text-[#72594B] hover:bg-[#FFF3E5] hover:text-[#E85D04]' }}">
                <i class="fa-solid fa-chart-line w-4"></i>
                Dashboard
            </a>

            <a href="#"
            class="flex items-center gap-3 rounded-xl px-4 py-3 text-xs transition duration-200 {{ request()->routeIs('seller.pesanan') ? 'bg-[#E85D04] text-white font-bold shadow-sm' : 'font-semibold text-[#72594B] hover:bg-[#FFF3E5] hover:text-[#E85D04]' }}">
                <span class="flex items-center gap-3">
                    <i class="fa-solid fa-cart-shopping w-4"></i>
                    Pesanan
                </span>
                @if ($jumlahPesananSeller > 0)
                    <span class="flex h-4 min-w-4 items-center justify-center rounded-full px-1 text-[8px] font-bold {{ request()->routeIs('seller.pesanan*') ? 'bg-white text-[#E85D04]' : 'bg-[#E85D04] text-white' }}">
                        {{ $jumlahPesananSeller > 99 ? '99+' : $jumlahPesananSeller }}
                    </span>
                @endif
            </a>

            <a href="{{ route('seller.produk') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-xs transition duration-200 {{ request()->routeIs('seller.produk') ? 'bg-[#E85D04] text-white font-bold shadow-sm' : 'font-semibold text-[#72594B] hover:bg-[#FFF3E5] hover:text-[#E85D04]' }}">
                <i class="fa-solid fa-box w-4"></i>
                Produk
            </a>

            <a href="{{ route('seller.balance') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-xs transition duration-200 {{ request()->routeIs('seller.balance') ? 'bg-[#E85D04] text-white font-bold shadow-sm' : 'font-semibold text-[#72594B] hover:bg-[#FFF3E5] hover:text-[#E85D04]' }}">
                <i class="fa-solid fa-wallet w-4"></i>
                My balance
            </a>

            <a href="{{ route('seller.laporan') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-xs transition duration-200 {{ request()->routeIs('seller.laporan') ? 'bg-[#E85D04] text-white font-bold shadow-sm' : 'font-semibold text-[#72594B] hover:bg-[#FFF3E5] hover:text-[#E85D04]' }}">
                <i class="fa-solid fa-chart-column w-4"></i>
                Laporan
            </a>

        </div>

        @auth
        <div class="mt-3 border-t border-orange-100 pt-3">
            <p class="truncate text-xs font-bold text-[#3B2115]">
                {{ Auth::user()->toko?->nama_toko ?? Auth::user()->username }}
            </p>
            <p class="truncate text-[10px] text-[#72594B]">
                {{ Auth::user()->email }}
            </p>
        </div>
        @endauth
    </div>
</nav>

<x-custom-alert-confirmation/>