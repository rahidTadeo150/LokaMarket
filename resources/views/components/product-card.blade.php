<a href="{{ $link }}"
    class="group block overflow-hidden rounded-2xl border border-[#F1DCC8] bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
    <div class="relative overflow-hidden bg-[#FFF3E5]">
        <img src="{{ $thumbnailImage }}"
            alt="{{ $nama }}"
            class="h-56 w-full object-cover transition duration-500 group-hover:scale-105">

        {{-- Discount --}}
        @if($diskon)
            <span class="absolute left-3 top-3 rounded-full bg-[#FF6B00] px-3 py-1 text-xs font-bold text-white shadow-sm">
                Promo {{ $diskon }}%
            </span>
        @endif
        <button type="button"
                onclick="event.preventDefault()"
                class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full bg-white/90 text-[#72594B] shadow-sm backdrop-blur transition hover:bg-[#FF6B00] hover:text-white">
            <i class="fa-regular fa-heart"></i>
        </button>
    </div>
    <div class="p-4">
        <div class="mb-2 flex items-center gap-2">
            <span class="rounded-full bg-[#FFF0E5] px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-[#C1440E]">
                {{ $kategori }}
            </span>
            <span class="text-xs text-[#A58C7D]">
                {{ $lokasi }}
            </span>
        </div>
        <p class="line-clamp-2 min-h-12 text-[15px] font-bold leading-6 text-[#3B2115]">
            {{ $nama }}
        </p>
        <div class="mt-2 flex items-center gap-1">
            <i class="fa-solid fa-star text-xs text-[#FF9F1C]"></i>
            <span class="text-xs font-semibold text-[#3B2115]">
                {{ $rating }}
            </span>
            <span class="text-xs text-[#A58C7D]">
                ({{ $reviews }})
            </span>
        </div>
        <div class="mt-4">
            <div class="flex items-center justify-between gap-2">
                <p class="text-lg font-bold text-[#C1440E]">
                    Rp{{ $harga }}
                </p>
                <button type="button"
                        onclick="event.preventDefault()"
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FF6B00] text-white transition hover:bg-[#E85D00]">
                    <i class="fa-solid fa-cart-shopping text-sm"></i>
                </button>
            </div>
        </div>
    </div>
</a>
