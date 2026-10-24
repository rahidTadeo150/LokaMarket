@extends('layouts.customer')

@section('title', 'Pilihan Produk - LokaMarket')

@section('content')
    <main class="min-h-screen bg-[#FFF9F4]">
        <section class="relative isolate overflow-hidden bg-linear-to-br from-[#FFF3E2] to-[#FBAD51] px-4 py-8 sm:px-6 sm:py-10">
           
            <div class="absolute -right-10 -top-10 -z-10 h-32 w-32 rounded-full bg-orange-300/30 blur-2xl"></div>
            <div class="absolute -bottom-8 -left-8 -z-10 h-24 w-24 rounded-full bg-white/30 blur-xl"></div>

            <div class="absolute right-8 top-5 -z-10 h-20 w-20 opacity-30"
                style="background-image: radial-gradient(#D97706 1px, transparent 1px); background-size: 10px 10px;">
            </div>

            <div class="mx-auto w-full max-w-7xl">

                <div class="flex justify-center">
                    <div class="inline-flex items-center gap-2 rounded-full border border-orange-200 bg-white/70 px-3 py-1.5 shadow-sm backdrop-blur-sm">

                        <i class="fa-solid fa-store text-xs text-orange-600"></i>
                        <span class="text-xs font-semibold text-orange-700">
                            Produk UMKM Pilihan
                        </span>
                        
                    </div>
                </div>

                <div class="mt-3 text-center">

                    <h1 class="text-2xl font-bold tracking-tight text-[#3B2115] sm:text-3xl md:text-4xl">
                        Produk UMKM
                        <span class="text-orange-600">Untuk Anda</span>
                    </h1>
                    <p class="mx-auto mt-2 max-w-xl text-sm text-[#72594B] sm:text-base">
                        Temukan berbagai produk terbaik dari UMKM lokal
                        untuk memenuhi kebutuhan Anda.
                    </p>

                </div>

                <div class="mt-4 flex flex-wrap justify-center gap-2">

                    <span class="inline-flex items-center gap-1.5 rounded-full bg-white/60 px-3 py-1.5 text-xs font-medium text-[#72594B]">
                        <i class="fa-solid fa-circle-check text-orange-500"></i>
                        Berkualitas
                    </span>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-white/60 px-3 py-1.5 text-xs font-medium text-[#72594B]">
                        <i class="fa-solid fa-heart text-orange-500"></i>
                        Dukung UMKM
                    </span>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-white/60 px-3 py-1.5 text-xs font-medium text-[#72594B]">
                        <i class="fa-solid fa-box-open text-orange-500"></i>
                        Banyak Pilihan
                    </span>

                </div>

            </div>
        </section>

        <section class="bg-[#FFF9F4] px-4 py-12 sm:px-6 md:py-16">
            <div class="mx-auto max-w-7xl">

                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex-1">
                        <form id="searchForm"
                            method="GET"
                            action="{{ url()->current() }}"
                            class="relative">

                            <input type="hidden"
                                    name="kategori"
                                    value="{{ request('kategori') }}">

                            <input type="hidden"
                                    name="sort"
                                    value="{{ request('sort', 'default') }}">

                            <input type="search"
                                id="searchInput"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari produk, toko, atau kategori..."
                                autocomplete="off"
                                maxlength="100"
                                class="w-full rounded-full border border-gray-300 bg-white px-5 py-3 pr-24 text-sm text-[#3B2115] placeholder-[#A58C7D] transition focus:border-[#FF6B00] focus:outline-none focus:ring-2 focus:ring-[#FFD1AD]">

                            @if (request()->filled('search'))
                            <a href="{{ request()->url() . '?' . http_build_query(request()->except('search', 'page')) }}"
                            class="absolute right-12 top-1/2 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full text-[#8A7568] transition hover:bg-orange-50 hover:text-orange-600"
                            aria-label="Hapus pencarian">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                            @endif

                            <button type="submit"
                                    class="absolute right-2 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-[#FF6B00] text-white transition hover:bg-[#E85D00]"
                                    aria-label="Cari produk">
                                <i class="fa-solid fa-magnifying-glass text-sm"></i>
                            </button>

                        </form>
                    </div>

                    <button type="button"
                            onclick="toggleFilter()"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-[#F1DCC8] bg-white px-4 py-3 text-sm font-medium text-[#72594B] shadow-sm transition hover:border-[#FF6B00] hover:text-[#C1440E] md:hidden">
                        <i class="fa-solid fa-sliders"></i>
                        <span>Filter</span>
                    </button>

                </div>

                <div class="grid items-start grid-cols-1 gap-6 md:grid-cols-[280px_minmax(0,1fr)]">

                    <aside id="filterSidebar" class="hidden md:block">

                        <div class="sticky top-24 rounded-xl border border-[#F1DCC8] bg-[#FFF7F0] p-4 shadow-sm">
                            <x-product-filter
                                :kategori="$kategori"
                                :selectedKategori="request('kategori')"
                                :sort="request('sort', 'default')"/>
                        </div>

                    </aside>

                    <div class="grid grid-cols-2 gap-3 sm:gap-5 xl:grid-cols-4">

                        @forelse ($produk as $item)
                        <x-card-produk :produk="$item" />
                        @empty
                        <div class="col-span-full rounded-2xl border border-[#F1DCC8] bg-white px-5 py-12 text-center">

                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#FFF1E5]">
                                <i class="fa-solid fa-magnifying-glass text-2xl text-[#FF6B00]"></i>
                            </div>

                            <h3 class="mt-4 text-lg font-bold text-[#3B2115]">
                                @if (request()->filled('search'))
                                    Produk tidak ditemukan
                                @else
                                    Produk belum tersedia
                                @endif
                            </h3>

                            <p class="mx-auto mt-2 max-w-md text-sm text-[#72594B]">
                                @if (request()->filled('search'))
                                Tidak ditemukan produk yang cocok dengan pencarian
                                "{{ request('search') }}".
                                @elseif (request()->filled('kategori'))
                                Belum ada produk aktif pada kategori ini.
                                @else
                                Belum ada produk yang tersedia saat ini.
                                @endif
                            </p>

                            @if (request()->hasAny(['search', 'kategori', 'sort']))
                            <a href="{{ url()->current() }}"
                            class="mt-5 inline-flex items-center justify-center gap-2 rounded-full bg-[#FF6B00] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#E85D00]">
                                <i class="fa-solid fa-rotate-left"></i>
                                Reset Pencarian dan Filter
                            </a>
                            @endif

                        </div>
                        @endforelse

                        <div class="col-span-full mt-4 border-t border-[#F1DCC8] pt-6">

                            <div class="mb-4 flex flex-col gap-1 text-center text-xs text-[#72594B] sm:flex-row sm:items-center sm:justify-between sm:text-left">
                                <p>
                                    Menampilkan
                                    <span class="font-semibold text-[#3B2115]">
                                        {{ $produk->firstItem() ?? 0 }}–{{ $produk->lastItem() ?? 0 }}
                                    </span>
                                    dari
                                    <span class="font-semibold text-[#3B2115]">
                                        {{ $produk->total() }}
                                    </span>
                                    produk
                                </p>

                                <p>
                                    Halaman {{ $produk->currentPage() }}
                                    dari {{ $produk->lastPage() }}
                                </p>
                            </div>

                            <div class="flex justify-center">
                                {{ $produk->onEachSide(1)->links() }}
                            </div>

                        </div>

                    </div>
                    
                </div>
                
                <div id="filterBackdrop"
                    class="fixed inset-0 z-40 hidden bg-[#3B2115]/50"
                    onclick="toggleFilter()"></div>

                <div id="mobileFilter"
                    class="fixed inset-x-0 bottom-0 z-50 hidden flex-col overflow-hidden rounded-t-3xl border-t border-[#F1DCC8] bg-[#FFF9F4] shadow-2xl"
                    style="height: 70vh; height: 70dvh; transform: translateY(100%);">

                    <div class="flex shrink-0 items-center justify-between border-b border-[#F1DCC8] px-5 py-4">
                        
                        <div>
                            <p class="text-lg font-bold text-[#3B2115]">
                                Filter Produk
                            </p>
                            <p class="mt-1 text-xs text-[#72594B]">
                                Atur kategori dan urutan produk
                            </p>
                        </div>

                        <button
                            type="button"
                            onclick="toggleFilter()"
                            class="flex h-10 w-10 items-center justify-center rounded-full hover:bg-orange-100"
                            aria-label="Tutup filter">
                            <i class="fa-solid fa-xmark text-xl text-[#72594B]"></i>
                        </button>

                    </div>

                    <div id="mobileFilterContent"
                        class="min-h-0 flex-1 overflow-x-hidden overflow-y-scroll overscroll-contain p-4"
                        style="-webkit-overflow-scrolling: touch; touch-action: pan-y;">
                        <x-product-filter
                            :kategori="$kategori"
                            :selectedKategori="request('kategori')"
                            :sort="request('sort', 'default')"/>

                        <div class="h-8"></div>

                    </div>
                </div>

            </div>

        </section>

    </main>

@endsection
