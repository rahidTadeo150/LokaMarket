<div class="space-y-6">
    {{-- Category Filter --}}
    <div>
        <h4 class="mb-3 text-sm font-bold text-[#3B2115]">Kategori</h4>
        <div class="space-y-2">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-orange-500">
                <span class="text-sm text-[#72594B]">Makanan & Minuman</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-orange-500">
                <span class="text-sm text-[#72594B]">Kerajinan Tangan</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-orange-500">
                <span class="text-sm text-[#72594B]">Fashion</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-orange-500">
                <span class="text-sm text-[#72594B]">Kecantikan</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-orange-500">
                <span class="text-sm text-[#72594B]">Rumah Tangga</span>
            </label>
        </div>
    </div>

    <div class="border-t border-[#F1DCC8]"></div>

    {{-- Price Range Filter --}}
    <div>
        <h4 class="mb-3 text-sm font-bold text-[#3B2115]">Harga</h4>
        <div class="space-y-2">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="radio" name="price" class="w-4 h-4 text-orange-500" value="all">
                <span class="text-sm text-[#72594B]">Semua Harga</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="radio" name="price" class="w-4 h-4 text-orange-500" value="0-50000">
                <span class="text-sm text-[#72594B]">Rp 0 - Rp 50.000</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="radio" name="price" class="w-4 h-4 text-orange-500" value="50000-100000">
                <span class="text-sm text-[#72594B]">Rp 50.000 - Rp 100.000</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="radio" name="price" class="w-4 h-4 text-orange-500" value="100000-500000">
                <span class="text-sm text-[#72594B]">Rp 100.000 - Rp 500.000</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="radio" name="price" class="w-4 h-4 text-orange-500" value="500000+">
                <span class="text-sm text-[#72594B]">Rp 500.000+</span>
            </label>
        </div>
    </div>

    <div class="border-t border-[#F1DCC8]"></div>

    {{-- Rating Filter --}}
    <div>
        <h4 class="mb-3 text-sm font-bold text-[#3B2115]">Rating</h4>
        <div class="space-y-2">
            @foreach([5, 4, 3, 2, 1] as $star)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-orange-500">
                    <div class="flex items-center gap-1">
                        @for($i = 0; $i < $star; $i++)
                            <i class="fa-solid fa-star text-xs text-yellow-400"></i>
                        @endfor
                        <span class="text-xs text-[#8B7162] ml-1">& Ke Atas</span>
                    </div>
                </label>
            @endforeach
        </div>
    </div>

    <div class="border-t border-[#F1DCC8]"></div>

    {{-- Sort By --}}
    <div>
        <h4 class="mb-3 text-sm font-bold text-[#3B2115]">Urutkan</h4>
        <select class="w-full rounded-lg border border-[#F1DCC8] bg-white px-3 py-2 text-sm 
                  text-[#72594B] transition focus:border-[#FF6B00] focus:outline-none 
                  focus:ring-2 focus:ring-[#FFD1AD]">
            <option value="latest">Terbaru</option>
            <option value="popular">Paling Populer</option>
            <option value="price-low">Harga: Terendah</option>
            <option value="price-high">Harga: Tertinggi</option>
            <option value="rating">Rating Tertinggi</option>
        </select>
    </div>

    {{-- Action Buttons --}}
    <div class="flex gap-2 pt-4">
        <button class="flex-1 rounded-lg border border-[#F1DCC8] bg-white px-3 py-2 text-sm 
                 font-semibold text-[#72594B] transition hover:bg-[#FFF0E5]">
            Reset Filter
        </button>
        <button class="flex-1 rounded-lg bg-[#FF6B00] px-3 py-2 text-sm font-semibold 
                 text-white transition hover:bg-[#E85D00]">
            Terapkan
        </button>
    </div>
</div>
