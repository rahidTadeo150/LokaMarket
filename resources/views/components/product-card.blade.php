@props(['product'])

<div class="product-card group relative overflow-hidden rounded-2xl bg-white shadow-md transition-all 
            duration-300 hover:shadow-xl hover:scale-105">
    {{-- Product Image Container --}}
    <div class="relative overflow-hidden bg-gray-200">
        {{-- Badge --}}
        <div class="absolute top-3 left-3 z-10 inline-flex items-center gap-2">
            @if($product['badge'] ?? null)
                <span class="rounded-full bg-orange-500 px-3 py-1 text-xs font-semibold text-white">
                    {{ $product['badge'] }}
                </span>
            @endif
        </div>

        {{-- Wishlist Button --}}
        <button class="absolute top-3 right-3 z-10 flex h-9 w-9 items-center justify-center 
                     rounded-full bg-white text-gray-500 shadow-md transition hover:bg-red-50 
                     hover:text-red-500">
            <i class="fa-solid fa-heart text-lg"></i>
        </button>

        {{-- Image --}}
        <img 
            src="{{ $product['image'] }}" 
            alt="{{ $product['name'] }}"
            class="aspect-square w-full object-cover transition-transform duration-300 
                   group-hover:scale-110"
        >

        {{-- Quick View --}}
        <div class="absolute inset-0 flex items-center justify-center bg-black/0 transition-all 
                   duration-300 group-hover:bg-black/30">
            <button class="translate-y-10 rounded-full bg-white px-6 py-2 font-semibold 
                         text-gray-800 shadow-lg transition-all duration-300 hover:bg-orange-500 
                         hover:text-white group-hover:translate-y-0">
                Lihat Detail
            </button>
        </div>
    </div>

    {{-- Product Info --}}
    <div class="p-4">
        {{-- Rating --}}
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
            <span class="ml-1 text-xs text-gray-500">({{ $reviewCount }})</span>
        </div>

        {{-- Product Name --}}
        <h3 class="product-name mb-3 line-clamp-2 text-sm font-semibold text-gray-800 
                   transition group-hover:text-orange-600">
            {{ $product['name'] }}
        </h3>

        {{-- Price --}}
        <div class="mb-4">
            <div class="text-lg font-bold text-orange-600">
                Rp {{ number_format($product['price'], 0, ',', '.') }}
            </div>
            @if($product['originalPrice'] ?? null)
                <p class="text-xs text-gray-400 line-through">
                    Rp {{ number_format($product['originalPrice'], 0, ',', '.') }}
                </p>
            @endif
        </div>

        {{-- Add to Cart Button --}}
        <button class="w-full rounded-lg bg-orange-500 px-4 py-2 font-semibold text-white 
                     transition hover:bg-orange-600 active:scale-95">
            <i class="fa-solid fa-shopping-cart mr-2"></i>
            Tambah Keranjang
        </button>
    </div>
</div>
