@props(['categories' => [], 'selectedCategories' => [], 'sort' => 'default'])

<form method="GET" action="{{ route('cust.pilihanProduk') }}" class="space-y-6">
    <div>
        <h4 class="mb-3 text-sm font-bold text-[#3B2115]">Kategori</h4>
        <div class="flex flex-wrap items-center gap-2.5">
            @foreach ($categories as $category)
                @php
                    $isActive = in_array($category, $selectedCategories, true);
                @endphp
                <label class="cursor-pointer">
                    <input
                        type="radio"
                        name="category[]"
                        value="{{ $category }}"
                        @checked($isActive)
                        class="peer sr-only"
                    >
                    <span class="inline-flex min-h-[36px] items-center justify-center rounded-full border border-[#E9D7C9] bg-white px-3 py-2 text-xs font-semibold text-[#3B2115] shadow-sm transition duration-200 peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF1E5] peer-checked:text-[#C1440E] peer-checked:shadow-md hover:border-[#FFB778]">
                        {{ $category }}
                    </span>
                </label>
            @endforeach
        </div>
    </div>

    <div class="border-t border-[#F1DCC8]"></div>

    <div>
        <h4 class="mb-3 text-sm font-bold text-[#3B2115]">Urutkan</h4>
        <select
            name="sort"
            class="w-full rounded-full border border-[#F1DCC8] bg-white px-4 py-3 text-sm text-[#72594B] transition focus:border-[#FF6B00] focus:outline-none focus:ring-2 focus:ring-[#FFD1AD]"
        >
            <option value="default" @selected($sort === 'default')>Terbaru</option>
            <option value="price_low" @selected($sort === 'price_low')>Harga: Terendah</option>
            <option value="price_high" @selected($sort === 'price_high')>Harga: Tertinggi</option>
        </select>
    </div>

    <div class="flex gap-2 pt-4">
        <a href="{{ route('cust.pilihanProduk') }}" class="flex-1 rounded-full border border-[#F1DCC8] bg-white px-3 py-3 text-center text-sm font-semibold text-[#72594B] transition hover:bg-[#FFF0E5]">
            Reset Filter
        </a>
        <button type="submit" class="flex-1 rounded-full bg-[#FF6B00] px-3 py-3 text-sm font-semibold text-white transition hover:bg-[#E85D00]">
            Terapkan
        </button>
    </div>
</form>
