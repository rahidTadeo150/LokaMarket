@props(['product'])

<div class="product-card group relative overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
    <div class="relative overflow-hidden bg-[#FFF5EC]">
        <div class="absolute top-3 left-3 z-10 inline-flex items-center gap-2">
            @if($product['badge'] ?? null)
                <span class="rounded-full bg-[#FF6B00] px-3 py-1 text-xs font-semibold text-white">
                    {{ $product['badge'] }}
                </span>
            @endif
        </div>

        {{-- Image --}}
        <img src="{{ $product['image'] }}" 
            alt="{{ $product['name'] }}"
            class="aspect-square w-full object-cover transition-transform duration-300  group-hover:scale-110"
        >
    </div>

    {{-- Product Info --}}
    <div class="border-t border-[#F3E5D9] p-4">
        <div class="mb-2 flex items-center gap-1">
            @php
                $rating = $product['rating'] ?? 5;
                $reviewCount = $product['reviewCount'] ?? 0;
            @endphp
            @for($i = 0; $i < 5; $i++)
                @if($i < $rating)
                    <i class="fa-solid fa-star text-xs text-yellow-400"></i>
                @else
                    <i class="fa-regular fa-star text-xs text-gray-300"></i>
                @endif
            @endfor
            <span class="ml-1 text-xs text-[#8B7162]">({{ $reviewCount }})</span>
        </div>

        {{-- Product Name --}}
        <p class="product-name mb-3 line-clamp-2 text-sm font-semibold text-[#3B2115] transition group-hover:text-[#C1440E]">
            {{ $product['name'] }}
        </p>

        {{-- Price --}}
        <div class="mb-4">
            <div class="text-lg font-bold text-[#C1440E]">
                Rp {{ number_format($product['price'], 0, ',', '.') }}
            </div>
            @if($product['originalPrice'] ?? null)
                <p class="text-xs text-[#A58C7D] line-through">
                    Rp {{ number_format($product['originalPrice'], 0, ',', '.') }}
                </p>
            @endif
        </div>

        {{-- Add to Cart Button --}}
        <button class="w-full rounded-full bg-[#FF6B00] px-4 py-2 font-semibold text-white 
                 transition hover:bg-[#E85D00] active:scale-95">
            <i class="fa-solid fa-shopping-cart mr-2"></i>
            Tambah Keranjang
        </button>
    </div>
</div>
