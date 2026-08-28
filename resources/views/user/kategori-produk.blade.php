@extends('layouts.customer')

@section('title', 'Kategori Produk - LokaMarket')

@section('content')

    {{-- HERO --}}
    <section class="overflow-hidden bg-linear-to-br from-[#FFF3E2] to-[#FBAD51]">
        <div class="flex flex-col-reverse items-center justify-between gap-8 px-4 py-10 text-center sm:px-6 md:flex-row md:px-16 md:py-14 md:text-left">
            <div class="flex flex-col items-center gap-y-3 md:items-start">
                <span class="mb-2 flex w-fit items-center gap-1.5 rounded-full border border-orange-200 bg-white px-3 py-1 text-xs font-medium text-orange-600 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                    KATEGORI PRODUK
                </span>
                <div>
                    <p class="max-w-xl text-3xl font-bold leading-tight text-[#3B2115] sm:text-4xl lg:text-5xl">
                        Semua Kebutuhan Lokal,
                        <br>
                        Satu Genggaman
                    </p>
                    <p class="mt-4 max-w-lg text-sm leading-6 text-[#72594B] sm:text-base">
                        Jelajahi produk dari pedagang, petani, dan perajin di
                        sekitarmu — urut berdasarkan kategori supaya lebih
                        gampang ditemukan.
                    </p>
                </div>

                {{-- Search bar --}}
                <form action="{{ route('cust.kategori') }}" method="GET"
                      class="mt-6 flex w-full max-w-lg items-center gap-2 rounded-full border border-orange-100 bg-white p-2 shadow-sm sm:max-w-xl">
                    <span class="pl-3 text-orange-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari kategori atau nama produk..."
                        class="w-full border-0 bg-transparent text-sm text-[#3B2115] placeholder:text-gray-400 focus:outline-none focus:ring-0"
                    >
                    <button type="submit"
                            class="shrink-0 rounded-full bg-[#FF6B00] px-6 py-3 text-xs font-semibold text-white shadow-sm transition hover:bg-[#E85D00]">
                        Cari
                    </button>
                </form>
            </div>

            {{-- Hero image --}}
            <div class="w-full md:w-2/5">
                <img
                    src="{{ asset('storage/hero-image.png') }}"
                    alt="Kategori produk lokal"
                    class="mx-auto w-full max-w-sm object-contain"
                >
            </div>
        </div>
    </section>

    {{-- Kategori Grid --}}
    <section id="kategori" class="bg-[#FFF9F4] py-12 sm:py-16">
        <div class="px-6 lg:px-10">
            <div class="text-center">
                <p class="text-xs font-extrabold tracking-wider text-[#C1440E]">
                    JELAJAHI SEMUA
                </p>
                <p class="mt-1.5 text-2xl font-bold text-[#3A2317] sm:text-3xl">
                    Pilih Kategori yang Kamu Cari
                </p>
                <p class="mt-2 text-sm text-[#8B7162]">
                    8 kategori, ratusan UMKM lokal siap kirim hari ini.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-2 gap-3 sm:gap-4 md:grid-cols-4">

                @forelse ($kategoriList as $kategori)
                    <a href="{{ route('cust.pilihanProduk') }}"
                       class="group relative rounded-xl border border-[#F3E5D9] bg-white p-4 text-left shadow-sm transition hover:-translate-y-1 hover:shadow-md sm:p-6">

                        <span class="absolute right-4 top-4 rounded-full bg-orange-50 px-2.5 py-1 text-[10px] font-semibold text-orange-600">
                            {{ $kategori['jumlah'] }}
                        </span>

                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-orange-50 transition group-hover:bg-orange-100">
                            <i class="fa-solid {{ $kategori['icon'] }} text-2xl text-[#C1440E] lg:text-3xl"></i>
                        </div>

                        <p class="mt-4 text-base font-bold text-[#3B2115] lg:text-lg">
                            {{ $kategori['nama'] }}
                        </p>
                        <p class="mt-1 text-[11px] font-light leading-5 text-gray-400 lg:text-xs">
                            {{ $kategori['deskripsi'] }}
                        </p>
                    </a>
                @empty
                    <div class="col-span-2 py-10 text-center text-sm text-gray-400 md:col-span-4">
                        Kategori "{{ request('q') }}" tidak ditemukan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Lagi Dicari --}}
    <section class="border-y border-[#F3E5D9] bg-white py-14 sm:py-16">
        <div class="px-6 text-center">
            <p class="text-xs font-extrabold tracking-wider text-[#C1440E]">
                LAGI DICARI
            </p>
            <p class="mt-1.5 text-2xl font-bold text-[#3A2317]">
                Lagi Dicari Minggu Ini
            </p>

            <div class="mx-auto mt-8 flex max-w-3xl flex-wrap items-center justify-center gap-3">
                @foreach ($trending as $kata)
                    <a href="{{ route('cust.kategori', ['q' => $kata]) }}"
                       class="rounded-full border border-[#F3E5D9] bg-white px-5 py-2.5 text-xs font-medium text-[#3B2115] shadow-sm transition hover:border-orange-300 hover:bg-orange-50 hover:text-orange-600 sm:text-sm">
                        {{ $kata }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA: Tidak menemukan --}}
    <section class="relative overflow-hidden bg-[#EA4F0C]">
        <div class="px-6 py-14 text-center sm:py-16">
            <p class="text-2xl font-bold text-white sm:text-3xl">
                Enggak Nemu yang Kamu Cari?
            </p>
            <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-orange-100">
                Bilang saja ke tim kami, kita bantu carikan ke UMKM lokal terdekat.
            </p>
            <a href="#"
               class="mt-6 inline-flex items-center justify-center rounded-full bg-white px-10 py-3 text-xs font-bold text-[#EA4F0C] shadow-sm transition hover:bg-orange-50 hover:-translate-y-0.5">
                Hubungi Kami
            </a>
        </div>
    </section>

@endsection