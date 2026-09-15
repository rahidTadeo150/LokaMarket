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
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <div>
                        <p class="text-[10px] font-medium text-[#A08F85]">
                            Produk Disimpan
                        </p>
                        <p class="mt-1 text-lg font-extrabold text-[#3B2115]">
                            9 Produk
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-orange-100 bg-white p-4 shadow-sm sm:p-5">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                        <i class="fa-solid fa-tags"></i>
                    </div>

                    <div>
                        <p class="text-[10px] font-medium text-[#A08F85]">
                            Perkiraan Nilai
                        </p>
                        <p class="mt-1 text-lg font-extrabold text-[#3B2115]">
                            Rp365.000
                        </p>
                    </div>
                </div>
            </div>

        </section>

        <section class="mb-7 rounded-2xl border border-orange-100 bg-white p-4 shadow-sm">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex flex-wrap items-center gap-3">

                    <label class="flex cursor-pointer items-center gap-2 text-xs font-bold text-[#3B2115]">
                        <input type="checkbox"
                            class="h-4 w-4 cursor-pointer rounded border-gray-300 accent-[#FF6B00]">
                        Pilih semua
                    </label>

                    <span class="hidden h-5 w-px bg-orange-100 sm:block"></span>

                    <button type="button"
                            class="text-xs font-semibold text-red-500 transition hover:text-red-600">
                        <i class="fa-regular fa-trash-can mr-1"></i>
                        Hapus pilihan
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

                <button type="button"
                        class="shrink-0 rounded-full bg-[#EA4F0C] px-4 py-2 text-[10px] font-bold text-white shadow-sm">
                    Semua
                </button>

                <button type="button"
                        class="shrink-0 rounded-full border border-orange-100 bg-white px-4 py-2 text-[10px] font-bold text-[#72594B] transition hover:bg-orange-50">
                    Makanan & Minuman
                </button>

                <button type="button"
                        class="shrink-0 rounded-full border border-orange-100 bg-white px-4 py-2 text-[10px] font-bold text-[#72594B] transition hover:bg-orange-50">
                    Kerajinan
                </button>

                <button type="button"
                        class="shrink-0 rounded-full border border-orange-100 bg-white px-4 py-2 text-[10px] font-bold text-[#72594B] transition hover:bg-orange-50">
                    Fashion
                </button>

                <button type="button"
                        class="shrink-0 rounded-full border border-orange-100 bg-white px-4 py-2 text-[10px] font-bold text-[#72594B] transition hover:bg-orange-50">
                    Kesehatan
                </button>

                <button type="button"
                        class="shrink-0 rounded-full border border-orange-100 bg-white px-4 py-2 text-[10px] font-bold text-[#72594B] transition hover:bg-orange-50">
                    Rumah Tangga
                </button>

            </div>

        </section>

        {{-- PRODUCT GRID --}}
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">


            {{-- PRODUCT 1 --}}
            <div
                class="group relative flex flex-col overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div class="relative h-44 overflow-hidden bg-orange-100 sm:h-48">

                    {{-- IMAGE DUMMY --}}
                    <div
                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-orange-100 to-orange-200">

                        <i
                            class="fa-solid fa-bowl-food text-5xl text-orange-400">
                        </i>

                    </div>


                    {{-- CHECKBOX --}}
                    <div class="absolute left-3 top-3">

                        <input
                            type="checkbox"
                            class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">

                    </div>


                    {{-- HEART --}}
                    <button
                        type="button"
                        class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-md transition hover:scale-105">

                        <i class="fa-solid fa-heart text-sm text-[#EA4F0C]"></i>

                    </button>

                </div>


                <div class="flex flex-1 flex-col p-4">

                    <p class="text-[9px] font-bold text-orange-500">
                        Makanan & Minuman
                    </p>

                    <h3 class="mt-1 line-clamp-2 text-sm font-bold leading-5 text-[#3B2115]">
                        Nasi Pecel Bu Sri
                    </h3>

                    <p class="mt-3 text-base font-extrabold text-[#EA4F0C]">
                        Rp12.000
                    </p>

                    <p class="mt-1 text-[9px] text-[#A08F85]">
                        Dapur Bu Sri
                    </p>


                    <div
                        class="mt-auto flex items-center justify-between border-t border-dashed border-orange-100 pt-3">

                        <span class="text-[9px] text-[#A08F85]">
                            2 hari lalu
                        </span>

                        <button
                            type="button"
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-[#EA4F0C] text-white transition hover:bg-[#D4460A]">

                            <i class="fa-solid fa-cart-plus text-xs"></i>

                        </button>

                    </div>

                </div>

            </div>


            {{-- ======================================== --}}
            {{-- PRODUCT 2 --}}
            {{-- ======================================== --}}

            <div
                class="group relative flex flex-col overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div class="relative h-44 overflow-hidden bg-amber-100 sm:h-48">

                    <div
                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-amber-100 to-orange-100">

                        <i
                            class="fa-solid fa-mug-hot text-5xl text-amber-500">
                        </i>

                    </div>

                    <div class="absolute left-3 top-3">

                        <input
                            type="checkbox"
                            class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">

                    </div>

                    <button
                        type="button"
                        class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-md transition hover:scale-105">

                        <i class="fa-solid fa-heart text-sm text-[#EA4F0C]"></i>

                    </button>

                </div>


                <div class="flex flex-1 flex-col p-4">

                    <p class="text-[9px] font-bold text-orange-500">
                        Makanan & Minuman
                    </p>

                    <h3 class="mt-1 line-clamp-2 text-sm font-bold leading-5 text-[#3B2115]">
                        Kopi Tubruk Cak Man
                    </h3>

                    <p class="mt-3 text-base font-extrabold text-[#EA4F0C]">
                        Rp8.000
                    </p>

                    <p class="mt-1 text-[9px] text-[#A08F85]">
                        Kopi Cak Man
                    </p>

                    <div
                        class="mt-auto flex items-center justify-between border-t border-dashed border-orange-100 pt-3">

                        <span class="text-[9px] text-[#A08F85]">
                            5 hari lalu
                        </span>

                        <button
                            type="button"
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-[#EA4F0C] text-white transition hover:bg-[#D4460A]">

                            <i class="fa-solid fa-cart-plus text-xs"></i>

                        </button>

                    </div>

                </div>

            </div>


            {{-- ======================================== --}}
            {{-- PRODUCT 3 --}}
            {{-- ======================================== --}}

            <div
                class="group relative flex flex-col overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div class="relative h-44 overflow-hidden bg-yellow-100 sm:h-48">

                    <div
                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-yellow-100 to-orange-100">

                        <i
                            class="fa-solid fa-cookie-bite text-5xl text-yellow-600">
                        </i>

                    </div>

                    <div class="absolute left-3 top-3">

                        <input
                            type="checkbox"
                            class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">

                    </div>

                    <button
                        type="button"
                        class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-md transition hover:scale-105">

                        <i class="fa-solid fa-heart text-sm text-[#EA4F0C]"></i>

                    </button>

                    {{-- TURUN HARGA --}}
                    <span
                        class="absolute bottom-3 left-3 rounded-full bg-green-500 px-2.5 py-1 text-[8px] font-bold text-white">

                        Turun harga

                    </span>

                </div>


                <div class="flex flex-1 flex-col p-4">

                    <p class="text-[9px] font-bold text-orange-500">
                        Makanan & Minuman
                    </p>

                    <h3 class="mt-1 line-clamp-2 text-sm font-bold leading-5 text-[#3B2115]">
                        Keripik Tempe Renyah
                    </h3>

                    <p class="mt-3 text-base font-extrabold text-[#EA4F0C]">
                        Rp15.000
                    </p>

                    <p class="mt-1 text-[9px] text-[#A08F85]">
                        Oleh-Oleh Banyuwangi
                    </p>

                    <div
                        class="mt-auto flex items-center justify-between border-t border-dashed border-orange-100 pt-3">

                        <span class="text-[9px] text-[#A08F85]">
                            1 minggu lalu
                        </span>

                        <button
                            type="button"
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-[#EA4F0C] text-white transition hover:bg-[#D4460A]">

                            <i class="fa-solid fa-cart-plus text-xs"></i>

                        </button>

                    </div>

                </div>

            </div>


            {{-- ======================================== --}}
            {{-- PRODUCT 4 --}}
            {{-- ======================================== --}}

            <div
                class="group relative flex flex-col overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div class="relative h-44 overflow-hidden bg-green-100 sm:h-48">

                    <div
                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-green-100 to-lime-100">

                        <i
                            class="fa-solid fa-bag-shopping text-5xl text-green-600">
                        </i>

                    </div>

                    <div class="absolute left-3 top-3">

                        <input
                            type="checkbox"
                            class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">

                    </div>

                    <button
                        type="button"
                        class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-md transition hover:scale-105">

                        <i class="fa-solid fa-heart text-sm text-[#EA4F0C]"></i>

                    </button>

                    {{-- STOK --}}
                    <span
                        class="absolute bottom-3 left-3 rounded-full bg-[#FFF3E2] px-2.5 py-1 text-[8px] font-bold text-[#8D6B42]">

                        Stok terbatas

                    </span>

                </div>


                <div class="flex flex-1 flex-col p-4">

                    <p class="text-[9px] font-bold text-orange-500">
                        Kerajinan Tangan
                    </p>

                    <h3 class="mt-1 line-clamp-2 text-sm font-bold leading-5 text-[#3B2115]">
                        Tas Anyaman Bambu
                    </h3>

                    <p class="mt-3 text-base font-extrabold text-[#EA4F0C]">
                        Rp45.000
                    </p>

                    <p class="mt-1 text-[9px] text-[#A08F85]">
                        Kerajinan Bu Ani
                    </p>

                    <div
                        class="mt-auto flex items-center justify-between border-t border-dashed border-orange-100 pt-3">

                        <span class="text-[9px] text-[#A08F85]">
                            3 hari lalu
                        </span>

                        <button
                            type="button"
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-[#EA4F0C] text-white transition hover:bg-[#D4460A]">

                            <i class="fa-solid fa-cart-plus text-xs"></i>

                        </button>

                    </div>

                </div>

            </div>


            {{-- ======================================== --}}
            {{-- PRODUCT 5 --}}
            {{-- ======================================== --}}

            <div
                class="group relative flex flex-col overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div class="relative h-44 overflow-hidden bg-pink-100 sm:h-48">

                    <div
                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-pink-100 to-orange-100">

                        <i
                            class="fa-solid fa-shirt text-5xl text-pink-500">
                        </i>

                    </div>

                    <div class="absolute left-3 top-3">

                        <input
                            type="checkbox"
                            class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">

                    </div>

                    <button
                        type="button"
                        class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-md transition hover:scale-105">

                        <i class="fa-solid fa-heart text-sm text-[#EA4F0C]"></i>

                    </button>

                </div>


                <div class="flex flex-1 flex-col p-4">

                    <p class="text-[9px] font-bold text-orange-500">
                        Fashion
                    </p>

                    <h3 class="mt-1 line-clamp-2 text-sm font-bold leading-5 text-[#3B2115]">
                        Kaos Lokal Banyuwangi
                    </h3>

                    <p class="mt-3 text-base font-extrabold text-[#EA4F0C]">
                        Rp75.000
                    </p>

                    <p class="mt-1 text-[9px] text-[#A08F85]">
                        Banyuwangi Apparel
                    </p>

                    <div
                        class="mt-auto flex items-center justify-between border-t border-dashed border-orange-100 pt-3">

                        <span class="text-[9px] text-[#A08F85]">
                            4 hari lalu
                        </span>

                        <button
                            type="button"
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-[#EA4F0C] text-white transition hover:bg-[#D4460A]">

                            <i class="fa-solid fa-cart-plus text-xs"></i>

                        </button>

                    </div>

                </div>

            </div>


            {{-- ======================================== --}}
            {{-- PRODUCT 6 --}}
            {{-- ======================================== --}}

            <div
                class="group relative flex flex-col overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div class="relative h-44 overflow-hidden bg-blue-100 sm:h-48">

                    <div
                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-100 to-cyan-100">

                        <i
                            class="fa-solid fa-leaf text-5xl text-green-500">
                        </i>

                    </div>

                    <div class="absolute left-3 top-3">

                        <input
                            type="checkbox"
                            class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">

                    </div>

                    <button
                        type="button"
                        class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-md transition hover:scale-105">

                        <i class="fa-solid fa-heart text-sm text-[#EA4F0C]"></i>

                    </button>

                </div>


                <div class="flex flex-1 flex-col p-4">

                    <p class="text-[9px] font-bold text-orange-500">
                        Kesehatan
                    </p>

                    <h3 class="mt-1 line-clamp-2 text-sm font-bold leading-5 text-[#3B2115]">
                        Madu Murni Hutan
                    </h3>

                    <p class="mt-3 text-base font-extrabold text-[#EA4F0C]">
                        Rp55.000
                    </p>

                    <p class="mt-1 text-[9px] text-[#A08F85]">
                        Madu Alam Jember
                    </p>

                    <div
                        class="mt-auto flex items-center justify-between border-t border-dashed border-orange-100 pt-3">

                        <span class="text-[9px] text-[#A08F85]">
                            6 hari lalu
                        </span>

                        <button
                            type="button"
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-[#EA4F0C] text-white transition hover:bg-[#D4460A]">

                            <i class="fa-solid fa-cart-plus text-xs"></i>

                        </button>

                    </div>

                </div>

            </div>


            {{-- ======================================== --}}
            {{-- PRODUCT 7 --}}
            {{-- ======================================== --}}

            <div
                class="group relative flex flex-col overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div class="relative h-44 overflow-hidden bg-stone-100 sm:h-48">

                    <div
                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-stone-100 to-orange-100">

                        <i
                            class="fa-solid fa-mortar-pestle text-5xl text-stone-500">
                        </i>

                    </div>

                    <div class="absolute left-3 top-3">

                        <input
                            type="checkbox"
                            class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">

                    </div>

                    <button
                        type="button"
                        class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-md">

                        <i class="fa-solid fa-heart text-sm text-[#EA4F0C]"></i>

                    </button>

                </div>


                <div class="flex flex-1 flex-col p-4">

                    <p class="text-[9px] font-bold text-orange-500">
                        Rumah Tangga
                    </p>

                    <h3 class="mt-1 line-clamp-2 text-sm font-bold leading-5 text-[#3B2115]">
                        Sambal Cobek Tradisional
                    </h3>

                    <p class="mt-3 text-base font-extrabold text-[#EA4F0C]">
                        Rp18.000
                    </p>

                    <p class="mt-1 text-[9px] text-[#A08F85]">
                        Dapur Mbak Rina
                    </p>

                    <div
                        class="mt-auto flex items-center justify-between border-t border-dashed border-orange-100 pt-3">

                        <span class="text-[9px] text-[#A08F85]">
                            1 minggu lalu
                        </span>

                        <button
                            type="button"
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-[#EA4F0C] text-white">

                            <i class="fa-solid fa-cart-plus text-xs"></i>

                        </button>

                    </div>

                </div>

            </div>


            {{-- ======================================== --}}
            {{-- PRODUCT 8 --}}
            {{-- ======================================== --}}

            <div
                class="group relative flex flex-col overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div class="relative h-44 overflow-hidden bg-purple-100 sm:h-48">

                    <div
                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-purple-100 to-pink-100">

                        <i
                            class="fa-solid fa-gift text-5xl text-purple-500">
                        </i>

                    </div>

                    <div class="absolute left-3 top-3">

                        <input
                            type="checkbox"
                            class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">

                    </div>

                    <button
                        type="button"
                        class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-md">

                        <i class="fa-solid fa-heart text-sm text-[#EA4F0C]"></i>

                    </button>

                </div>


                <div class="flex flex-1 flex-col p-4">

                    <p class="text-[9px] font-bold text-orange-500">
                        Kerajinan Tangan
                    </p>

                    <h3 class="mt-1 line-clamp-2 text-sm font-bold leading-5 text-[#3B2115]">
                        Hampers UMKM Nusantara
                    </h3>

                    <p class="mt-3 text-base font-extrabold text-[#EA4F0C]">
                        Rp85.000
                    </p>

                    <p class="mt-1 text-[9px] text-[#A08F85]">
                        Kreasi Lokal
                    </p>

                    <div
                        class="mt-auto flex items-center justify-between border-t border-dashed border-orange-100 pt-3">

                        <span class="text-[9px] text-[#A08F85]">
                            2 minggu lalu
                        </span>

                        <button
                            type="button"
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-[#EA4F0C] text-white">

                            <i class="fa-solid fa-cart-plus text-xs"></i>

                        </button>

                    </div>

                </div>

            </div>

        </div>


        {{-- ======================================== --}}
        {{-- BOTTOM ACTION --}}
        {{-- ======================================== --}}

        <div
            class="mt-8 flex flex-col gap-3 rounded-2xl border border-orange-100 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">

            <div>

                <p class="text-sm font-bold text-[#3B2115]">
                    Sudah menemukan produk favorit?
                </p>

                <p class="mt-1 text-[10px] text-[#A08F85]">
                    Tambahkan produk pilihanmu ke keranjang dan lanjutkan belanja.
                </p>

            </div>

            <a href="#"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#EA4F0C] px-5 py-3 text-xs font-bold text-white shadow-sm transition hover:bg-[#D4460A]">
                <i class="fa-solid fa-cart-shopping"></i>
                Lihat Keranjang
            </a>

        </div>

    </div>

</main>

@endsection