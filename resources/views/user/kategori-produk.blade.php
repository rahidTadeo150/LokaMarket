@extends('layouts.customer')

@section('title', 'Kategori Produk - LokaMarket')

@section('content')
    <main>
        {{-- HERO --}}
        <section class="relative overflow-hidden bg-linear-to-br from-[#FFF3E2] to-[#FBAD51]">
            <div class="flex flex-col-reverse items-center justify-between gap-8 px-4 py-10 sm:px-6 md:flex-row md:px-16 md:py-14">
                <div class="flex min-w-0 w-full flex-col items-center gap-y-3 text-center md:w-7/12 md:items-start md:text-left">
                    <span class="mb-2 flex w-fit uppercase items-center gap-1.5 rounded-full border border-orange-200 bg-white px-3 py-1 text-xs font-medium text-orange-600 shadow-sm">
                        <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                        kategori Produk
                    </span>
                    <div>
                        <p class="max-w-xl text-3xl font-bold leading-tight text-[#3B2115] sm:text-4xl lg:text-5xl">
                            Semua Kebutuhan Lokal,
                            <br>
                            Satu Genggaman
                        </p>
                        <p class="mt-4 max-w-lg text-sm leading-6 text-[#72594B] sm:text-base">
                            Jelajahi produk dari pedagang, petani, dan perajin di
                            sekitarmu urut berdasarkan kategori supaya lebih
                            gampang ditemukan.
                        </p>
                    </div>

                    {{-- Animated Category Tags --}}
                    <div class="mt-6 w-full min-w-0 overflow-hidden">
                        <div class="relative w-full min-w-0 overflow-hidden rounded-full border border-orange-100 bg-white/50 p-2 shadow-lg">
                            
                            {{-- Fade Effect --}}
                            <div class="pointer-events-none absolute inset-y-0 left-0 z-10 w-10 bg-linear-to-r from-white/50 to-transparent"></div>
                            <div class="pointer-events-none absolute inset-y-0 right-0 z-10 w-10 bg-linear-to-l from-white/50 to-transparent"></div>

                            {{-- Kategori Looping --}}
                            <div class="flex w-max animate-kategori-slide items-center gap-2">
                                {{-- Loop Pertama --}}
                                @foreach ($kategoriList as $kategori)
                                    <a href="{{ route('cust.pilihanProduk', ['category' => $kategori['nama']]) }}"
                                        class="shrink-0 rounded-full bg-orange-50 px-4 py-2 text-xs font-semibold text-[#C1440E] transition hover:bg-orange-100">
                                        <i class="fa-solid {{ $kategori['icon'] }} mr-1.5"></i>
                                        {{ $kategori['nama'] }}
                                    </a>
                                @endforeach
                                {{-- Loop Kedua --}}
                                @foreach ($kategoriList as $kategori)
                                    <a href="{{ route('cust.pilihanProduk', ['category' => $kategori['nama']]) }}"
                                        class="shrink-0 rounded-full bg-orange-50 px-4 py-2 text-xs font-semibold text-[#C1440E] transition hover:bg-orange-100">
                                        <i class="fa-solid {{ $kategori['icon'] }} mr-1.5"></i>
                                        {{ $kategori['nama'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <p class="mt-2 text-center text-[10px] text-[#A88978]">
                            Banyak Jenis Produk Dari UMKM Lokal Untuk anda!
                        </p>
                    </div>
                </div>
                <div class="relative flex w-full justify-center md:absolute md:right-0 md:top-0 md:bottom-0 md:w-5/12 md:justify-end">
                    <img
                        src="{{ asset('storage/hero-kategori.png') }}"
                        alt="Kategori produk lokal"
                        class="h-auto w-full object-cover md:h-full md:max-h-none md:w-full md:object-cover md:object-bottom">
                </div>
            </div>
        </section>
    
        {{-- Kategori Card --}}
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
                        13 kategori, ratusan UMKM lokal siap kirim hari ini.
                    </p>
                </div>
                <div class="mt-10 grid grid-cols-2 gap-3 sm:gap-4 md:grid-cols-4">
                    @forelse ($kategoriList as $kategori)
                        <a href="{{ route('cust.pilihanProduk', ['category' => $kategori['nama']]) }}"
                            class="group relative rounded-xl border border-[#F3E5D9] bg-white p-4 text-left shadow-sm transition ease-in-out duration-600 hover:border-2 hover:border-orange-400 hover:-translate-y-1 hover:shadow-lg sm:p-6">
                            <span class="absolute right-3 top-3 rounded-full bg-orange-600 px-2.5 py-1 text-[10px] font-semibold text-white">
                                {{ $kategori['jumlah'] }} Produk
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
    
        {{-- Cust Service Banner --}}
        <section class="relative overflow-hidden bg-[#EA4F0C]">
            <div class="px-6 py-14 text-center sm:py-16">
                <p class="text-2xl font-bold text-white sm:text-3xl">
                    Tidak Menemukan yang Kamu Cari?
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
    </main>
@endsection