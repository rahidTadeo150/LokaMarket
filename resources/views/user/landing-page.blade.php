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
                class="w-full md:w-1/2 object-cover"
            >
        </div>
    </section>

    {{-- Kategori --}}
    <section class="bg-[#FFF9F4] py-12 sm:py-16">
        <div class="flex flex-col px-6 gap-y-3">
            <div class="text-center">
                <p class="text-xs font-extrabold text-[#C1440E]">
                    JELAJAHI KATEGORI
                </p>
                <p class="mt-1.5 text-2xl font-bold text-[#3A2317]">
                    Apapun jenis kebutuhanmu LokaMarket Solusinya
                </p>
            </div>

            {{-- Kategori Card --}}
            <div class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-4">
                <div class="px-10 rounded-xl border border-[#F3E5D9] bg-white p-5 flex flex-col items-center justify-center text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <div class="w-fit p-4 items-center justify-center rounded-full bg-orange-50">
                        <i class="text-2xl lg:text-3xl text-[#C1440E] fa-solid fa-bowl-food"></i>
                    </div>
                    <p class="inline-block text-sm lg:text-base font-bold text-[#3B2115]">
                        Makanan & Minuman
                    </p>
                    <p class="inline-block text-[10px] lg:text-xs font-extralight text-gray-400">
                        Masakan rumahan & minuman yang menggugah selera
                    </p>
                </div>
                <div class="px-10 rounded-xl border border-[#F3E5D9] bg-white p-5 flex flex-col items-center justify-center text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <div class="w-fit p-4 items-center justify-center rounded-full bg-orange-50">
                        <i class="text-2xl lg:text-3xl text-[#C1440E] fa-solid fa-cookie-bite"></i>
                    </div>
                    <p class="inline-block text-sm lg:text-base font-bold text-[#3B2115]">
                        Aneka Snack
                    </p>
                    <p class="inline-block text-[10px] lg:text-xs font-extralight text-gray-400">
                        Beragam jajanan dari yang berat dan ringan
                    </p>
                </div>
                <div class="px-10 rounded-xl border border-[#F3E5D9] bg-white p-5 flex flex-col items-center justify-center text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <div class="w-fit p-4 items-center justify-center rounded-full bg-orange-50">
                        <i class="text-2xl lg:text-3xl text-[#C1440E] fa-solid fa-seedling"></i>
                    </div>
                    <p class="inline-block text-sm lg:text-base font-bold text-[#3B2115]">
                        Sayur & Hasil Bumi
                    </p>
                    <p class="inline-block text-[10px] lg:text-xs font-extralight text-gray-400">
                        Segar langsung dari petani sekitar
                    </p>
                </div>
                <div class="px-10 rounded-xl border border-[#F3E5D9] bg-white p-5 flex flex-col items-center justify-center text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <div class="w-fit p-4 items-center justify-center rounded-full bg-orange-50">
                        <i class="text-2xl lg:text-3xl text-[#C1440E] fa-solid fa-scissors"></i>
                    </div>
                    <p class="inline-block text-sm lg:text-base font-bold text-[#3B2115]">
                        Kerajinan Tangan
                    </p>
                    <p class="inline-block text-[10px] lg:text-xs font-extralight text-gray-400">
                        Aneka Kerajinan Tangan Yang Unik
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection