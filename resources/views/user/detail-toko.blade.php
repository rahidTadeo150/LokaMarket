@extends('layouts.customer')

@section('title', 'Detail Toko - LokaMarket')

@section('content')
    <main class="min-h-screen bg-[#f8f4ef] text-slate-800">
        {{-- Header Toko --}}
        <section class="relative">
            {{-- Banner --}}
            <div class="h-64 md:h-72 bg-linear-to-r from-[#FFE0B2] via-[#FFC477] to-[#FFB45B]">
                <div class="mx-auto h-full px-4">
                    <button type="button"
                            onclick="history.back()"
                            class="absolute left-4 top-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-sm font-semibold text-[#3B2115] shadow-sm backdrop-blur transition hover:bg-white hover:shadow-md md:left-6">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        <span>Kembali</span>
                    </button>
                </div>
            </div>
            <div class="max-w-6xl mx-auto px-4">
                <div class="relative">
                    <div class="absolute -top-16 left-4 md:left-6">
                        <div class="h-28 w-28 md:h-32 md:w-32 overflow-hidden rounded-full border-4 border-white bg-white shadow-lg">
                            <img
                                src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=400&q=80"
                                alt="Geprek WW"
                                class="h-full w-full object-cover">
                        </div>
                    </div>
                    <div class="min-h-32 px-4 pt-4 pb-5 md:px-6">
                        <div class="ml-32 md:ml-40">
                            <h1 class="text-xl font-black tracking-tight text-[#3B2115] md:text-3xl">
                                Geprek WW
                            </h1>
                            <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-[#5D4037] md:text-sm">
                                <span class="inline-flex items-center gap-1.5">
                                    <i class="fa-solid fa-location-dot text-[#3B2115]"></i>
                                    Banyuwangi, Jawa Timur
                                </span>
                                <span class="inline-flex items-center gap-1.5">
                                    <i class="fa-solid fa-store text-[#3B2115]"></i>
                                    Bergabung 2022
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end md:-mt-1">
                            <button type="button"
                                    class="rounded-full bg-[#E85D04] px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#D94F00] hover:shadow-md">
                                <i class="fa-regular fa-comment-dots mr-1.5"></i>
                                Chat Toko
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- Tentang Toko --}}
        <section class="max-w-6xl mx-auto px-4 pb-8">
            <div class="rounded-lg bg-white border border-orange-100 shadow-sm p-5 md:p-7">
                <p class="text-2xl font-bold text-slate-800">
                    Tentang Toko
                </p>
                <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-5 text-sm text-slate-600">
                    <p class="leading-7">
                        Warung GEPREK WW menyajikan ayam geprek dengan rasa pedas,
                        kriuk, dan bumbu khas Banyuwangi. Cocok untuk pecinta makanan
                        pedas dengan cita rasa autentik.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="rounded-2xl border border-orange-100 bg-[#fffaf4] p-4">
                            <div class="flex items-center gap-2 text-[#7b3d1a] font-semibold mb-2">
                                <i class="fa-solid fa-clock"></i>
                                <span>Email</span>
                            </div>
                            <p>
                                GebrekHW@gmail.com
                            </p>
                        </div>
                        <div class="rounded-2xl border border-orange-100 bg-[#fffaf4] p-4">
                            <div class="flex items-center gap-2 text-[#7b3d1a] font-semibold mb-2">
                                <i class="fa-solid fa-phone"></i>
                                <span>Kontak</span>
                            </div>
                            <p>
                                0812-3456-7890
                            </p>
                        </div>
                        <div class="rounded-2xl border border-orange-100 bg-[#fffaf4] p-4 sm:col-span-2">
                            <div class="flex items-center gap-2 text-[#7b3d1a] font-semibold mb-2">
                                <i class="fa-solid fa-clock"></i>
                                <span>Jam Operasional</span>
                            </div>
                            <p>
                                08.00 - 20.00 WIB
                            </p>
                        </div>
                        <div class="rounded-2xl border border-orange-100 bg-[#fffaf4] p-4 sm:col-span-2">
                            <div class="flex items-center gap-2 text-[#7b3d1a] font-semibold mb-2">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>Alamat</span>
                            </div>
                            <p>
                                Jl. D. I. Panjaitan No. 45, Banyuwangi
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- Semua Produk --}}
        <section class="max-w-6xl mx-auto px-4 pb-10">
            <div class="flex items-center justify-between mb-5">
                <p class="text-2xl font-bold text-slate-800">
                    Semua Produk
                </p>
            </div>

            {{-- Produk List --}}
            <div class="grid grid-cols-2 gap-3 sm:gap-5 xl:grid-cols-4">
                <x-product-card
                    link="{{ route('cust.detailProduk') }}"
                    thumbnailImage="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=700&q=80"
                    nama="Ayam Geprek Pedas"
                    diskon="12"
                    kategori="Makanan"
                    lokasi="Banyuwangi"
                    rating="4.8"
                    reviews="96"
                    harga="18.000"/>
            </div>
        </section>
    </main>
@endsection
