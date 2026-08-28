@extends('layouts.customer')

@section('title', 'Landing Page - LokaMarket')

@section('content')
    <main>
        
        {{-- HERO --}}
        <section class="overflow-hidden bg-linear-to-br from-[#FFF3E2] to-[#FBAD51]">
            <div class="flex flex-col-reverse items-center justify-between gap-8 px-4 py-8 text-center sm:px-6 md:flex-row md:px-16 md:py-10 md:text-left">
                <div class="flex flex-col items-center gap-y-3 md:items-start">
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
                        <a href="{{ route('cust.caraKerja') }}"
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
                <div class="mt-8 grid grid-cols-2 gap-3 sm:gap-4 md:grid-cols-4">
                    <div class="rounded-xl border border-[#F3E5D9] bg-white p-3 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md sm:p-5">
                        <div class="w-full p-4 items-center justify-center rounded-full bg-orange-50">
                            <i class="text-2xl lg:text-3xl text-[#C1440E] fa-solid fa-bowl-food"></i>
                        </div>
                        <p class="inline-block text-sm lg:text-base font-bold text-[#3B2115]">
                            Makanan & Minuman
                        </p>
                        <p class="inline-block text-[10px] lg:text-xs font-extralight text-gray-400">
                            Masakan rumahan & minuman yang menggugah selera
                        </p>
                    </div>
                    <div class="rounded-xl border border-[#F3E5D9] bg-white p-3 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md sm:p-5">
                        <div class="w-full p-4 items-center justify-center rounded-full bg-orange-50">
                            <i class="text-2xl lg:text-3xl text-[#C1440E] fa-solid fa-cookie-bite"></i>
                        </div>
                        <p class="inline-block text-sm lg:text-base font-bold text-[#3B2115]">
                            Aneka Snack
                        </p>
                        <p class="inline-block text-[10px] lg:text-xs font-extralight text-gray-400">
                            Beragam jajanan dari yang berat dan ringan
                        </p>
                    </div>
                    <div class="rounded-xl border border-[#F3E5D9] bg-white p-3 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md sm:p-5">
                        <div class="w-full p-4 items-center justify-center rounded-full bg-orange-50">
                            <i class="text-2xl lg:text-3xl text-[#C1440E] fa-solid fa-seedling"></i>
                        </div>
                        <p class="inline-block text-sm lg:text-base font-bold text-[#3B2115]">
                            Sayur & Hasil Bumi
                        </p>
                        <p class="inline-block text-[10px] lg:text-xs font-extralight text-gray-400">
                            Segar langsung dari petani sekitar
                        </p>
                    </div>
                    <div class="rounded-xl border border-[#F3E5D9] bg-white p-3 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md sm:p-5">
                        <div class="w-full p-4 items-center justify-center rounded-full bg-orange-50">
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
            <div class="px-6 lg:px-10">
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-orange-500">
                            Produk pilihan
                        </p>
                        <p class="mt-1 text-lg font-bold text-[#3B2115]">
                            Produk Lokal Dari Penjual Lokal
                        </p>
                        <p class="mt-2 text-xs text-[#8B7162]">
                            Produk segar dan pilihan dari UMKM Lokal di sekitar kamu.
                        </p>
                    </div>
                    <a href="#"
                       class="hidden text-xs font-semibold text-orange-600 hover:text-orange-700 sm:block">
                        Lihat Semua →
                    </a>
                </div>
                <div class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-4">
    
                    {{-- Product --}}
                    <div class="group overflow-hidden h-fit rounded-xl border border-[#F3E5D9] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <div class="aspect-4/3 overflow-hidden bg-[#FFF5EC]">
                            <img
                                src="https://i.pinimg.com/736x/36/f6/6a/36f66af2ae3813adb08d3ab284dac6cd.jpg"
                                alt="Produk lokal"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                            >
                        </div>
                        <div class="px-4 py-3 text-sm md:text-base">
                                Nasi Box Rumahan
                            </p>
                            <p class="mt-1 text-[10px] md:text-xs font-light text-gray-400">
                                Bu Ani • 0.8 km
                            </p>
    
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-sm font-bold text-orange-600">
                                    Rp25.000
                                </span>
    
                                <button
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white transition hover:bg-orange-600">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="group overflow-hidden h-fit rounded-xl border border-[#F3E5D9] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <div class="aspect-4/3 overflow-hidden bg-[#FFF5EC]">
                            <img
                                src="https://i.pinimg.com/736x/36/f6/6a/36f66af2ae3813adb08d3ab284dac6cd.jpg"
                                alt="Produk lokal"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                            >
                        </div>
                        <div class="px-4 py-3 text-sm md:text-base">
                                Nasi Box Rumahan
                            </p>
                            <p class="mt-1 text-[10px] md:text-xs font-light text-gray-400">
                                Bu Ani • 0.8 km
                            </p>
    
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-sm font-bold text-orange-600">
                                    Rp25.000
                                </span>
    
                                <button
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white transition hover:bg-orange-600">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="group overflow-hidden h-fit rounded-xl border border-[#F3E5D9] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <div class="aspect-4/3 overflow-hidden bg-[#FFF5EC]">
                            <img
                                src="https://i.pinimg.com/736x/36/f6/6a/36f66af2ae3813adb08d3ab284dac6cd.jpg"
                                alt="Produk lokal"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                            >
                        </div>
                        <div class="px-4 py-3 text-sm md:text-base">
                                Nasi Box Rumahan
                            </p>
                            <p class="mt-1 text-[10px] md:text-xs font-light text-gray-400">
                                Bu Ani • 0.8 km
                            </p>
    
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-sm font-bold text-orange-600">
                                    Rp25.000
                                </span>
    
                                <button
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white transition hover:bg-orange-600">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="group overflow-hidden h-fit rounded-xl border border-[#F3E5D9] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <div class="aspect-4/3 overflow-hidden bg-[#FFF5EC]">
                            <img
                                src="https://i.pinimg.com/736x/36/f6/6a/36f66af2ae3813adb08d3ab284dac6cd.jpg"
                                alt="Produk lokal"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                            >
                        </div>
                        <div class="px-4 py-3 text-sm md:text-base">
                                Nasi Box Rumahan
                            </p>
                            <p class="mt-1 text-[10px] md:text-xs font-light text-gray-400">
                                Bu Ani • 0.8 km
                            </p>
    
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-sm font-bold text-orange-600">
                                    Rp25.000
                                </span>
    
                                <button
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white transition hover:bg-orange-600">
                                    +
                                </button>
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
    
        {{-- Testimonial Card --}}
        <section class="bg-[#FFF0DC] py-12 px-5 md:px-20 lg:px-40 sm:py-16">
            <div class="px-6 sm:px-8">
                <div class="rounded-2xl bg-white px-6 py-8 text-center shadow-sm sm:px-10">
                    <span class="text-2xl text-orange-500 font-extrabold">
                        “
                    </span>
                    <p class="mx-auto mb-2 max-w-2xl text-xs md:text-sm leading-6 text-[#72594B]">
                        Sekarang nggak perlu jauh-jauh cari makanan enak.
                        Tinggal buka LokaMarket, banyak pilihan dari tetangga
                        sendiri. Rasanya lebih dekat dan sekaligus membantu
                        usaha warga sekitar.
                    </p>
                    <span class="text-2xl text-orange-500 font-extrabold">
                        “
                    </span>
                    <div class="w-full mt-5 flex items-center justify-center gap-x-3">
                        <div class="h-10 md:h-14 w-10 md:w-14 flex items-center justify-center overflow-hidden rounded-full bg-linear-to-br from-[#F2600C] to-[#FDB813]">
                            <i class="text-sm md:text-lg font-light text-white fa-solid fa-user"></i>
                        </div>
                        <div class="flex flex-col items-start">
                            <p class="text-xs md:text-sm font-bold text-[#3B2115]">
                                Rina
                            </p>
                            <p class="text-[10px] md:text-xs font-light text-gray-400">
                                Pelanggan LokaMarket
                            </p>
                        </div>
                    </div>
    
                </div>
    
            </div>
        </section>
        <section class="relative overflow-hidden bg-[#EA4F0C]">
            <div class="px-6 py-14 text-center sm:py-16">
                <p class="text-2xl font-bold text-white sm:text-3xl">
                    Punya Usaha Lokal? Yuk Gabung!
                </p>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-orange-100">
                    Jangkau lebih banyak pelanggan di sekitar kamu
                    dan kembangkan usaha bersama LokaMarket.
                </p>
                <a href=""
                   class="mt-6 inline-flex items-center justify-center rounded-full bg-white px-10 py-3 text-xs font-bold text-[#EA4F0C] shadow-sm transition hover:bg-orange-50 hover:-translate-y-0.5">
                    Daftar Sebagai Penjual
                </a>
            </div>
        </section>
    </main>
@endsection