{{-- Navbar Toko --}}
<nav class="sticky top-0 z-50 border-b border-orange-100 bg-white">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-5 lg:px-8">
         <a href="{{ route('seller.dashboard') }}">
            <img src="{{ asset('storage/logo-lokamarket.png') }}"
                 alt="LokaMarket"
                 class="w-36">
        </a>
        <div class="hidden items-center gap-1 md:flex">
            <a href="#"
                class="flex items-center gap-2 rounded-lg bg-[#FFF3E5] px-4 py-2 text-xs font-bold text-[#E85D04]">
                <i class="fa-solid fa-chart-line text-[11px]"></i>
                Dashboard
            </a>
            <a href="#"
                class="flex items-center gap-2 rounded-lg px-4 py-2 text-xs font-semibold text-[#72594B] transition hover:bg-[#FFF9F4] hover:text-[#E85D04]">
                <i class="fa-solid fa-cart-shopping text-[11px]"></i>
                Pesanan
                <span class="flex h-4 min-w-4 items-center justify-center rounded-full bg-[#E85D04] px-1 text-[8px] font-bold text-white">
                    4
                </span>
            </a>
            <a href="#"
                class="flex items-center gap-2 rounded-lg px-4 py-2 text-xs font-semibold text-[#72594B] transition hover:bg-[#FFF9F4] hover:text-[#E85D04]">
                <i class="fa-solid fa-box text-[11px]"></i>
                Produk
            </a>
            <a href="#"
                class="flex items-center gap-2 rounded-lg px-4 py-2 text-xs font-semibold text-[#72594B] transition hover:bg-[#FFF9F4] hover:text-[#E85D04]">
                <i class="fa-solid fa-users text-[11px]"></i>
                keLola Toko
            </a>
            <a href="#"
                class="flex items-center gap-2 rounded-lg px-4 py-2 text-xs font-semibold text-[#72594B] transition hover:bg-[#FFF9F4] hover:text-[#E85D04]">
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
            <button type="button"
                class="flex items-center gap-2 rounded-full transition hover:bg-[#FFF9F4]">
                <div class="hidden text-right sm:block">
                    <p class="text-[11px] font-bold text-[#3B2115]">
                        Geprek WW
                    </p>
                    <p class="text-[9px] text-[#A58C7D]">
                        Pemilik Toko
                    </p>
                </div>
                <div class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full border-2 border-orange-100 bg-orange-50">
                    <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=200&q=80"
                        alt="Geprek WW"
                        class="h-full w-full object-cover">
                </div>
                <i class="fa-solid fa-chevron-down hidden text-[9px] text-[#A58C7D] sm:block"></i>
            </button>

            {{-- Mobile Menu --}}
            <button type="button"
                    onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                    class="flex h-9 w-9 items-center justify-center rounded-lg text-[#3B2115] transition hover:bg-[#FFF3E5] md:hidden">
                <i class="fa-solid fa-bars text-sm"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="hidden border-t border-orange-100 bg-white px-5 py-3 md:hidden">
        <div class="space-y-1">
            <a href="#"
                class="flex items-center gap-3 rounded-lg bg-[#FFF3E5] px-4 py-3 text-xs font-bold text-[#E85D04]">
                <i class="fa-solid fa-chart-line w-4"></i>
                Dashboard
            </a>
            <a href="#"
                class="flex items-center justify-between rounded-lg px-4 py-3 text-xs font-semibold text-[#72594B] hover:bg-[#FFF9F4]">
                <span class="flex items-center gap-3">
                    <i class="fa-solid fa-cart-shopping w-4"></i>
                    Pesanan
                </span>
                <span class="rounded-full bg-[#E85D04] px-2 py-0.5 text-[8px] font-bold text-white">
                    4
                </span>
            </a>
            <a href="#"
                class="flex items-center gap-3 rounded-lg px-4 py-3 text-xs font-semibold text-[#72594B] hover:bg-[#FFF9F4]">
                <i class="fa-solid fa-box w-4"></i>
                Produk
            </a>
            <a href="#"
                class="flex items-center gap-3 rounded-lg px-4 py-3 text-xs font-semibold text-[#72594B] hover:bg-[#FFF9F4]">
                <i class="fa-solid fa-users w-4"></i>
                Pelanggan
            </a>
            <a href="#"
                class="flex items-center gap-3 rounded-lg px-4 py-3 text-xs font-semibold text-[#72594B] hover:bg-[#FFF9F4]">
                <i class="fa-solid fa-chart-column w-4"></i>
                Laporan
            </a>
        </div>
    </div>
</nav>