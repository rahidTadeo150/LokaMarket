@extends('layouts.customer')

@section('title', 'Wishlist Kamu - LokaMarket')

@section('content')
<main class="min-h-screen bg-[#FFF9F4]">

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <section class="relative overflow-hidden">

            <div class="relative mx-auto max-w-7xl py-6">

                <button type="button"
                        onclick="history.back()"
                        class="group inline-flex mb-5 items-center gap-2 text-sm font-medium text-slate-600 hover:text-orange-600 transition">
                    
                    <span class="flex items-center justify-center w-9 h-9 rounded-full bg-white border border-orange-100 shadow-sm group-hover:bg-orange-50 group-hover:border-orange-200 transition">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                    </span>

                    <span>
                        kembali
                    </span>

                </button>

                <div class="relative overflow-hidden rounded-2xl bg-linear-to-br from-orange-500 via-orange-500 to-[#D9490B] px-5 py-6 text-white shadow-xl shadow-orange-200/50 sm:px-7 sm:py-7 md:rounded-3xl">

                    <div class="absolute -right-12 -top-16 h-40 w-40 rounded-full border-18 border-white/10"></div>
                    <div class="absolute -bottom-16 -left-12 h-40 w-40 rounded-full border-14 border-white/10"></div>
                    <div class="absolute right-32 top-6 h-20 w-20 rounded-full bg-white/10 blur-2xl"></div>

                    <i class="fa-solid fa-heart pointer-events-none absolute right-8 top-8 rotate-12 text-3xl text-white/10 sm:right-16 sm:text-5xl"></i>
                    <i class="fa-solid fa-heart pointer-events-none absolute bottom-5 right-24 -rotate-12 text-lg text-white/10"></i>


                    <div class="relative flex items-center justify-between gap-5">

                        <div class="flex min-w-0 items-center gap-4 sm:gap-5">

                            <div class="relative flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 shadow-inner ring-1 ring-white/25 backdrop-blur-md sm:h-16 sm:w-16">
                                <div class="absolute inset-1 rounded-xl border border-white/10"></div>
                                <i class="fa-solid fa-heart relative text-xl text-white sm:text-2xl"></i>
                            </div>

                            <div class="min-w-0">

                                <div class="mb-1 flex items-center gap-2">
                                    <span class="rounded-full bg-white/15 px-2.5 py-1 text-[9px] font-bold uppercase tracking-wider text-orange-50 ring-1 ring-white/10">
                                        Favoritmu
                                    </span>
                                </div>

                                <p class="truncate text-xl font-extrabold tracking-tight sm:text-2xl lg:text-3xl">
                                    Wishlist Kamu
                                </p>

                                <p class="mt-1 max-w-md text-xs leading-relaxed text-orange-100 sm:text-sm">
                                    Kumpulan produk yang kamu sukai dan ingin dibeli nanti.
                                </p>

                            </div>

                        </div>

                        <div class="hidden shrink-0 sm:flex sm:items-center sm:gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                                <i class="fa-regular fa-bookmark text-sm"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="mb-7 grid grid-cols-1 gap-3 sm:grid-cols-2 sm:gap-4">

            <div class="rounded-2xl border border-orange-100 bg-white p-4 shadow-sm sm:p-5">
                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <div>
                        <p class="text-[10px] font-medium text-[#A08F85]">
                            Produk Disimpan
                        </p>
                        <p class="mt-1 text-lg font-extrabold text-[#3B2115]">
                            {{ number_format($totalWishlist, 0, ',', '.') }} Produk
                        </p>
                    </div>

                </div>

            </div>

            <div class="rounded-2xl border border-orange-100 bg-white p-4 shadow-sm sm:p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                        <i class="fa-solid fa-tags"></i>
                    </div>

                    <div>
                        <p class="text-[10px] font-medium text-[#A08F85]">
                            Perkiraan Nilai
                        </p>
                        <p class="mt-1 text-lg font-extrabold text-[#3B2115]">
                            Rp{{ number_format($totalNilai, 0, ',', '.') }}
                        </p>
                    </div>

                </div>

            </div>

        </section>

        <section class="mb-7 rounded-2xl border border-orange-100 bg-white p-4 shadow-sm">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex flex-wrap items-center gap-3">

                    <label class="group flex cursor-pointer items-center gap-2.5 text-xs font-bold text-[#3B2115]">

                        <input type="checkbox"
                            id="selectAllWishlist"
                            class="select-all-checkbox peer sr-only"
                            aria-label="Pilih semua produk">

                        <span class="flex h-5 w-5 items-center justify-center rounded-md border border-orange-200 bg-white text-transparent shadow-sm transition-all duration-200 group-hover:border-orange-400 peer-checked:border-orange-500 peer-checked:bg-orange-500 peer-checked:text-white peer-focus-visible:ring-4 peer-focus-visible:ring-orange-300/50">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </span>

                        <span class="transition-colors duration-200 group-hover:text-orange-600">
                            Pilih semua
                        </span>

                    </label>

                    <span class="hidden h-5 w-px bg-orange-100 sm:block"></span>

                    <form id="deleteWishlistForm"
                        action="{{ route('cust.wishlist.deleteSelected') }}"
                        method="POST"
                        class="hidden">

                        @csrf
                        @method('DELETE')
                        <div id="selectedWishlistInputs"></div>
                    </form>

                    <button type="button"
                            id="deleteSelectedWishlist"
                            disabled
                            data-theme="red"
                            data-title="Hapus Produk Wishlist?"
                            data-confirm-text="Ya, Hapus"
                            data-icon="fa-trash-can"
                            class="cursor-pointer text-xs font-semibold text-red-500 transition hover:text-red-600 disabled:cursor-not-allowed disabled:opacity-40">
                        <i class="fa-regular fa-trash-can mr-1"></i>
                        Hapus pilihan
                        <span id="selectedWishlistCount" class="ml-1">(0)</span>
                    </button>

                </div>

                <div class="flex items-center gap-2">

                    <span class="hidden text-[10px] font-medium text-[#A08F85] sm:block">
                        Urutkan
                    </span>

                    <div class="relative">

                        <select class="appearance-none rounded-xl border border-orange-100 bg-[#FFF9F4] py-2.5 pl-4 pr-9 text-xs font-bold text-[#3B2115] outline-none transition focus:border-orange-400">
                            <option>Terbaru</option>
                            <option>Harga Terendah</option>
                            <option>Harga Tertinggi</option>
                            <option>Nama Produk</option>
                        </select>

                        <i class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[9px] text-[#A08F85] fa-solid fa-chevron-down"></i>

                    </div>

                </div>

            </div>

            <div class="mt-4 flex gap-2 overflow-x-auto pb-1">

                <a href="{{ route('cust.wishlist') }}"
                class="shrink-0 rounded-full px-4 py-2 text-[10px] font-bold transition {{ !request('kategori') ? 'bg-[#EA4F0C] text-white shadow-sm' : 'border border-orange-100 bg-white text-[#72594B] hover:bg-orange-50' }}">
                    Semua
                </a>

                @forelse ($kategoriWishlist as $kategori)
                <a href="{{ route('cust.wishlist', array_merge(request()->except('page'), ['kategori' => $kategori->slug])) }}"
                class="shrink-0 rounded-full border px-4 py-2 text-[10px] font-bold transition {{ request('kategori') === $kategori->slug ? 'border-[#EA4F0C] bg-[#EA4F0C] text-white shadow-sm' : 'border-orange-100 bg-white text-[#72594B] hover:bg-orange-50' }}">
                    {{ $kategori->nama }}
                </a>
                @empty
                <span class="px-2 py-2 text-[10px] text-[#A08F85]">
                    Belum ada kategori di wishlist.
                </span>
                @endforelse

            </div>

        </section>

        @if ($wishlists->count())
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                @foreach ($wishlists as $item)
                @continue(!$item->produk)
                <article class="group relative flex flex-col overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div class="relative h-44 overflow-hidden bg-orange-50 sm:h-48">

                        <a href="{{ route('cust.detailProduk', $item->produk->slug) }}"
                        class="flex h-full w-full items-center justify-center">

                            @if ($item->produk->thumbnail && $item->produk->thumbnail->foto)
                            <img src="{{ asset('storage/' . $item->produk->thumbnail->foto) }}"
                                alt="{{ $item->produk->nama }}"
                                class="h-full w-full object-cover"
                                loading="lazy">
                            @else
                            <img src="{{ asset('images/default-product.jpg') }}"
                                alt="Foto produk tidak tersedia"
                                class="h-full w-full object-cover"
                                loading="lazy">
                            @endif

                        </a>

                        <div class="absolute left-3 top-3 z-10">

                            <label class="group relative flex cursor-pointer items-center justify-center">

                                <input type="checkbox"
                                    name="selected_wishlist[]"
                                    value="{{ $item->id }}"
                                    class="wishlist-checkbox peer sr-only"
                                    aria-label="Pilih {{ $item->produk->nama }}">

                                <span class="flex h-6 w-6 items-center justify-center rounded-lg
                                        border border-white/80 bg-white/90 text-transparent
                                        shadow-md backdrop-blur-sm
                                        transition-all duration-200 ease-out
                                        group-hover:scale-110 group-hover:border-orange-400
                                        peer-checked:scale-105 peer-checked:border-orange-500
                                        peer-checked:bg-orange-500 peer-checked:text-white
                                        peer-focus-visible:ring-4 peer-focus-visible:ring-orange-300/60">
                                    <i class="fa-solid fa-check text-xs transition-transform duration-200 peer-checked:scale-100"></i>
                                </span>

                            </label>

                        </div>

                        <x-wishlist-button :produk="$item->produk" :is-wishlisted="$item->produk->is_wishlisted ?? false"/>

                        @if (($item->produk->stok ?? 0) <= 0)
                            <span class="absolute bottom-3 left-3 rounded-full bg-red-500 px-2.5 py-1 text-[9px] font-bold text-white">
                                Stok habis
                            </span>
                        @elseif (($item->produk->stok ?? 0) <= 5)
                            <span class="absolute bottom-3 left-3 rounded-full bg-amber-100 px-2.5 py-1 text-[9px] font-bold text-amber-800">
                                Stok terbatas
                            </span>
                        @endif

                    </div>

                    <div class="flex flex-1 flex-col p-3 sm:p-4">

                        <p class="text-[10px] font-bold text-orange-500">
                            {{ $item->produk->kategori->nama ?? 'Kategori lainnya' }}
                        </p>

                        <a href="{{ route('cust.detailProduk', $item->produk->slug) }}">
                            <p class="mt-1 line-clamp-2 text-sm font-bold leading-5 text-[#3B2115] transition hover:text-orange-600">
                                {{ $item->produk->nama }}
                            </p>
                        </a>

                        <p class="mt-3 text-base font-extrabold text-[#EA4F0C]">
                            Rp{{ number_format($item->produk->harga, 0, ',', '.') }}
                        </p>

                        <p class="mt-1 truncate text-[10px] text-[#A08F85]">
                            {{ $item->produk->toko->nama_toko ?? 'Toko lokal' }}
                        </p>

                        <div class="mt-auto flex items-center justify-between gap-2 border-t border-dashed border-orange-100 pt-3">

                            <span class="text-[9px] text-[#A08F85]">
                                Disimpan {{ $item->created_at?->diffForHumans() ?? '-' }}
                            </span>

                            <a href="{{ route('cust.detailProduk', $item->produk->slug) }}"
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#EA4F0C] text-white transition hover:bg-[#D4460A]"
                            aria-label="Lihat {{ $item->produk->nama }}"
                            title="Lihat produk">
                                <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            </a>

                        </div>

                    </div>

                </article>
                @endforeach

            </div>

            @if ($wishlists->hasPages())
            <div class="mt-8 rounded-2xl border border-orange-100 bg-white px-4 py-4 shadow-sm sm:px-5">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <p class="text-xs text-[#72594B]">
                        Menampilkan
                        <span class="font-bold text-[#3B2115]">
                            {{ $wishlists->firstItem() }}–{{ $wishlists->lastItem() }}
                        </span>
                        dari
                        <span class="font-bold text-[#3B2115]">
                            {{ $wishlists->total() }}
                        </span>
                        produk
                    </p>

                    <div class="flex flex-wrap items-center gap-2">
                        @if ($wishlists->onFirstPage())
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl border border-orange-100 text-gray-300">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </span>
                        @else
                        <a href="{{ $wishlists->previousPageUrl() }}"
                        class="flex h-9 w-9 items-center justify-center rounded-xl border border-orange-100 text-[#72594B] transition hover:border-orange-300 hover:bg-orange-50">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </a>
                        @endif

                        @foreach ($wishlists->getUrlRange(1, $wishlists->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                        class="flex h-9 min-w-9 items-center justify-center rounded-xl px-3 text-xs font-bold transition
                        {{ $page == $wishlists->currentPage()
                                ? 'bg-[#EA4F0C] text-white shadow-sm'
                                : 'border border-orange-100 bg-white text-[#72594B] hover:bg-orange-50' }}">
                            {{ $page }}
                        </a>
                        @endforeach

                        @if ($wishlists->hasMorePages())
                        <a href="{{ $wishlists->nextPageUrl() }}"
                        class="flex h-9 w-9 items-center justify-center rounded-xl border border-orange-100 text-[#72594B] transition hover:border-orange-300 hover:bg-orange-50">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </a>
                        @else
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl border border-orange-100 text-gray-300">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </span>
                        @endif
                    </div>

                </div>
            </div>
            @endif

        @else
        <div class="rounded-3xl border border-dashed border-orange-200 bg-white px-5 py-14 text-center shadow-sm sm:py-16">

            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-orange-50 text-orange-400">
                <i class="fa-regular fa-heart text-3xl"></i>
            </div>

            <h3 class="mt-5 text-lg font-extrabold text-[#3B2115]">
                Wishlist kamu masih kosong
            </h3>

            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#72594B]">
                Simpan produk yang kamu sukai dengan menekan ikon hati agar mudah ditemukan saat ingin berbelanja.
            </p>

            <a href="{{ route('cust.pilihanProduk') }}"
            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#EA4F0C] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#D4460A]">
                <i class="fa-solid fa-bag-shopping"></i>
                Jelajahi Produk
            </a>

        </div>
        @endif

        <div class="mt-8 flex flex-col gap-3 rounded-2xl border border-orange-100 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-bold text-[#3B2115]">
                    Sudah menemukan produk favorit?
                </p>
                <p class="mt-1 text-[10px] text-[#A08F85]">
                    Tambahkan produk pilihanmu ke keranjang dan lanjutkan belanja.
                </p>
            </div>

            <a href="{{ route('cust.keranjang') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#EA4F0C] px-5 py-3 text-xs font-bold text-white shadow-sm transition hover:bg-[#D4460A]">
                <i class="fa-solid fa-cart-shopping"></i>
                Lihat Keranjang
            </a>

        </div>

    </div>

    <x-custom-alert-confirmation/>

</main>
@endsection