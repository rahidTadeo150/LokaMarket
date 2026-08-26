@extends('layouts.customer')

@section('title', 'Landing Page - LokaMarket')

@section('content')
    {{-- HERO --}}
    <section class="overflow-hidden bg-[#FFE8CC]">
        <div class="flex flex-col-reverse md:flex-row justify-between items-center px-10 md:px-16 py-20">
            <div class="flex flex-col gap-y-3">
                <span class="mb-4 w-fit rounded-full border border-orange-200 bg-white px-3 py-1 text-xs font-medium text-orange-600 shadow-sm">
                     Belanja lokal, dukung warga sekitar
                </span>
                <div>
                    <p class="max-w-xl text-3xl font-bold leading-tight text-[#3B2115] sm:text-4xl lg:text-5xl">
                        Belanja Langsung
                        <br>
                        dari Warga Sekitarmu
                    </p>
                    <p class="mt-4 max-w-lg text-sm leading-6 text-[#72594B] sm:text-base">
                        Temukan produk lokal terbaik di sekitarmu,
                        pesan dengan mudah, dan bantu UMKM berkembang
                        bersama LokaMarket.
                    </p>
                </div>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href=""
                       class="inline-flex items-center justify-center rounded-full bg-[#FF6B00] px-5 py-3 text-xs font-semibold text-white shadow-sm transition hover:bg-[#E85D00] hover:-translate-y-0.5">
                        Mulai Belanja
                    </a>
                    <a href="#cara-kerja"
                       class="inline-flex items-center justify-center rounded-full border border-orange-400 bg-white px-5 py-3 text-xs font-semibold text-[#FF6B00] transition hover:bg-orange-50">
                        Cara Kerja
                    </a>
                </div>
            </div>

            {{-- Hero image --}}
            <img
                src="{{ asset('storage/hero-image.png') }}"
                alt="Belanja produk lokal"
                class="w-full max-w-md object-contain"
            >
        </div>
    </section>

    {{-- Kategori --}}
    <section class="bg-[#FFF9F4] py-12 sm:py-16">
        <div class="mx-auto max-w-6xl px-6 sm:px-8 lg:px-10">

            <div class="text-center">
                <h2 class="text-lg font-bold text-[#3B2115]">
                    Semua Kebutuhan Lokal, Satu Tempat
                </h2>

                <p class="mt-2 text-xs text-[#8B7162]">
                    Temukan produk pilihan dari warga dan UMKM di sekitar kamu.
                </p>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-4">

                {{-- Category 1 --}}
                <a href="#"
                   class="group rounded-xl border border-[#F3E5D9] bg-white p-5 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-orange-50 text-2xl">
                        🏠
                    </div>

                    <h3 class="mt-4 text-xs font-bold text-[#3B2115]">
                        Makanan & Minuman
                    </h3>

                    <p class="mt-1 text-[10px] text-gray-400">
                        120+ produk
                    </p>
                </a>


                {{-- Category 2 --}}
                <a href="#"
                   class="group rounded-xl border border-[#F3E5D9] bg-white p-5 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-orange-50 text-2xl">
                        👜
                    </div>

                    <h3 class="mt-4 text-xs font-bold text-[#3B2115]">
                        Aneka Kerajinan
                    </h3>

                    <p class="mt-1 text-[10px] text-gray-400">
                        85+ produk
                    </p>
                </a>


                {{-- Category 3 --}}
                <a href="#"
                   class="group rounded-xl border border-[#F3E5D9] bg-white p-5 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-orange-50 text-2xl">
                        🍴
                    </div>

                    <h3 class="mt-4 text-xs font-bold text-[#3B2115]">
                        Buah & Sayur
                    </h3>

                    <p class="mt-1 text-[10px] text-gray-400">
                        60+ produk
                    </p>
                </a>


                {{-- Category 4 --}}
                <a href="#"
                   class="group rounded-xl border border-[#F3E5D9] bg-white p-5 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-orange-50 text-2xl">
                        🏡
                    </div>

                    <h3 class="mt-4 text-xs font-bold text-[#3B2115]">
                        Kebutuhan Rumah
                    </h3>

                    <p class="mt-1 text-[10px] text-gray-400">
                        90+ produk
                    </p>
                </a>

            </div>
        </div>
    </section>
@endsection