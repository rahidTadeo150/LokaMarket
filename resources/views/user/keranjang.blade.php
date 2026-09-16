@extends('layouts.customer')

@section('title', 'Keranjang - LokaMarket')

@section('content')
    <main class="min-h-screen bg-[#FFF9F4]">
        <section class="relative overflow-hidden">

            <div class="pointer-events-none absolute -right-24 -top-24 h-64 w-64 rounded-full bg-orange-200/30 blur-3xl"></div>
            <div class="pointer-events-none absolute -left-24 top-32 h-52 w-52 rounded-full bg-orange-100/40 blur-3xl"></div>

            <div class="relative mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

                <a href="{{ url('/') }}"
                class="group mb-5 inline-flex items-center gap-2 text-sm font-medium
                        text-[#72594B] transition hover:text-orange-500">
                    <i class="fa-solid fa-arrow-left text-xs transition-transform duration-300 group-hover:-translate-x-1"></i>
                    Lanjut Belanja
                </a>

                <div class="relative overflow-hidden rounded-2xl md:rounded-3xl bg-linear-to-br from-orange-500 via-orange-500 to-[#D9490B] px-5 py-6 text-white shadow-lg shadow-orange-200/50">

                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-12 -left-8 h-28 w-28 rounded-full bg-orange-300/20"></div>

                <div class="absolute right-16 top-8 h-20 w-20 rounded-full bg-white/10 blur-2xl"></div>

                <div class="relative flex items-center justify-between gap-4">

                    <div class="flex items-center gap-4">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 shadow-inner ring-1 ring-white/20 backdrop-blur-sm">
                            <i class="fa-solid fa-cart-shopping text-xl text-white"></i>
                        </div>

                        <div>
                            
                            <h2 class="mt-0.5 text-xl font-bold tracking-tight sm:text-2xl">
                                Keranjang Belanja
                            </h2>

                            <p class="mt-1 text-sm text-orange-100">
                                Siap checkout produk pilihanmu?
                            </p>

                        </div>

                    </div>

                    <div class="hidden shrink-0 text-right sm:block">

                        <p class="text-xs text-orange-100">
                            Total item dalam keranjang
                        </p>
                        <p class="mt-0.5 text-2xl font-bold">
                            {{ $totalItem }}
                        </p>

                    </div>

                </div>

            </div>

        </section>

        <section class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-5 items-start lg:gap-6 lg:grid-cols-[minmax(0,1fr)_400px]">

                <div class="overflow-hidden rounded-3xl border-2 border-orange-100 bg-white shadow-lg">

                    <div class="px-2 divide-y divide-orange-100">

                        @forelse ($keranjang?->detail ?? [] as $detail)

                            @php
                                $item = $detail->produk;
                                $subtotalItem = $item->harga * $detail->quantity;
                            @endphp

                            <div class="group p-4 sm:p-6"
                                data-cart-item="{{ $detail->id }}">
                                <div class="flex gap-3 sm:gap-5">

                                    <div class="relative h-24 w-24 shrink-0 overflow-hidden rounded-2xl bg-orange-50 sm:h-32 sm:w-32">

                                        <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/default-product.jpg') }}"
                                            alt="{{ $item->nama }}"
                                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                                        @if ($item->kategori)
                                            <span class="absolute left-2 top-2 rounded-full bg-orange-500 px-2 py-1 text-[9px] font-bold text-white sm:text-[10px]">
                                                {{ $item->kategori->nama }}
                                            </span>
                                        @endif

                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-between">

                                            <div class="min-w-0">

                                                <p class="truncate text-sm font-bold text-[#3B2115] sm:text-base">
                                                    {{ $item->nama }}
                                                </p>

                                                <div class="mt-2 flex flex-wrap items-center gap-2">

                                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-orange-50 px-3 py-1 text-xs font-semibold text-orange-700">
                                                        <i class="fa-solid fa-store text-[10px]"></i>
                                                        {{ $item->toko->nama_toko }}
                                                    </span>

                                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#FFF9F4] px-3 py-1 text-xs font-medium text-[#72594B]">
                                                        <i class="fa-solid fa-tag text-[10px]"></i>
                                                        {{ $item->kategori->nama }}
                                                    </span>

                                                </div>

                                            </div>

                                            <button type="button"
                                                    onclick="window.removeItem({{ $detail->id }})"
                                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-orange-500 transition hover:bg-red-50 hover:text-red-500 active:scale-95 sm:h-10 sm:w-10">
                                                <i class="fa-regular fa-trash-can text-sm"></i>
                                            </button>

                                        </div>

                                        <div class="mt-4 flex items-center justify-between sm:mt-5">

                                            <div class="inline-flex items-center rounded-xl border border-orange-100 bg-orange-50/40">

                                                <button type="button"
                                                        onclick="decreaseCart({{ $detail->id }})"
                                                        class="flex h-9 w-9 items-center justify-center text-orange-500 transition hover:bg-orange-100 active:scale-95">
                                                    <i class="fa-solid fa-minus text-[10px]"></i>
                                                </button>

                                                <span id="quantity-{{ $detail->id }}"
                                                    class="flex h-9 min-w-9 items-center justify-center text-sm font-bold text-[#3B2115]">
                                                    {{ $detail->quantity }}
                                                </span>

                                                <button type="button"
                                                        onclick="increaseCart({{ $detail->id }})"
                                                        class="flex h-9 w-9 items-center justify-center text-orange-500 transition hover:bg-orange-100 active:scale-95">
                                                    <i class="fa-solid fa-plus text-[10px]"></i>
                                                </button>

                                            </div>

                                            <div class="shrink-0 text-right">

                                                <p id="subtotal-{{ $detail->id }}"
                                                class="text-sm font-bold text-orange-500 sm:text-lg">
                                                    Rp {{ number_format($subtotalItem, 0, ',', '.') }}
                                                </p>

                                                <p class="mt-0.5 text-[10px] text-[#72594B]">
                                                    Rp {{ number_format($item->harga, 0, ',', '.') }} / item
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>

                        @empty

                            <div class="flex flex-col items-center justify-center px-6 py-14 text-center sm:py-20">

                                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-cart-shopping text-2xl"></i>
                                </div>

                                <p class="mt-5 text-lg font-bold text-[#3B2115] sm:text-xl">
                                    Keranjang Masih Kosong
                                </p>

                                <p class="mt-2 max-w-md text-xs leading-relaxed text-[#72594B] sm:text-sm">
                                    Belum ada produk di keranjangmu. Yuk temukan produk lokal favoritmu dan tambahkan ke keranjang.
                                </p>

                                <a href="{{ route('cust.pilihanProduk') }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-orange-200 transition hover:bg-orange-600 active:scale-95">
                                    Mulai Belanja
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>

                            </div>

                        @endforelse

                    </div>

                    <div class="m-4 rounded-2xl border border-orange-100 bg-orange-50/70 p-4 sm:m-6">
                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-orange-500 shadow-sm">
                                <i class="fa-solid fa-shield-heart"></i>
                            </div>

                            <div class="min-w-0">

                                <p class="text-xs font-bold text-[#3B2115] sm:text-sm">
                                    Belanja di LokaMarket lebih aman
                                </p>
                                <p class="mt-0.5 text-[10px] text-[#72594B] sm:text-xs">
                                    Produk dari UMKM terpercaya dengan kualitas terbaik.
                                </p>

                            </div>

                            <i class="fa-solid fa-shield-halved ml-auto hidden text-xl text-orange-400 sm:block"></i>

                        </div>
                    </div>

                </div>

                <div class="lg:sticky lg:top-24">

                    <div class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-lg">

                        <div class="relative overflow-hidden bg-linear-to-br from-orange-400 to-orange-600 px-5 py-5 text-white sm:px-6">

                            <div class="absolute -right-5 -top-10 h-28 w-28 rounded-full bg-white/10"></div>

                            <div class="relative flex items-center gap-3">
                                <p class="text-lg font-bold sm:text-xl">
                                    Ringkasan Belanja
                                </p>
                            </div>

                        </div>


                        <div class="p-5 sm:p-6">

                            <div class="flex items-center justify-between text-sm">

                                <span class="text-[#72594B]">
                                    Subtotal ({{ $totalItem }})
                                </span>
                                <span class="font-semibold text-[#3B2115]">
                                    Rp{{ number_format($subtotal, 0, ',', '.') }}
                                </span>

                            </div>

                            <div class="mt-5 flex items-center justify-between text-sm">

                                <span class="text-[#72594B]">
                                    Ongkos Kirim
                                </span>
                                <span class="font-semibold text-[#3B2115]">
                                    Rp{{ number_format($ongkir, 0, ',', '.') }}
                                </span>

                            </div>

                            <div class="mt-5 flex items-center gap-3 rounded-2xl bg-orange-50 p-4">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-orange-500 shadow-sm">
                                    <i class="fa-solid fa-truck"></i>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-bold text-orange-600">
                                        Gratis ongkir
                                    </p>
                                    <p class="mt-0.5 text-[10px] text-[#72594B] sm:text-xs">
                                        untuk pembelian minimum Rp 200.000
                                    </p>
                                </div>

                                <i class="fa-solid fa-chevron-right text-xs text-orange-400"></i>

                            </div>

                            <div class="my-6 border-t border-orange-100"></div>

                            <div class="flex items-center justify-between gap-3">

                                <span class="text-sm font-bold text-[#3B2115]">
                                    Total Pembayaran
                                </span>
                                <span class="whitespace-nowrap text-xl font-extrabold text-orange-500 sm:text-2xl">
                                    Rp{{ number_format($totalPembayaran, 0, ',', '.') }}
                                </span>

                            </div>

                            <button type="button"
                                    class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-linear-to-r from-orange-500 to-orange-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-200 transition duration-300 hover:-translate-y-0.5 hover:shadow-xl active:scale-[0.98]">
                                Checkout Sekarang
                                <i class="fa-solid fa-arrow-right text-xs"></i>

                            </button>


                            <button type="button"
                                    id="clearCartButton"
                                    class="cursor-pointer mt-3 flex w-full items-center justify-center gap-2 rounded-xl border border-orange-200 bg-white px-5 py-3 text-sm font-semibold text-orange-500 transition hover:bg-orange-50 active:scale">
                                <i class="fa-regular fa-trash-can"></i>
                                Kosongkan Keranjang
                            </button>

                            <div class="mt-6 grid grid-cols-3 gap-2 sm:gap-3">

                                <div class="text-center">
                                    <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                                        <i class="fa-solid fa-shield-halved text-xs"></i>
                                    </div>
                                    <p class="mt-2 text-[9px] font-bold text-[#3B2115] sm:text-[10px]">
                                        Pembayaran Aman
                                    </p>
                                </div>


                                <div class="text-center">
                                    <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                                        <i class="fa-solid fa-truck-fast text-xs"></i>
                                    </div>

                                    <p class="mt-2 text-[9px] font-bold text-[#3B2115] sm:text-[10px]">
                                        Pengiriman Cepat
                                    </p>
                                </div>


                                <div class="text-center">
                                    <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                                        <i class="fa-solid fa-heart text-xs"></i>
                                    </div>
                                    <p class="mt-2 text-[9px] font-bold text-[#3B2115] sm:text-[10px]">
                                        Produk Lokal
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
            
            <div class="mb-10 flex items-end justify-between">

                <div>

                    <div class="flex items-center gap-2">

                        <span class="text-lg text-orange-500 sm:text-xl">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                        </span>
                        <h2 class="text-lg font-bold text-[#3B2115] sm:text-2xl">
                            Rekomendasi untuk Anda
                        </h2>

                    </div>

                    <p class="mt-1 text-xs text-[#72594B] sm:text-sm">
                        Produk pilihan yang mungkin Anda suka
                    </p>

                </div>

                <a href="{{ route('cust.pilihanProduk') }}"
                class="hidden items-center gap-2 text-sm font-semibold text-orange-500 transition hover:text-orange-600 sm:flex">

                    Lihat Semua
                    <i class="fa-solid fa-arrow-right text-xs"></i>

                </a>

            </div>

            <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 sm:gap-4 lg:grid-cols-4">
                
                @foreach ($produk as $items)
                <x-card-produk :produk="$items"/>
                @endforeach

            </div>

        </section>

        <div id="clearCartModal"
            class="fixed inset-0 z-100 hidden items-center justify-center bg-black/40 px-4 backdrop-blur-sm">
            <div id="clearCartContent"
                class="w-full max-w-sm scale-95 rounded-3xl border border-orange-100 bg-white p-6 opacity-0 shadow-2xl transition-all duration-300">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50 text-orange-500">
                    <i class="fa-solid fa-trash-can text-xl"></i>
                </div>

                <div class="mt-5 text-center">

                    <p class="text-lg font-bold text-[#3B2115]">
                        Kosongkan Keranjang?
                    </p>
                    <p class="mt-2 text-xs leading-relaxed text-[#72594B] sm:text-sm">
                        Semua produk yang ada di keranjang akan dihapus. Tindakan ini tidak dapat dibatalkan.
                    </p>

                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">

                    <button type="button"
                            id="cancelClearCart"
                            class="rounded-xl border border-orange-200 bg-white px-4 py-3 text-sm font-semibold text-[#72594B] transition hover:bg-orange-50 active:scale-[0.98]">
                        Batal
                    </button>

                    <button type="button"
                            id="confirmClearCart"
                            class="rounded-xl bg-orange-500 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-orange-200 transition hover:bg-orange-600 active:scale-[0.98]">
                        Kosongkan
                    </button>

                </div>

            </div>
        </div>

    </main>

@endsection