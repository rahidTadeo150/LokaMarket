@props([
    'kategori' => collect(),
    'selectedKategori' => null,
    'sort' => 'default'
])

<section class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-[0_8px_30px_rgba(193,68,14,0.07)]">

    <div class="relative overflow-hidden bg-linear-to-bl from-orange-400 to-orange-600 px-5 py-5 text-white sm:px-6">
        
        <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-white/10"></div>
        <div class="absolute -bottom-8 -left-5 h-16 w-16 rounded-full bg-orange-300/20"></div>

        <div class="relative flex items-center gap-3">

            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white/15 backdrop-blur-sm ring-1 ring-white/20">
                <i class="fa-solid fa-sliders text-lg"></i>
            </div>

            <div class="min-w-0">
                <p class="text-[11px] font-medium uppercase tracking-wider text-orange-100">
                    LokaMarket
                </p>

                <h3 class="mt-0.5 text-lg font-bold">
                    Filter Produk
                </h3>

                <p class="mt-0.5 text-xs text-orange-50">
                    Temukan produk yang kamu cari
                </p>
            </div>

        </div>

    </div>


    <form method="GET"
        action="{{ route('cust.pilihanProduk') }}"
        class="p-5 sm:p-6">

        <div>
            <div class="mb-3 flex items-center justify-between">

                <div>
                    <h4 class="text-sm font-bold text-[#3B2115]">
                        Kategori
                    </h4>

                    <p class="mt-0.5 text-[11px] text-[#9A8172]">
                        Pilih kategori produk
                    </p>
                </div>

                <span class="rounded-full bg-[#FFF1E5] px-2.5 py-1 text-[10px] font-semibold text-[#C1440E]">
                    {{ $kategori->count() }}
                </span>

            </div>

            <div class="space-y-1.5">
                <label class="relative block cursor-pointer">

                    <input type="radio"
                        name="kategori"
                        value=""
                        @checked(empty($selectedKategori))
                        class="peer sr-only">

                    <span class="block rounded-2xl border border-transparent bg-white px-3 py-2.5 pr-11 transition-all peer-checked:border-[#FFD5B8] peer-checked:bg-[#FFF1E5]">
                        <span class="flex items-center gap-3">

                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#FFF7F0] text-[#A88B78]">
                                <i class="fa-solid fa-border-all text-xs"></i>
                            </span>
                            <span class="text-sm font-medium text-[#72594B]">
                                Semua Produk
                            </span>

                        </span>
                    </span>

                    <span class="absolute right-3 top-1/2 flex h-5 w-5 -translate-y-1/2 items-center justify-center rounded-full border border-[#E9D7C9] bg-white text-transparent transition-all duration-200 peer-checked:border-[#FF6B00] peer-checked:bg-[#FF6B00] peer-checked:text-white">
                        <i class="fa-solid fa-check text-[8px]"></i>
                    </span>
                    
                </label>

                @foreach ($kategori as $k)
                <label class="relative block cursor-pointer">

                    <input type="radio"
                            name="kategori"
                            value="{{ $k->slug }}"
                            @checked((string) $selectedKategori === (string) $k->slug)
                            class="peer sr-only">

                    <span class="block rounded-2xl border border-transparent bg-white px-3 py-2.5 pr-11 transition-all peer-checked:border-[#FFD5B8] peer-checked:bg-[#FFF1E5]">
                        <span class="flex items-center gap-3">

                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#FFF7F0] text-[#A88B78]">
                                <i class="fa-solid {{ $k->icon }} text-xs"></i>
                            </span>
                            <span class="truncate text-sm font-medium text-[#72594B]">
                                {{ $k->nama }}
                            </span>

                        </span>
                    </span>

                    <span class="absolute right-3 top-1/2 flex h-5 w-5 -translate-y-1/2 items-center justify-center rounded-full border border-[#E9D7C9] bg-white text-transparent transition-all duration-200 peer-checked:border-[#FF6B00] peer-checked:bg-[#FF6B00] peer-checked:text-white">
                        <i class="fa-solid fa-check text-[8px]"></i>
                    </span>

                </label>
                @endforeach

            </div>
        </div>

        <div class="my-5 h-px bg-[#F1E6DE]"></div>

        <div>
            <div class="mb-3">

                <h4 class="text-sm font-bold text-[#3B2115]">
                    Urutkan
                </h4>
                <p class="mt-0.5 text-[11px] text-[#9A8172]">
                    Atur urutan produk
                </p>

            </div>

            <div class="relative">

                <select name="sort"
                        class="w-full appearance-none rounded-2xl border border-[#E9DDD5] bg-[#FFFDFC] px-4 py-3 pr-10 text-sm font-medium text-[#72594B] outline-none transition-all hover:border-[#DCC8BB] focus:border-[#FF9A5C] focus:ring-4 focus:ring-[#FFF0E5]">

                    <option value="default" @selected($sort === 'default')}>
                        Terbaru
                    </option>
                    <option value="price_low" @selected($sort === 'price_low')}>
                        Harga Terendah
                    </option>
                    <option value="price_high" @selected($sort === 'price_high')}>
                        Harga Tertinggi
                    </option>

                </select>

                <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-[10px] text-[#A89589]"></i>

            </div>
        </div>

        <div class="mt-6 flex gap-2.5">

            <a href="{{ route('cust.pilihanProduk') }}"
                class="flex-1 rounded-2xl border border-[#E9DDD5] bg-white px-4 py-3 text-center text-xs font-semibold text-[#72594B] transition-all duration-200 hover:border-[#D8C5B8] hover:bg-[#FFF9F5]">
                Reset
            </a>

            <button type="submit"
                    class="flex-[1.5] rounded-2xl bg-[#FF6B00] px-4 py-3 text-xs font-bold text-white shadow-sm shadow-orange-200 transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#E85D00] hover:shadow-md">
                Terapkan
            </button>

        </div>

    </form>

</section>