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

    {{-- Produk Card --}}
    <section class="bg-white py-12 sm:py-16">
        <div class="mx-auto max-w-6xl px-6 sm:px-8 lg:px-10">

            <div class="flex items-end justify-between">
                <div>
                    <span class="text-[10px] font-semibold uppercase tracking-wider text-orange-500">
                        Produk pilihan
                    </span>

                    <h2 class="mt-1 text-lg font-bold text-[#3B2115]">
                        Produk dari Tetangga, Bukan Gudang
                    </h2>

                    <p class="mt-2 text-xs text-[#8B7162]">
                        Produk segar dan pilihan dari penjual di sekitar kamu.
                    </p>
                </div>

                <a href="#"
                   class="hidden text-xs font-semibold text-orange-600 hover:text-orange-700 sm:block">
                    Lihat Semua →
                </a>
            </div>


            <div class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-4">

                {{-- Product --}}
                <div class="overflow-hidden rounded-xl border border-[#F3E5D9] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="aspect-[4/3] overflow-hidden bg-[#FFF5EC]">
                        <img
                            src="{{ asset('storage/product-1.jpg') }}"
                            alt="Produk lokal"
                            class="h-full w-full object-cover transition duration-300 hover:scale-105"
                        >
                    </div>

                    <div class="p-3">
                        <h3 class="line-clamp-2 text-xs font-semibold text-[#3B2115]">
                            Nasi Box Rumahan
                        </h3>

                        <p class="mt-1 text-[10px] text-gray-400">
                            Bu Ani • 0.8 km
                        </p>

                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-xs font-bold text-orange-600">
                                Rp25.000
                            </span>

                            <button
                                class="flex h-7 w-7 items-center justify-center rounded-full bg-orange-500 text-white transition hover:bg-orange-600">
                                +
                            </button>
                        </div>
                    </div>

                </div>


                <div class="overflow-hidden rounded-xl border border-[#F3E5D9] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="aspect-[4/3] overflow-hidden bg-[#FFF5EC]">
                        <img
                            src="{{ asset('storage/product-2.jpg') }}"
                            alt="Produk lokal"
                            class="h-full w-full object-cover transition duration-300 hover:scale-105"
                        >
                    </div>

                    <div class="p-3">
                        <h3 class="line-clamp-2 text-xs font-semibold text-[#3B2115]">
                            Keripik Pisang Coklat
                        </h3>

                        <p class="mt-1 text-[10px] text-gray-400">
                            Kak Rina • 1.2 km
                        </p>

                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-xs font-bold text-orange-600">
                                Rp18.000
                            </span>

                            <button
                                class="flex h-7 w-7 items-center justify-center rounded-full bg-orange-500 text-white transition hover:bg-orange-600">
                                +
                            </button>
                        </div>
                    </div>

                </div>


                <div class="overflow-hidden rounded-xl border border-[#F3E5D9] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="aspect-[4/3] overflow-hidden bg-[#FFF5EC]">
                        <img
                            src="{{ asset('storage/product-3.jpg') }}"
                            alt="Produk lokal"
                            class="h-full w-full object-cover transition duration-300 hover:scale-105"
                        >
                    </div>

                    <div class="p-3">
                        <h3 class="line-clamp-2 text-xs font-semibold text-[#3B2115]">
                            Dimsum Frozen Homemade
                        </h3>

                        <p class="mt-1 text-[10px] text-gray-400">
                            Bu Sari • 1.5 km
                        </p>

                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-xs font-bold text-orange-600">
                                Rp30.000
                            </span>

                            <button
                                class="flex h-7 w-7 items-center justify-center rounded-full bg-orange-500 text-white transition hover:bg-orange-600">
                                +
                            </button>
                        </div>
                    </div>

                </div>


                <div class="overflow-hidden rounded-xl border border-[#F3E5D9] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="aspect-[4/3] overflow-hidden bg-[#FFF5EC]">
                        <img
                            src="{{ asset('storage/product-4.jpg') }}"
                            alt="Produk lokal"
                            class="h-full w-full object-cover transition duration-300 hover:scale-105"
                        >
                    </div>

                    <div class="p-3">
                        <h3 class="line-clamp-2 text-xs font-semibold text-[#3B2115]">
                            Kue Kering Rumahan
                        </h3>

                        <p class="mt-1 text-[10px] text-gray-400">
                            Pak Dedi • 2.1 km
                        </p>

                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-xs font-bold text-orange-600">
                                Rp22.000
                            </span>

                            <button
                                class="flex h-7 w-7 items-center justify-center rounded-full bg-orange-500 text-white transition hover:bg-orange-600">
                                +
                            </button>
                        </div>
                    </div>

                </div>

            </div>

            <div class="mt-6 text-center sm:hidden">
                <a href="#" class="text-xs font-semibold text-orange-600">
                    Lihat Semua Produk →
                </a>
            </div>

        </div>
    </section>
@endsection