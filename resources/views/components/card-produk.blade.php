@props(['produk'])

<article class="produk-card group relative flex h-full flex-col overflow-hidden rounded-2xl border border-[#F1E2D5] bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-orange-200 hover:shadow-[0_12px_30px_rgba(194,93,24,0.12)]">

    <div class="relative aspect-4/3 overflow-hidden bg-[#FFF5EB]">

        <a href="{{ route('cust.detailProduk', ['produk' => $produk->slug]) }}"
           class="block h-full w-full">

            @if ($produk->thumbnail)
                <img src="{{ asset('storage/' . $produk->thumbnail->foto) }}"
                    alt="{{ $produk->nama }}"
                    loading="lazy"
                    class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
            @else
                <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#FFF3E5] to-[#FFE4C8]">

                    <div class="text-center">

                        <div class="mx-auto mb-2 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/80 text-orange-300 shadow-sm">
                            <i class="fa-regular fa-image text-2xl"></i>
                        </div>

                        <p class="text-xs font-medium text-[#C1440E]/60">
                            Foto belum tersedia
                        </p>

                    </div>

                </div>
            @endif

            <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-black/20 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

            <div class="absolute left-3 top-3">
                <span class="inline-flex items-center rounded-full border border-white/70 bg-white/95 px-3 py-1.5 text-[11px] font-bold text-[#C1440E] shadow-sm backdrop-blur-sm">
                    {{ $produk->kategori->nama ?? 'Produk' }}
                </span>
            </div>

        </a>

        <div class="absolute right-0.5 top-0.5 z-10">
            <x-wishlist-button :produk="$produk" :is-wishlisted="$produk->is_wishlisted ?? false"/>
        </div>

    </div>

    <div class="flex flex-1 flex-col p-4">

        <div class="mb-2 flex min-w-0 items-center gap-1.5 text-xs text-[#947C6E]">
            <i class="fa-solid fa-store shrink-0 text-orange-500"></i>
            <span class="truncate">
                {{ $produk->toko->nama_toko ?? 'Toko Lokal' }}
            </span>
        </div>

        <a href="{{ route('cust.detailProduk', ['produk' => $produk->slug]) }}"
           class="mb-2 line-clamp-2 min-h-10 text-sm font-bold leading-5 text-[#3B2115] transition-colors duration-200 hover:text-orange-600">
            {{ $produk->nama }}
        </a>

        @php
            $rating = (float) ($produk->ulasan_avg_rating ?? 0);
            $jumlahUlasan = (int) ($produk->ulasan_count ?? 0);
        @endphp

        <div class="mb-3 flex items-center gap-2">

            <div class="flex items-center gap-0.5 text-[11px] text-amber-400">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($rating >= $i)
                        <i class="fa-solid fa-star"></i>
                    @elseif ($rating >= ($i - 0.5))
                        <i class="fa-solid fa-star-half-stroke"></i>
                    @else
                        <i class="fa-regular fa-star text-gray-300"></i>
                    @endif
                @endfor
            </div>

            <span class="text-xs font-semibold text-[#806B5D]">
                {{ $jumlahUlasan > 0 ? number_format($rating, 1, ',', '.') : '0,0' }}
            </span>

            <span class="text-[11px] text-[#A18B7D]">
                ({{ $jumlahUlasan }} ulasan)
            </span>

        </div>

        <div class="mt-auto border-t border-dashed border-[#F0E5DC] pt-3">

            <div class="flex items-end justify-between gap-2">

                <div class="min-w-0">

                    <p class="mb-0.5 text-[10px] font-medium uppercase tracking-wider text-[#A18B7D]">
                        Harga Produk
                    </p>

                    <p class="truncate text-lg font-extrabold tracking-tight text-[#EA580C]">
                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                    </p>

                    <div class="mt-1 flex items-center gap-1.5">
                        @if ($produk->stok > 0)
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            <span class="text-[11px] font-medium text-[#8B776A]">
                                Stok {{ $produk->stok }}
                            </span>
                        @else
                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                            <span class="text-[11px] font-medium text-red-500">
                                Stok habis
                            </span>
                        @endif
                    </div>
                    
                </div>

                <button type="button"
                        aria-label="Tambah ke keranjang"
                        @disabled($produk->stok <= 0)
                        onclick="event.preventDefault(); event.stopPropagation();"
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-500 text-white shadow-sm shadow-orange-200 transition-all duration-200 hover:bg-orange-600 hover:shadow-md hover:shadow-orange-200 active:scale-95 disabled:cursor-not-allowed disabled:bg-gray-300 disabled:shadow-none">

                    <i class="fa-solid fa-cart-shopping text-sm"></i>

                </button>

            </div>

        </div>

    </div>

</article>
