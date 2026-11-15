
@extends('layouts.customer')

@section('title', $produk->nama . ' - LokaMarket')

@section('content')

@php
    $rating = (float) ($produk->ulasan_avg_rating ?? 0);
    $jumlahUlasan = (int) ($produk->ulasan_count ?? 0);
    $fotoProduk = collect();

    if ($produk->thumbnail) {
        $fotoProduk->push($produk->thumbnail);
    }

    foreach ($produk->preview as $foto) {
        $fotoProduk->push($foto);
    }
@endphp

<main class="min-h-screen bg-[#FFF9F2] pb-12">

    <div class="mx-auto max-w-7xl space-y-7 px-4 py-6 sm:px-6 lg:px-8">

        {{-- NAVIGASI --}}
        <div class="flex items-center justify-between">
            <a href="{{ route('cust.pilihanProduk') }}"
               class="group inline-flex items-center gap-2.5 text-sm font-semibold text-[#72594B] transition hover:text-orange-600">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#F1DCC8] bg-white shadow-sm transition group-hover:border-orange-200 group-hover:bg-orange-50">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </span>
                Kembali ke produk
            </a>

            <span class="hidden items-center gap-2 rounded-full border border-green-100 bg-green-50 px-3 py-2 text-xs font-semibold text-green-700 sm:inline-flex">
                <i class="fa-solid fa-shield-halved"></i>
                Belanja aman di LokaMarket
            </span>
        </div>

        {{-- DETAIL PRODUK --}}
        <section class="grid grid-cols-1 gap-6 lg:grid-cols-12">

            {{-- GALERI FOTO --}}
            <div class="space-y-3 lg:col-span-7">

                <div class="relative overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white p-2 shadow-sm">

                    <div class="relative overflow-hidden rounded-2xl bg-[#FFF7EE]">

                        @if ($fotoProduk->isNotEmpty())

                            <img id="mainProductImage"
                                 src="{{ asset('storage/' . $fotoProduk->first()->foto) }}"
                                 alt="{{ $produk->nama }}"
                                 class="aspect-square max-h-[620px] w-full object-contain sm:aspect-[5/4]">

                            <x-wishlist-button
                                :produk="$produk"
                                :is-wishlisted="$isWishlisted" />

                            @if ($fotoProduk->count() > 1)

                                <button type="button"
                                        data-gallery-prev
                                        aria-label="Foto sebelumnya"
                                        class="absolute left-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-white/70 bg-white/90 text-[#3B2115] shadow-md transition hover:bg-orange-500 hover:text-white">
                                    <i class="fa-solid fa-chevron-left text-xs"></i>
                                </button>

                                <button type="button"
                                        data-gallery-next
                                        aria-label="Foto berikutnya"
                                        class="absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-white/70 bg-white/90 text-[#3B2115] shadow-md transition hover:bg-orange-500 hover:text-white">
                                    <i class="fa-solid fa-chevron-right text-xs"></i>
                                </button>

                            @endif

                            <span class="absolute bottom-4 left-4 rounded-full bg-black/50 px-3 py-1.5 text-[10px] font-semibold text-white backdrop-blur-sm">
                                <i class="fa-regular fa-images mr-1"></i>
                                {{ $fotoProduk->count() }} Foto Produk
                            </span>

                        @else

                            <div class="flex aspect-square items-center justify-center">
                                <div class="text-center">
                                    <i class="fa-regular fa-image text-6xl text-orange-200"></i>
                                    <p class="mt-3 text-sm font-medium text-[#8A7568]">
                                        Foto produk belum tersedia
                                    </p>
                                </div>
                            </div>

                        @endif

                    </div>

                </div>

                {{-- THUMBNAIL --}}
                @if ($fotoProduk->isNotEmpty())

                    <div class="flex gap-3 overflow-x-auto pb-2">

                        @foreach ($fotoProduk as $index => $foto)

                            <button type="button"
                                    data-gallery-index="{{ $index }}"
                                    class="product-thumbnail h-20 w-20 shrink-0 overflow-hidden rounded-xl border-2 {{ $index === 0 ? 'border-orange-500' : 'border-transparent' }} bg-white p-1 transition hover:border-orange-300 sm:h-24 sm:w-24">

                                <img src="{{ asset('storage/' . $foto->foto) }}"
                                     alt="Foto {{ $produk->nama }} {{ $index + 1 }}"
                                     class="h-full w-full rounded-lg object-cover">

                            </button>

                        @endforeach

                    </div>

                @endif

                {{-- INFORMASI SINGKAT --}}
                <div class="grid grid-cols-3 gap-3">

                    <div class="rounded-2xl border border-[#F1DCC8] bg-white p-3 text-center">
                        <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <p class="mt-2 text-xs font-bold text-[#3B2115]">Produk Lokal</p>
                        <p class="mt-1 text-[10px] text-[#8A7568]">Dari UMKM</p>
                    </div>

                    <div class="rounded-2xl border border-[#F1DCC8] bg-white p-3 text-center">
                        <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-xl bg-green-50 text-green-600">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <p class="mt-2 text-xs font-bold text-[#3B2115]">Belanja Aman</p>
                        <p class="mt-1 text-[10px] text-[#8A7568]">Transaksi aman</p>
                    </div>

                    <div class="rounded-2xl border border-[#F1DCC8] bg-white p-3 text-center">
                        <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                        <p class="mt-2 text-xs font-bold text-[#3B2115]">Produk Pilihan</p>
                        <p class="mt-1 text-[10px] text-[#8A7568]">UMKM Indonesia</p>
                    </div>

                </div>

            </div>

            {{-- INFORMASI PRODUK --}}
            <div class="lg:col-span-5">

                <div class="sticky top-24 space-y-5 rounded-3xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-7">

                    {{-- KATEGORI --}}
                    <div class="flex flex-wrap items-center justify-between gap-3">

                        <span class="inline-flex items-center gap-2 rounded-full bg-orange-50 px-3 py-1.5 text-xs font-bold text-orange-600">
                            <i class="fa-solid fa-tag"></i>
                            {{ $produk->kategori->nama ?? 'Produk Lokal' }}
                        </span>

                        <span class="text-xs font-medium text-[#A18B7D]">
                            <i class="fa-solid fa-circle-check mr-1 text-green-500"></i>
                            Produk tersedia di LokaMarket
                        </span>

                    </div>

                    {{-- NAMA PRODUK --}}
                    <div>
                        <h1 class="text-2xl font-extrabold leading-snug tracking-tight text-[#3B2115] sm:text-3xl">
                            {{ $produk->nama }}
                        </h1>

                        {{-- RATING --}}
                        <div class="mt-3 flex flex-wrap items-center gap-2.5">

                            <div class="flex items-center gap-0.5 text-sm text-amber-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($rating >= $i)
                                        <i class="fa-solid fa-star"></i>
                                    @elseif ($rating >= ($i - 0.5))
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    @else
                                        <i class="fa-regular fa-star text-orange-200"></i>
                                    @endif
                                @endfor
                            </div>

                            <span class="text-sm font-bold text-[#3B2115]">
                                {{ number_format($rating, 1, ',', '.') }}
                            </span>

                            <span class="text-xs text-[#A18B7D]">
                                ({{ number_format($jumlahUlasan, 0, ',', '.') }} ulasan)
                            </span>

                        </div>
                    </div>

                    {{-- HARGA --}}
                    <div class="rounded-2xl bg-[#FFF7EE] p-4 sm:p-5">

                        <p class="text-xs font-semibold text-[#8A7568]">
                            Harga produk
                        </p>

                        <div class="mt-1 flex flex-wrap items-baseline gap-2">

                            <span class="text-3xl font-black tracking-tight text-orange-600 sm:text-4xl">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </span>

                            <span class="text-xs text-[#8A7568]">
                                / item
                            </span>

                        </div>

                    </div>

                    {{-- STOK --}}
                    <div class="flex items-center justify-between gap-3 rounded-2xl border border-[#F1DCC8] p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl {{ $produk->stok > 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-500' }}">
                                <i class="fa-solid fa-box-open"></i>
                            </div>

                            <div>
                                <p class="text-xs text-[#8A7568]">Ketersediaan stok</p>

                                <p class="mt-1 text-sm font-bold {{ $produk->stok > 0 ? 'text-green-700' : 'text-red-600' }}">
                                    {{ $produk->stok > 0 ? number_format($produk->stok, 0, ',', '.') . ' item tersedia' : 'Stok habis' }}
                                </p>
                            </div>

                        </div>

                        <span class="rounded-full px-3 py-1 text-[10px] font-bold {{ $produk->stok > 0 ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-600' }}">
                            {{ $produk->stok > 0 ? 'Tersedia' : 'Habis' }}
                        </span>

                    </div>

                    {{-- LOKASI --}}
                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <div class="min-w-0">
                            <p class="text-xs font-bold text-[#3B2115]">Lokasi penjual</p>
                            <p class="mt-1 text-xs leading-relaxed text-[#72594B]">
                                {{ $produk->toko->kecamatan->nama ?? 'Kecamatan belum tersedia' }},
                                {{ $produk->toko->kota->nama ?? '-' }},
                                {{ $produk->toko->provinsi->nama ?? '-' }}
                            </p>
                        </div>

                    </div>

                    <div class="border-t border-dashed border-[#F1DCC8]"></div>

                    {{-- TOMBOL PEMESANAN --}}
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                        <button type="button"
                                onclick="openOrderSheet('cart')"
                                @disabled($produk->stok <= 0)
                                class="flex h-12 items-center justify-center gap-2 rounded-full border border-orange-500 bg-white text-sm font-bold text-orange-600 transition hover:bg-orange-50 disabled:cursor-not-allowed disabled:opacity-50">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Keranjang
                        </button>

                        <button type="button"
                                onclick="openOrderSheet('buy')"
                                @disabled($produk->stok <= 0)
                                class="flex h-12 items-center justify-center gap-2 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-sm font-bold text-white shadow-md shadow-orange-200 transition hover:brightness-105 active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-50">
                            <i class="fa-solid fa-bag-shopping"></i>
                            Beli Sekarang
                        </button>

                    </div>

                    <p class="flex items-center justify-center gap-2 text-center text-[10px] text-[#A18B7D]">
                        <i class="fa-solid fa-lock text-green-600"></i>
                        Pembayaran aman dan mudah melalui LokaMarket
                    </p>

                </div>

            </div>

        </section>

        <section id="productInformation"
                class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

            {{-- HEADER TAB --}}
            <div class="border-b border-[#F1DCC8] bg-gradient-to-r from-[#FFFCF9] to-white px-5 pt-5 sm:px-7 sm:pt-7">

                <div class="mb-5">
                    <h2 class="text-xl font-extrabold tracking-tight text-[#3B2115]">
                        Informasi Produk
                    </h2>
                    <p class="mt-1 text-xs text-[#8A7568]">
                        Kenali produk lebih dekat sebelum melakukan pembelian.
                    </p>
                </div>

                {{-- TAB NAVIGATION --}}
                <div class="flex w-full gap-2 overflow-x-auto pb-3 hide-scrollbar"
                    role="tablist"
                    aria-label="Informasi produk">

                    <button type="button"
                            id="tabButton-deskripsi"
                            data-tab-button="deskripsi"
                            role="tab"
                            aria-controls="tabContent-deskripsi"
                            aria-selected="true"
                            class="product-tab-button flex shrink-0 items-center gap-2 rounded-xl border border-orange-200 bg-orange-500 px-4 py-3 text-xs font-bold text-white shadow-sm shadow-orange-100 transition-all duration-200">

                        <i class="fa-solid fa-align-left"></i>
                        Deskripsi

                    </button>

                    <button type="button"
                            id="tabButton-ulasan"
                            data-tab-button="ulasan"
                            role="tab"
                            aria-controls="tabContent-ulasan"
                            aria-selected="false"
                            class="product-tab-button flex shrink-0 items-center gap-2 rounded-xl border border-transparent bg-white px-4 py-3 text-xs font-semibold text-[#806B5D] transition-all duration-200 hover:border-orange-100 hover:bg-orange-50 hover:text-orange-600">

                        <i class="fa-solid fa-star"></i>
                        Ulasan

                        <span class="rounded-full bg-orange-50 px-2 py-0.5 text-[10px] font-bold text-orange-600">
                            {{ $jumlahUlasan }}
                        </span>

                    </button>

                    <button type="button"
                            id="tabButton-penjual"
                            data-tab-button="penjual"
                            role="tab"
                            aria-controls="tabContent-penjual"
                            aria-selected="false"
                            class="product-tab-button flex shrink-0 items-center gap-2 rounded-xl border border-transparent bg-white px-4 py-3 text-xs font-semibold text-[#806B5D] transition-all duration-200 hover:border-orange-100 hover:bg-orange-50 hover:text-orange-600">

                        <i class="fa-solid fa-store"></i>
                        Penjual

                    </button>

                </div>

            </div>

            {{-- TAB CONTENT --}}
            <div class="p-5 sm:p-7 lg:p-8">

                {{-- ==========================================
                    TAB DESKRIPSI
                =========================================== --}}
                <div id="tabContent-deskripsi"
                    data-tab-content="deskripsi"
                    role="tabpanel"
                    aria-labelledby="tabButton-deskripsi"
                    class="product-tab-content">

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                        {{-- DESKRIPSI UTAMA --}}
                        <div class="space-y-5 lg:col-span-2">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-orange-50 text-orange-600">
                                    <i class="fa-solid fa-file-lines text-lg"></i>
                                </div>

                                <div>
                                    <h3 class="text-base font-extrabold text-[#3B2115]">
                                        Deskripsi Produk
                                    </h3>
                                    <p class="mt-1 text-xs text-[#A18B7D]">
                                        Informasi dan detail produk
                                    </p>
                                </div>

                            </div>

                            <div class="rounded-2xl border border-[#F3E5D9] bg-[#FFFCF9] p-5 sm:p-6">

                                <p class="whitespace-pre-line break-words text-sm leading-8 text-[#72594B]">{{ $produk->deskripsi ?: 'Belum ada deskripsi untuk produk ini.' }}</p>

                            </div>

                        </div>

                        {{-- INFORMASI SINGKAT --}}
                        <div class="space-y-3">

                            <h3 class="text-sm font-extrabold text-[#3B2115]">
                                Informasi Produk
                            </h3>

                            <div class="space-y-3 rounded-2xl border border-[#F1DCC8] bg-white p-4">

                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-xs text-[#8A7568]">Kategori</span>
                                    <span class="text-xs font-bold text-[#3B2115]">
                                        {{ $produk->kategori->nama ?? 'Produk Lokal' }}
                                    </span>
                                </div>

                                <div class="border-t border-dashed border-[#F1DCC8]"></div>

                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-xs text-[#8A7568]">Stok</span>
                                    <span class="text-xs font-bold {{ $produk->stok > 0 ? 'text-green-600' : 'text-red-500' }}">
                                        {{ number_format($produk->stok, 0, ',', '.') }} item
                                    </span>
                                </div>

                                <div class="border-t border-dashed border-[#F1DCC8]"></div>

                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-xs text-[#8A7568]">Penjual</span>
                                    <span class="max-w-[55%] truncate text-xs font-bold text-[#3B2115]">
                                        {{ $produk->toko->nama_toko ?? 'Toko LokaMarket' }}
                                    </span>
                                </div>

                                <div class="border-t border-dashed border-[#F1DCC8]"></div>

                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-xs text-[#8A7568]">Rating</span>
                                    <span class="flex items-center gap-1 text-xs font-bold text-[#3B2115]">
                                        <i class="fa-solid fa-star text-amber-400"></i>
                                        {{ number_format($rating, 1, ',', '.') }}
                                    </span>
                                </div>

                            </div>

                            <div class="rounded-2xl bg-gradient-to-br from-orange-500 to-[#D9490B] p-4 text-white">

                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-heart"></i>
                                    <p class="text-xs font-bold">Dukung UMKM Lokal</p>
                                </div>

                                <p class="mt-2 text-[11px] leading-6 text-orange-50">
                                    Setiap pembelianmu membantu mengembangkan usaha lokal Indonesia.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ==========================================
                    TAB ULASAN
                =========================================== --}}
                <div id="tabContent-ulasan"
                    data-tab-content="ulasan"
                    role="tabpanel"
                    aria-labelledby="tabButton-ulasan"
                    class="product-tab-content hidden">

                    {{-- HEADER ULASAN --}}
                    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">

                        <div>
                            <h3 class="text-lg font-extrabold text-[#3B2115]">
                                Ulasan Pembeli
                            </h3>
                            <p class="mt-1 text-xs text-[#8A7568]">
                                Pengalaman pembeli setelah menggunakan produk ini.
                            </p>
                        </div>

                        <span class="inline-flex w-fit items-center gap-2 rounded-full bg-orange-50 px-3 py-2 text-xs font-bold text-orange-600">
                            <i class="fa-solid fa-comments"></i>
                            {{ number_format($jumlahUlasan, 0, ',', '.') }} ulasan
                        </span>

                    </div>

                    {{-- RINGKASAN RATING --}}
                    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

                        <div class="flex flex-col items-center justify-center rounded-2xl border border-orange-100 bg-gradient-to-br from-[#FFFAF5] to-white p-5 text-center">

                            <p class="text-4xl font-black tracking-tight text-[#3B2115]">
                                {{ number_format($rating, 1, ',', '.') }}
                            </p>

                            <div class="mt-2 flex items-center gap-1 text-sm text-amber-400">

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($rating >= $i)
                                        <i class="fa-solid fa-star"></i>
                                    @elseif ($rating >= ($i - 0.5))
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    @else
                                        <i class="fa-regular fa-star text-orange-200"></i>
                                    @endif
                                @endfor

                            </div>

                            <p class="mt-2 text-[10px] text-[#8A7568]">
                                Rating keseluruhan
                            </p>

                        </div>

                        <div class="flex flex-col justify-center rounded-2xl border border-[#F1DCC8] bg-white p-5 sm:col-span-2">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-50 text-green-600">
                                    <i class="fa-solid fa-shield-check text-lg"></i>
                                </div>

                                <div>
                                    <p class="text-sm font-bold text-[#3B2115]">
                                        Ulasan dari pembeli
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-[#8A7568]">
                                        Penilaian dan pengalaman pelanggan membantu calon pembeli lainnya.
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- DAFTAR ULASAN --}}
                    <div class="mt-7">

                        <div class="mb-4 flex items-center justify-between gap-3">
                            <h4 class="text-sm font-extrabold text-[#3B2115]">
                                Semua Ulasan
                            </h4>

                            <span class="text-[10px] text-[#A18B7D]">
                                Terbaru
                            </span>
                        </div>

                        <div class="space-y-4">

                            @forelse ($ulasan as $item)

                                <article class="rounded-2xl border border-[#F1DCC8] bg-white p-4 transition hover:border-orange-200 sm:p-5">

                                    {{-- IDENTITAS PEMBELI --}}
                                    <div class="flex items-start justify-between gap-3">

                                        <div class="flex min-w-0 items-center gap-3">

                                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-orange-100 to-orange-50 text-orange-600">
                                                <i class="fa-solid fa-user"></i>
                                            </div>

                                            <div class="min-w-0">
                                                <p class="truncate text-sm font-bold text-[#3B2115]">
                                                    {{ $item->user->username ?? 'Pengguna LokaMarket' }}
                                                </p>

                                                <p class="mt-1 text-[10px] text-[#A18B7D]">
                                                    {{ $item->created_at?->translatedFormat('d F Y') }}
                                                </p>
                                            </div>

                                        </div>

                                        <span class="inline-flex shrink-0 items-center gap-1 rounded-full bg-green-50 px-2.5 py-1.5 text-[10px] font-bold text-green-700">
                                            <i class="fa-solid fa-circle-check"></i>
                                            Pembeli
                                        </span>

                                    </div>

                                    {{-- RATING --}}
                                    <div class="mt-4 flex items-center gap-2">

                                        <div class="flex gap-0.5 text-xs text-amber-400">

                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="{{ $item->rating >= $i ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                            @endfor

                                        </div>

                                        <span class="text-xs font-bold text-[#3B2115]">
                                            {{ $item->rating }}.0
                                        </span>

                                    </div>

                                    {{-- ISI ULASAN --}}
                                    @if ($item->ulasan)
                                        <p class="mt-3 whitespace-pre-line break-words text-sm leading-7 text-[#72594B]">
                                            {{ $item->ulasan }}
                                        </p>
                                    @endif

                                    {{-- TAG ULASAN --}}
                                    @if (!empty($item->tag_ulasan))
                                        <div class="mt-3 flex flex-wrap gap-2">

                                            @foreach ($item->tag_ulasan as $tag)
                                                <span class="rounded-full border border-orange-100 bg-orange-50 px-3 py-1.5 text-[10px] font-semibold text-orange-700">
                                                    <i class="fa-solid fa-check mr-1"></i>
                                                    {{ $tag }}
                                                </span>
                                            @endforeach

                                        </div>
                                    @endif

                                    {{-- FOTO ULASAN --}}
                                    @if ($item->foto->isNotEmpty())

                                        <div class="mt-4 flex flex-wrap gap-2">

                                            @foreach ($item->foto as $foto)

                                                <a href="{{ asset('storage/' . $foto->foto) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="group h-20 w-20 overflow-hidden rounded-xl border border-[#F1DCC8] bg-orange-50 sm:h-24 sm:w-24">

                                                    <img src="{{ asset('storage/' . $foto->foto) }}"
                                                        alt="Foto ulasan produk"
                                                        loading="lazy"
                                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-110">

                                                </a>

                                            @endforeach

                                        </div>

                                    @endif

                                </article>

                            @empty

                                <div class="rounded-2xl border border-dashed border-orange-200 bg-[#FFFCF9] px-5 py-12 text-center">

                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-orange-300">
                                        <i class="fa-regular fa-comment-dots text-2xl"></i>
                                    </div>

                                    <h4 class="mt-4 text-sm font-extrabold text-[#3B2115]">
                                        Belum Ada Ulasan
                                    </h4>

                                    <p class="mx-auto mt-2 max-w-sm text-xs leading-6 text-[#8A7568]">
                                        Produk ini belum memiliki penilaian. Jadilah pembeli pertama yang membagikan pengalamanmu!
                                    </p>

                                </div>

                            @endforelse

                        </div>

                        {{-- PAGINATION --}}
                        @if ($ulasan->hasPages())
                            <div class="mt-6 border-t border-[#F1DCC8] pt-5">
                                {{ $ulasan->links() }}
                            </div>
                        @endif

                    </div>

                </div>


                {{-- ==========================================
                    TAB PENJUAL
                =========================================== --}}
                <div id="tabContent-penjual"
                    data-tab-content="penjual"
                    role="tabpanel"
                    aria-labelledby="tabButton-penjual"
                    class="product-tab-content hidden">

                    <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">

                        {{-- PROFIL TOKO --}}
                        <div class="rounded-2xl border border-[#F1DCC8] bg-gradient-to-br from-[#FFFAF5] to-white p-5 sm:p-6 lg:col-span-2">

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                                <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-orange-100 bg-white">

                                    @if ($produk->toko->foto_profil)
                                        <img src="{{ asset('storage/' . $produk->toko->foto_profil) }}"
                                            alt="{{ $produk->toko->nama_toko }}"
                                            class="h-full w-full object-cover">
                                    @else
                                        <i class="fa-solid fa-store text-3xl text-orange-400"></i>
                                    @endif

                                </div>

                                <div class="min-w-0 flex-1">

                                    <p class="text-[10px] font-bold uppercase tracking-wider text-orange-600">
                                        Toko Penjual
                                    </p>

                                    <h3 class="mt-1 truncate text-xl font-extrabold text-[#3B2115]">
                                        {{ $produk->toko->nama_toko }}
                                    </h3>

                                    <p class="mt-2 text-xs text-[#8A7568]">
                                        <i class="fa-solid fa-calendar-days mr-1 text-orange-500"></i>
                                        Bergabung {{ $produk->toko->created_at?->translatedFormat('F Y') }}
                                    </p>

                                </div>

                            </div>

                            <div class="mt-6 border-t border-orange-100 pt-5">

                                <h4 class="text-sm font-bold text-[#3B2115]">
                                    Alamat Toko
                                </h4>

                                <div class="mt-3 flex items-start gap-3 rounded-xl bg-white p-4">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-50 text-orange-600">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>

                                    <p class="text-xs leading-6 text-[#72594B]">
                                        {{ $produk->toko->alamat ?: 'Alamat toko belum tersedia.' }}
                                    </p>

                                </div>

                            </div>

                            <a href="{{ route('cust.detailToko', ['toko' => $produk->toko->slug]) }}"
                            class="mt-5 flex h-11 w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 text-xs font-bold text-white shadow-md shadow-orange-100 transition hover:brightness-105">

                                <i class="fa-solid fa-store"></i>
                                Kunjungi Halaman Toko
                                <i class="fa-solid fa-arrow-right ml-1"></i>

                            </a>

                        </div>

                        {{-- STATISTIK TOKO --}}
                        <div class="space-y-3">

                            <h4 class="text-sm font-extrabold text-[#3B2115]">
                                Statistik Toko
                            </h4>

                            <div class="rounded-2xl border border-[#F1DCC8] bg-white p-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                                        <i class="fa-solid fa-box-open"></i>
                                    </div>

                                    <div>
                                        <p class="text-xl font-black text-[#3B2115]">
                                            {{ number_format($jumlahProduk, 0, ',', '.') }}
                                        </p>
                                        <p class="text-[10px] text-[#8A7568]">
                                            Produk Aktif
                                        </p>
                                    </div>

                                </div>

                            </div>

                            <div class="rounded-2xl border border-[#F1DCC8] bg-white p-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-500">
                                        <i class="fa-solid fa-star"></i>
                                    </div>

                                    <div>
                                        <p class="text-xl font-black text-[#3B2115]">
                                            {{ number_format($rating, 1, ',', '.') }}
                                        </p>
                                        <p class="text-[10px] text-[#8A7568]">
                                            Rating Produk Ini
                                        </p>
                                    </div>

                                </div>

                            </div>

                            <div class="rounded-2xl border border-[#F1DCC8] bg-white p-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-green-600">
                                        <i class="fa-solid fa-comments"></i>
                                    </div>

                                    <div>
                                        <p class="text-xl font-black text-[#3B2115]">
                                            {{ number_format($jumlahUlasan, 0, ',', '.') }}
                                        </p>
                                        <p class="text-[10px] text-[#8A7568]">
                                            Ulasan Produk Ini
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- PRODUK LAINNYA --}}
        <section class="space-y-5">

            <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-end">

                <div>
                    <h2 class="text-xl font-extrabold text-[#3B2115] sm:text-2xl">
                        Produk Lainnya dari Penjual
                    </h2>

                    <p class="mt-1 text-sm text-[#8A7568]">
                        Temukan produk menarik lainnya dari toko ini.
                    </p>
                </div>

                <a href="{{ route('cust.detailToko', ['toko' => $produk->toko->slug]) }}"
                   class="text-xs font-bold text-orange-600 transition hover:text-orange-700">
                    Lihat semua produk
                    <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>

            </div>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-4">

                @forelse ($anotherProduk as $item)

                    <x-card-produk :produk="$item" />

                @empty

                    <div class="col-span-full rounded-2xl border border-dashed border-orange-200 bg-white p-10 text-center">

                        <i class="fa-regular fa-face-frown text-4xl text-orange-300"></i>

                        <h3 class="mt-4 font-bold text-[#3B2115]">
                            Belum ada produk lainnya
                        </h3>

                        <p class="mt-1 text-sm text-[#72594B]">
                            Penjual belum memiliki produk lain yang tersedia.
                        </p>

                    </div>

                @endforelse

            </div>

        </section>

        {{-- BANNER --}}
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#D9490B] via-orange-500 to-[#FF922E] px-6 py-8 shadow-sm sm:px-8 lg:px-10">

            <div class="pointer-events-none absolute -right-12 -top-20 h-56 w-56 rounded-full bg-white/10 blur-2xl"></div>
            <div class="pointer-events-none absolute -bottom-20 left-1/3 h-48 w-48 rounded-full bg-white/10 blur-2xl"></div>

            <div class="relative flex flex-col items-center justify-between gap-6 md:flex-row">

                <div class="flex flex-col items-center gap-4 text-center sm:flex-row sm:text-left">

                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border border-white/20 bg-white/15 text-white">
                        <i class="fa-solid fa-store text-3xl"></i>
                    </div>

                    <div>
                        <h2 class="text-xl font-extrabold text-white sm:text-2xl">
                            Dukung Produk UMKM Lokal
                        </h2>

                        <p class="mt-2 max-w-lg text-sm leading-6 text-orange-50">
                            Temukan produk berkualitas dan dukung pertumbuhan pelaku UMKM Indonesia.
                        </p>
                    </div>

                </div>

                <a href="{{ route('cust.pilihanProduk') }}"
                   class="shrink-0 rounded-full bg-white px-6 py-3 text-sm font-bold text-orange-600 shadow-sm transition hover:bg-orange-50">
                    Jelajahi Produk
                    <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>

            </div>

        </section>

        {{-- MODAL PEMESANAN --}}
        <div id="orderSheet"
             data-product-id="{{ $produk->id }}"
             data-product-price="{{ $produk->harga }}"
             data-product-stock="{{ $produk->stok }}"
             class="invisible fixed inset-0 z-100"
             aria-hidden="true">

            <div id="orderBackdrop"
                 class="absolute inset-0 bg-[#24140D]/55 opacity-0 backdrop-blur-[3px] transition-opacity duration-300"></div>

            <div class="absolute inset-x-0 bottom-0 flex justify-center sm:inset-0 sm:items-center sm:p-4">

                <div id="orderPanel"
                     role="dialog"
                     aria-modal="true"
                     aria-labelledby="orderSheetTitle"
                     class="absolute bottom-0 left-0 right-0 mx-auto flex max-h-[88dvh] w-full max-w-lg translate-y-full flex-col overflow-hidden rounded-t-3xl bg-white shadow-2xl transition-transform duration-300 ease-out sm:bottom-auto sm:top-1/2 sm:max-h-[85dvh] sm:-translate-y-1/2 sm:rounded-3xl">

                    {{-- HEADER MODAL --}}
                    <div class="relative shrink-0 overflow-hidden bg-gradient-to-r from-orange-500 to-[#D9490B] px-5 py-4">

                        <div class="pointer-events-none absolute -right-8 -top-10 h-28 w-28 rounded-full bg-white/10"></div>

                        <div class="relative flex items-center justify-between gap-3">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-white/20 bg-white/15 text-white">
                                    <i class="fa-solid fa-bag-shopping text-lg"></i>
                                </div>

                                <div>
                                    <p class="text-[10px] text-orange-100">LokaMarket</p>
                                    <h2 id="orderSheetTitle" class="text-lg font-extrabold text-white">
                                        Pesan Produk
                                    </h2>
                                    <p class="text-[11px] text-orange-50">
                                        Atur jumlah pesananmu
                                    </p>
                                </div>

                            </div>

                            <button type="button"
                                    data-order-close
                                    aria-label="Tutup pemesanan"
                                    class="flex h-9 w-9 items-center justify-center rounded-full border border-white/20 bg-white/15 text-white transition hover:bg-white/25">
                                <i class="fa-solid fa-xmark"></i>
                            </button>

                        </div>

                        <div class="relative mt-4 flex items-center justify-between rounded-xl border border-white/15 bg-white/10 px-3 py-2">

                            <span class="text-xs font-medium text-white">
                                <i class="fa-solid fa-box-open mr-1.5"></i>
                                Stok tersedia
                            </span>

                            <span class="rounded-full bg-white px-3 py-1 text-[10px] font-bold {{ $produk->stok > 0 ? 'text-green-700' : 'text-red-600' }}">
                                {{ number_format($produk->stok, 0, ',', '.') }} item
                            </span>

                        </div>

                    </div>

                    {{-- BODY MODAL --}}
                    <div class="min-h-0 flex-1 space-y-5 overflow-y-auto overscroll-contain px-5 py-5">

                        {{-- PRODUK --}}
                        <div class="flex items-center gap-3">

                            <div class="h-16 w-16 shrink-0 overflow-hidden rounded-xl border border-orange-100 bg-orange-50">

                                @if ($produk->thumbnail && $produk->thumbnail->foto)

                                    <img src="{{ asset('storage/' . $produk->thumbnail->foto) }}"
                                         alt="{{ $produk->nama }}"
                                         class="h-full w-full object-cover">

                                @else

                                    <div class="flex h-full w-full items-center justify-center text-orange-400">
                                        <i class="fa-regular fa-image text-xl"></i>
                                    </div>

                                @endif

                            </div>

                            <div class="min-w-0 flex-1">

                                <span class="inline-flex rounded-full bg-orange-50 px-2.5 py-1 text-[10px] font-semibold text-orange-600">
                                    {{ $produk->kategori->nama ?? 'Produk Lokal' }}
                                </span>

                                <p class="mt-1 line-clamp-2 text-sm font-bold text-[#3B2115]">
                                    {{ $produk->nama }}
                                </p>

                                <p class="mt-1 text-sm font-extrabold text-orange-600">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </p>

                            </div>

                        </div>

                        <div class="border-t border-dashed border-orange-200"></div>

                        {{-- KUANTITAS --}}
                        <div class="flex items-center justify-between gap-3">

                            <div>
                                <p class="text-sm font-bold text-[#3B2115]">
                                    Jumlah Produk
                                </p>

                                <p class="mt-1 text-xs text-[#8A7568]">
                                    Pilih jumlah yang ingin dibeli
                                </p>
                            </div>

                            <div class="flex shrink-0 items-center gap-2 rounded-xl border border-orange-200 bg-orange-50/70 p-1">

                                <button type="button"
                                        onclick="orderDecreaseQuantity()"
                                        aria-label="Kurangi jumlah"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-orange-600 transition hover:bg-orange-100">
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
                                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-orange-600 transition hover:bg-orange-100">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>

                            </div>

                        </div>

                        {{-- RINGKASAN --}}
                        <div class="rounded-2xl border border-orange-100 bg-[#FFFAF5] p-4">

                            <div class="flex items-center justify-between gap-3">
                                <span class="text-xs text-[#72594B]">Harga satuan</span>

                                <span class="text-xs font-semibold text-[#3B2115]">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="mt-3 flex items-center justify-between gap-3">
                                <span class="text-xs text-[#72594B]">Jumlah pesanan</span>

                                <span id="orderSummary" class="text-xs font-semibold text-[#3B2115]">
                                    1 item
                                </span>
                            </div>

                            <div class="my-4 border-t border-dashed border-orange-200"></div>

                            <div class="flex items-center justify-between gap-3">

                                <div>
                                    <p class="text-sm font-bold text-[#3B2115]">Total Harga</p>
                                    <p class="mt-1 text-[10px] text-[#8A7568]">
                                        Belum termasuk ongkos kirim
                                    </p>
                                </div>

                                <span id="orderTotal" class="text-lg font-black text-orange-600">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>

                    </div>

                    {{-- FOOTER MODAL --}}
                    <div class="shrink-0 border-t border-orange-100 bg-white px-5 py-4 pb-[calc(1rem+env(safe-area-inset-bottom))]">

                        <button type="button"
                                id="orderSubmitButton"
                                onclick="submitOrder()"
                                @disabled($produk->stok <= 0)
                                class="flex min-h-12 w-full items-center justify-center rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-4 py-3 text-sm font-bold text-white shadow-md shadow-orange-200 transition hover:brightness-105 active:scale-[0.99] disabled:cursor-not-allowed disabled:opacity-50">

                            <i id="orderSubmitIcon" class="fa-solid fa-cart-shopping mr-2"></i>

                            <span id="orderSubmitText">
                                Tambah ke Keranjang
                            </span>

                            <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>

                        </button>

                        <p class="mt-3 flex items-center justify-center gap-2 text-center text-[10px] text-[#8A7568]">
                            <i class="fa-solid fa-shield-halved text-green-600"></i>
                            {{ $produk->stok > 0 ? 'Pesanan aman dan mudah di LokaMarket' : 'Produk sedang habis dan belum dapat dipesan' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

@endsection
