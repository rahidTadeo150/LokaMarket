<nav class="fixed z-50 w-full border-b border-[#F1DCC8] bg-white shadow-lg">
    <div class="mx-auto flex h-16 max-w-360 items-center justify-between gap-3 px-4 sm:h-[76px] sm:px-10 lg:px-14">
        <a href="{{ route('cust.landingPage') }}" aria-label="Kembali ke halaman utama LokaMarket">
            <img src="{{ asset('storage/logo-lokamarket.png') }}" alt="LokaMarket" class="h-10 w-auto sm:h-12">
        </a>
        @if (request()->routeIs('cust.login'))
            <div class="flex shrink-0 items-center gap-2 text-[10px] sm:gap-4 sm:text-xs">
                <span class="hidden text-[#72594B] sm:inline">
                    Belum punya akun?
                </span>
                <a href="{{ route('cust.register') }}"
                    class="rounded-full border border-[#D9490B] px-4 py-2 font-semibold text-[#C1440E] transition hover:bg-[#FFF0E5] sm:px-7 sm:py-2.5">
                    Daftar
                </a>
            </div>
        @elseif (request()->routeIs('cust.register'))
            <div class="flex items-center gap-3">
                <span class="hidden text-sm text-slate-600 sm:inline">
                    Sudah punya akun?
                </span>
                <a href="{{ route('cust.login') }}"
                    class="rounded-full border border-[#D34E0E] px-6 py-2 text-sm font-semibold text-[#D34E0E] transition hover:bg-orange-50">
                    Masuk
                </a>
            </div>
        @endif
    </div>
</nav>