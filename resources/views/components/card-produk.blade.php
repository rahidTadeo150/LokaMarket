@props(['produk'])

<a href="{{ route('cust.detailProduk', $produk->slug) }}"
   class="produk-card group block overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
    <div class="relative overflow-hidden bg-[#FFF3E5]">
            @if ($produk->gambar)
            <img src="{{ asset('storage/' . $produk->gambar) }}"
                alt="{{ $produk->nama }}"
                class="h-56 w-full object-cover transition duration-500 group-hover:scale-105">
            @else
            <div class="flex h-56 w-full items-center justify-center bg-linear-to-br from-[#FFF3E5] to-[#FFE8CF]">
                <div class="text-center">
                    <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/70 text-orange-300">
                        <i class="fa-regular fa-image text-2xl"></i>
                    </div>

                    <p class="text-xs font-medium text-[#C1440E]/60">
                        Foto produk belum tersedia
                    </p>
                </div>
            </div>
            @endif

            <div class="absolute left-3 top-3">
                <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-[#C1440E] shadow-sm">
                    {{ $produk->kategori->nama ?? 'Produk' }}
                </span>
            </div>
        
        <button type="button"
                onclick="event.preventDefault();"
                class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full bg-white/90 text-[#72594B] shadow-sm transition hover:bg-orange-500 hover:text-white">
            <i class="fa-regular fa-heart"></i>
        </button>
    </div>

    <div class="p-4">
        <div class="mb-2 flex items-center gap-1.5 text-xs text-[#72594B]">
            <i class="fa-solid fa-store text-orange-500"></i>
            <span class="truncate">
                {{ $produk->toko->nama_toko ?? 'Toko Lokal' }}
            </span>
        </div>

        <h3 class="nama-produk line-clamp-2 min-h-12 text-sm font-bold text-[#3B2115] transition group-hover:text-orange-600">
            {{ $produk->nama }}
        </h3>

        <div class="mt-3 flex items-center justify-between">
            <div>
                <p class="text-lg font-black text-orange-600">
                    Rp{{ number_format($produk->harga, 0, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-[#72594B]">
                    Stok {{ $produk->stok }}
                </p>
            </div>

            <button type="button"
                    onclick="event.preventDefault();"
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500 text-white transition hover:bg-orange-600">
                <i class="fa-solid fa-cart-shopping"></i>
            </button>

        </div>
    </div>
</a>