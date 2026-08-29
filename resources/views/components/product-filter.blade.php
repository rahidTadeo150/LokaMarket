@props(['categories' => [], 'selectedCategories' => [], 'sort' => 'default'])

<form method="GET" action="{{ route('cust.pilihanProduk') }}" class="space-y-6">
    <div>
        <h4 class="mb-3 text-sm font-bold text-[#3B2115]">Kategori</h4>
        <div class="space-y-2">
            @foreach ($categories as $category)
                <label class="flex cursor-pointer items-center gap-3">
                    <input
                        type="checkbox"
                        name="category[]"
                        value="{{ $category }}"
                        @checked(in_array($category, $selectedCategories, true))
                        class="h-4 w-4 rounded border-gray-300 text-orange-500"
                    >
                    <span class="text-sm text-[#72594B]">{{ $category }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div class="border-t border-[#F1DCC8]"></div>

    <div>
        <h4 class="mb-3 text-sm font-bold text-[#3B2115]">Urutkan</h4>
        <select
            name="sort"
            class="w-full rounded-lg border border-[#F1DCC8] bg-white px-3 py-2 text-sm text-[#72594B] transition focus:border-[#FF6B00] focus:outline-none focus:ring-2 focus:ring-[#FFD1AD]"
        >
            <option value="default" @selected($sort === 'default')>Terbaru</option>
            <option value="price_low" @selected($sort === 'price_low')>Harga: Terendah</option>
            <option value="price_high" @selected($sort === 'price_high')>Harga: Tertinggi</option>
        </select>
    </div>

    <div class="flex gap-2 pt-4">
        <a href="{{ route('cust.pilihanProduk') }}" class="flex-1 rounded-lg border border-[#F1DCC8] bg-white px-3 py-2 text-center text-sm font-semibold text-[#72594B] transition hover:bg-[#FFF0E5]">
            Reset Filter
        </a>
        <button type="submit" class="flex-1 rounded-lg bg-[#FF6B00] px-3 py-2 text-sm font-semibold text-white transition hover:bg-[#E85D00]">
            Terapkan
        </button>
    </div>
</form>
