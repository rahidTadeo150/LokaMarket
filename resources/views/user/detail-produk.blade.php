@extends('layouts.customer')

@section('title', $produk->nama . ' - LokaMarket')

@section('content')

<main class="min-h-screen bg-[#FFF9F2] py-6 sm:py-8">

    <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

        <a href="{{ route('cust.pilihanProduk') }}"
        class="group inline-flex items-center gap-3 text-sm font-medium text-[#72594B] transition hover:text-orange-600">
            <span class="flex h-10 w-10 items-center justify-center rounded-full border border-orange-100 bg-white shadow-sm transition group-hover:bg-orange-50">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </span>
            Kembali
        </a>

        <section class="overflow-hidden rounded-3xl border border-orange-200/80 bg-linear-to-br from-[#FFF1DF] via-[#FFF7EC] to-[#FFE5C8] p-4 shadow-sm sm:p-6 lg:p-8">

            <div class="grid grid-cols-1 gap-7 lg:grid-cols-2 lg:gap-8">

                <div class="min-w-0">

                    <div class="relative overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">

                        @if ($produk->thumbnail)
                        <img id="mainProductImage"
                            src="{{ asset('storage/' . $produk->thumbnail->foto) }}"
                            alt="{{ $produk->nama }}"
                            class="aspect-square w-full object-cover">

                        <x-wishlist-button :produk="$produk" :is-wishlisted="$isWishlisted"/>

                            @if ($produk->preview->count() > 0)
                            <button type="button"
                                    data-gallery-prev
                                    aria-label="Foto sebelumnya"
                                    class="absolute left-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white text-orange-600 shadow-md transition hover:bg-orange-500 hover:text-white">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>

                            <button type="button"
                                    data-gallery-next
                                    aria-label="Foto berikutnya"
                                    class="absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white text-orange-600 shadow-md transition hover:bg-orange-500 hover:text-white">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                            @endif

                        @else
                        <div class="flex aspect-square items-center justify-center bg-orange-50">
                            <div class="text-center">
                                <i class="fa-regular fa-image text-5xl text-orange-300"></i>
                                <p class="mt-3 text-sm text-[#8A7568]">
                                    Foto produk belum tersedia
                                </p>
                            </div>
                        </div>
                        @endif

                    </div>

                    @if ($produk->thumbnail || $produk->preview->count() > 0)

                        <div class="mt-3 grid grid-cols-5 gap-2 sm:gap-3">

                            @if ($produk->thumbnail)
                            <button type="button"
                                    data-gallery-index="0"
                                    class="product-thumbnail overflow-hidden rounded-xl border-2 border-orange-500 bg-white shadow-sm">
                                <img src="{{ asset('storage/' . $produk->thumbnail->foto) }}"
                                    alt="Thumbnail {{ $produk->nama }}"
                                    class="aspect-square w-full object-cover">
                            </button>
                            @endif

                            @foreach ($produk->preview as $index => $foto)
                            <button type="button"
                                    data-gallery-index="{{ $index + 1 }}"
                                    class="product-thumbnail overflow-hidden rounded-xl border-2 border-transparent bg-white transition hover:border-orange-300">   
                                <img src="{{ asset('storage/' . $foto->foto) }}"
                                    alt="Foto {{ $produk->nama }} {{ $index + 1 }}"
                                    class="aspect-square w-full object-cover">
                            </button>
                            @endforeach

                        </div>

                    @endif

                </div>

                <div class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-lg shadow-orange-100/40">

                    <div class="p-5 sm:p-7">

                        <span class="inline-flex items-center rounded-full border border-orange-200 bg-orange-50 px-3 py-1.5 text-xs font-semibold text-orange-700">
                            <i class="fa-solid fa-tag mr-2"></i>
                            {{ $produk->kategori->nama }}
                        </span>

                        <h1 class="mt-4 text-2xl font-extrabold leading-tight tracking-tight text-[#3B2115] sm:text-3xl">
                            {{ $produk->nama }}
                        </h1>

                        <div class="mt-3 flex flex-wrap items-center gap-3">

                            <div class="flex items-center gap-0.5 text-sm text-orange-500">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if (($produk->rating ?? 0) >= $i)
                                    <i class="fa-solid fa-star"></i>
                                    @elseif (($produk->rating ?? 0) >= ($i - 0.5))
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                    @else
                                    <i class="fa-regular fa-star text-orange-200"></i>
                                    @endif
                                @endfor
                            </div>

                            <span class="text-sm font-bold text-[#3B2115]">
                                {{ number_format($produk->rating ?? 0, 1) }}
                            </span>

                            <span class="text-orange-200">|</span>

                            <span class="text-sm text-[#72594B]">
                                Terjual 250+
                            </span>

                        </div>

                        <div class="mt-4 flex items-center gap-3 rounded-2xl border border-orange-100 bg-white p-3">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                                {{ $produk->stok > 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-500' }}">
                                <i class="fa-solid fa-box-open text-lg"></i>
                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="text-xs text-[#8A7568]">
                                    Stok tersedia
                                </p>

                                <p class="mt-1 text-sm font-bold
                                    {{ $produk->stok > 0 ? 'text-green-700' : 'text-red-600' }}">
                                    @if ($produk->stok > 0)
                                        {{ number_format($produk->stok, 0, ',', '.') }} item
                                    @else
                                        Stok habis
                                    @endif
                                </p>
                            </div>

                            <span class="rounded-full px-3 py-1 text-xs font-semibold
                                {{ $produk->stok > 0 ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-600' }}">
                                {{ $produk->stok > 0 ? 'Tersedia' : 'Habis' }}
                            </span>

                        </div>

                        <div class="mt-5 rounded-2xl bg-orange-50/80 p-4">
                            <p class="text-xs font-medium text-[#8A7568]">
                                Harga produk
                            </p>

                            <div class="mt-1 flex flex-wrap items-baseline gap-2">
                                <span class="text-3xl font-black tracking-tight text-orange-600 sm:text-4xl">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </span>
                                <span class="text-sm text-[#72594B]">
                                    / Item
                                </span>
                            </div>
                        </div>

                        <div class="mt-5 rounded-2xl border border-orange-100 bg-[#FFFCF9] p-4">

                            <div class="flex items-start gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                                    <i class="fa-solid fa-location-dot text-lg"></i>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-bold text-[#3B2115]">
                                        {{ $produk->toko->kecamatan->nama ?? 'Kecamatan belum tersedia' }}
                                    </p>
                                    <p class="text-xs leading-relaxed text-[#72594B]">
                                        {{ $produk->toko->kota->nama ?? '-' }},
                                        {{ $produk->toko->provinsi->nama ?? '-' }}
                                    </p>
                                </div>

                            </div>

                        </div>

                        <div class="mt-5 grid grid-cols-3 divide-x divide-orange-100 rounded-2xl border border-orange-100 bg-white py-4">

                            <div class="flex flex-col items-center px-1 text-center">
                                
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                                    <i class="fa-solid fa-store"></i>
                                </span>

                                <p class="mt-2 text-[11px] font-bold text-[#3B2115]">
                                    Produk Lokal
                                </p>

                                <p class="mt-1 text-[10px] text-[#72594B]">
                                    Dari UMKM
                                </p>

                            </div>

                            <div class="flex flex-col items-center px-1 text-center">

                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </span>

                                <p class="mt-2 text-[11px] font-bold text-[#3B2115]">
                                    Belanja Aman
                                </p>

                                <p class="mt-1 text-[10px] text-[#72594B]">
                                    Transaksi aman
                                </p>

                            </div>

                            <div class="flex flex-col items-center px-1 text-center">

                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                                    <i class="fa-solid fa-circle-check"></i>
                                </span>

                                <p class="mt-2 text-[11px] font-bold text-[#3B2115]">
                                    Produk Pilihan
                                </p>

                                <p class="mt-1 text-[10px] text-[#72594B]">
                                    Berkualitas
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="border-t border-orange-100 bg-[#FFFCF9] p-5 sm:px-7 sm:py-5">

                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                            <button type="button"
                                    onclick="openOrderSheet('cart')"
                                    @disabled($produk->stok <= 0)
                                    class="flex h-12 items-center justify-center gap-2 rounded-full border border-orange-500 bg-white text-sm font-bold text-orange-600 transition hover:bg-orange-50 disabled:cursor-not-allowed disabled:opacity-50">
                                <i class="fa-solid fa-cart-shopping"></i>
                                Tambah ke Keranjang
                            </button>

                            <button type="button"
                                    onclick="openOrderSheet('buy')"
                                    @disabled($produk->stok <= 0)
                                    class="flex h-12 items-center justify-center gap-2 rounded-full bg-linear-to-r from-orange-500 to-orange-600 text-sm font-bold text-white shadow-md shadow-orange-200 transition hover:brightness-105 active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-50">
                                <i class="fa-solid fa-bag-shopping"></i>
                                Beli Sekarang
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="rounded-3xl border border-orange-100 bg-white/90 p-5 shadow-sm sm:p-7 lg:p-8">

            <div class="grid grid-cols-1 gap-7 lg:grid-cols-3">

                <div class="lg:col-span-2">

                    <div class="flex flex-wrap items-center gap-6 border-b border-orange-100 sm:gap-8">

                        <button type="button"
                                class="relative pb-4 text-sm font-bold text-orange-600">
                            Deskripsi
                            <span class="absolute inset-x-0 -bottom-px h-0.5 rounded-full bg-orange-500"></span>
                        </button>

                        <button type="button" 
                                class="pb-4 text-sm text-[#72594B] transition hover:text-orange-600">
                            Ulasan (124)
                        </button>

                        <button type="button" 
                                class="pb-4 text-sm text-[#72594B] transition hover:text-orange-600">
                            Penjual
                        </button>

                    </div>

                    <div class="pt-6">
                        <p class="text-xl font-extrabold text-[#3B2115]">
                            Deskripsi Produk
                        </p>
                        <p class="mt-4 whitespace-pre-line text-sm leading-7 text-[#72594B]">
                            {{ $produk->deskripsi }}
                        </p>
                    </div>

                </div>

                <aside class="rounded-2xl border border-orange-100 bg-linear-to-br from-[#FFF8EF] to-[#FFF0DF] p-5">

                    <p class="text-lg font-extrabold text-[#3B2115]">
                        Tentang Penjual
                    </p>

                    <div class="mt-5 flex items-center gap-3">

                        <div class="h-16 w-16 shrink-0 overflow-hidden rounded-3xl border border-orange-100 bg-orange-50">
                            @if ($produk->toko->foto_profil)
                            <img src="{{ asset('storage/' . $produk->toko->foto_profil) }}"
                                alt="Profil {{ $produk->toko->nama_toko }}"
                                class="h-full w-full object-cover">
                            @else
                            <div class="flex h-full w-full items-center justify-center text-orange-500">
                                <i class="fa-solid fa-store text-2xl"></i>
                            </div>
                            @endif
                        </div>

                        <div class="min-w-0">
                            <p class="font-bold text-[#3B2115]">
                                {{ $produk->toko->nama_toko }}
                            </p>
                            <p class="mt-1 text-xs text-[#72594B]">
                                {{ $produk->toko->alamat }}
                            </p>
                            <p class="mt-2 text-[11px] text-[#8A7568]">
                                Member sejak {{ $produk->toko->created_at->translatedFormat('F Y') }}
                            </p>
                        </div>

                    </div>

                    <div class="mt-5 grid grid-cols-3 divide-x divide-orange-200 border-y border-orange-200 py-4 text-center">

                        <div class="px-1">
                            <p class="font-extrabold text-[#3B2115]">98%</p>
                            <p class="mt-1 text-[10px] text-[#72594B]">Penilaian Positif</p>
                        </div>

                        <div class="px-1">
                            <p class="font-extrabold text-[#3B2115]">
                                {{ $jumlahProduk }}
                            </p>
                            <p class="mt-1 text-[10px] text-[#72594B]">Produk Terjual</p>
                        </div>

                        <div class="px-1">
                            <p class="font-extrabold text-[#3B2115]">1 Jam</p>
                            <p class="mt-1 text-[10px] text-[#72594B]">Respon</p>
                        </div>

                    </div>

                    <a href="{{ route('cust.detailToko', ['toko' => $produk->toko->slug]) }}"
                        class="mt-5 flex h-11 w-full items-center justify-center rounded-full border border-orange-400 bg-white text-sm font-bold text-orange-600 transition hover:bg-orange-500 hover:text-white">
                        Kunjungi Profil Toko
                    </a>

                </aside>

            </div>
        </section>

        {{-- PRODUK LAINNYA --}}
        <section class="space-y-5">

            <div>
                <h2 class="text-xl font-extrabold text-[#3B2115] sm:text-2xl">
                    Produk Lainnya dari Penjual
                </h2>
                <p class="mt-1 text-sm text-[#8A7568]">
                    Temukan produk lain dari toko ini.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-4">

                @forelse ($anotherProduk as $item)
                    <x-card-produk :produk="$item" />
                @empty
                    <div class="col-span-full rounded-2xl border border-orange-100 bg-white p-10 text-center">
                        <i class="fa-regular fa-face-frown text-4xl text-orange-300"></i>
                        <h3 class="mt-4 font-bold text-[#3B2115]">
                            Produk belum tersedia
                        </h3>
                        <p class="mt-1 text-sm text-[#72594B]">
                            Belum ada produk lain yang tersedia saat ini.
                        </p>
                    </div>
                @endforelse

            </div>

        </section>

        {{-- BANNER LOKAMARKET --}}
        <section class="relative overflow-hidden rounded-3xl bg-linear-to-r from-orange-600 via-orange-500 to-[#FF8A26] px-6 py-8 shadow-sm sm:px-8 lg:px-10">

            <div class="pointer-events-none absolute -right-12 -top-20 h-56 w-56 rounded-full bg-white/10 blur-2xl"></div>

            <div class="relative flex flex-col items-center justify-between gap-6 md:flex-row">

                <div class="flex flex-col items-center gap-4 text-center sm:flex-row sm:text-left">

                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/20 text-white">
                        <i class="fa-solid fa-store text-3xl"></i>
                    </div>

                    <div>
                        <h2 class="text-xl font-extrabold text-white sm:text-2xl">
                            Dukung Produk UMKM Lokal
                        </h2>
                        <p class="mt-2 max-w-lg text-sm leading-6 text-orange-50">
                            Belanja produk berkualitas langsung dari pelaku UMKM di sekitarmu.
                        </p>
                    </div>

                </div>

                <a href="{{ route('cust.pilihanProduk') }}"
                class="shrink-0 rounded-full bg-white px-6 py-3 text-sm font-bold text-orange-600 transition hover:bg-orange-50">
                    Jelajahi Produk UMKM
                </a>

            </div>

        </section>

        <div id="orderSheet"
            data-product-id="{{ $produk->id }}"
            data-product-price="{{ $produk->harga }}"
            data-product-stock="{{ $produk->stok }}"
            class="invisible fixed inset-0 z-100"
            aria-hidden="true">

            <div id="orderBackdrop"
                class="absolute inset-0 bg-[#24140D]/50 opacity-0 backdrop-blur-[3px] transition-opacity duration-300"></div>

            <div class="absolute inset-x-0 bottom-0 flex justify-center sm:inset-0 sm:items-center sm:p-4">

                <div id="orderPanel"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="orderSheetTitle"
                    class="absolute bottom-0 left-0 right-0 mx-auto flex max-h-[88dvh] w-full max-w-lg translate-y-full flex-col overflow-hidden rounded-t-2xl bg-white shadow-2xl transition-transform duration-300 ease-out sm:bottom-auto sm:top-1/2 sm:max-h-[85dvh] sm:-translate-y-1/2 sm:rounded-2xl">
                    
                    <div class="relative shrink-0 overflow-hidden bg-linear-to-br from-orange-500 via-orange-500 to-[#D9490B] px-4 py-3.5 sm:px-5">

                        <div class="pointer-events-none absolute -right-8 -top-10 h-28 w-28 rounded-full bg-white/10"></div>
                        <div class="pointer-events-none absolute -bottom-12 right-16 h-24 w-24 rounded-full bg-white/10"></div>

                        <div class="relative flex items-center justify-between gap-3">

                            <div class="flex min-w-0 items-center gap-3">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-white/20 bg-white/15 text-white">
                                    <i class="fa-solid fa-bag-shopping text-lg"></i>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-[10px] font-medium text-orange-100">
                                        LokaMarket
                                    </p>
                                    <p id="orderSheetTitle"
                                        class="mt-0.5 text-lg font-extrabold leading-tight text-white">
                                        Pesan Produk
                                    </p>
                                    <p class="mt-0.5 text-[11px] text-orange-50">
                                        Atur jumlah pesananmu
                                    </p>
                                </div>

                            </div>

                            <button type="button"
                                    data-order-close
                                    aria-label="Tutup pemesanan"
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-white/20 bg-white/15 text-white transition hover:bg-white/25 active:scale-95">
                                <i class="fa-solid fa-xmark text-base"></i>
                            </button>

                        </div>

                        <div class="relative mt-3 flex items-center justify-between gap-3 rounded-xl border border-white/15 bg-white/10 px-3 py-2">
                            
                            <div class="flex items-center gap-2 text-white">
                                <i class="fa-solid fa-box-open text-xs"></i>
                                <span class="text-xs font-medium">
                                    Stok tersedia
                                </span>
                            </div>

                            <span class="rounded-full bg-white px-2.5 py-1 text-[10px] font-bold {{ $produk->stok > 0 ? 'text-green-700' : 'text-red-600' }}">
                                {{ number_format($produk->stok, 0, ',', '.') }} item
                            </span>

                        </div>
                    </div>

                    <div class="min-h-0 flex-1 space-y-4 overflow-y-auto overscroll-contain px-4 py-4 sm:px-5">

                        <div class="flex items-center gap-3">

                            <div class="h-17 w-17 shrink-0 overflow-hidden rounded-xl border border-orange-100 bg-orange-50">

                                @if ($produk->thumbnail && $produk->thumbnail->foto)
                                <img src="{{ asset('storage/' . $produk->thumbnail->foto) }}"
                                    alt="{{ $produk->nama }}"
                                    class="h-full w-full object-cover"
                                    loading="lazy">
                                @else
                                <div class="flex h-full w-full items-center justify-center text-orange-400">
                                    <i class="fa-regular fa-image text-xl"></i>
                                </div>
                                @endif

                            </div>

                            <div class="min-w-0 flex-1">

                                <span class="inline-flex max-w-full rounded-full bg-orange-50 px-2 py-1 text-[10px] font-semibold text-orange-600">
                                    {{ $produk->kategori->nama ?? 'Produk Lokal' }}
                                </span>

                                <p class="mt-1 line-clamp-2 text-sm font-bold leading-snug text-[#3B2115]">
                                    {{ $produk->nama }}
                                </p>

                                <p class="mt-1 text-sm font-extrabold text-orange-600">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </p>

                            </div>

                        </div>

                        <div class="border-t border-dashed border-orange-200"></div>

                        <div class="flex items-center justify-between gap-3">

                            <div class="min-w-0">
                                <p class="text-sm font-bold text-[#3B2115]">
                                    Jumlah Produk
                                </p>
                                <p class="mt-1 text-xs text-[#8A7568]">
                                    Pilih jumlah pesanan
                                </p>
                            </div>

                            <div class="flex shrink-0 items-center gap-2 rounded-xl border border-orange-200 bg-orange-50/70 p-1">
                                
                                <button type="button"
                                        onclick="orderDecreaseQuantity()"
                                        aria-label="Kurangi jumlah"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-orange-600 transition hover:bg-orange-100 active:scale-95">   
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </button>

                                <input id="orderQuantity"
                                    type="number"
                                    min="1"
                                    max="{{ $produk->stok }}"
                                    value="1"
                                    inputmode="numeric"
                                    aria-label="Jumlah produk"
                                    class="w-10 border-0 bg-transparent p-0 text-center text-sm font-bold text-[#3B2115] outline-none focus:ring-0">

                                <button type="button"
                                        onclick="orderIncreaseQuantity()"
                                        aria-label="Tambah jumlah"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-orange-600 transition hover:bg-orange-100 active:scale-95">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>

                            </div>

                        </div>

                        <div class="rounded-xl border border-orange-100 bg-[#FFFAF5] p-3">

                            <div class="flex items-center justify-between gap-3">
                                <span class="text-xs text-[#72594B]">
                                    Harga satuan
                                </span>
                                <span class="text-xs font-semibold text-[#3B2115]">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="mt-2 flex items-center justify-between gap-3">
                                <span class="text-xs text-[#72594B]">
                                    Jumlah pesanan
                                </span>
                                <span id="orderSummary"
                                    class="text-xs font-semibold text-[#3B2115]">
                                    1 item
                                </span>
                            </div>

                            <div class="my-3 border-t border-dashed border-orange-200"></div>

                            <div class="flex items-center justify-between gap-3">

                                <div>
                                    <p class="text-sm font-bold text-[#3B2115]">
                                        Total Harga
                                    </p>
                                    <p class="mt-0.5 text-[10px] text-[#8A7568]">
                                        Belum termasuk ongkos kirim
                                    </p>
                                </div>

                                <span id="orderTotal"
                                    class="text-right text-lg font-black tracking-tight text-orange-600">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="shrink-0 border-t border-orange-100 bg-white px-4 py-3 pb-[calc(0.75rem+env(safe-area-inset-bottom))] sm:px-5">
                        
                        <button type="button"
                                id="orderSubmitButton"
                                onclick="submitOrder()"
                                @disabled($produk->stok <= 0)
                                class="flex min-h-11 w-full items-center justify-center rounded-xl bg-linear-to-r from-orange-500 to-orange-600 px-4 py-2.5 text-sm font-bold text-white shadow-md shadow-orange-200/60 transition hover:brightness-105 active:scale-[0.99] disabled:cursor-not-allowed disabled:opacity-50">
                            <i id="orderSubmitIcon"
                            class="fa-solid fa-cart-shopping mr-2"></i>
                            <span id="orderSubmitText">
                                Tambah ke Keranjang
                            </span>
                            <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                        </button>

                        <p class="mt-2 flex items-center justify-center gap-1.5 text-center text-[10px] text-[#8A7568]">
                            <i class="fa-solid fa-shield-halved text-green-600"></i>
                            @if ($produk->stok > 0)
                            Pesanan aman dan mudah di LokaMarket
                            @else
                            Produk sedang habis dan belum dapat dipesan
                            @endif
                        </p>

                    </div>

                </div>

            </div>
            
        </div>

    </div>
    
</main>

@endsection